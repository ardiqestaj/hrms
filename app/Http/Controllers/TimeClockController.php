<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\LeavesEvidence;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Illuminate\Http\Request;

class TimeClockController extends Controller
{
    public function clock()
    {
        // TmeClock Settings Table
        $timeFormat = DB::table('clock_time_settings')->value("time_format");
        $data = DB::table('clock_time_settings')->where('id', 1)->first();
        $cc = $data->clock_comment;
        $tz = $data->timezone;
        $tf = $data->time_format;
        $rfid = $data->rfid;

        // Attendance Table
        $i = Auth::user()->rec_id;
        $dt = Carbon::now();
        $attendance = DB::table('time_clocks')->where('idno', $i)->get();
        $todayAttendance = DB::table('time_clocks')->where('idno', $i)->where('date', $today = Carbon::today())->get();
        $monthAttendance = DB::table('time_clocks')->where('idno', $i)->where('date', '>', Carbon::now()->startOfMonth())->where('date', '<', Carbon::now()->endOfMonth())->get();

        // Schedule Table
        $schedules = DB::table('assignment_employees')
            ->join('schedules', 'schedules.idno', '=', 'assignment_employees.location_type_work_id')
            ->where('assignment_employees.employee_id', $i)->first();
        $workingHrs = $schedules->hours;
        $restDays = $schedules->restday;
        $days = explode(', ', $restDays);
        $numOfRestDays = count($days);

        // Holidays Table
        $weekHolidayss = Holiday::where('date_holiday', '>', Carbon::now()->startOfWeek())->where('date_holiday', '<', Carbon::now()->endOfWeek())->get();
        $monthHolidays = Holiday::where('date_holiday', '>', Carbon::now()->startOfMonth())->where('date_holiday', '<', Carbon::now()->endOfMonth())->get();
        $monthHolidaysNo = count($monthHolidays);
        $weekHolidays = count($weekHolidayss);

        // Total days in the current month
        $now = Carbon::now();
        $totalMonthDay = Carbon::now()->daysInMonth;
        $startOfMonth = $now->startOfMonth()->format('Y-m-d');

        // Start of current Week
        $now = Carbon::now();
        $startOfWeek = $now->startOfWeek()->format('Y-m-d');

        // Leaves Table
        $monthLeaves = LeavesEvidence::select('from_date', 'to_date')
            ->where('rec_id', Auth::user()->rec_id)
            ->where('status', 'Approved')
            ->get();
        $monthLeavesCount = count($monthLeaves);

        // Function to display all reccurring days in a month
        function workingDays($startDate, $totalDays)
        {
            $date_array = explode('-', $startDate);
            $day = $date_array[0];
            $month = $date_array[1];
            $year = $date_array[2];
            $working_date = array();

            for ($p = 0; $p < $totalDays; $p++) {
                $working_date[] = date('l', mktime(0, 0, 0, $month, $day + (int) $p, $year));
            }
            return $working_date;
        }
        // All days in a month
        $getMonthAllDays = workingDays($startOfMonth, $totalMonthDay);

        // Count all Leaves of the month
        function countLeaves($tableVar, $startCount, $endCount)
        {
            foreach ($tableVar as $monthL) {
                $period = CarbonPeriod::create($monthL->$startCount, $monthL->$endCount);
                foreach ($period as $date) {
                    $date->format('l');
                }
                $dates[] = $period->toArray();
            }
            return $dates;
        }
        $daysThroughLeaves = countLeaves($monthLeaves, 'from_date', 'to_date');

        foreach ($daysThroughLeaves as $restDa) {
            foreach ($restDa as $leave[]) {

            }
        }
        $totalLeavesOfMonth = count($leave);

        // Number of Holidays that are Rest Days
        function countDayOverleap($tableVar, $restD)
        {
            $totalMonthHolidays = 0;
            foreach ($restD as $day) {
                foreach ($tableVar as $var) {
                    if (date('l', strtotime($var->date_holiday)) == $day) {
                        $sum = 1;
                    } else {
                        $sum = 0;
                    }
                    $totalMonthHolidays += $sum;
                }
            }
            return $totalMonthHolidays;
        }
        $monthHolidaysEqualRestDay = countDayOverleap($monthHolidays, $days);
        $monthHolidaysNotRestDays = ($monthHolidaysNo - $monthHolidaysEqualRestDay);

        // Number of Month Days that are rest days
        function countDayOverleap2($tableVar, $restD)
        {
            $totalMonthHolidays = 0;
            foreach ($restD as $day) {
                foreach ($tableVar as $var) {
                    if (date('l', strtotime($var)) == $day) {
                        $sum = 1;
                    } else {
                        $sum = 0;
                    }
                    $totalMonthHolidays += $sum;
                }
            }
            return $totalMonthHolidays;
        }
        $monthDaysEqualRestDays = countDayOverleap2($getMonthAllDays, $days);

        //Number of  Leaves within current month
        function countDayOverleap7($tableVar)
        {
            $totalMonthHolidays = 0;
            foreach ($tableVar as $var) {
                if ($var->isCurrentMonth()) {
                    $sum = 1;
                } else {
                    $sum = 0;
                }
                $totalMonthHolidays += $sum;
            }
            return $totalMonthHolidays;
        }
        $allCurrentLeavesOfMonth = countDayOverleap7($leave);

        //Number of  Leaves that are also rest Days
        function countDayOverleap3($tableVar, $restD)
        {
            $totalMonthHolidays = 0;
            foreach ($restD as $day) {
                foreach ($tableVar as $var) {
                    if (date('l', strtotime($var)) == $day && $var->isCurrentMonth()) {
                        $sum = 1;
                    } else {
                        $sum = 0;
                    }
                    $totalMonthHolidays += $sum;
                }
            }
            return $totalMonthHolidays;
        }
        $LeaveDaysEqualRestDays = countDayOverleap3($leave, $days);
        $LeaveDaysEqualNotDays = ($allCurrentLeavesOfMonth - $LeaveDaysEqualRestDays);

        //Number of Leaves that are also holidays
        function countDayOverleap5($tableVar, $restD)
        {
            $totalMonthHolidays = 0;
            foreach ($restD as $day) {
                foreach ($tableVar as $var) {
                    if ($var->date_holiday == date('Y-m-d', strtotime($day)) && $day->isCurrentMonth()) {
                        $sum = 1;
                    } else {
                        $sum = 0;
                    }
                    $totalMonthHolidays += $sum;
                }
            }
            return $totalMonthHolidays;
        }
        $monthLeavesEqualHolidays = countDayOverleap5($monthHolidays, $leave);

        // Total working days in the current month
        $monthWorkingDays = (count($getMonthAllDays) - $monthDaysEqualRestDays - $monthHolidaysNotRestDays - $monthLeavesEqualHolidays - $LeaveDaysEqualNotDays);
        // Total working hours this Month
        $monthWorkingHrs = $monthWorkingDays * $workingHrs;

        return view('form.attendanceemployee', compact('cc', 'tz', 'tf', 'rfid', 'attendance', 'todayAttendance', 'schedules', 'timeFormat', 'monthWorkingDays', 'monthWorkingHrs', 'monthAttendance', 'workingHrs', 'now'));
    }

    // Clock In/Clock Out
    public function add(Request $request)
    {

        if ($request->idno == null || $request->type == null) {
            return response()->json([
                "error" => trans("Please enter your ID."),
            ]);
        }

        if (strlen($request->idno) >= 20 || strlen($request->type) >= 20) {
            return response()->json([
                "error" => trans("Invalid Employee ID."),
            ]);
        }

        $idno = strtoupper($request->idno);
        $type = $request->type;
        $date = date('Y-m-d');
        $time = date('h:i:s A');
        $comment = strtoupper($request->clockin_comment);
        $ip = $request->ip();

        // clock-in comment feature
        $clock_comment = DB::table('clock_time_settings')->value('clock_comment');
        $tf = DB::table('clock_time_settings')->value('time_format');
        $time_val = ($tf == 1) ? $time : date("H:i:s", strtotime($time));

        if ($clock_comment == "on") {
            if ($comment == null) {
                return response()->json([
                    "error" => trans("Please provide your comment!"),
                ]);
            }
        }

        // ip resriction
        $iprestriction = DB::table('clock_time_settings')->value('iprestriction');
        if ($iprestriction != null) {
            $ips = explode(",", $iprestriction);

            if (in_array($ip, $ips) == false) {
                $msge = trans("Whoops! You are not allowed to Clock In or Out from your IP address") . " " . $ip;
                return response()->json([
                    "error" => $msge,
                ]);
            }
        }

        $employee_id = DB::table('employees')->where('employee_id', $idno)->value('employee_id');
        if ($employee_id == null) {
            return response()->json([
                "error" => trans("You entered an invalid ID."),
            ]);
        }

        $emp = DB::table('employees')->where('employee_id', $idno)->first();
        $lastname = $emp->lastname;
        $firstname = $emp->name;
        $mi = $emp->username;
        $employee = mb_strtoupper($lastname . ', ' . $firstname . ' ' . $mi);

        if ($type == 'timein') {
            $has = DB::table('time_clocks')->where([['idno', $idno], ['date', $date]])->exists();

            if ($has == 1) {
                $hti = DB::table('time_clocks')->where([['idno', $idno], ['date', $date]])->value('timein');
                $hti = date('h:i A', strtotime($hti));
                $hti_24 = ($tf == 1) ? $hti : date("H:i", strtotime($hti));

                return response()->json([
                    "employee" => $employee,
                    "error" => trans("You already Time In today at") . " " . $hti_24,
                ]);

            } else {
                $last_in_notimeout = DB::table('time_clocks')->where([['idno', $idno], ['timeout', null]])->count();

                if ($last_in_notimeout >= 1) {
                    return response()->json([
                        "error" => trans("Please Clock Out from your last Clock In."),
                    ]);

                } else {

                    // DB::table('assignment_employees')
                    //     ->join('schedules', 'schedules.idno', '=', 'assignment_employees.location_type_work_id')
                    //     ->where('assignment_employees.employee_id', $i)->first();

                    $sched_in_time = DB::table('assignment_employees')
                        ->join('schedules', 'schedules.idno', '=', 'assignment_employees.location_type_work_id')
                    //  ->where('schedules.archive', 0)
                        ->where('assignment_employees.employee_id', $idno)->value('schedules.intime');

                    // DB::table('schedules')->where([['idno', $idno], ['archive', 0]])->value('intime');

                    if ($sched_in_time == null) {
                        $status_in = "Ok";
                    } else {
                        $sched_clock_in_time_24h = date("H.i", strtotime($sched_in_time));
                        $time_in_24h = date("H.i", strtotime($time));

                        if ($time_in_24h <= $sched_clock_in_time_24h) {
                            $status_in = 'In Time';
                        } else {
                            $status_in = 'Late In';
                        }
                    }

                    if ($clock_comment == "on" && $comment != null) {
                        DB::table('time_clocks')->insert([
                            [
                                'idno' => $idno,
                                'reference' => $employee_id,
                                'date' => $date,
                                'employee' => $employee,
                                'timein' => $date . " " . $time,
                                'status_timein' => $status_in,
                                'comment' => $comment,
                            ],
                        ]);
                    } else {
                        DB::table('time_clocks')->insert([
                            [
                                'idno' => $idno,
                                'reference' => $employee_id,
                                'date' => $date,
                                'employee' => $employee,
                                'timein' => $date . " " . $time,
                                'status_timein' => $status_in,
                            ],
                        ]);
                    }

                    return response()->json([
                        "type" => $type,
                        "time" => $time_val,
                        "date" => $date,
                        "lastname" => $lastname,
                        "firstname" => $firstname,
                        "mi" => $mi,
                    ]);
                }
            }
        }

        if ($type == 'timeout') {
            $timeIN = DB::table('time_clocks')->where([['idno', $idno], ['timeout', null]])->value('timein');
            $clockInDate = DB::table('time_clocks')->where([['idno', $idno], ['timeout', null]])->value('date');
            $hasout = DB::table('time_clocks')->where([['idno', $idno], ['date', $date]])->value('timeout');
            $timeOUT = date("Y-m-d h:i:s A", strtotime($date . " " . $time));

            if ($timeIN == null) {
                return response()->json([
                    "error" => trans("Please Clock In before Clocking Out."),
                ]);
            }

            if ($hasout != null) {
                $hto = DB::table('time_clocks')->where([['idno', $idno], ['date', $date]])->value('timeout');
                $hto = date('h:i A', strtotime($hto));
                $hto_24 = ($tf == 1) ? $hto : date("H:i", strtotime($hto));

                return response()->json([
                    "employee" => $employee,
                    "error" => trans("You already Time Out today at") . " " . $hto_24,
                ]);

            } else {
                $sched_out_time = DB::table('assignment_employees')
                    ->join('schedules', 'schedules.idno', '=', 'assignment_employees.location_type_work_id')
                //  ->where('schedules.archive', 0)
                    ->where('assignment_employees.employee_id', $idno)->value('schedules.intime');

                // DB::table('schedules')->where([['idno', $idno], ['archive', 0]])->value('outime');

                if ($sched_out_time == null) {
                    $status_out = "Ok";
                } else {
                    $sched_clock_out_time_24h = date("H.i", strtotime($sched_out_time));
                    $time_out_24h = date("H.i", strtotime($timeOUT));

                    if ($time_out_24h >= $sched_clock_out_time_24h) {
                        $status_out = 'On Time';
                    } else {
                        $status_out = 'Early Out';
                    }
                }

                $time1 = Carbon::createFromFormat("Y-m-d h:i:s A", $timeIN);
                $time2 = Carbon::createFromFormat("Y-m-d h:i:s A", $timeOUT);
                $th = $time1->diffInHours($time2);
                $tm = floor(($time1->diffInMinutes($time2) - (60 * $th)));
                $totalhour = $th . "." . $tm;

                $scheduless = DB::table('assignment_employees')
                    ->join('schedules', 'schedules.idno', '=', 'assignment_employees.location_type_work_id')
                    ->where('assignment_employees.employee_id', $idno)->first();

                // DB::table('schedules')->where('idno', $idno)->first();
                $overtime = '';
                if ($scheduless->hours < $totalhour) {
                    $overtime = ($totalhour - $scheduless->hours);
                } else {
                    $overtime = 0;
                };

                $missedhours = '';
                if ($scheduless->hours > $totalhour) {
                    $missedhours = ($scheduless->hours - $totalhour);
                } else {
                    $missedhours = 0;
                };

                DB::table('time_clocks')->where([['idno', $idno], ['date', $clockInDate]])->update(array(
                    'timeout' => $timeOUT,
                    'totalhours' => $totalhour,
                    'overtime' => $overtime,
                    'missedhours' => $missedhours,
                    'status_timeout' => $status_out)
                );

                return response()->json([
                    "type" => $type,
                    "time" => $time_val,
                    "date" => $date,
                    "lastname" => $lastname,
                    "firstname" => $firstname,
                    "mi" => $mi,
                ]);
            }
        }

    }

    // search attendance
    public function search(Request $request)
    {
        {
            // TmeClock Settings Table
            $timeFormat = DB::table('clock_time_settings')->value("time_format");
            $data = DB::table('clock_time_settings')->where('id', 1)->first();
            $cc = $data->clock_comment;
            $tz = $data->timezone;
            $tf = $data->time_format;
            $rfid = $data->rfid;

            // Attendance Table
            $i = Auth::user()->rec_id;
            $dt = Carbon::now();
            $attendance = DB::table('time_clocks')->where('idno', $i)->get();
            $todayAttendance = DB::table('time_clocks')->where('idno', $i)->where('date', $today = Carbon::today())->get();
            $monthAttendance = DB::table('time_clocks')->where('idno', $i)->where('date', '>', Carbon::now()->startOfMonth())->where('date', '<', Carbon::now()->endOfMonth())->get();

            // Schedule Table
            $schedules = DB::table('assignment_employees')
                ->join('schedules', 'schedules.idno', '=', 'assignment_employees.location_type_work_id')
                ->where('assignment_employees.employee_id', $i)->first();

            // DB::table('schedules')->where('idno', $i)->first();
            $workingHrs = $schedules->hours;
            $restDays = $schedules->restday;
            $days = explode(', ', $restDays);
            $numOfRestDays = count($days);

            // Holidays Table
            $weekHolidayss = Holiday::where('date_holiday', '>', Carbon::now()->startOfWeek())->where('date_holiday', '<', Carbon::now()->endOfWeek())->get();
            $monthHolidays = Holiday::where('date_holiday', '>', Carbon::now()->startOfMonth())->where('date_holiday', '<', Carbon::now()->endOfMonth())->get();
            $monthHolidaysNo = count($monthHolidays);
            $weekHolidays = count($weekHolidayss);

            // Total days in the current month
            $now = Carbon::now();
            $totalMonthDay = Carbon::now()->daysInMonth;
            $startOfMonth = $now->startOfMonth()->format('Y-m-d');

            // Start of current Week
            $now = Carbon::now();
            $startOfWeek = $now->startOfWeek()->format('Y-m-d');

            // Leaves Table
            $monthLeaves = LeavesEvidence::select('from_date', 'to_date')
                ->where('rec_id', Auth::user()->rec_id)
                ->where('status', 'Approved')
                ->get();
            $monthLeavesCount = count($monthLeaves);

            // Function to display all reccurring days in a month
            function workingDays($startDate, $totalDays)
            {
                $date_array = explode('-', $startDate);
                $day = $date_array[0];
                $month = $date_array[1];
                $year = $date_array[2];
                $working_date = array();

                for ($p = 0; $p < $totalDays; $p++) {
                    $working_date[] = date('l', mktime(0, 0, 0, $month, $day + (int) $p, $year));
                }
                return $working_date;
            }
            // All days in a month
            $getMonthAllDays = workingDays($startOfMonth, $totalMonthDay);

            // Count all Leaves of the month
            function countLeaves($tableVar, $startCount, $endCount)
            {
                foreach ($tableVar as $monthL) {
                    $period = CarbonPeriod::create($monthL->$startCount, $monthL->$endCount);
                    foreach ($period as $date) {
                        $date->format('l');
                    }
                    $dates[] = $period->toArray();
                }
                return $dates;
            }
            $daysThroughLeaves = countLeaves($monthLeaves, 'from_date', 'to_date');

            foreach ($daysThroughLeaves as $restDa) {
                foreach ($restDa as $leave[]) {

                }
            }
            $totalLeavesOfMonth = count($leave);

            // Number of Holidays that are Rest Days
            function countDayOverleap($tableVar, $restD)
            {
                $totalMonthHolidays = 0;
                foreach ($restD as $day) {
                    foreach ($tableVar as $var) {
                        if (date('l', strtotime($var->date_holiday)) == $day) {
                            $sum = 1;
                        } else {
                            $sum = 0;
                        }
                        $totalMonthHolidays += $sum;
                    }
                }
                return $totalMonthHolidays;
            }
            $monthHolidaysEqualRestDay = countDayOverleap($monthHolidays, $days);
            $monthHolidaysNotRestDays = ($monthHolidaysNo - $monthHolidaysEqualRestDay);

            // Number of Month Days that are rest days
            function countDayOverleap2($tableVar, $restD)
            {
                $totalMonthHolidays = 0;
                foreach ($restD as $day) {
                    foreach ($tableVar as $var) {
                        // foreach ($var as $v) {
                        //     dd($v);
                        // }

                        if (date('l', strtotime($var)) == $day) {
                            $sum = 1;
                        } else {
                            $sum = 0;
                        }
                    }
                    $totalMonthHolidays += $sum;
                }
                return $totalMonthHolidays;

            }
        }
        $monthDaysEqualRestDays = countDayOverleap2($getMonthAllDays, $days);

        //Number of  Leaves within current month
        function countDayOverleap7($tableVar)
        {
            $totalMonthHolidays = 0;
            foreach ($tableVar as $var) {
                if ($var->isCurrentMonth()) {
                    $sum = 1;
                } else {
                    $sum = 0;
                }
                $totalMonthHolidays += $sum;
            }
            return $totalMonthHolidays;
        }
        $allCurrentLeavesOfMonth = countDayOverleap7($leave);

        //Number of  Leaves that are also rest Days
        function countDayOverleap3($tableVar, $restD)
        {
            $totalMonthHolidays = 0;
            foreach ($restD as $day) {
                foreach ($tableVar as $var) {
                    if (date('l', strtotime($var)) == $day && $var->isCurrentMonth()) {
                        $sum = 1;
                    } else {
                        $sum = 0;
                    }
                    $totalMonthHolidays += $sum;
                }
            }
            return $totalMonthHolidays;
        }
        $LeaveDaysEqualRestDays = countDayOverleap3($leave, $days);
        $LeaveDaysEqualNotDays = ($allCurrentLeavesOfMonth - $LeaveDaysEqualRestDays);

        //Number of Leaves that are also holidays
        function countDayOverleap5($tableVar, $restD)
        {
            $totalMonthHolidays = 0;
            foreach ($restD as $day) {
                foreach ($tableVar as $var) {
                    if ($var->date_holiday == date('Y-m-d', strtotime($day)) && $day->isCurrentMonth()) {
                        $sum = 1;
                    } else {
                        $sum = 0;
                    }
                    $totalMonthHolidays += $sum;
                }
            }
            return $totalMonthHolidays;
        }
        $monthLeavesEqualHolidays = countDayOverleap5($monthHolidays, $leave);

        // Total working days in the current month
        $monthWorkingDays = (count($getMonthAllDays) - $monthDaysEqualRestDays - $monthHolidaysNotRestDays - $monthLeavesEqualHolidays - $LeaveDaysEqualNotDays);
        // Total working hours this Month
        $monthWorkingHrs = $monthWorkingDays * $workingHrs;

        // $date  = $request->date;
        // $month = $request->month;

        // $date  =  $request->date;
        $year = $request->year;
        $month = $request->month;
        $date = Carbon::parse($request->date)->format('Y-m-d');
        // $date;

        // search by month
        if ($request->month) {
            $attendance = DB::table('time_clocks')->select()
                ->where('date', 'LIKE', '%' . $month . '%')
                ->get();
        }

        //  search by year
        if ($request->year) {
            $attendance = DB::table('time_clocks')->select()
                ->where('date', 'LIKE', '%' . $year . '%')
                ->get();
        }

        // search by year and month
        if ($request->month && $request->year) {
            $attendance = DB::table('time_clocks')
                ->where('date', 'LIKE', '%' . $year . '%')
                ->where('date', 'LIKE', '%' . $month . '%')
                ->get();
        }

        //  search by date
        if ($request->has('date')) {
            $attendance = DB::table('time_clocks')
                ->where('date', 'LIKE', '%' . $date . '%')
                ->get();
        }

        // $now = Carbon::now();

        //  return normal view
        return view('form.attendanceemployee', compact('cc', 'tz', 'tf', 'rfid', 'attendance', 'todayAttendance', 'schedules', 'timeFormat', 'monthWorkingDays', 'monthWorkingHrs', 'monthAttendance', 'workingHrs', 'year', 'month', 'now', 'date'));
    }

}
