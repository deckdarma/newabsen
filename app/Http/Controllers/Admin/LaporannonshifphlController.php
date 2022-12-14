<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Models\Attendance;
use App\Models\Company;
use App\Models\EmailTemplate;
use App\Models\Employee;
use App\Models\Liburshift;
use App\Models\Patokanabsen;
use App\Models\Normalabsensi;
use App\Models\Payroll;
use App\Models\Dataskor;
use App\Models\Leavetype;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Attendance\UpdateRequest;
use App\Http\Requests;

/*
 * Attendance Controller of Admin Panel
 */

class  LaporannonshifphlController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->attendanceOpen = 'active';
        $this->pageTitle = trans("Laporan Pegawai");
date_default_timezone_set('Asia/Makassar'); 
        $timezones = [
            "Pacific/Pago_Pago" => "-11:00",
            "Pacific/Midway" => "-11:00",
            "Pacific/Niue" => "-11:00",
            "Pacific/Honolulu" => "-10:00",
            "Pacific/Tahiti" => "-10:00",
            "Pacific/Rarotonga" => "-10:00",
            "Pacific/Marquesas" => "-09:30",
            "America/Adak" => "-09:00",
            "Pacific/Gambier" => "-09:00",
            "America/Anchorage" => "-08:00",
            "America/Nome" => "-08:00",
            "America/Sitka" => "-08:00",
            "America/Yakutat" => "-08:00",
            "America/Metlakatla" => "-08:00",
            "America/Juneau" => "-08:00",
            "Pacific/Pitcairn" => "-08:00",
            "America/Phoenix" => "-07:00",
            "America/Creston" => "-07:00",
            "America/Dawson" => "-07:00",
            "America/Los_Angeles" => "-07:00",
            "America/Dawson_Creek" => "-07:00",
            "America/Whitehorse" => "-07:00",
            "America/Hermosillo" => "-07:00",
            "America/Fort_Nelson" => "-07:00",
            "America/Tijuana" => "-07:00",
            "America/Vancouver" => "-07:00",
            "America/Chihuahua" => "-06:00",
            "America/Cambridge_Bay" => "-06:00",
            "America/Boise" => "-06:00",
            "America/Denver" => "-06:00",
            "America/El_Salvador" => "-06:00",
            "America/Costa_Rica" => "-06:00",
            "America/Mazatlan" => "-06:00",
            "America/Ojinaga" => "-06:00",
            "America/Guatemala" => "-06:00",
            "America/Edmonton" => "-06:00",
            "America/Inuvik" => "-06:00",
            "America/Belize" => "-06:00",
            "America/Managua" => "-06:00",
            "America/Swift_Current" => "-06:00",
            "America/Regina" => "-06:00",
            "Pacific/Galapagos" => "-06:00",
            "America/Yellowknife" => "-06:00",
            "America/Tegucigalpa" => "-06:00",
            "America/Monterrey" => "-05:00",
            "America/Menominee" => "-05:00",
            "America/Bahia_Banderas" => "-05:00",
            "America/Bogota" => "-05:00",
            "America/Cancun" => "-05:00",
            "America/Merida" => "-05:00",
            "America/Chicago" => "-05:00",
            "America/Winnipeg" => "-05:00",
            "America/Eirunepe" => "-05:00",
            "America/Atikokan" => "-05:00",
            "America/Matamoros" => "-05:00",
            "Pacific/Easter" => "-05:00",
            "America/Guayaquil" => "-05:00",
            "America/Indiana/Knox" => "-05:00",
            "America/Indiana/Tell_City" => "-05:00",
            "America/Jamaica" => "-05:00",
            "America/Lima" => "-05:00",
            "America/Mexico_City" => "-05:00",
            "America/Cayman" => "-05:00",
            "America/Rainy_River" => "-05:00",
            "America/Rankin_Inlet" => "-05:00",
            "America/Rio_Branco" => "-05:00",
            "America/North_Dakota/Center" => "-05:00",
            "America/Panama" => "-05:00",
            "America/Resolute" => "-05:00",
            "America/North_Dakota/New_Salem" => "-05:00",
            "America/North_Dakota/Beulah" => "-05:00",
            "America/New_York" => "-04:00",
            "America/Puerto_Rico" => "-04:00",
            "America/Porto_Velho" => "-04:00",
            "America/Grand_Turk" => "-04:00",
            "America/Guadeloupe" => "-04:00",
            "America/Grenada" => "-04:00",
            "America/Marigot" => "-04:00",
            "America/Martinique" => "-04:00",
            "America/Port_of_Spain" => "-04:00",
            "America/Port-au-Prince" => "-04:00",
            "America/Guyana" => "-04:00",
            "America/Indiana/Indianapolis" => "-04:00",
            "America/Manaus" => "-04:00",
            "America/Havana" => "-04:00",
            "America/Tortola" => "-04:00",
            "America/Indiana/Marengo" => "-04:00",
            "America/Indiana/Petersburg" => "-04:00",
            "America/Indiana/Vevay" => "-04:00",
            "America/Indiana/Vincennes" => "-04:00",
            "America/Indiana/Winamac" => "-04:00",
            "America/Iqaluit" => "-04:00",
            "America/Kentucky/Louisville" => "-04:00",
            "America/Kentucky/Monticello" => "-04:00",
            "America/Kralendijk" => "-04:00",
            "America/La_Paz" => "-04:00",
            "America/Pangnirtung" => "-04:00",
            "America/Dominica" => "-04:00",
            "America/Nassau" => "-04:00",
            "America/Campo_Grande" => "-04:00",
            "America/Montserrat" => "-04:00",
            "America/Lower_Princes" => "-04:00",
            "America/Aruba" => "-04:00",
            "America/Asuncion" => "-04:00",
            "America/Nipigon" => "-04:00",
            "America/Barbados" => "-04:00",
            "America/St_Barthelemy" => "-04:00",
            "America/St_Kitts" => "-04:00",
            "America/Blanc-Sablon" => "-04:00",
            "America/Boa_Vista" => "-04:00",
            "America/Detroit" => "-04:00",
            "America/St_Thomas" => "-04:00",
            "America/St_Lucia" => "-04:00",
            "America/Caracas" => "-04:00",
            "America/Toronto" => "-04:00",
            "America/Antigua" => "-04:00",
            "America/St_Vincent" => "-04:00",
            "America/Anguilla" => "-04:00",
            "America/Cuiaba" => "-04:00",
            "America/Curacao" => "-04:00",
            "America/Santo_Domingo" => "-04:00",
            "America/Thunder_Bay" => "-04:00",
            "Atlantic/Stanley" => "-03:00",
            "America/Montevideo" => "-03:00",
            "America/Paramaribo" => "-03:00",
            "America/Moncton" => "-03:00",
            "America/Sao_Paulo" => "-03:00",
            "America/Thule" => "-03:00",
            "America/Santarem" => "-03:00",
            "Antarctica/Rothera" => "-03:00",
            "America/Santiago" => "-03:00",
            "America/Punta_Arenas" => "-03:00",
            "Antarctica/Palmer" => "-03:00",
            "America/Recife" => "-03:00",
            "Atlantic/Bermuda" => "-03:00",
            "America/Maceio" => "-03:00",
            "America/Argentina/Tucuman" => "-03:00",
            "America/Araguaina" => "-03:00",
            "America/Argentina/Buenos_Aires" => "-03:00",
            "America/Argentina/Catamarca" => "-03:00",
            "America/Argentina/Cordoba" => "-03:00",
            "America/Argentina/Jujuy" => "-03:00",
            "America/Argentina/Mendoza" => "-03:00",
            "America/Argentina/Rio_Gallegos" => "-03:00",
            "America/Argentina/Salta" => "-03:00",
            "America/Argentina/San_Juan" => "-03:00",
            "America/Argentina/San_Luis" => "-03:00",
            "America/Argentina/La_Rioja" => "-03:00",
            "America/Argentina/Ushuaia" => "-03:00",
            "America/Fortaleza" => "-03:00",
            "America/Halifax" => "-03:00",
            "America/Goose_Bay" => "-03:00",
            "America/Glace_Bay" => "-03:00",
            "America/Belem" => "-03:00",
            "America/Cayenne" => "-03:00",
            "America/Bahia" => "-03:00",
            "America/St_Johns" => "-02:30",
            "America/Noronha" => "-02:00",
            "America/Godthab" => "-02:00",
            "America/Miquelon" => "-02:00",
            "Atlantic/South_Georgia" => "-02:00",
            "Atlantic/Cape_Verde" => "-01:00",
            "Africa/Bissau" => "+00:00",
            "Africa/Freetown" => "+00:00",
            "Africa/Dakar" => "+00:00",
            "Africa/Conakry" => "+00:00",
            "Atlantic/Reykjavik" => "+00:00",
            "Africa/Banjul" => "+00:00",
            "Atlantic/Azores" => "+00:00",
            "Africa/Bamako" => "+00:00",
            "Africa/Accra" => "+00:00",
            "Atlantic/St_Helena" => "+00:00",
            "Africa/Lome" => "+00:00",
            "America/Scoresbysund" => "+00:00",
            "Africa/Abidjan" => "+00:00",
            "Africa/Nouakchott" => "+00:00",
            "Africa/Monrovia" => "+00:00",
            "America/Danmarkshavn" => "+00:00",
            "Africa/Ouagadougou" => "+00:00",
            "Africa/Sao_Tome" => "+00:00",
            "Europe/Dublin" => "+01:00",
            "Europe/Isle_of_Man" => "+01:00",
            "Europe/Jersey" => "+01:00",
            "Africa/Porto-Novo" => "+01:00",
            "Africa/Bangui" => "+01:00",
            "Europe/Lisbon" => "+01:00",
            "Europe/London" => "+01:00",
            "Africa/Niamey" => "+01:00",
            "Africa/Brazzaville" => "+01:00",
            "Africa/Casablanca" => "+01:00",
            "Africa/Ndjamena" => "+01:00",
            "Africa/Douala" => "+01:00",
            "Africa/El_Aaiun" => "+01:00",
            "Africa/Luanda" => "+01:00",
            "Africa/Malabo" => "+01:00",
            "Atlantic/Canary" => "+01:00",
            "Africa/Libreville" => "+01:00",
            "Africa/Lagos" => "+01:00",
            "Africa/Kinshasa" => "+01:00",
            "Atlantic/Faroe" => "+01:00",
            "Atlantic/Madeira" => "+01:00",
            "Africa/Tunis" => "+01:00",
            "Africa/Algiers" => "+01:00",
            "Europe/Guernsey" => "+01:00",
            "Europe/Paris" => "+02:00",
            "Europe/Ljubljana" => "+02:00",
            "Europe/Luxembourg" => "+02:00",
            "Europe/Madrid" => "+02:00",
            "Europe/Malta" => "+02:00",
            "Europe/Kaliningrad" => "+02:00",
            "Europe/Oslo" => "+02:00",
            "Europe/Monaco" => "+02:00",
            "Africa/Lusaka" => "+02:00",
            "Europe/Gibraltar" => "+02:00",
            "Europe/Copenhagen" => "+02:00",
            "Europe/Busingen" => "+02:00",
            "Europe/Budapest" => "+02:00",
            "Europe/Brussels" => "+02:00",
            "Europe/Bratislava" => "+02:00",
            "Europe/Prague" => "+02:00",
            "Europe/Berlin" => "+02:00",
            "Europe/Belgrade" => "+02:00",
            "Europe/Andorra" => "+02:00",
            "Europe/Amsterdam" => "+02:00",
            "Africa/Tripoli" => "+02:00",
            "Africa/Windhoek" => "+02:00",
            "Europe/Podgorica" => "+02:00",
            "Europe/Sarajevo" => "+02:00",
            "Europe/Warsaw" => "+02:00",
            "Africa/Gaborone" => "+02:00",
            "Antarctica/Troll" => "+02:00",
            "Africa/Blantyre" => "+02:00",
            "Europe/Zagreb" => "+02:00",
            "Europe/Rome" => "+02:00",
            "Africa/Bujumbura" => "+02:00",
            "Europe/Vienna" => "+02:00",
            "Africa/Cairo" => "+02:00",
            "Europe/Vatican" => "+02:00",
            "Europe/Vaduz" => "+02:00",
            "Africa/Ceuta" => "+02:00",
            "Africa/Mbabane" => "+02:00",
            "Europe/Tirane" => "+02:00",
            "Africa/Harare" => "+02:00",
            "Europe/Stockholm" => "+02:00",
            "Africa/Johannesburg" => "+02:00",
            "Europe/Skopje" => "+02:00",
            "Africa/Khartoum" => "+02:00",
            "Africa/Kigali" => "+02:00",
            "Africa/Maseru" => "+02:00",
            "Africa/Maputo" => "+02:00",
            "Africa/Lubumbashi" => "+02:00",
            "Europe/San_Marino" => "+02:00",
            "Europe/Zurich" => "+02:00",
            "Indian/Comoro" => "+03:00",
            "Europe/Athens" => "+03:00",
            "Indian/Mayotte" => "+03:00",
            "Europe/Riga" => "+03:00",
            "Europe/Bucharest" => "+03:00",
            "Europe/Chisinau" => "+03:00",
            "Europe/Zaporozhye" => "+03:00",
            "Europe/Vilnius" => "+03:00",
            "Europe/Helsinki" => "+03:00",
            "Europe/Istanbul" => "+03:00",
            "Europe/Kiev" => "+03:00",
            "Europe/Kirov" => "+03:00",
            "Europe/Uzhgorod" => "+03:00",
            "Europe/Tallinn" => "+03:00",
            "Europe/Sofia" => "+03:00",
            "Europe/Mariehamn" => "+03:00",
            "Europe/Minsk" => "+03:00",
            "Europe/Simferopol" => "+03:00",
            "Europe/Moscow" => "+03:00",
            "Indian/Antananarivo" => "+03:00",
            "Asia/Amman" => "+03:00",
            "Asia/Aden" => "+03:00",
            "Africa/Mogadishu" => "+03:00",
            "Asia/Kuwait" => "+03:00",
            "Asia/Nicosia" => "+03:00",
            "Asia/Baghdad" => "+03:00",
            "Antarctica/Syowa" => "+03:00",
            "Asia/Jerusalem" => "+03:00",
            "Asia/Bahrain" => "+03:00",
            "Asia/Gaza" => "+03:00",
            "Asia/Qatar" => "+03:00",
            "Asia/Famagusta" => "+03:00",
            "Asia/Riyadh" => "+03:00",
            "Africa/Nairobi" => "+03:00",
            "Asia/Hebron" => "+03:00",
            "Africa/Kampala" => "+03:00",
            "Asia/Damascus" => "+03:00",
            "Asia/Beirut" => "+03:00",
            "Africa/Dar_es_Salaam" => "+03:00",
            "Africa/Djibouti" => "+03:00",
            "Africa/Asmara" => "+03:00",
            "Africa/Addis_Ababa" => "+03:00",
            "Africa/Juba" => "+03:00",
            "Indian/Mauritius" => "+04:00",
            "Asia/Tbilisi" => "+04:00",
            "Europe/Saratov" => "+04:00",
            "Asia/Dubai" => "+04:00",
            "Europe/Astrakhan" => "+04:00",
            "Indian/Mahe" => "+04:00",
            "Europe/Ulyanovsk" => "+04:00",
            "Asia/Baku" => "+04:00",
            "Indian/Reunion" => "+04:00",
            "Europe/Samara" => "+04:00",
            "Asia/Muscat" => "+04:00",
            "Asia/Yerevan" => "+04:00",
            "Europe/Volgograd" => "+04:00",
            "Asia/Kabul" => "+04:30",
            "Asia/Tehran" => "+04:30",
            "Asia/Aqtobe" => "+05:00",
            "Asia/Aqtau" => "+05:00",
            "Asia/Karachi" => "+05:00",
            "Antarctica/Mawson" => "+05:00",
            "Asia/Oral" => "+05:00",
            "Asia/Tashkent" => "+05:00",
            "Indian/Kerguelen" => "+05:00",
            "Indian/Maldives" => "+05:00",
            "Asia/Atyrau" => "+05:00",
            "Asia/Qyzylorda" => "+05:00",
            "Asia/Dushanbe" => "+05:00",
            "Asia/Samarkand" => "+05:00",
            "Asia/Yekaterinburg" => "+05:00",
            "Asia/Ashgabat" => "+05:00",
            "Asia/Colombo" => "+05:30",
            "Asia/Kolkata" => "+05:30",
            "Asia/Kathmandu" => "+05:45",
            "Asia/Dhaka" => "+06:00",
            "Asia/Bishkek" => "+06:00",
            "Asia/Thimphu" => "+06:00",
            "Asia/Omsk" => "+06:00",
            "Antarctica/Vostok" => "+06:00",
            "Indian/Chagos" => "+06:00",
            "Asia/Urumqi" => "+06:00",
            "Asia/Almaty" => "+06:00",
            "Asia/Qostanay" => "+06:00",
            "Indian/Cocos" => "+06:30",
            "Asia/Yangon" => "+06:30",
            "Antarctica/Davis" => "+07:00",
            "Asia/Tomsk" => "+07:00",
            "Asia/Vientiane" => "+07:00",
            "Asia/Barnaul" => "+07:00",
            "Asia/Krasnoyarsk" => "+07:00",
            "Asia/Pontianak" => "+07:00",
            "Asia/Ho_Chi_Minh" => "+07:00",
            "Asia/Hovd" => "+07:00",
            "Asia/Phnom_Penh" => "+07:00",
            "Asia/Jakarta" => "+07:00",
            "Indian/Christmas" => "+07:00",
            "Asia/Novosibirsk" => "+07:00",
            "Asia/Novokuznetsk" => "+07:00",
            "Asia/Bangkok" => "+07:00",
            "Antarctica/Casey" => "+08:00",
            "Asia/Shanghai" => "+08:00",
            "Asia/Brunei" => "+08:00",
            "Asia/Kuala_Lumpur" => "+08:00",
            "Australia/Perth" => "+08:00",
            "Asia/Manila" => "+08:00",
            "Asia/Ulaanbaatar" => "+08:00",
            "Asia/Macau" => "+08:00",
            "Asia/Kuching" => "+08:00",
            "Asia/Makassar" => "+08:00",
            "Asia/Taipei" => "+08:00",
            "Asia/Choibalsan" => "+08:00",
            "Asia/Irkutsk" => "+08:00",
            "Asia/Hong_Kong" => "+08:00",
            "Asia/Singapore" => "+08:00",
            "Australia/Eucla" => "+08:45",
            "Asia/Chita" => "+09:00",
            "Asia/Tokyo" => "+09:00",
            "Pacific/Palau" => "+09:00",
            "Asia/Khandyga" => "+09:00",
            "Asia/Yakutsk" => "+09:00",
            "Asia/Seoul" => "+09:00",
            "Asia/Dili" => "+09:00",
            "Asia/Jayapura" => "+09:00",
            "Asia/Pyongyang" => "+09:00",
            "Australia/Adelaide" => "+09:30",
            "Australia/Darwin" => "+09:30",
            "Australia/Broken_Hill" => "+09:30",
            "Pacific/Guam" => "+10:00",
            "Pacific/Port_Moresby" => "+10:00",
            "Antarctica/DumontDUrville" => "+10:00",
            "Pacific/Chuuk" => "+10:00",
            "Australia/Currie" => "+10:00",
            "Pacific/Saipan" => "+10:00",
            "Australia/Hobart" => "+10:00",
            "Australia/Sydney" => "+10:00",
            "Australia/Lindeman" => "+10:00",
            "Australia/Melbourne" => "+10:00",
            "Asia/Ust-Nera" => "+10:00",
            "Asia/Vladivostok" => "+10:00",
            "Australia/Brisbane" => "+10:00",
            "Australia/Lord_Howe" => "+10:30",
            "Pacific/Pohnpei" => "+11:00",
            "Asia/Srednekolymsk" => "+11:00",
            "Antarctica/Macquarie" => "+11:00",
            "Asia/Sakhalin" => "+11:00",
            "Pacific/Efate" => "+11:00",
            "Pacific/Bougainville" => "+11:00",
            "Asia/Magadan" => "+11:00",
            "Pacific/Kosrae" => "+11:00",
            "Pacific/Noumea" => "+11:00",
            "Pacific/Norfolk" => "+11:00",
            "Pacific/Guadalcanal" => "+11:00",
            "Pacific/Tarawa" => "+12:00",
            "Pacific/Wake" => "+12:00",
            "Pacific/Wallis" => "+12:00",
            "Pacific/Nauru" => "+12:00",
            "Pacific/Majuro" => "+12:00",
            "Pacific/Kwajalein" => "+12:00",
            "Pacific/Funafuti" => "+12:00",
            "Pacific/Fiji" => "+12:00",
            "Pacific/Auckland" => "+12:00",
            "Antarctica/McMurdo" => "+12:00",
            "Asia/Anadyr" => "+12:00",
            "Asia/Kamchatka" => "+12:00",
            "Pacific/Chatham" => "+12:45",
            "Pacific/Fakaofo" => "+13:00",
            "Pacific/Enderbury" => "+13:00",
            "Pacific/Apia" => "+13:00",
            "Pacific/Tongatapu" => "+13:00",
            "Pacific/Kiritimati" => "+14:00",
        ];
        $this->timezones = array_flip($timezones);
    }


    /*
     * This is the view page of attendance.
     */
    public function index()
    {
        $this->viewPegawaiActive = 'active';
	     $this->pageTitle = "Laporan Pegawai (PHL)";
        /*$this->date = Carbon::now()->format('Y-m-d');

        return View::make('admin.attendances.index', $this->data);*/

        $this->attendances = Attendance::all();
        $this->viewPegawaiActive = 'active';

        $this->date = date('Y-m-d');
        $this->daysInMonth = Carbon::now()->daysInMonth;

        $this->employees = Employee::manager()
            ->select('full_name', 'employees.id','employeeID')
            ->where('statusmupeg', '=', 'PHL')
			   	->where('shift', '=', '0')
			->orderBy('statusmupeg', 'asc')
			->orderBy('order', 'desc')
            ->where('status', '=', 'active')
			->get();


        return View::make('admin.laporannonshifphl.attendance-sheet', $this->data);
    }

    /*
     * This is the view page of attendance.
     */
    public function attendanceEmployee()
    {
        $this->viewAttendanceEmployeeActive = 'active';

        $this->date = Carbon::now()->format('Y-m-d');

        return View::make('admin.laporannonshifphl.attendance-sheet', $this->data);

    }


    /**
     * @return mixed
     * This method is called when we mark the attendance and redirects to edit page.
     */


  public function create()
    {
          $this->viewPegawaiActive = 'active';
	     $this->pageTitle = "Laporan Pegawai";
        return View::make('admin.laporannonshifphl.create', $this->data);

    }



    /**
     * Display the specified attendance
     */
    public function show($id)
    {
        $this->employee = Employee::findOrFail($id);
        if ($this->employee == null) {
            return View::make('admin.errors.noaccess', $this->data);
        }

        $this->viewPegawaiActive = 'active';


        $this->attendance = Attendance::where('employee_id', '=', $id)->where(function ($query) {
            $query->where('application_status', '=', 'approved')
                ->orwhere('application_status', '=', null)
                ->orwhere('status', '=', 'present');
        })->get();

        $this->liburshifts = Liburshift::get();

        $this->employeeslist = Employee::manager()
            ->select('full_name', 'employees.id','employeeID')
            ->where('status', '=', 'active')->get();

        return View::make('admin.laporannonshifphl.show', $this->data);
    }



 





    public function filterAttendance(Request $request)
    {
		
        $employees = Employee::with(['attendance' => function($query) use($request) {
            $query->whereRaw('MONTH(date) = ?', [$request->month])->whereRaw('YEAR(date) = ?', [$request->year]);
        }]);

        if($request->employee_id == 'all') {
                $employees = $employees->get();
        } else {
            $employees = $employees->where('id', $request->employee_id)->get();
        }

        $final = [];

    $this->daysInMonth = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
   $this->databulan = $request->month;
   $this->datatahun = $request->year;
   $this->idinas = $this->company_id;
   $this->noidapegs = $request->employee_id;
       foreach($employees as $employee) {
   $this->namapegawai = $employee->full_name;
   $this->nippegawai = $employee->employeeID;

    }
   

$this->attendanceas = Attendance::where('employee_id', '=', $request->employee_id)
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

->where(DB::raw('MONTH(attendance.date)'), '=', $request->month)
->where(DB::raw('YEAR(attendance.date)'), '=', $request->year)


		-> where(function ($query) {

            $query->where('application_status', '=', 'approved')
             ->orwhere('application_status', '=', null)
             ->orwhere('status', '=', 'present')
             ->orwhere('status', '=', 'absent');
        })
	->get();
	
	
		    $this->namadinas = Company::where('id', '=', $this->company_id)->get();
     $this->liburshifts = Liburshift::get(); 
$this->leavetype = Leavetype::get(); 
$this->dataskor = Dataskor::get(); 
$this->datatpp = Payroll::where('employee_id', '=', $request->employee_id)
->where('month', '=', $request->month)
->where('year', '=', $request->year)

->get(); 

        $view = View::make('admin.laporannonshifphl.load', $this->data)->render();

        return Reply::successWithDataNew($view);
    }

  
 
}
