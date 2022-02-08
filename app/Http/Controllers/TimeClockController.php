<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Carbon\Carbon;

use App\Models\TimeClock;
use App\Models\Schedule;
use App\Models\Holiday;
use App\Models\LeavesEvidence;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests;

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
        $attendance = DB::table('time_clocks')->where('idno', $i)->get();

        // Schedule Table
        $schedules = DB::table('schedules')->where('idno', $i)->first();
        $workingHrs = $schedules->hours;
        $restDays = $schedules->restday;
        $days = explode(', ',$restDays);
        $numOfRestDays = count($days);

        // Leaves Table 
        $now = Carbon::now();

        $from = date('2022-02-07');
        $to = date('2022-03-03');

        $date_arra = [];

        $monthLeaves = LeavesEvidence::select('from_date', 'day')->where('rec_id', Auth::user()->rec_id)->get();
        // return $monthLeaves->attributesToArray();
        // $leaveStart = $monthLeaves->from_date;
        // $leaveEnd = $monthLeaves->to_date;
        $monthLeavesCount = count($monthLeaves);

        // $date_arra = [];
        // foreach($monthLeaves as $leave){
        //     $leaveStart = $leave->from_date;
        //     $leaveEnd = $leave->to_date;
        //     array_push($date_arra, $leaveStart);
        // }

        // array_push($date_arra, $leaveStart, $leaveEnd);
        // $leaveStart = $monthLeaves->from_date;
        // $leaveEnd = $monthLeaves->to_date;



        // ->whereMonth('from_date', Carbon::now()->month)
        // ->WhereBetween('to_date', [$from, $to])
        // ->get();
        // $monthLeavesCount = count($monthLeaves);

        
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

        // $getMonthAllDays3 = $monthLeaves;

        // array of rest day names
        // $d = 0;
        // foreach($days as $day){
        //     ${'restday'.$d} = $day;
        //     $d++;
        // }

        // Function to count reccurring days in a month
        function workingDays( $startDate, $totalDays ) {
            $date_array = explode('-', $startDate );
            $day = $date_array[0];
            $month = $date_array[1];
            $year = $date_array[2];
            $working_date = array();
    
            for ( $p = 0; $p < $totalDays; $p++ ) {
            $working_date[] = date('l', mktime(0, 0, 0,$month,$day +(int)$p,$year));
            }
            return $working_date;
        }
        // All days in a month
        $getMonthAllDays = workingDays($startOfMonth, $totalMonthDay);
        // Total days in a week and start date of week



        foreach ($monthLeaves as $leave) {
            // $getWeekRestDays = workingDays($leave, $leaveLength);
                $getWeekRestDays = workingDays($leave->from_date, $leave->day);
        // return $getWeekRestDays;
        }
        // for ($v=0; $v<$monthLeavesCount; $v++) {
        //     for($i=0; $i<$monthLeavesCount; $i++){
        //         foreach ($monthLeaves as ${'leave'.$i}) {
        //             ${'getWeekRestDays'.$v} = workingDays(${'leave'.$i}->from_date, ${'leave'.$i}->day);
        //         }
        //     }
        // }


        // Number of Month Recurring 
        // function totalRestDays($restDaysNum, $duplicateDays, $restdays, $getDays){
        //     $totalRestDaysInMonth = 0;
        //     for ($j=0; $j<$restDaysNum; $j++) {
        //         global ${'restday'.$j};

        //         str_replace(array(${$restdays.$j}), array(${$restdays.$j}), $getDays, ${$duplicateDays.$j});
        //         $totalRestDaysInMonth += ${$duplicateDays.$j};
        //     }
        //     return ($totalRestDaysInMonth);
        // }
        // // funksion per numrin e RestDay per month
        // $totRestDaysInMonth = totalRestDays($numOfRestDays, 'dupMonthDays', 'restday', $getMonthAllDays);

        // // funksion per numrin e RestDay per Week
        // $totRestDaysInWeek = totalRestDays($numOfRestDays, 'dupWeekDays', 'restday', $getWeekRestDays);



        // // Number of Month Recurring days
        // $totalRestDaysInMonth = 0;
        // for ($j=0; $j<$numOfRestDays; $j++){
        //     str_replace(array(${'restday'.$j}),array(${'restday'.$j}), $getMonthAllDays, ${'dupMonthDays'.$j});
        //     $totalRestDaysInMonth += ${'dupMonthDays'.$j};
        // }
        // // // Total rest days in a month
        // $totalRestDaysInMonth;

        // // Number of Month Recurring days
        // $totalRestDaysInWeek = 0;
        // for ($j=0; $j<$numOfRestDays; $j++){
        //     str_replace(array(${'restday'.$j}),array(${'restday'.$j}), $getDays, ${'dupWeekDays'.$j});
        //     $totalRestDaysInWeek += ${'dupWeekDays'.$j};
        // }

        // // Total rest days in a week
        // $totalRestDaysInWeek;
     



        // Check if Holidays of the current month are rest days also
        // function countDayOverleap($maxNumFirstLoop, $tableVar, $columnName, $firstLoopItemVar){
        //     for ($j=0; $j<$maxNumFirstLoop; $j++) {
        //     global ${'restday'.$j};
        //         $totalMonthHolidays = 0;
        //         foreach ($tableVar as $monthHoli) {
        //             if (date('l', strtotime($monthHoli->$columnName)) != ${$firstLoopItemVar.$j}) {
        //                 $weekdayHolid1 = 1;
        //             } else {
        //                 $weekdayHolid1 = 0;
        //             }
        //             $totalMonthHolidays += $weekdayHolid1;
        //         }
        //     }
        //     return ($totalMonthHolidays);
        // }

        // //Month Holidays that are not Rest Days
        // $monthHolidaysNotRestDays = countDayOverleap($numOfRestDays, $monthHolidays, 'date_holiday', 'restday');
        // // Week Holdays that are not rest days
        // $weekHolidaysNotRestDays = countDayOverleap($numOfRestDays, $weekHolidayss, 'date_holiday', 'restday');


        // Number of Rest Days in a month
        // function countDayOverleap2($maxNumFirstLoop, $tableVar, $firstLoopItemVar){
        //     for ($j=0; $j<$maxNumFirstLoop; $j++) {
        //     global ${'restday'.$j};
        //         $totalMonthHolidays = 0;
        //         foreach ($tableVar as $monthHoli) {
        //             if (date('l', strtotime($monthHoli)) != ${$firstLoopItemVar.$j}  ) {
        //                 $weekdayHolid1 = 0;
        //             } else {
        //                 $weekdayHolid1 = 1;
        //             }
        //             $totalMonthHolidays += $weekdayHolid1;
        //         }
        //     }
        //     return ($totalMonthHolidays);
        // }
        // $weekHolidaysNotRestDays = countDayOverleap2($numOfRestDays, $getMonthAllDays, 'restday');








                // Number of Holidays that are Rest Days
                function countDayOverleap($tableVar, $restD){
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



                // Number of Month Days that are rest days
                function countDayOverleap2($tableVar, $restD){
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



            // Number of Leaves that are Rest Days

        // Week Holidays that are rest days
        // for ($j=0; $j<$numOfRestDays; $j++) {
        //     $totalWeekHolidays = 0;
        //     foreach ($weekHolidayss as $weekHoli) {
        //         if (date('l', strtotime($weekHoli->date_holiday)) != ${'restday'.$j}) {
        //             $weekdayHolid1 = 1;
        //         } else {
        //             $weekdayHolid1 = 0;
        //         }
        //         $totalWeekHolidays += $weekdayHolid1;
        //     }
        // }
        // //Week Holiday Days that are not Rest Days
        // $totalWeekHolidays;


        return view('form.attendanceemployee', compact('cc', 'tz', 'tf', 'rfid', 'attendance', 'timeFormat', 'getWeekRestDays'));
    }

    // Clock In/Clock Out
    public function add(Request $request)
    {
        if ($request->idno == NULL || $request->type == NULL) 
        {
            return response()->json([
                "error" => trans("Please enter your ID.")
            ]);
        }

        if(strlen($request->idno) >= 20 || strlen($request->type) >= 20) 
        {
            return response()->json([
                "error" => trans("Invalid Employee ID.")
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
        $time_val = ($tf == 1) ? $time : date("H:i:s", strtotime($time)) ;

        if ($clock_comment == "on") 
        {
            if ($comment == NULL) 
            {
                return response()->json([
                    "error" => trans("Please provide your comment!")
                ]);
            }
        }

        // ip resriction
        $iprestriction = DB::table('clock_time_settings')->value('iprestriction');
        if ($iprestriction != NULL) 
        {
            $ips = explode(",", $iprestriction);

            if(in_array($ip, $ips) == false) 
            {
                $msge = trans("Whoops! You are not allowed to Clock In or Out from your IP address")." ".$ip;
                return response()->json([
                    "error" => $msge,
                ]);
            }
        } 


        $employee_id = DB::table('employees')->where('employee_id', $idno)->value('employee_id');
        if($employee_id == null) {
            return response()->json([
                "error" => trans("You entered an invalid ID.")
            ]);
        }

        $emp = DB::table('employees')->where('employee_id', $idno)->first();
        $lastname = $emp->lastname;
        $firstname = $emp->name;
        $mi = $emp->username;
        $employee = mb_strtoupper($lastname.', '.$firstname.' '.$mi);

        if ($type == 'timein') 
        {
            $has = DB::table('time_clocks')->where([['idno', $idno],['date', $date]])->exists();

            if ($has == 1) 
            {
                $hti = DB::table('time_clocks')->where([['idno', $idno],['date', $date]])->value('timein');
                $hti = date('h:i A', strtotime($hti));
                $hti_24 = ($tf == 1) ? $hti : date("H:i", strtotime($hti)) ;

                return response()->json([
                    "employee" => $employee,
                    "error" => trans("You already Time In today at")." ".$hti_24,
                ]);

            } else {
                $last_in_notimeout = DB::table('time_clocks')->where([['idno', $idno],['timeout', NULL]])->count();

                if($last_in_notimeout >= 1)
                {
                    return response()->json([
                        "error" => trans("Please Clock Out from your last Clock In.")
                    ]);

                } else {

                    $sched_in_time = DB::table('schedules')->where([['idno', $idno], ['archive', 0]])->value('intime');
                    
                    if($sched_in_time == NULL)
                    {
                        $status_in = "Ok";
                    } else {
                        $sched_clock_in_time_24h = date("H.i", strtotime($sched_in_time));
                        $time_in_24h = date("H.i", strtotime($time));

                        if ($time_in_24h <= $sched_clock_in_time_24h) 
                        {
                            $status_in = 'In Time';
                        } else {
                            $status_in = 'Late In';
                        }
                    }

                    if($clock_comment == "on" && $comment != NULL) 
                    {
                        DB::table('time_clocks')->insert([
                            [
                                'idno' => $idno,
                                'reference' => $employee_id,
                                'date' => $date,
                                'employee' => $employee,
                                'timein' => $date." ".$time,
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
                                'timein' => $date." ".$time,
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
  
        if ($type == 'timeout') 
        {
            $timeIN = DB::table('time_clocks')->where([['idno', $idno], ['timeout', NULL]])->value('timein');
            $clockInDate = DB::table('time_clocks')->where([['idno', $idno],['timeout', NULL]])->value('date');
            $hasout = DB::table('time_clocks')->where([['idno', $idno],['date', $date]])->value('timeout');
            $timeOUT = date("Y-m-d h:i:s A", strtotime($date." ".$time));

            if($timeIN == NULL) 
            {
                return response()->json([
                    "error" => trans("Please Clock In before Clocking Out.")
                ]);
            } 

            if ($hasout != NULL) 
            {
                $hto = DB::table('time_clocks')->where([['idno', $idno],['date', $date]])->value('timeout');
                $hto = date('h:i A', strtotime($hto));
                $hto_24 = ($tf == 1) ? $hto : date("H:i", strtotime($hto)) ;

                return response()->json([
                    "employee" => $employee,
                    "error" => trans("You already Time Out today at")." ".$hto_24,
                ]);

            } else {
                $sched_out_time = DB::table('schedules')->where([['idno', $idno], ['archive', 0]])->value('outime');
                
                if($sched_out_time == NULL) 
                {
                    $status_out = "Ok";
                } else {
                    $sched_clock_out_time_24h = date("H.i", strtotime($sched_out_time));
                    $time_out_24h = date("H.i", strtotime($timeOUT));
                    
                    if($time_out_24h >= $sched_clock_out_time_24h) 
                    {
                        $status_out = 'On Time';
                    } else {
                        $status_out = 'Early Out';
                    }
                }

                $time1 = Carbon::createFromFormat("Y-m-d h:i:s A", $timeIN); 
                $time2 = Carbon::createFromFormat("Y-m-d h:i:s A", $timeOUT); 
                $th = $time1->diffInHours($time2);
                $tm = floor(($time1->diffInMinutes($time2) - (60 * $th)));
                $totalhour = $th.".".$tm;

                DB::table('time_clocks')->where([['idno', $idno],['date', $clockInDate]])->update(array(
                    'timeout' => $timeOUT,
                    'totalhours' => $totalhour,
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
}
