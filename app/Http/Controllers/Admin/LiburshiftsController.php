<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\Liburshift\DeleteRequest;
use App\Http\Requests\Admin\Liburshift\UpdateRequest;
use App\Models\Liburshift;
use App\Models\LiburshiftsList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;


class LiburshiftsController extends AdminBaseController
{


    public function __construct()
    {
        parent::__construct();
        $this->liburshiftOpen = 'active';
        $this->hrMenuActive = 'active';
        $this->pageTitle = trans("Hari Libur Shift");

        $year = ((request()->get('year'))) ? request()->get('year') : Carbon::now()->year;


        $month = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ];

        $this->year = $year;
        $this->months = $month;
        $this->currentMonth = Carbon::now()->format("F");
    }

    public function index($year = null)
    {
        $year = (isset($year)) ? $year : date("Y");

        $this->current_year = $year;
        Session::put('year', $year);

        $this->liburshifts = Liburshift::whereRaw('YEAR(date) = ?', array($year))->orderBy('date', 'ASC')->get();
        $this->liburshifts_list = LiburshiftsList::whereRaw('YEAR(date) = ?', array($year))
  
            ->orderBy('date', 'ASC')
            ->get();

        $this->liburshiftActive = 'active';
        $hol = [];


        $dateArr = $this->getDateForSpecificDayBetweenDates($year . '-01-01', $year . '-12-31', 0);
        $dateSatArr = $this->getDateForSpecificDayBetweenDates($year . '-01-01', $year . '-12-31', 6);
        $dateFriArr = $this->getDateForSpecificDayBetweenDates($year . '-01-01', $year . '-12-31', 5);

        $sat_sun = Liburshift::selectRaw('SUM(IF(WEEKDAY(date) = 6,1,0)) as sun,
									SUM(IF(WEEKDAY(date) = 5, 1, 0)) as sat,
									SUM(IF(WEEKDAY(date) = 4, 1, 0)) as fri
									')->whereRaw('YEAR(date) = ?', array($year))->first();

        $this->number_of_sundays = count($dateArr);
        $this->number_of_saturdays = count($dateSatArr);
        $this->number_of_fridays = count($dateSatArr);
        $this->number_of_sat_db = $sat_sun['sat'];
        $this->number_of_sun_db = $sat_sun['sun'];
        $this->number_of_fri_db = $sat_sun['fri'];
        $this->liburshifts_in_db = count($this->liburshifts);

        // Send liburshifts list
        $this->data["all_sundays"] = $dateArr;
        $this->data["all_saturdays"] = $dateSatArr;
        $this->data["all_fridays"] = $dateFriArr;


        foreach ($this->liburshifts as $liburshift) {
            $hol[date('F', strtotime($liburshift->date))]['id'][] = $liburshift->id;
            $hol[date('F', strtotime($liburshift->date))]['date'][] = date('d F Y', strtotime($liburshift->date));
            $hol[date('F', strtotime($liburshift->date))]['ocassion'][] = $liburshift->occassion;
            $hol[date('F', strtotime($liburshift->date))]['day'][] = date('D', strtotime($liburshift->date));
        }

        $this->liburshiftsArray = $hol;

        return View::make('admin.liburshifts.index', $this->data);
    }

    /**
     * Show the form for creating a new liburshift
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.liburshifts.create');
    }

    /**
     * Store a newly created liburshift in storage.
     *
     * @return Response
     */
    public function store(UpdateRequest $request)
    {
        Cache::forget('liburshift_cache');
        $input = request()->all();

        $year = \Session::get("year");

        $liburshift = array_combine($input['date'], $input['occasion']);

        \DB::beginTransaction();

        // Add custom liburshifts
        foreach ($liburshift as $index => $value) {
            if ($index == '') {
                continue;
            }

            $add = Liburshift::firstOrCreate(['date' => date('Y-m-d', strtotime($index)),
                'company_id' => $this->company_id

            ]);

            $holi = Liburshift::find($add->id);
            $holi->occassion = $value;
            $holi->save();
        }

        if (isset($input["liburshifts_list"])) {
            $liburshifts_list = $input["liburshifts_list"];

            // Add selected liburshifts
            foreach ($liburshifts_list as $liburshift_item) {
                $item = explode("|", $liburshift_item);

                $holi = Liburshift::firstOrCreate(['date' => $item[0],
                    'company_id' => $this->company_id

                ]);

                $holi->occassion = $item[1];
                $holi->save();
            }
        }

        if (isset($input["removedLiburshifts"])) {

            // Remove liburshifts
            $removedLiburshifts = explode("~", $input["removedLiburshifts"]);

            foreach ($removedLiburshifts as $removedLiburshift) {
                $item = explode("|", $removedLiburshift);

                $holi = Liburshift::where("date", $item[0])->where("company_id", $this->company_id)->first();

                if ($holi) {
                    $holi->delete();
                }
            }
        }

        \DB::commit();

        return Reply::redirect(route('admin.liburshifts.index'), 'messages.liburshiftAddMessage');

    }

    /**
     * Display the specified liburshift.
     */
    public function show($id)
    {
        $liburshift = Liburshift::findOrFail($id);

        return View::make('admin.liburshifts.show', compact('liburshift'));
    }

    /**
     * Show the form for editing the specified liburshift.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $liburshift = Liburshift::find($id);

        return View::make('admin.liburshifts.edit', compact('liburshift'));
    }

    /**
     * Update the specified liburshift in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        Cache::forget('liburshift_cache');
        $liburshift = Liburshift::findOrFail($id);

        $data = request()->all();

        $liburshift->update($data);

        return Redirect::route('admin.liburshifts.index');
    }

    /**
     * Remove the specified liburshift from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(DeleteRequest $request, $id)
    {

        Liburshift::destroy($id);
        $output['success'] = 'deleted';

        Cache::forget('liburshift_cache');

        return Reply::success('Successfully deleted');
    }

    public function Sunday()
    {
        Cache::forget('liburshift_cache');

        $year = session('year');
        $dateArr = $this->getDateForSpecificDayBetweenDates($year . '-01-01', $year . '-12-31', 0);

        \DB::beginTransaction();
        foreach ($dateArr as $date) {
            $holi = Liburshift::firstOrCreate(['date' => $date,
                'company_id' => $this->company_id]);
            $update = Liburshift::find($holi->id);
            $update->occassion = trans('core.officeOff');
            $update->save();
        }
        \DB::commit();

        return Redirect::route('admin.liburshifts.change_year', [$year])
            ->with('success', trans("messages.liburshiftDayMessage", ["day" => trans("core.sunday")]));
    }

    public function Saturday()
    {
        Cache::forget('liburshift_cache');

        $year = session('year');
        $dateArr = $this->getDateForSpecificDayBetweenDates($year . '-01-01', $year . '-12-31', 6);

        \DB::beginTransaction();
        foreach ($dateArr as $date) {
            $holi = Liburshift::firstOrCreate(['date' => $date,
                'company_id' => $this->company_id]);
            $update = Liburshift::find($holi->id);
            $update->occassion = trans('core.officeOff');
            $update->save();
        }
        \DB::commit();

        return Redirect::route('admin.liburshifts.change_year', [$year])
            ->with('success', trans("messages.liburshiftDayMessage", ["day" => trans("core.saturday")]));
    }

    public function Friday()
    {
        Cache::forget('liburshift_cache');

        $year = session('year');
        $dateArr = $this->getDateForSpecificDayBetweenDates($year . '-01-01', $year . '-12-31', 5);

        \DB::beginTransaction();
        foreach ($dateArr as $date) {
            $holi = Liburshift::firstOrCreate(['date' => $date,
                'company_id' => $this->company_id]);
            $update = Liburshift::find($holi->id);
            $update->occassion = trans('core.officeOff');
            $update->save();
        }
        \DB::commit();

        return Redirect::route('admin.liburshifts.change_year', [$year])
            ->with('success', trans("messages.liburshiftDayMessage", ["day" => trans("core.friday")]));
    }


    public function getDateForSpecificDayBetweenDates($startDate, $endDate, $weekdayNumber)
    {
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        $dateArr = [];

        do {
            if (date("w", $startDate) != $weekdayNumber) {
                $startDate += (24 * 3600); // add 1 day
            }
        } while (date("w", $startDate) != $weekdayNumber);


        while ($startDate <= $endDate) {
            $dateArr[] = date('Y-m-d', $startDate);
            $startDate += (7 * 24 * 3600); // add 7 days
        }

        return ($dateArr);
    }

    public function change_year($year)
    {
        Session::put('year', $year);
        $this->liburshifts = Liburshift::whereRaw('YEAR(date) = ?', array($year))->orderBy('date', 'ASC')->get();;
        $this->liburshiftActive = 'active';
        $hol = [];

        //$year       = date("Y");
        $dateArr = $this->getDateForSpecificDayBetweenDates($year . '-01-01', $year . '-12-31', 0);
        $dateSatArr = $this->getDateForSpecificDayBetweenDates($year . '-01-01', $year . '-12-31', 6);

        $sat_sun = Liburshift::selectRaw('SUM(IF(WEEKDAY(date) = 6,1,0)) as sun,
									SUM(IF(WEEKDAY(date) = 5, 1, 0)) as sat,
									SUM(IF(WEEKDAY(date) = 4, 1, 0)) as fri
									')->whereRaw('YEAR(date) = ?', array($year))->first();


        $this->number_of_sundays = count($dateArr);
        $this->number_of_saturdays = count($dateSatArr);
        $this->number_of_fridays = count($dateSatArr);
        $this->number_of_sat_db = $sat_sun['sat'];
        $this->number_of_sun_db = $sat_sun['sun'];
        $this->number_of_fri_db = $sat_sun['fri'];
        $this->liburshifts_in_db = count($this->liburshifts);

        foreach ($this->liburshifts as $liburshift) {
            $hol[date('F', strtotime($liburshift->date))]['id'][] = $liburshift->id;
            $hol[date('F', strtotime($liburshift->date))]['date'][] = date('d F Y', strtotime($liburshift->date));
            $hol[date('F', strtotime($liburshift->date))]['ocassion'][] = $liburshift->occassion;
            $hol[date('F', strtotime($liburshift->date))]['day'][] = date('D', strtotime($liburshift->date));
        }

        $this->liburshiftsArray = $hol;

        return View::make('admin.liburshifts.index', $this->data);
    }

    public function removeAllWeekendLiburshifts()
    {
        $year = session('year');
        $sunDateArr = $this->getDateForSpecificDayBetweenDates($year . '-01-01', $year . '-12-31', 0);
        $satDateArr = $this->getDateForSpecificDayBetweenDates($year . '-01-01', $year . '-12-31', 6);
        $friDateArr = $this->getDateForSpecificDayBetweenDates($year . '-01-01', $year . '-12-31', 5);

        foreach ($sunDateArr as $sun_date) {
            $del_sun_date = Liburshift::where('date', '=', $sun_date)->first();
            if (sizeof($del_sun_date)) {
                $del_sun_date->delete();
            }
        }
        foreach ($satDateArr as $sat_date) {
            $del_sat_date = Liburshift::where('date', '=', $sat_date)->first();
            if (sizeof($del_sat_date)) {
                $del_sat_date->delete();
            }
        }
        foreach ($friDateArr as $date) {
            $del_date = Liburshift::where('date', '=', $date)->first();
            if (sizeof($del_date)) {
                $del_date->delete();
            }
        }
        return Redirect::route('admin.liburshifts.change_year', [$year])
            ->with('success', trans("messages.liburshiftDayMessage", ["day" => trans("core.removeAllFriSatSun")]));
    }


}
