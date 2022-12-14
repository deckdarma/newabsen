<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;

use App\Models\Attendance2;
use App\Models\Company;
use App\Models\EmailTemplate;

use App\Models\Employee2;
use App\Models\Holiday;
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

class KehadiranadminphlController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->attendancesOpenPHL = 'active';
        $this->absMenuActive = 'active';
        $this->pageTitle = trans("Tambah Kehadiran (PHL)");
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
           $date = Carbon::now()->timezone('Asia/Makassar')->format("Y-m-d");

        $attendance_count = Attendance2::where('date', '=', $date)
            ->count();
        $employee_count = Employee2::where('status', '=', 'active')
            ->count();

        if ($employee_count == $attendance_count && ($attendance_count)>0) {
            if (!\Session::get('success')) {
                \Session::flash('success', trans("messages.attendanceAlreadyMarked"));
            }
        } else {
            \Session::forget('success');
        }

        return \Redirect::route('admin.kehadiranadminphl.edit', $date);
    }



  

    /**
     * @return mixed
     * This method is called when we mark the attendance and redirects to edit page.
     */

    public function create()
    {
        $date = Carbon::now()->timezone('Asia/Makassar')->format("Y-m-d");

        $attendance_count = Attendance2::where('date', '=', $date)
            ->count();
        $employee_count = Employee2::where('status', '=', 'active')
            ->count();

        if ($employee_count == $attendance_count && ($attendance_count)>0) {
            if (!\Session::get('success')) {
                \Session::flash('success', trans("messages.attendanceAlreadyMarked"));
            }
        } else {
            \Session::forget('success');
        }

        return \Redirect::route('admin.kehadiranadminphl.edit', $date);
    }


    
    public function edit($date_str)
    {
        $dateObj = Carbon::createFromFormat("Y-m-d", $date_str, $this->data["setting"]->timezone)->timezone('Asia/Makassar');
        $date = $dateObj->format("Y-m-d");

        $this->markAttendanceActive = 'nonactive';

        $attendanceArray = [];
        $this->attendance = Employee2::leftJoin("attendance", function ($query) use ($date) {
                $query->on("attendance.employee_id", "=", "employees.employeeID");
                $query->on("attendance.date", "=", \DB::raw('"' . $date . '"'));
            })
            ->select('employees.full_name',
                'employees.employeeID as employeeID',
                'attendance.status',
                'attendance.date',
                'attendance.leaveType',
                'attendance.halfDayType',
                'attendance.application_status',
                'attendance.applied_on',
                'attendance.clock_in',
                'attendance.clock_out',
                'attendance.clock_in_ip_address',
                'attendance.clock_out_ip_address',
                'attendance.working_from',
                'attendance.notes',
                'attendance.reason',
                'attendance.is_late'
            )
            ->where("employees.status", "active")
            ->take(5)
            ->get();

        $this->todays_holidays = Holiday::where('date', '=', $date)
            ->get()
            ->first();

        foreach ($this->attendance as $attend) {
            $attendanceArray[$attend['employeeID']] = $attend;
        }

        $this->date = $dateObj->timezone('Asia/Makassar');
        $this->attendanceArray = $attendanceArray;
        $this->leaveTypes = Attendance2::leaveTypesEmployees($this->company_id);

        $this->data["employees_count"] = Employee2::count();
        $this->officeStartTime = Carbon::createFromFormat('H:i:s', '06:00:00', 'Asia/Makassar')->timezone('Asia/Makassar')->format('H:i:s');
        $this->timeZoneLocal = 'Asia/Makassar';
        $this->officeEndTime = Carbon::createFromFormat('H:i:s', '24:00:00', 'Asia/Makassar')->timezone('Asia/Makassar')->format('H:i:s');

        return \View::make('admin.kehadiranadminphl.edit', $this->data);
    }

    /**
     * Update the specified attendance in storage.
     */
    public function update($date_str)
    {
        $date = Carbon::parse($date_str)->format("Y-m-d");

        $data = json_decode(request()->get("data"), true);
        $employeeIDs = array_keys($data);

        \DB::beginTransaction();

        // Get all employee ids for this company

        $allEmployeeIDs = Employee2::pluck("id");

        try {
            foreach ($allEmployeeIDs as $employeeID) {

                /** @var Attendance $attendance */
                $attendance = Attendance2::firstOrCreate(['employee_id' => $employeeID, 'date' => $date]);

                if (in_array($employeeID, $employeeIDs)) {

                    // If employee's leave is approved but admin marks him present, then we remove his leave and mark him present
                    if ($attendance->application_status != 'approved' || ($attendance->application_status == 'approved' && $data[$employeeID]["status"] == 'true')) {

                        // We separately set all parameters for present and absent
                        // so that previously set values are overwritten. For example,
                        // if a person was marked present for a day but then he was updated as absent
                        // then his clocking details should be null to prevent wrong calculations
                        if ($data[$employeeID]["status"] == "true") {
                            $attendance->status = "present";
                            $attendance->leaveType = null;
                            $attendance->halfDayType = null;
                            $attendance->reason = '';
                            $attendance->application_status = null;

                            $clock_in = Carbon::createFromFormat('H:i:s', $data[$employeeID]["clock_in"], admin()->company->timezone)
                                ->timezone('Asia/Makassar');
                            $clock_out = Carbon::createFromFormat('H:i:s', $data[$employeeID]["clock_out"], admin()->company->timezone)
                                ->timezone('Asia/Makassar');

                            // When admin is updating, late mark should not be according to clock in/clock out

                            if ($data[$employeeID]["late"] == "true") {
                                $attendance->is_late = 1;
                            } else {
                                $attendance->is_late = 0;
                            }

                            $attendance->clock_in = $clock_in->format('H:i:s');
                            $attendance->clock_out = $clock_out->format('H:i:s');
                            $attendance->working_from = "Office";
                            $attendance->notes = "";
                        } else {
                            $attendance->status = "absent";
                            $attendance->leaveType = $data[$employeeID]["leaveType"];
                            $attendance->halfDayType = ($data[$employeeID]["halfDay"] == 'true') ? 'yes' : 'no';
                            $attendance->reason = $data[$employeeID]["reason"];
                            $attendance->application_status = null;
                            $attendance->is_late = 0;

                            $attendance->clock_in = null;
                            $attendance->clock_out = null;
                            $attendance->working_from = "";
                            $attendance->notes = "";
                        }

                        $attendance->office_start_time = '06:00:00';
                        $attendance->office_end_time = '24:00:00';
                        $attendance->last_updated_by = admin()->id;

                        $attendance->save();
                    }
                } else {
                    if ($attendance->status != "absent") {
                        $attendance->status = "present";
                        $attendance->leaveType = null;
                        $attendance->halfDayType = null;
                        $attendance->reason = '';
                        $attendance->application_status = null;
                        $attendance->last_updated_by = admin()->id;

                        $attendance->is_late = 0;

                        $attendance->clock_in = '06:00:00';
                        $attendance->clock_out = '24:00:00';
                        $attendance->office_start_time = '06:00:00';
                        $attendance->office_end_time = '24:00:00';
                        $attendance->clock_in_ip_address = null;
                        $attendance->clock_out_ip_address = null;
                        $attendance->working_from = 'Office';
                        $attendance->notes = '';
                        $attendance->save();
                    }
                }
            }
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }

        \DB::commit();

        $this->date = Carbon::parse($date_str)->format("d M Y");

   

        return ["status" => "success",
            "message" => trans("messages.attendanceUpdateMessage", ["attendance" => date('d M Y', strtotime($date))]),
            'toastrHeading' => trans('messages.success'),
            'toastrMessage' => trans("messages.attendanceUpdateMessage", ["attendance" => date('d M Y', strtotime($date))]),
            'toastrType' => 'success',
            'action' => 'showToastr',
            'date' => $date];
    }

   

    /**
     * Remove the specified attendance from storage.
     */
    public function destroy($id)
    {
        Attendance2::destroy($id);

        return Redirect::route('admin.kehadiranadminphl.index');
    }

    /**
     *Updates the single Row Attendance
     *
     */
    public function updateAttendanceRow(UpdateRequest $request)
    {
        $input = $request->all();

        $date = Carbon::createFromFormat("d-m-Y", $input['date'])->timezone('Asia/Makassar')->format('Y-m-d');

        /** @var Attendance $attendance */
        $attendance = Attendance2::firstOrCreate(['employee_id' => request()->get('id'), 'date' => $date]);

        if ($attendance->application_status != 'approved' || ($attendance->application_status == 'approved' && $input['status'] == 'present')) {
            if ($input['status'] == 'present') {
                $attendance->status = 'present';
                $attendance->leaveType = null;
                $attendance->halfDayType = "no";

                $clock_in = Carbon::createFromFormat('H:i:s', request()->get('clock_in'))->timezone('Asia/Makassar');
                $clock_out = Carbon::createFromFormat('H:i:s', request()->get('clock_out'))->timezone('Asia/Makassar');

                $attendance->clock_in = $clock_in->format('H:i:s');
                $attendance->clock_out = $clock_out->format('H:i:s');
				        $attendance->masuk = $clock_in->format('H:i:s');
                $attendance->keluar = $clock_out->format('H:i:s');

                if ($input["is_late"] == "true") {
                    $attendance->is_late = 1;
                } else {
                    $attendance->is_late = 0;
                }

                $clock_in_ip = request()->get('clock_in_ip');
                $clock_out_ip = request()->get('clock_out_ip');
                $working_from = request()->get('work');
                $notes = request()->get('notes');

                if ($clock_in_ip != 'Not Set') {
                    $attendance->clock_in_ip_address = $clock_in_ip;
                }

                if ($clock_out_ip != 'Not Set') {
                    $attendance->clock_out_ip_address = $clock_out_ip;
                }

                $attendance->working_from = $working_from;
                $attendance->notes = $notes;
            } else {
                $attendance->status = 'absent';

                if ($input['half_day'] == 'true') {
                    $attendance->halfDayType = "yes";
                } else {
                    $attendance->halfDayType = "no";
                }

                $attendance->leaveType = request()->get('leave_type');

                $attendance->reason = $input['reason'];

                $attendance->clock_in = null;
                $attendance->clock_out = null;
				     $attendance->masuk = '00:00:00';
                $attendance->keluar = '00:00:00';
                $attendance->is_late = 0;
                $attendance->clock_in_ip_address = null;
                $attendance->clock_out_ip_address = null;
                $attendance->working_from = "";
                $attendance->notes = "";
            }

            $attendance->last_updated_by = admin()->id;
            $attendance->office_start_time = '06:00:00';
            $attendance->office_end_time = '24:00:00';

            $attendance->save();

            return [
                'status' => 'success',
                'toastrMessage' => trans('messages.successUpdate'),
                'toastrHeading' => trans('messages.success'),
                'action' => 'showToastr',
                'checkbox' => $attendance->is_late,
                'divHTML' => \View::make("admin.kehadiranadminphl.col3", ["row" => $attendance])->render()
            ];

        }
        return [
            'status' => 'fail',
            'msg' => "Failed in outer loop",
            'toastrMessage' => trans('messages.successUpdate'),
            'toastrHeading' => trans('messages.success'),
            'toastrType' => 'error',
            'action' => 'showToastr',
            'divHTML' => \View::make("admin.kehadiranadminphl.col3", ["row" => $attendance])->render()
        ];
    }


    public function ajax_attendance(Request $request)
    {
        if ($request->has('date')) {
            $date = Carbon::parse(request()->get('date'))->format('Y-m-d');
        } else {
            $date = Carbon::now()->format('Y-m-d');
        }
        $leaveTypes = Leavetype::get();
	
        $result = Employee2::leftJoin("attendance", function ($query) use ($date) {
                $query->on("attendance.employee_id", "=", "employees.id");
                $query->on("attendance.date", "=", \DB::raw('"' . $date . '"'));
            })
			 ->leftJoin('leavetypes', 'attendance.leaveType', '=', 'leavetypes.singkat', )
			
		
       	
            ->select('employees.full_name as full_name','employees.order as order',
			'leavetypes.leaveType as keterangan',
		
			'leavetypes.singkat as singkatan',
	
			'leavetypes.singkat as idketerangan',
			
			
			'attendance.date as tanggalabsen',
			'attendance.masuk as absenmasuk',

			'attendance.leaveType as idleaveType',
			'attendance.is_late as iddataSkor',
			'attendance.keluar as pulangkantor',
			'attendance.apel_pagi as apelpagi',
			'attendance.apel_sore as apelsore',
                'employees.id as employeeID',
                'attendance.status',
                'attendance.date',
					'attendance.apel_pagi',
                'attendance.apel_sore',
                'attendance.leaveType',
                'attendance.halfDayType',
                'attendance.application_status',
                'attendance.applied_on',
                'attendance.clock_in',
                'attendance.clock_out',
                'attendance.clock_in_ip_address',
                'attendance.clock_out_ip_address',
                'attendance.working_from',
                'attendance.notes',
                'attendance.reason',
                'attendance.is_late',
                'employees.id',
                'employees.statusmupeg',
                'employees.employeeID as eID'
            )
            ->where("employees.status", "active")
        
			->where('employees.statusmupeg', 'PHL')
		
            ->get();
        return DataTables::of($result)
                 ->editColumn('eID', function ($row) {
		  return "<div style='display:none'>" .$row->order. "</div>" . $row->full_name . "</strong><div style=\"font-size: 11px;\">PHL</div></td>";
           

		   })
    
            ->editColumn('date', function ($row) {

                $attendance_mark = \View::make("admin.kehadiranadminphl.col3", ["row" => $row])->render();

                return $attendance_mark;
            })
            ->editColumn('clock_in', function ($row) {

                if ($row->clock_in != null) {
                    $input_value_clock_in = Carbon::createFromFormat('H:i:s', $row->clock_in, 'Asia/Makassar')->timezone('Asia/Makassar')->format('H:i:s');
                } else {
                    $input_value_clock_in = Carbon::createFromFormat('H:i:s', '06:00:00', 'Asia/Makassar')->timezone('Asia/Makassar')->format('H:i:s');
                }

                if ($row->clock_out != null) {
                    $input_value_clock_out = Carbon::createFromFormat('H:i:s', $row->clock_out, 'Asia/Makassar')->timezone('Asia/Makassar')->format('H:i:s');
                } else {
                    $input_value_clock_out = Carbon::createFromFormat('H:i:s', '24:00:00', 'Asia/Makassar')->timezone('Asia/Makassar')->format('H:i:s');
                }

                return \View::make("admin.kehadiranadminphl.col4", [
                    "row" => $row, "clock_in" => $input_value_clock_in,
                    "clock_out" => $input_value_clock_out])->render();
            })
       
            ->removeColumn('leaveType')

            ->removeColumn('id')
            ->removeColumn('halfDayType')
            ->removeColumn('application_status')
            ->removeColumn('applied_on')
            ->removeColumn('clock_out')
            ->removeColumn('clock_in_ip_address')
            ->removeColumn('clock_out_ip_address')
            ->removeColumn('is_late')
            ->removeColumn('reason')
            ->removeColumn('notes')
            ->removeColumn('working_from')
            ->rawColumns(['eID', 'status', 'date', 'clock_in', 'action'])
            ->make();
    }

   

}
