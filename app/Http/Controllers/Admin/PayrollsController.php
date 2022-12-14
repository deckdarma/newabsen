<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Exports\PayrollExport;
use App\Http\Controllers\AdminBaseController;

use App\Http\Requests\Admin\Payroll\DeleteRequest;
use App\Http\Requests\Admin\Payroll\EditRequest;
use App\Http\Requests\Admin\Payroll\ShowRequest;
use App\Http\Requests\Admin\Payroll\StoreRequest;
use App\Http\Requests\Admin\Payroll\UpdateRequest;
use App\Models\Award;
use App\Models\EmailTemplate;
use App\Models\Employee;
use App\Models\Leavetype;
use App\Models\Holiday;
use App\Models\Attendance;
use App\Models\Patokanabsen;
use App\Models\Normalabsensi;
use App\Models\Dataskor;
use App\Models\Presentabsensi;
use App\Models\Expense;
use App\Models\Payroll;
use App\Models\Salary;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PayrollsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = "Kinerja dan Kehadiran";
        $this->payrollOpen = 'active open';
        $this->payrollActive = 'active';
        $this->hrMenuActive = 'active';
    }

    public function index()
    {
        $this->employees = Employee::select('id', 'full_name', 'employeeID', 'statusmupeg')
            ->where('status', '=', 'active')
            ->where('shift', '=', '0')
			 ->where('designation', '!=', NULL)
		     	 ->orderBy('statusmupeg', 'asc')
     	 ->orderBy('order', 'desc')
            ->get();
        return View::make('admin.payrolls.index', $this->data);
    }

    // Datatable ajax request
    public function ajax_payrolls(Request $request)
    {

        $result = Employee::manager(admin()->id)
            ->join('payrolls', 'payrolls.employee_id', '=', 'employees.id')
            ->select(
                DB::raw('(@cnt := if(@cnt IS NULL, 0,  @cnt) + 1) AS s_id'),
                'payrolls.id',
                'employees.employeeID as employeeID',
                'employees.full_name',
                'employees.statusmupeg',
                'department.name',
                DB::raw('CONCAT(LPAD(payrolls.month,2, 0), "-", payrolls.year) as year'),
                'payrolls.jumlah_bersih_keseluruhan',
                'payrolls.jumlah_prestasi_kehadiran',
                'payrolls.jumlah_prestasi_kinerja',
                'payrolls.employee_id',
                'payrolls.status'
            )

			  ->where('employees.status', '=', 'active')
			  ->where('employees.shift', '=', '0') ;

        if ($request->employee_id !== 'all') {
            $result = $result->where('employees.id', $request->employee_id);
        }

        return DataTables::of($result)
            ->filterColumn('year', function ($query, $keyword) {
                $sql = "CONCAT(LPAD(payrolls.month,2, 0), \"-\", payrolls.year)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('created_at', function ($row) {
                return date('d-M-Y', strtotime($row->created_at));
            })
            ->editColumn('id', function () {
                static $row = 0;
                $row++;
                return $row;
            })
            ->editColumn('status', function ($row) {
                $color = ['paid' => 'success', 'unpaid' => 'danger'];

                return "<span id='status{$row->id}' class='label label-{$color[$row->status]}'>" .
                    trans("core." . $row->status) . "</span>";
            }) 

		
            ->editColumn('net_salary', function ($row) {
                return round($row->net_salary, 2);
            })
            ->addColumn('actions', '
              <a style="width: 75px;" class="btn purple btn-sm margin-bottom-5"  href="{{ route(\'admin.payrolls.edit\',$id)}}" ><i class="fa fa-edit"></i> {{trans("core.edit")}}</a>

               <a style="width: 75px;" href="javascript:;" onclick="del(\'{{ $id }}\');return false;" class="btn red btn-sm margin-bottom-5">
               <i class="fa fa-trash"></i> {{trans("core.btnDelete")}}</a>')
            ->editColumn('full_name', function ($row) {
				if ($row->statusmupeg == "ASN") {
             return $row->full_name. "</strong><div style=\"font-size: 11px;\">NIP: " . $row->employeeID . "</div>";
			}else {
			return $row->full_name. "</strong><div style=\"font-size: 11px;\">".$row->statusmupeg."</div>";
				
			}

		   })
			
			

            ->rawColumns(['actions', 'status', 'full_name'])
            ->make();
    }


    public function create()
    {
        $this->pageTitle = "Tambah Kinerja dan Kehadiran";
        $this->employees = Employee::manager()
            ->select('full_name', 'employees.id', 'employeeID', 'statusmupeg')
            ->where('status', '=', 'active')
            ->where('shift', '=', '0')
     	 ->orderBy('statusmupeg', 'asc')
     	 ->orderBy('order', 'desc')
			
			->get();

        return View::make('admin.payrolls.create', $this->data);
    }

    public function check()
    {
        $this->payrolls = Payroll::where('employee_id', '=', request()->get('employee_id'))
            ->where('month', '=', request()->get('month'))
            ->where('year', '=', request()->get('year'))->first();
        try {
            $this->basicSalary = Salary::where('employee_id', '=', request()->get('employee_id'))
                ->where('type', '=', 'basic')->first()->salary;
        } catch (\Exception $e) {
            $this->basicSalary = 0;
        }

        try {
            $this->hourly_rate = Salary::where('employee_id', '=', request()->get('employee_id'))
                ->where('type', '=', 'hourly_rate')->first()->salary;
        } catch (\Exception $e) {
            $this->hourly_rate = 0;
        }

        if ($this->payrolls) {
            $output['success'] = 'success';

            $output['content'] = View::make('admin.payrolls.create_edit', $this->data)->render();
        } else {
            $this->expense = Expense::selectRaw('month(purchase_date) as month,year(purchase_date) as year, sum(price) as sum,employee_id')
                ->groupBy('month', 'year', 'employee_id')->orderBy('month', 'desc')
                ->where('employee_id', '=', request()->get('employee_id'))
                ->where('status', '=', 'approved')
                ->whereRaw("month(purchase_date) ='" . request()->get('month') . "'")
                ->whereRaw("year(purchase_date) ='" . request()->get('year') . "'")->get()
                ->first();

            $this->expense = isset($this->expense->sum) ? $this->expense->sum : 0;
            $monthName = date('F', mktime(0, 0, 0, request()->get('month'), 10)); // March

            $this->awardBonus = Award::selectRaw('sum(cash_price) as sum')
                ->where('employee_id', '=', request()->get('employee_id'))
                ->where('month', '=', strtolower($monthName))
                ->where('year', '=', request()->get('year'))->first();

            $this->awardBonus = isset($this->awardBonus->sum) ? $this->awardBonus->sum : 0;
			

$this->datanama = Employee::where('id', '=', request()->get('employee_id'))
->select('employees.full_name as full_name','employees.employeeID as employeeID','employees.statusmupeg as statusmupeg','employees.id as dataid')

->get();


$this->attendanceas = Attendance::where('employee_id', '=', request()->get('employee_id'))
->leftJoin('patokanabsens', 'attendance.date', '=', 'patokanabsens.date' )

->leftJoin('normalabsensis', 'attendance.normal', '=', 'normalabsensis.normal' )
->leftJoin('leavetypes', 'attendance.leaveType', '=', 'leavetypes.singkat')
->select("attendance.date as datatanggal", 
"attendance.masuk as masuk", 
"attendance.keluar as pulang", 
"attendance.status as status", 
"attendance.leaveType as leaveType",
"leavetypes.leaveType as namaketerangan", 
"attendance.apel_pagi as apel_pagi",
"attendance.apel_sore as apel_sore",
"attendance.apel_sore as apel_sore",


			"patokanabsens.nama_event as nama_event",
			"patokanabsens.date as tanggalperiode",
			"patokanabsens.jam_masuk as jam_masuk",
			"patokanabsens.ONTIME_masuk as ONTIME_masuk",
			"patokanabsens.SKOR1_masuk as SKOR1_masuk",
			"patokanabsens.SKOR2_masuk as SKOR2_masuk",
			"patokanabsens.SKOR3_masuk as SKOR3_masuk",
			"patokanabsens.SKOR4_masuk as SKOR4_masuk",
			
			"patokanabsens.jam_pulang as jam_pulang",
			"patokanabsens.ONTIME_pulang as ONTIME_pulang",
			"patokanabsens.SKOR1_pulang as SKOR1_pulang",
			"patokanabsens.SKOR2_pulang as SKOR2_pulang",
			"patokanabsens.SKOR3_pulang as SKOR3_pulang",
			"patokanabsens.SKOR4_pulang as SKOR4_pulang",
			"patokanabsens.jam_akhir_masuk as jam_akhir_masuk",
			"patokanabsens.jam_akhir_pulang as jam_akhir_pulang",
			
			
			
			"patokanabsens.jam_masuk_jumat as jam_masuk_jumat",
			"patokanabsens.ONTIME_masuk_jumat as ONTIME_masuk_jumat",
			"patokanabsens.SKOR1_masuk_jumat as SKOR1_masuk_jumat",
			"patokanabsens.SKOR2_masuk_jumat as SKOR2_masuk_jumat",
			"patokanabsens.SKOR3_masuk_jumat as SKOR3_masuk_jumat",
			"patokanabsens.SKOR4_masuk_jumat as SKOR4_masuk_jumat",
			
			"patokanabsens.jam_pulang as jam_pulang",
			"patokanabsens.ONTIME_pulang_jumat as ONTIME_pulang_jumat",
			"patokanabsens.SKOR1_pulang_jumat as SKOR1_pulang_jumat",
			"patokanabsens.SKOR2_pulang_jumat as SKOR2_pulang_jumat",
			"patokanabsens.SKOR3_pulang_jumat as SKOR3_pulang_jumat",
			"patokanabsens.SKOR4_pulang_jumat as SKOR4_pulang_jumat",
			"patokanabsens.jam_akhir_masuk_jumat as jam_akhir_masuk_jumat",
			"patokanabsens.jam_akhir_pulang_jumat as jam_akhir_pulang_jumat",
			
			
			
			
			"normalabsensis.jam_masuk_jumat as jam_masuk_normal_jumat",
			"normalabsensis.ONTIME_masuk_jumat as ONTIME_masuk_normal_jumat",
			"normalabsensis.SKOR1_masuk_jumat as SKOR1_masuk_normal_jumat",
			"normalabsensis.SKOR2_masuk_jumat as SKOR2_masuk_normal_jumat",
			"normalabsensis.SKOR3_masuk_jumat as SKOR3_masuk_normal_jumat",
			"normalabsensis.SKOR4_masuk_jumat as SKOR4_masuk_normal_jumat",
			
			"normalabsensis.jam_pulang_jumat as jam_pulang_normal_jumat",
			"normalabsensis.ONTIME_pulang_jumat as ONTIME_pulang_normal_jumat",
			"normalabsensis.SKOR1_pulang_jumat as SKOR1_pulang_normal_jumat",
			"normalabsensis.SKOR2_pulang_jumat as SKOR2_pulang_normal_jumat",
			"normalabsensis.SKOR3_pulang_jumat as SKOR3_pulang_normal_jumat",
			"normalabsensis.SKOR4_pulang_jumat as SKOR4_pulang_normal_jumat",
			"normalabsensis.jam_akhir_masuk_jumat as jam_akhir_masuk_normal_jumat",
			"normalabsensis.jam_akhir_pulang_jumat as jam_akhir_pulang_normal_jumat",
			

			"normalabsensis.jam_masuk as jam_masuk_normal",
			"normalabsensis.ONTIME_masuk as ONTIME_masuk_normal",
			"normalabsensis.SKOR1_masuk as SKOR1_masuk_normal",
			"normalabsensis.SKOR2_masuk as SKOR2_masuk_normal",
			"normalabsensis.SKOR3_masuk as SKOR3_masuk_normal",
			"normalabsensis.SKOR4_masuk as SKOR4_masuk_normal",
			
			"normalabsensis.jam_pulang as jam_pulang_normal",
			"normalabsensis.ONTIME_pulang as ONTIME_pulang_normal",
			"normalabsensis.SKOR1_pulang as SKOR1_pulang_normal",
			"normalabsensis.SKOR2_pulang as SKOR2_pulang_normal",
			"normalabsensis.SKOR3_pulang as SKOR3_pulang_normal",
			"normalabsensis.SKOR4_pulang as SKOR4_pulang_normal",
			"normalabsensis.jam_akhir_masuk as jam_akhir_masuk_normal",
			"normalabsensis.jam_akhir_pulang as jam_akhir_pulang_normal",			

)

->where(DB::raw('MONTH(attendance.date)'), '=', date('m', mktime(0, 0, 0, request()->get('month'), 10)))
->where(DB::raw('YEAR(attendance.date)'), '=', request()->get('year'))


		-> where(function ($query) {

            $query->where('application_status', '=', 'approved')
             ->orwhere('application_status', '=', null)
             ->orwhere('status', '=', 'present')
             ->orwhere('status', '=', 'absent');
        })
	->get();		




$this->attendanceas_shift = Attendance::where('employee_id', '=', request()->get('employee_id'))
->leftJoin('patokanshiftabsens', 'attendance.date', '=', 'patokanshiftabsens.date' )

->leftJoin('normalshiftabsensis', 'attendance.normal', '=', 'normalshiftabsensis.normal' )
->leftJoin('leavetypes', 'attendance.leaveType', '=', 'leavetypes.singkat')
->select("attendance.date as datatanggal", 
"attendance.masuk as masuk", 
"attendance.keluar as pulang", 
"attendance.status as status", 
"attendance.leaveType as leaveType",
"leavetypes.leaveType as namaketerangan", 
"attendance.apel_pagi as apel_pagi",
"attendance.apel_sore as apel_sore",
"attendance.apel_sore as apel_sore",


			"patokanshiftabsens.nama_event as nama_event",
			"patokanshiftabsens.date as tanggalperiode",
			"patokanshiftabsens.jam_masuk as jam_masuk",
			"patokanshiftabsens.ONTIME_masuk as ONTIME_masuk",
			"patokanshiftabsens.SKOR1_masuk as SKOR1_masuk",
			"patokanshiftabsens.SKOR2_masuk as SKOR2_masuk",
			"patokanshiftabsens.SKOR3_masuk as SKOR3_masuk",
			"patokanshiftabsens.SKOR4_masuk as SKOR4_masuk",
			
			"patokanshiftabsens.jam_pulang as jam_pulang",
			"patokanshiftabsens.ONTIME_pulang as ONTIME_pulang",
			"patokanshiftabsens.SKOR1_pulang as SKOR1_pulang",
			"patokanshiftabsens.SKOR2_pulang as SKOR2_pulang",
			"patokanshiftabsens.SKOR3_pulang as SKOR3_pulang",
			"patokanshiftabsens.SKOR4_pulang as SKOR4_pulang",
			"patokanshiftabsens.jam_akhir_masuk as jam_akhir_masuk",
			"patokanshiftabsens.jam_akhir_pulang as jam_akhir_pulang",
			
			
			
			"patokanshiftabsens.jam_masuk_jumat as jam_masuk_jumat",
			"patokanshiftabsens.ONTIME_masuk_jumat as ONTIME_masuk_jumat",
			"patokanshiftabsens.SKOR1_masuk_jumat as SKOR1_masuk_jumat",
			"patokanshiftabsens.SKOR2_masuk_jumat as SKOR2_masuk_jumat",
			"patokanshiftabsens.SKOR3_masuk_jumat as SKOR3_masuk_jumat",
			"patokanshiftabsens.SKOR4_masuk_jumat as SKOR4_masuk_jumat",
			
			"patokanshiftabsens.jam_pulang as jam_pulang",
			"patokanshiftabsens.ONTIME_pulang_jumat as ONTIME_pulang_jumat",
			"patokanshiftabsens.SKOR1_pulang_jumat as SKOR1_pulang_jumat",
			"patokanshiftabsens.SKOR2_pulang_jumat as SKOR2_pulang_jumat",
			"patokanshiftabsens.SKOR3_pulang_jumat as SKOR3_pulang_jumat",
			"patokanshiftabsens.SKOR4_pulang_jumat as SKOR4_pulang_jumat",
			"patokanshiftabsens.jam_akhir_masuk_jumat as jam_akhir_masuk_jumat",
			"patokanshiftabsens.jam_akhir_pulang_jumat as jam_akhir_pulang_jumat",
			
			
			
			
			"normalshiftabsensis.jam_masuk_jumat as jam_masuk_normal_jumat",
			"normalshiftabsensis.ONTIME_masuk_jumat as ONTIME_masuk_normal_jumat",
			"normalshiftabsensis.SKOR1_masuk_jumat as SKOR1_masuk_normal_jumat",
			"normalshiftabsensis.SKOR2_masuk_jumat as SKOR2_masuk_normal_jumat",
			"normalshiftabsensis.SKOR3_masuk_jumat as SKOR3_masuk_normal_jumat",
			"normalshiftabsensis.SKOR4_masuk_jumat as SKOR4_masuk_normal_jumat",
			
			"normalshiftabsensis.jam_pulang_jumat as jam_pulang_normal_jumat",
			"normalshiftabsensis.ONTIME_pulang_jumat as ONTIME_pulang_normal_jumat",
			"normalshiftabsensis.SKOR1_pulang_jumat as SKOR1_pulang_normal_jumat",
			"normalshiftabsensis.SKOR2_pulang_jumat as SKOR2_pulang_normal_jumat",
			"normalshiftabsensis.SKOR3_pulang_jumat as SKOR3_pulang_normal_jumat",
			"normalshiftabsensis.SKOR4_pulang_jumat as SKOR4_pulang_normal_jumat",
			"normalshiftabsensis.jam_akhir_masuk_jumat as jam_akhir_masuk_normal_jumat",
			"normalshiftabsensis.jam_akhir_pulang_jumat as jam_akhir_pulang_normal_jumat",
			

			"normalshiftabsensis.jam_masuk as jam_masuk_normal",
			"normalshiftabsensis.ONTIME_masuk as ONTIME_masuk_normal",
			"normalshiftabsensis.SKOR1_masuk as SKOR1_masuk_normal",
			"normalshiftabsensis.SKOR2_masuk as SKOR2_masuk_normal",
			"normalshiftabsensis.SKOR3_masuk as SKOR3_masuk_normal",
			"normalshiftabsensis.SKOR4_masuk as SKOR4_masuk_normal",
			
			"normalshiftabsensis.jam_pulang as jam_pulang_normal",
			"normalshiftabsensis.ONTIME_pulang as ONTIME_pulang_normal",
			"normalshiftabsensis.SKOR1_pulang as SKOR1_pulang_normal",
			"normalshiftabsensis.SKOR2_pulang as SKOR2_pulang_normal",
			"normalshiftabsensis.SKOR3_pulang as SKOR3_pulang_normal",
			"normalshiftabsensis.SKOR4_pulang as SKOR4_pulang_normal",
			"normalshiftabsensis.jam_akhir_masuk as jam_akhir_masuk_normal",
			"normalshiftabsensis.jam_akhir_pulang as jam_akhir_pulang_normal",			

)

->where(DB::raw('MONTH(attendance.date)'), '=', date('m', mktime(0, 0, 0, request()->get('month'), 10)))
->where(DB::raw('YEAR(attendance.date)'), '=', request()->get('year'))


		-> where(function ($query) {

            $query->where('application_status', '=', 'approved')
             ->orwhere('application_status', '=', null)
             ->orwhere('status', '=', 'present')
             ->orwhere('status', '=', 'absent');
        })
	->get();		



	
			
				$this->daysInMonth = cal_days_in_month(CAL_GREGORIAN, date('m', mktime(0, 0, 0, request()->get('month'), 10)), request()->get('year'));	
			   $this->databulan =  date('m', mktime(0, 0, 0, request()->get('month'), 10));
				$this->datatahun = request()->get('year');
				
				$this->noidapegs = request()->get('employee_id');
		$this->dataskor = Dataskor::get(); 
		$this->leavetype = Leavetype::get(); 
		

	
		$this->datagols = Employee::join('golonganpegs', 'employees.golongan', '=', 'golonganpegs.id' )
		->select('golonganpegs.golonganPeg as golonganPeg','golonganpegs.potongan as potongan')
		->where('employees.id', '=', request()->get('employee_id'))
		->where('employees.statusmupeg', '=', 'ASN')
		->get();
		
		
		$this->presntasiabsen = Presentabsensi::where('id', '=', '1')
		->get();
            $output['success'] = 'fail';
            $output['content'] = View::make('admin.payrolls.create_add', $this->data)->render();
        }


        return Response::json($output, 200);
    }

    /**
     * @param StoreRequest $request
     * @return array
     */
    public function store(StoreRequest $request)
    {
        $output = [];
        $deductions = [];
        $allowances = [];
        $input = $request->all();

        // Allowances
        $i = 0;
        if (isset($input['allowanceTitle'])) {
            foreach ($input['allowanceTitle'] as $title) {
                if ($title != '') {
                    $allowances[$title] = $input['allowance'][$i];
                }
                $i++;
            }
        }
        // Deductions
        $i = 0;
        if (isset($input['deductionTitle'])) {
            foreach ($input['deductionTitle'] as $title) {
                if ($title != '') {
                    $deductions[$title] = $input['deduction'][$i];
                }
                $i++;
            }
        }

        $payroll = Payroll::firstOrCreate([
            'employee_id' => $input['employee_id'], 'month' => $input['month'],
            'year' => $input['year'],
        ]);

        $payroll->basic = $input['basic'];
        $payroll->jumlah_prestasi_kehadiran = $input['jumlah_prestasi_kehadiran'];
		 $payroll->jumlah_prestasi_kinerja = $input['jumlah_prestasi_kinerja'];
		 $payroll->total_prestasi_kinerja = $input['total_prestasi_kinerja'];
		 $payroll->pemotongan_cuti_kinerja = $input['pemotongan_cuti_kinerja'];
		 $payroll->pemotongan_hukuman_kinerja = $input['pemotongan_hukuman_kinerja'];
		 $payroll->total_pemotongan_kinerja = $input['total_pemotongan_kinerja'];
		 $payroll->pay_date = $input['pay_date'];
		 $payroll->total_bobot_kinerja = $input['total_bobot_kinerja'];
		 $payroll->tambahan_tpp_rp = $input['tambahan_tpp_rp'];
		 $payroll->pph_pegawai = $input['pph_pegawai'];
		 $payroll->nilai_tpp_kinerja = $input['nilai_tpp_kinerja'];
		 $payroll->jumlah_kotor_kinerja = $input['jumlah_kotor_kinerja'];
		 $payroll->nilai_pajak_kinerja = $input['nilai_pajak_kinerja'];
		 $payroll->jumlah_iwp = $input['jumlah_iwp'];
		 $payroll->jumlah_bersih_keseluruhan = $input['jumlah_bersih_keseluruhan'];
	
		 
		 
		 
		 
        $payroll->overtime_pay = $input['overtime_pay'];
        $payroll->allowances = json_encode($allowances);
        $payroll->deductions = json_encode($deductions);
        $payroll->total_deduction = $input['total_deduction'];
        $payroll->expense = $input['expense'];
        $payroll->total_allowance = $input['total_allowance'];
        $payroll->net_salary = $input['net_salary'];
        $payroll->status = $request->status;
        $payroll->save();

        if (isset($input['type'])) {
            return Reply::redirect(route('admin.payrolls.index'), 'messages.payrollUpdateMessage');
        }
        return Reply::redirect(route('admin.payrolls.index'), 'messages.payrollAddMessage');
    }


    /**
     * @param ShowRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(ShowRequest $request, $id)
    {
        $this->pageTitle = trans("pages.payroll.showTitle");

        $this->payroll = Payroll::findOrFail($id);
        $this->employee = $this->payroll->employee;
        $this->payslip_num = Payroll::where('payrolls.id', '<=', $id)->count();


        return View::make('admin.payrolls.show_pdf', $this->data);
    }

    /**
     * @param EditRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EditRequest $request, $id)
    {
                $this->pageTitle = "Edit Kinerja dan Kehadiran";

        $this->payroll = Payroll::find($id);

        try {
            $this->hourly_rate = Salary::where('employee_id', '=', $this->payroll->employee_id)
                ->where('type', '=', 'hourly_rate')->first()->salary;
        } catch (\Exception $e) {
            $this->hourly_rate = 0;
        }
		
		$this->datanama = Employee::where('id', '=', $this->payroll->employee_id)
->select('employees.full_name as full_name','employees.employeeID as employeeID','employees.id as dataid')
->where('employees.statusmupeg', '=', 'ASN')
->get();


$this->attendanceas = Attendance::where('employee_id', '=', $this->payroll->employee_id)
->leftJoin('patokanabsens', 'attendance.date', '=', 'patokanabsens.date' )
->leftJoin('normalabsensis', 'attendance.normal', '=', 'normalabsensis.normal' )
->leftJoin('leavetypes', 'attendance.leaveType', '=', 'leavetypes.singkat')
->select("attendance.date as datatanggal", 
"attendance.masuk as masuk", 
"attendance.keluar as pulang", 
"attendance.status as status", 
"attendance.leaveType as leaveType",
"leavetypes.leaveType as namaketerangan", 
"attendance.apel_pagi as apel_pagi",
"attendance.apel_sore as apel_sore",
"attendance.apel_sore as apel_sore",

"patokanabsens.nama_event as nama_event",
"patokanabsens.date as tanggalperiode",
"patokanabsens.jam_masuk as jam_masuk",
"patokanabsens.ONTIME_masuk as ONTIME_masuk",
"patokanabsens.SKOR1_masuk as SKOR1_masuk",
"patokanabsens.SKOR2_masuk as SKOR2_masuk",
"patokanabsens.SKOR3_masuk as SKOR3_masuk",
"patokanabsens.SKOR4_masuk as SKOR4_masuk",
"patokanabsens.jam_pulang as jam_pulang",
"patokanabsens.ONTIME_pulang as ONTIME_pulang",
"patokanabsens.SKOR1_pulang as SKOR1_pulang",
"patokanabsens.SKOR2_pulang as SKOR2_pulang",
"patokanabsens.SKOR3_pulang as SKOR3_pulang",
"patokanabsens.SKOR4_pulang as SKOR4_pulang",
"patokanabsens.jam_akhir_masuk as jam_akhir_masuk",
			"patokanabsens.jam_akhir_pulang as jam_akhir_pulang",
			
			
			
			"patokanabsens.jam_masuk_jumat as jam_masuk_jumat",
			"patokanabsens.ONTIME_masuk_jumat as ONTIME_masuk_jumat",
			"patokanabsens.SKOR1_masuk_jumat as SKOR1_masuk_jumat",
			"patokanabsens.SKOR2_masuk_jumat as SKOR2_masuk_jumat",
			"patokanabsens.SKOR3_masuk_jumat as SKOR3_masuk_jumat",
			"patokanabsens.SKOR4_masuk_jumat as SKOR4_masuk_jumat",
			
			"patokanabsens.jam_pulang as jam_pulang",
			"patokanabsens.ONTIME_pulang_jumat as ONTIME_pulang_jumat",
			"patokanabsens.SKOR1_pulang_jumat as SKOR1_pulang_jumat",
			"patokanabsens.SKOR2_pulang_jumat as SKOR2_pulang_jumat",
			"patokanabsens.SKOR3_pulang_jumat as SKOR3_pulang_jumat",
			"patokanabsens.SKOR4_pulang_jumat as SKOR4_pulang_jumat",
			"patokanabsens.jam_akhir_masuk_jumat as jam_akhir_masuk_jumat",
			"patokanabsens.jam_akhir_pulang_jumat as jam_akhir_pulang_jumat",
			
			
			
			
			"normalabsensis.jam_masuk_jumat as jam_masuk_normal_jumat",
			"normalabsensis.ONTIME_masuk_jumat as ONTIME_masuk_normal_jumat",
			"normalabsensis.SKOR1_masuk_jumat as SKOR1_masuk_normal_jumat",
			"normalabsensis.SKOR2_masuk_jumat as SKOR2_masuk_normal_jumat",
			"normalabsensis.SKOR3_masuk_jumat as SKOR3_masuk_normal_jumat",
			"normalabsensis.SKOR4_masuk_jumat as SKOR4_masuk_normal_jumat",
			
			"normalabsensis.jam_pulang_jumat as jam_pulang_normal_jumat",
			"normalabsensis.ONTIME_pulang_jumat as ONTIME_pulang_normal_jumat",
			"normalabsensis.SKOR1_pulang_jumat as SKOR1_pulang_normal_jumat",
			"normalabsensis.SKOR2_pulang_jumat as SKOR2_pulang_normal_jumat",
			"normalabsensis.SKOR3_pulang_jumat as SKOR3_pulang_normal_jumat",
			"normalabsensis.SKOR4_pulang_jumat as SKOR4_pulang_normal_jumat",
			"normalabsensis.jam_akhir_masuk_jumat as jam_akhir_masuk_normal_jumat",
			"normalabsensis.jam_akhir_pulang_jumat as jam_akhir_pulang_normal_jumat",
			
			
			
			
			
			

			"normalabsensis.jam_masuk as jam_masuk_normal",
			"normalabsensis.ONTIME_masuk as ONTIME_masuk_normal",
			"normalabsensis.SKOR1_masuk as SKOR1_masuk_normal",
			"normalabsensis.SKOR2_masuk as SKOR2_masuk_normal",
			"normalabsensis.SKOR3_masuk as SKOR3_masuk_normal",
			"normalabsensis.SKOR4_masuk as SKOR4_masuk_normal",
			
			"normalabsensis.jam_pulang as jam_pulang_normal",
			"normalabsensis.ONTIME_pulang as ONTIME_pulang_normal",
			"normalabsensis.SKOR1_pulang as SKOR1_pulang_normal",
			"normalabsensis.SKOR2_pulang as SKOR2_pulang_normal",
			"normalabsensis.SKOR3_pulang as SKOR3_pulang_normal",
			"normalabsensis.SKOR4_pulang as SKOR4_pulang_normal",
			"normalabsensis.jam_akhir_masuk as jam_akhir_masuk_normal",
			"normalabsensis.jam_akhir_pulang as jam_akhir_pulang_normal",			

)

->where(DB::raw('MONTH(attendance.date)'), '=', date('m', mktime(0, 0, 0, $this->payroll->month, 10)))
->where(DB::raw('YEAR(attendance.date)'), '=', $this->payroll->year)



		-> where(function ($query) {

            $query->where('application_status', '=', 'approved')
             ->orwhere('application_status', '=', null)
             ->orwhere('status', '=', 'present')
             ->orwhere('status', '=', 'absent');
        })
	->get();			
			
			
			
			
			
	$this->attendanceas_shift = Attendance::where('employee_id', '=', $this->payroll->employee_id)
->leftJoin('patokanshiftabsens', 'attendance.date', '=', 'patokanshiftabsens.date' )
->leftJoin('normalshiftabsensis', 'attendance.normal', '=', 'normalshiftabsensis.normal' )
->leftJoin('leavetypes', 'attendance.leaveType', '=', 'leavetypes.singkat')
->select("attendance.date as datatanggal", 
"attendance.masuk as masuk", 
"attendance.keluar as pulang", 
"attendance.status as status", 
"attendance.leaveType as leaveType",
"leavetypes.leaveType as namaketerangan", 
"attendance.apel_pagi as apel_pagi",
"attendance.apel_sore as apel_sore",
"attendance.apel_sore as apel_sore",

"patokanshiftabsens.nama_event as nama_event",
"patokanshiftabsens.date as tanggalperiode",
"patokanshiftabsens.jam_masuk as jam_masuk",
"patokanshiftabsens.ONTIME_masuk as ONTIME_masuk",
"patokanshiftabsens.SKOR1_masuk as SKOR1_masuk",
"patokanshiftabsens.SKOR2_masuk as SKOR2_masuk",
"patokanshiftabsens.SKOR3_masuk as SKOR3_masuk",
"patokanshiftabsens.SKOR4_masuk as SKOR4_masuk",
"patokanshiftabsens.jam_pulang as jam_pulang",
"patokanshiftabsens.ONTIME_pulang as ONTIME_pulang",
"patokanshiftabsens.SKOR1_pulang as SKOR1_pulang",
"patokanshiftabsens.SKOR2_pulang as SKOR2_pulang",
"patokanshiftabsens.SKOR3_pulang as SKOR3_pulang",
"patokanshiftabsens.SKOR4_pulang as SKOR4_pulang",
"patokanshiftabsens.jam_akhir_masuk as jam_akhir_masuk",
"patokanshiftabsens.jam_akhir_pulang as jam_akhir_pulang",

"patokanshiftabsens.jam_masuk_jumat as jam_masuk_jumat",
"patokanshiftabsens.ONTIME_masuk_jumat as ONTIME_masuk_jumat",
"patokanshiftabsens.SKOR1_masuk_jumat as SKOR1_masuk_jumat",
"patokanshiftabsens.SKOR2_masuk_jumat as SKOR2_masuk_jumat",
"patokanshiftabsens.SKOR3_masuk_jumat as SKOR3_masuk_jumat",
"patokanshiftabsens.SKOR4_masuk_jumat as SKOR4_masuk_jumat",

"patokanshiftabsens.jam_pulang as jam_pulang",
"patokanshiftabsens.ONTIME_pulang_jumat as ONTIME_pulang_jumat",
"patokanshiftabsens.SKOR1_pulang_jumat as SKOR1_pulang_jumat",
"patokanshiftabsens.SKOR2_pulang_jumat as SKOR2_pulang_jumat",
"patokanshiftabsens.SKOR3_pulang_jumat as SKOR3_pulang_jumat",
"patokanshiftabsens.SKOR4_pulang_jumat as SKOR4_pulang_jumat",
"patokanshiftabsens.jam_akhir_masuk_jumat as jam_akhir_masuk_jumat",
"patokanshiftabsens.jam_akhir_pulang_jumat as jam_akhir_pulang_jumat",




"normalshiftabsensis.jam_masuk_jumat as jam_masuk_normal_jumat",
"normalshiftabsensis.ONTIME_masuk_jumat as ONTIME_masuk_normal_jumat",
"normalshiftabsensis.SKOR1_masuk_jumat as SKOR1_masuk_normal_jumat",
"normalshiftabsensis.SKOR2_masuk_jumat as SKOR2_masuk_normal_jumat",
"normalshiftabsensis.SKOR3_masuk_jumat as SKOR3_masuk_normal_jumat",
"normalshiftabsensis.SKOR4_masuk_jumat as SKOR4_masuk_normal_jumat",

"normalshiftabsensis.jam_pulang_jumat as jam_pulang_normal_jumat",
"normalshiftabsensis.ONTIME_pulang_jumat as ONTIME_pulang_normal_jumat",
"normalshiftabsensis.SKOR1_pulang_jumat as SKOR1_pulang_normal_jumat",
"normalshiftabsensis.SKOR2_pulang_jumat as SKOR2_pulang_normal_jumat",
"normalshiftabsensis.SKOR3_pulang_jumat as SKOR3_pulang_normal_jumat",
"normalshiftabsensis.SKOR4_pulang_jumat as SKOR4_pulang_normal_jumat",
"normalshiftabsensis.jam_akhir_masuk_jumat as jam_akhir_masuk_normal_jumat",
"normalshiftabsensis.jam_akhir_pulang_jumat as jam_akhir_pulang_normal_jumat",







"normalshiftabsensis.jam_masuk as jam_masuk_normal",
"normalshiftabsensis.ONTIME_masuk as ONTIME_masuk_normal",
"normalshiftabsensis.SKOR1_masuk as SKOR1_masuk_normal",
"normalshiftabsensis.SKOR2_masuk as SKOR2_masuk_normal",
"normalshiftabsensis.SKOR3_masuk as SKOR3_masuk_normal",
"normalshiftabsensis.SKOR4_masuk as SKOR4_masuk_normal",

"normalshiftabsensis.jam_pulang as jam_pulang_normal",
"normalshiftabsensis.ONTIME_pulang as ONTIME_pulang_normal",
"normalshiftabsensis.SKOR1_pulang as SKOR1_pulang_normal",
"normalshiftabsensis.SKOR2_pulang as SKOR2_pulang_normal",
"normalshiftabsensis.SKOR3_pulang as SKOR3_pulang_normal",
"normalshiftabsensis.SKOR4_pulang as SKOR4_pulang_normal",
"normalshiftabsensis.jam_akhir_masuk as jam_akhir_masuk_normal",
"normalshiftabsensis.jam_akhir_pulang as jam_akhir_pulang_normal",

)

->where(DB::raw('MONTH(attendance.date)'), '=', date('m', mktime(0, 0, 0, $this->payroll->month, 10)))
->where(DB::raw('YEAR(attendance.date)'), '=', $this->payroll->year)



		-> where(function ($query) {

            $query->where('application_status', '=', 'approved')
             ->orwhere('application_status', '=', null)
             ->orwhere('status', '=', 'present')
             ->orwhere('status', '=', 'absent');
        })
	->get();		
			
			
			
			
	
				
		$this->noidapegs = $this->payroll->employee_id;
		$this->dataskor = Dataskor::get(); 
		$this->leavetype = Leavetype::get(); 
	
		$this->datagols = Employee::join('golonganpegs', 'employees.golongan', '=', 'golonganpegs.id' )
		->select('golonganpegs.golonganPeg as golonganPeg','golonganpegs.potongan as potongan','golonganpegs.potongan as potongan')
		->where('employees.id', '=', $this->payroll->employee_id)
			 ->where('employees.statusmupeg', '=', 'ASN')
		->get();
		
		
		$this->presntasiabsen = Presentabsensi::where('id', '=', '1')
		->get();
		
		$this->sallery = Salary::where('employee_id', '=', $this->payroll->employee_id)
		->select('salary.salary as gajipegawai')
		->get();
		

        return View::make('admin.payrolls.edit', $this->data);
    }

    public function downloadPdf($id)
    {
        $this->payroll = Payroll::with('employee')->findOrFail($id);
        $this->employee = $this->payroll->employee;
        $this->payslip_num = Payroll::where('payrolls.id', '<=', $id)->count();
        return \PDF::loadView("admin.payrolls.pdfview", $this->data)
            ->download($this->payroll->employee_id . "-" . date('F', mktime(0, 0, 0, $this->payroll->month, 10)) . "-" . $this->payroll->year . ".pdf");
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();
        $payroll = Payroll::findOrFail($id);

        $payroll->update($data);

        return Redirect::route('admin.payrolls.index');
    }




    public function destroy(DeleteRequest $request, $id)
    {
        Payroll::destroy($id);

              return Reply::success("messages.successDelete");
    }
}


