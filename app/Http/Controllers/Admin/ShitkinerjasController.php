<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Exports\ShitkinerjaExport;
use App\Http\Controllers\AdminBaseController;

use App\Http\Requests\Admin\Shitkinerja\DeleteRequest;
use App\Http\Requests\Admin\Shitkinerja\EditRequest;
use App\Http\Requests\Admin\Shitkinerja\ShowRequest;
use App\Http\Requests\Admin\Shitkinerja\StoreRequest;
use App\Http\Requests\Admin\Shitkinerja\UpdateRequest;
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
use App\Models\Jadwalshift;
use App\Models\Datashift;
use App\Models\Expense;
use App\Models\Shitkinerja;
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

class ShitkinerjasController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = "Kinerja dan Kehadiran";
        $this->shitkinerjaOpen = 'active open';
        $this->shitkinerjaActive = 'active';
        $this->hrMenuActive = 'active';
    }

    public function index()
    {
        $this->employees = Employee::select('id', 'full_name', 'employeeID', 'statusmupeg')
            ->where('status', '=', 'active')
            ->where('shift', '=', '1')
			 ->where('designation', '!=', NULL)
			 ->orderBy('statusmupeg', 'asc')
     	 ->orderBy('order', 'desc')
            ->get();
        return View::make('admin.shitkinerjas.index', $this->data);
    }

    // Datatable ajax request
    public function ajax_shitkinerjas(Request $request)
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
			  ->where('employees.shift', '=', '1') ;

        if ($request->employee_id !== 'all') {
            $result = $result->where('employees.id', $request->employee_id);
        }

        return DataTables::of($result)
            ->filterColumn('year', function ($query, $keyword) {
                $sql = "CONCAT(LPAD(shitkinerjas.month,2, 0), \"-\", shitkinerjas.year)  like ?";
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
              <a style="width: 75px;" class="btn purple btn-sm margin-bottom-5"  href="{{ route(\'admin.shitkinerjas.edit\',$id)}}" ><i class="fa fa-edit"></i> {{trans("core.edit")}}</a>

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
            ->where('shift', '=', '1')
     	 ->orderBy('statusmupeg', 'asc')
     	 ->orderBy('order', 'desc')
			
			->get();

        return View::make('admin.shitkinerjas.create', $this->data);
    }

    public function check()
    {
        $this->shitkinerjas = Payroll::where('employee_id', '=', request()->get('employee_id'))
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

        if ($this->shitkinerjas) {
            $output['success'] = 'success';

            $output['content'] = View::make('admin.shitkinerjas.create_edit', $this->data)->render();
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





$this->shifpagidata = Jadwalshift::where('id', '=', '1338')
->select("jadwalshifts.jam_masuk_jumat as jam_masuk_normal_jumat",
"jadwalshifts.ONTIME_masuk_jumat as ONTIME_masuk_normal_jumat",
"jadwalshifts.SKOR1_masuk_jumat as SKOR1_masuk_normal_jumat",
"jadwalshifts.SKOR2_masuk_jumat as SKOR2_masuk_normal_jumat",
"jadwalshifts.SKOR3_masuk_jumat as SKOR3_masuk_normal_jumat",
"jadwalshifts.SKOR4_masuk_jumat as SKOR4_masuk_normal_jumat",

"jadwalshifts.jam_pulang_jumat as jam_pulang_normal_jumat",
"jadwalshifts.ONTIME_pulang_jumat as ONTIME_pulang_normal_jumat",
"jadwalshifts.SKOR1_pulang_jumat as SKOR1_pulang_normal_jumat",
"jadwalshifts.SKOR2_pulang_jumat as SKOR2_pulang_normal_jumat",
"jadwalshifts.SKOR3_pulang_jumat as SKOR3_pulang_normal_jumat",
"jadwalshifts.SKOR4_pulang_jumat as SKOR4_pulang_normal_jumat",
"jadwalshifts.jam_akhir_masuk_jumat as jam_akhir_masuk_normal_jumat",
"jadwalshifts.jam_akhir_pulang_jumat as jam_akhir_pulang_normal_jumat",


"jadwalshifts.jam_masuk as jam_masuk_normal",
"jadwalshifts.ONTIME_masuk as ONTIME_masuk_normal",
"jadwalshifts.SKOR1_masuk as SKOR1_masuk_normal",
"jadwalshifts.SKOR2_masuk as SKOR2_masuk_normal",
"jadwalshifts.SKOR3_masuk as SKOR3_masuk_normal",
"jadwalshifts.SKOR4_masuk as SKOR4_masuk_normal",

"jadwalshifts.jam_pulang as jam_pulang_normal",
"jadwalshifts.ONTIME_pulang as ONTIME_pulang_normal",
"jadwalshifts.SKOR1_pulang as SKOR1_pulang_normal",
"jadwalshifts.SKOR2_pulang as SKOR2_pulang_normal",
"jadwalshifts.SKOR3_pulang as SKOR3_pulang_normal",
"jadwalshifts.SKOR4_pulang as SKOR4_pulang_normal",
"jadwalshifts.jam_akhir_masuk as jam_akhir_masuk_normal",
"jadwalshifts.jam_akhir_pulang as jam_akhir_pulang_normal",	)

->get();






$this->shifsiangdata = Jadwalshift::where('id', '=', '1427')
->select("jadwalshifts.jam_masuk_jumat as jam_masuk_normal_jumat",
"jadwalshifts.ONTIME_masuk_jumat as ONTIME_masuk_normal_jumat",
"jadwalshifts.SKOR1_masuk_jumat as SKOR1_masuk_normal_jumat",
"jadwalshifts.SKOR2_masuk_jumat as SKOR2_masuk_normal_jumat",
"jadwalshifts.SKOR3_masuk_jumat as SKOR3_masuk_normal_jumat",
"jadwalshifts.SKOR4_masuk_jumat as SKOR4_masuk_normal_jumat",

"jadwalshifts.jam_pulang_jumat as jam_pulang_normal_jumat",
"jadwalshifts.ONTIME_pulang_jumat as ONTIME_pulang_normal_jumat",
"jadwalshifts.SKOR1_pulang_jumat as SKOR1_pulang_normal_jumat",
"jadwalshifts.SKOR2_pulang_jumat as SKOR2_pulang_normal_jumat",
"jadwalshifts.SKOR3_pulang_jumat as SKOR3_pulang_normal_jumat",
"jadwalshifts.SKOR4_pulang_jumat as SKOR4_pulang_normal_jumat",
"jadwalshifts.jam_akhir_masuk_jumat as jam_akhir_masuk_normal_jumat",
"jadwalshifts.jam_akhir_pulang_jumat as jam_akhir_pulang_normal_jumat",


"jadwalshifts.jam_masuk as jam_masuk_normal",
"jadwalshifts.ONTIME_masuk as ONTIME_masuk_normal",
"jadwalshifts.SKOR1_masuk as SKOR1_masuk_normal",
"jadwalshifts.SKOR2_masuk as SKOR2_masuk_normal",
"jadwalshifts.SKOR3_masuk as SKOR3_masuk_normal",
"jadwalshifts.SKOR4_masuk as SKOR4_masuk_normal",

"jadwalshifts.jam_pulang as jam_pulang_normal",
"jadwalshifts.ONTIME_pulang as ONTIME_pulang_normal",
"jadwalshifts.SKOR1_pulang as SKOR1_pulang_normal",
"jadwalshifts.SKOR2_pulang as SKOR2_pulang_normal",
"jadwalshifts.SKOR3_pulang as SKOR3_pulang_normal",
"jadwalshifts.SKOR4_pulang as SKOR4_pulang_normal",
"jadwalshifts.jam_akhir_masuk as jam_akhir_masuk_normal",
"jadwalshifts.jam_akhir_pulang as jam_akhir_pulang_normal",	)

->get();




$this->shifmalamdata = Jadwalshift::where('id', '=', '1428')
->select("jadwalshifts.jam_masuk_jumat as jam_masuk_normal_jumat",
"jadwalshifts.ONTIME_masuk_jumat as ONTIME_masuk_normal_jumat",
"jadwalshifts.SKOR1_masuk_jumat as SKOR1_masuk_normal_jumat",
"jadwalshifts.SKOR2_masuk_jumat as SKOR2_masuk_normal_jumat",
"jadwalshifts.SKOR3_masuk_jumat as SKOR3_masuk_normal_jumat",
"jadwalshifts.SKOR4_masuk_jumat as SKOR4_masuk_normal_jumat",

"jadwalshifts.jam_pulang_jumat as jam_pulang_normal_jumat",
"jadwalshifts.ONTIME_pulang_jumat as ONTIME_pulang_normal_jumat",
"jadwalshifts.SKOR1_pulang_jumat as SKOR1_pulang_normal_jumat",
"jadwalshifts.SKOR2_pulang_jumat as SKOR2_pulang_normal_jumat",
"jadwalshifts.SKOR3_pulang_jumat as SKOR3_pulang_normal_jumat",
"jadwalshifts.SKOR4_pulang_jumat as SKOR4_pulang_normal_jumat",
"jadwalshifts.jam_akhir_masuk_jumat as jam_akhir_masuk_normal_jumat",
"jadwalshifts.jam_akhir_pulang_jumat as jam_akhir_pulang_normal_jumat",


"jadwalshifts.jam_masuk as jam_masuk_normal",
"jadwalshifts.ONTIME_masuk as ONTIME_masuk_normal",
"jadwalshifts.SKOR1_masuk as SKOR1_masuk_normal",
"jadwalshifts.SKOR2_masuk as SKOR2_masuk_normal",
"jadwalshifts.SKOR3_masuk as SKOR3_masuk_normal",
"jadwalshifts.SKOR4_masuk as SKOR4_masuk_normal",

"jadwalshifts.jam_pulang as jam_pulang_normal",
"jadwalshifts.ONTIME_pulang as ONTIME_pulang_normal",
"jadwalshifts.SKOR1_pulang as SKOR1_pulang_normal",
"jadwalshifts.SKOR2_pulang as SKOR2_pulang_normal",
"jadwalshifts.SKOR3_pulang as SKOR3_pulang_normal",
"jadwalshifts.SKOR4_pulang as SKOR4_pulang_normal",
"jadwalshifts.jam_akhir_masuk as jam_akhir_masuk_normal",
"jadwalshifts.jam_akhir_pulang as jam_akhir_pulang_normal",	)

->get();



	
$this->attendanceas22 = Attendance::where('attendance.employee_id', '=', request()->get('employee_id'))


->leftJoin('datashift', 'attendance.date', '=', 'datashift.date')
->where('datashift.status', '=', 'hadir')
->where('datashift.employee_id', '=', request()->get('employee_id'))
->select("attendance.date as datatanggal",
 "datashift.date as dateshifs", 
 "datashift.leaveType as iddateshif", 
"attendance.masuk as masuk", 
"attendance.keluar as pulang", 
"attendance.status as status", 
"attendance.leaveType as leaveType",





"attendance.apel_pagi as apel_pagi",
"attendance.apel_sore as apel_sore",
"attendance.apel_sore as apel_sore",


)

->where(DB::raw('MONTH(attendance.date)'), '=', date('m', mktime(0, 0, 0, request()->get('month'), 10)))
->where(DB::raw('YEAR(attendance.date)'), '=', request()->get('year'))




		-> where(function ($query) {

            $query->where('attendance.application_status', '=', 'approved')
             ->orwhere('attendance.application_status', '=', null)

             ->orwhere('attendance.status', '=', 'present')
             ->orwhere('attendance.status', '=', 'absent');
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
            $output['content'] = View::make('admin.shitkinerjas.create_add', $this->data)->render();
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

        $shitkinerja = Payroll::firstOrCreate([
            'employee_id' => $input['employee_id'], 'month' => $input['month'],
            'year' => $input['year'],
        ]);

        $shitkinerja->basic = $input['basic'];
        $shitkinerja->jumlah_prestasi_kehadiran = $input['jumlah_prestasi_kehadiran'];
		 $shitkinerja->jumlah_prestasi_kinerja = $input['jumlah_prestasi_kinerja'];
		 $shitkinerja->total_prestasi_kinerja = $input['total_prestasi_kinerja'];
		 $shitkinerja->pemotongan_cuti_kinerja = $input['pemotongan_cuti_kinerja'];
		 $shitkinerja->pemotongan_hukuman_kinerja = $input['pemotongan_hukuman_kinerja'];
		 $shitkinerja->total_pemotongan_kinerja = $input['total_pemotongan_kinerja'];
		 $shitkinerja->pay_date = $input['pay_date'];
		 $shitkinerja->total_bobot_kinerja = $input['total_bobot_kinerja'];
		 $shitkinerja->tambahan_tpp_rp = $input['tambahan_tpp_rp'];
		 $shitkinerja->pph_pegawai = $input['pph_pegawai'];
		 $shitkinerja->nilai_tpp_kinerja = $input['nilai_tpp_kinerja'];
		 $shitkinerja->jumlah_kotor_kinerja = $input['jumlah_kotor_kinerja'];
		 $shitkinerja->nilai_pajak_kinerja = $input['nilai_pajak_kinerja'];
		 $shitkinerja->jumlah_iwp = $input['jumlah_iwp'];
		 $shitkinerja->jumlah_bersih_keseluruhan = $input['jumlah_bersih_keseluruhan'];
	
		 
		 
		 
		 
        $shitkinerja->overtime_pay = $input['overtime_pay'];
        $shitkinerja->allowances = json_encode($allowances);
        $shitkinerja->deductions = json_encode($deductions);
        $shitkinerja->total_deduction = $input['total_deduction'];
        $shitkinerja->expense = $input['expense'];
        $shitkinerja->total_allowance = $input['total_allowance'];
        $shitkinerja->net_salary = $input['net_salary'];
        $shitkinerja->status = $request->status;
        $shitkinerja->save();

        if (isset($input['type'])) {
            return Reply::redirect(route('admin.shitkinerjas.index'), 'messages.shitkinerjaUpdateMessage');
        }
        return Reply::redirect(route('admin.shitkinerjas.index'), 'messages.shitkinerjaAddMessage');
    }


    /**
     * @param ShowRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(ShowRequest $request, $id)
    {
        $this->pageTitle = trans("pages.shitkinerja.showTitle");

        $this->shitkinerja = Payroll::findOrFail($id);
        $this->employee = $this->shitkinerja->employee;
        $this->payslip_num = Payroll::where('shitkinerjas.id', '<=', $id)->count();


        return View::make('admin.shitkinerjas.show_pdf', $this->data);
    }

    /**
     * @param EditRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EditRequest $request, $id)
    {
                $this->pageTitle = "Edit Kinerja dan Kehadiran";

        $this->shitkinerja = Payroll::find($id);

        try {
            $this->hourly_rate = Salary::where('employee_id', '=', $this->shitkinerja->employee_id)
                ->where('type', '=', 'hourly_rate')->first()->salary;
        } catch (\Exception $e) {
            $this->hourly_rate = 0;
        }
		


$this->datanama = Employee::where('id', '=', $this->shitkinerja->employee_id)
->select('employees.full_name as full_name','employees.employeeID as employeeID','employees.statusmupeg as statusmupeg','employees.id as dataid')
->get();


$this->shifpagidata = Jadwalshift::where('id', '=', '1338')
->select("jadwalshifts.jam_masuk_jumat as jam_masuk_normal_jumat",
"jadwalshifts.ONTIME_masuk_jumat as ONTIME_masuk_normal_jumat",
"jadwalshifts.SKOR1_masuk_jumat as SKOR1_masuk_normal_jumat",
"jadwalshifts.SKOR2_masuk_jumat as SKOR2_masuk_normal_jumat",
"jadwalshifts.SKOR3_masuk_jumat as SKOR3_masuk_normal_jumat",
"jadwalshifts.SKOR4_masuk_jumat as SKOR4_masuk_normal_jumat",

"jadwalshifts.jam_pulang_jumat as jam_pulang_normal_jumat",
"jadwalshifts.ONTIME_pulang_jumat as ONTIME_pulang_normal_jumat",
"jadwalshifts.SKOR1_pulang_jumat as SKOR1_pulang_normal_jumat",
"jadwalshifts.SKOR2_pulang_jumat as SKOR2_pulang_normal_jumat",
"jadwalshifts.SKOR3_pulang_jumat as SKOR3_pulang_normal_jumat",
"jadwalshifts.SKOR4_pulang_jumat as SKOR4_pulang_normal_jumat",
"jadwalshifts.jam_akhir_masuk_jumat as jam_akhir_masuk_normal_jumat",
"jadwalshifts.jam_akhir_pulang_jumat as jam_akhir_pulang_normal_jumat",


"jadwalshifts.jam_masuk as jam_masuk_normal",
"jadwalshifts.ONTIME_masuk as ONTIME_masuk_normal",
"jadwalshifts.SKOR1_masuk as SKOR1_masuk_normal",
"jadwalshifts.SKOR2_masuk as SKOR2_masuk_normal",
"jadwalshifts.SKOR3_masuk as SKOR3_masuk_normal",
"jadwalshifts.SKOR4_masuk as SKOR4_masuk_normal",

"jadwalshifts.jam_pulang as jam_pulang_normal",
"jadwalshifts.ONTIME_pulang as ONTIME_pulang_normal",
"jadwalshifts.SKOR1_pulang as SKOR1_pulang_normal",
"jadwalshifts.SKOR2_pulang as SKOR2_pulang_normal",
"jadwalshifts.SKOR3_pulang as SKOR3_pulang_normal",
"jadwalshifts.SKOR4_pulang as SKOR4_pulang_normal",
"jadwalshifts.jam_akhir_masuk as jam_akhir_masuk_normal",
"jadwalshifts.jam_akhir_pulang as jam_akhir_pulang_normal",	)

->get();






$this->shifsiangdata = Jadwalshift::where('id', '=', '1427')
->select("jadwalshifts.jam_masuk_jumat as jam_masuk_normal_jumat",
"jadwalshifts.ONTIME_masuk_jumat as ONTIME_masuk_normal_jumat",
"jadwalshifts.SKOR1_masuk_jumat as SKOR1_masuk_normal_jumat",
"jadwalshifts.SKOR2_masuk_jumat as SKOR2_masuk_normal_jumat",
"jadwalshifts.SKOR3_masuk_jumat as SKOR3_masuk_normal_jumat",
"jadwalshifts.SKOR4_masuk_jumat as SKOR4_masuk_normal_jumat",

"jadwalshifts.jam_pulang_jumat as jam_pulang_normal_jumat",
"jadwalshifts.ONTIME_pulang_jumat as ONTIME_pulang_normal_jumat",
"jadwalshifts.SKOR1_pulang_jumat as SKOR1_pulang_normal_jumat",
"jadwalshifts.SKOR2_pulang_jumat as SKOR2_pulang_normal_jumat",
"jadwalshifts.SKOR3_pulang_jumat as SKOR3_pulang_normal_jumat",
"jadwalshifts.SKOR4_pulang_jumat as SKOR4_pulang_normal_jumat",
"jadwalshifts.jam_akhir_masuk_jumat as jam_akhir_masuk_normal_jumat",
"jadwalshifts.jam_akhir_pulang_jumat as jam_akhir_pulang_normal_jumat",


"jadwalshifts.jam_masuk as jam_masuk_normal",
"jadwalshifts.ONTIME_masuk as ONTIME_masuk_normal",
"jadwalshifts.SKOR1_masuk as SKOR1_masuk_normal",
"jadwalshifts.SKOR2_masuk as SKOR2_masuk_normal",
"jadwalshifts.SKOR3_masuk as SKOR3_masuk_normal",
"jadwalshifts.SKOR4_masuk as SKOR4_masuk_normal",

"jadwalshifts.jam_pulang as jam_pulang_normal",
"jadwalshifts.ONTIME_pulang as ONTIME_pulang_normal",
"jadwalshifts.SKOR1_pulang as SKOR1_pulang_normal",
"jadwalshifts.SKOR2_pulang as SKOR2_pulang_normal",
"jadwalshifts.SKOR3_pulang as SKOR3_pulang_normal",
"jadwalshifts.SKOR4_pulang as SKOR4_pulang_normal",
"jadwalshifts.jam_akhir_masuk as jam_akhir_masuk_normal",
"jadwalshifts.jam_akhir_pulang as jam_akhir_pulang_normal",	)

->get();




$this->shifmalamdata = Jadwalshift::where('id', '=', '1428')
->select("jadwalshifts.jam_masuk_jumat as jam_masuk_normal_jumat",
"jadwalshifts.ONTIME_masuk_jumat as ONTIME_masuk_normal_jumat",
"jadwalshifts.SKOR1_masuk_jumat as SKOR1_masuk_normal_jumat",
"jadwalshifts.SKOR2_masuk_jumat as SKOR2_masuk_normal_jumat",
"jadwalshifts.SKOR3_masuk_jumat as SKOR3_masuk_normal_jumat",
"jadwalshifts.SKOR4_masuk_jumat as SKOR4_masuk_normal_jumat",

"jadwalshifts.jam_pulang_jumat as jam_pulang_normal_jumat",
"jadwalshifts.ONTIME_pulang_jumat as ONTIME_pulang_normal_jumat",
"jadwalshifts.SKOR1_pulang_jumat as SKOR1_pulang_normal_jumat",
"jadwalshifts.SKOR2_pulang_jumat as SKOR2_pulang_normal_jumat",
"jadwalshifts.SKOR3_pulang_jumat as SKOR3_pulang_normal_jumat",
"jadwalshifts.SKOR4_pulang_jumat as SKOR4_pulang_normal_jumat",
"jadwalshifts.jam_akhir_masuk_jumat as jam_akhir_masuk_normal_jumat",
"jadwalshifts.jam_akhir_pulang_jumat as jam_akhir_pulang_normal_jumat",


"jadwalshifts.jam_masuk as jam_masuk_normal",
"jadwalshifts.ONTIME_masuk as ONTIME_masuk_normal",
"jadwalshifts.SKOR1_masuk as SKOR1_masuk_normal",
"jadwalshifts.SKOR2_masuk as SKOR2_masuk_normal",
"jadwalshifts.SKOR3_masuk as SKOR3_masuk_normal",
"jadwalshifts.SKOR4_masuk as SKOR4_masuk_normal",

"jadwalshifts.jam_pulang as jam_pulang_normal",
"jadwalshifts.ONTIME_pulang as ONTIME_pulang_normal",
"jadwalshifts.SKOR1_pulang as SKOR1_pulang_normal",
"jadwalshifts.SKOR2_pulang as SKOR2_pulang_normal",
"jadwalshifts.SKOR3_pulang as SKOR3_pulang_normal",
"jadwalshifts.SKOR4_pulang as SKOR4_pulang_normal",
"jadwalshifts.jam_akhir_masuk as jam_akhir_masuk_normal",
"jadwalshifts.jam_akhir_pulang as jam_akhir_pulang_normal",	)

->get();



	
$this->attendanceas22 = Attendance::where('attendance.employee_id', '=', $this->shitkinerja->employee_id)


->leftJoin('datashift', 'attendance.date', '=', 'datashift.date')
->where('datashift.status', '=', 'hadir')
->where('datashift.employee_id', '=', $this->shitkinerja->employee_id)
->select("attendance.date as datatanggal",
 "datashift.date as dateshifs", 
 "datashift.leaveType as iddateshif", 
"attendance.masuk as masuk", 
"attendance.keluar as pulang", 
"attendance.status as status", 
"attendance.leaveType as leaveType",





"attendance.apel_pagi as apel_pagi",
"attendance.apel_sore as apel_sore",
"attendance.apel_sore as apel_sore",


)

->where(DB::raw('MONTH(attendance.date)'), '=', date('m', mktime(0, 0, 0, $this->shitkinerja->month, 10)))
->where(DB::raw('YEAR(attendance.date)'), '=', $this->shitkinerja->year)




		-> where(function ($query) {

            $query->where('attendance.application_status', '=', 'approved')
             ->orwhere('attendance.application_status', '=', null)

             ->orwhere('attendance.status', '=', 'present')
             ->orwhere('attendance.status', '=', 'absent');
        })
	->get();
			
			

				
		$this->noidapegs = $this->shitkinerja->employee_id;
		$this->dataskor = Dataskor::get(); 
		$this->leavetype = Leavetype::get(); 
	
		$this->datagols = Employee::join('golonganpegs', 'employees.golongan', '=', 'golonganpegs.id' )
		->select('golonganpegs.golonganPeg as golonganPeg','golonganpegs.potongan as potongan','golonganpegs.potongan as potongan')
		->where('employees.id', '=', $this->shitkinerja->employee_id)

		->get();
		
		
		$this->presntasiabsen = Presentabsensi::where('id', '=', '1')
		->get();
		
		$this->sallery = Salary::where('employee_id', '=', $this->shitkinerja->employee_id)
		->select('salary.salary as gajipegawai')
		->get();
		

        return View::make('admin.shitkinerjas.edit', $this->data);
    }

    public function downloadPdf($id)
    {
        $this->shitkinerja = Payroll::with('employee')->findOrFail($id);
        $this->employee = $this->shitkinerja->employee;
        $this->payslip_num = Payroll::where('shitkinerjas.id', '<=', $id)->count();
        return \PDF::loadView("admin.shitkinerjas.pdfview", $this->data)
            ->download($this->shitkinerja->employee_id . "-" . date('F', mktime(0, 0, 0, $this->shitkinerja->month, 10)) . "-" . $this->shitkinerja->year . ".pdf");
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();
        $shitkinerja = Payroll::findOrFail($id);

        $shitkinerja->update($data);

        return Redirect::route('admin.shitkinerjas.index');
    }




    public function destroy(DeleteRequest $request, $id)
    {
        Payroll::destroy($id);

              return Reply::success("Berhasil Di Hapus");
    }
}


