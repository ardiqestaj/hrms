<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Carbon\Carbon;

use App\Models\TimeClock;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests;

class TimeClockController extends Controller
{
    public function clock()
    {
        // Time Clock 
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
        $restDays = $schedules->restday;
        $days = explode(',',$restDays);

        $d = 0;
        foreach($days as $day){
            ${'restday'.$d} = $day;
            $d++;
        }

        if(!empty($restday0)){
            $restday0 = $restday0;
        } else {
            $restday0 = 0;
        }
        if(!empty($restday1)){
            $restday1 = $restday1;
        } else {
            $restday1 = 0;
        }

        // Number of working hours in a day
        // $workingHrs = $schedules->hours;

        // number of working Days in a week
        // $workDays = 7 - count(explode(',',$restDays));

        // Total days in the current month
        $now = Carbon::now();
        $totalMonthDay = Carbon::now()->daysInMonth;
        $startOfMont = $now->startOfMonth()->format('Y-m-d');

        // Function to count reccurring days in a month
        function workingDays( $startOfMonth, $totalMonthDays ) {
        $date_array = explode('-', $startOfMonth );
        $day = $date_array[0];
        $month = $date_array[1];
        $year = $date_array[2];
        $working_date = array();

        for ( $p = 1; $p <= $totalMonthDays; $p++ ) {
        $working_date[] = date('l', mktime(0, 0, 0,$month,$day +(int)$p,$year));

        }
        return $working_date;
        }

        $getDays = workingDays($startOfMont, $totalMonthDay);
        $getWorkingDays = workingDays($startOfMont, $totalMonthDay);

         // trick to check the occurrence of week days
        $day1 = str_replace(array($restday0),array($restday0), $getDays, $dupweekDays);
        $day2 = str_replace(array($restday1),array($restday1), $getDays, $dupweekDays);
        // str_replace(array($restday1),array($restday1), $getDays, $dupweekDays);
        echo $dupweekDays;

        // Explanation of the above code:



        // /Some Experment
        // $now = Carbon::now();
        // $startOfMonth = $now->startOfMonth()->format('Y-m-d');
        // $endOfMonth = $now->endOfMonth()->format('Y-m-d');

        // $date = new BusinessDays();

        // $Bdays = $date->daysBetween(
        // Carbon::createFromDate($startOfMonth), // This is a Monday
        // Carbon::createFromDate($endOfMonth)
        // );

        // $mondays = $this->getMondays();
        // $now = Carbon::now();
        // $endOfMonth = $now->endOfMonth()->format('Y-m-d');
        // // Days in the current month
        // $totalMonthDays = Carbon::parse( $startOfMonth )->diffInDays( $endOfMonth );

        // // Start and End of current week
        // $now = Carbon::now();
        // $startOfWeek = $now->startOfWeek()->format('Y-m-d');
        // $endOfWeek = $now->endOfWeek()->format('Y-m-d');
        // $totalWeekDays = Carbon::parse( $startOfWeek )->diffInDays( $endOfWeek );

        // Returning Data to Employee Atttendance Page
        return view('form.attendanceemployee', compact('cc', 'tz', 'tf', 'rfid', 'attendance', 'timeFormat'));
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
