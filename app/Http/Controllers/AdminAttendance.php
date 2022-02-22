<?php

namespace App\Http\Controllers;
use DB;
use Auth;

use App\Models\TimeClock;
use App\Models\User;
use App\Models\Holiday;
use App\Models\LeavesEvidence;

use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class AdminAttendance extends Controller
{
    public function AdminAttendance(){

    $month = Carbon::now()->format('m');
    $years = Carbon::now()->format('Y');
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $years);


    $users = User::select('rec_id', 'name')
    ->where('role_name', 'LIKE', 'employee')->get();
    if(count($users)>8){
    $users = User::select('rec_id', 'name')
    ->where('role_name', 'LIKE', 'employee')->paginate(8);
    }else {
    $users = User::select('rec_id', 'name')
    ->where('role_name', 'LIKE', 'employee')->get();
    }

    // Attendance
    $now = Carbon::now();
    $startOfMonth = $now->startOfMonth()->format('Y-m-d');
    $now = Carbon::now();
    $attendances = TimeClock::whereBetween('date', [$startOfMonth, $now])->get();
    $todayAttendances = DB::table('time_clocks')->where('date', Carbon::today())->get();

    $schedules = DB::table('schedules')->select('idno', 'hours', 'restday')->get();

    $monthHolidays = Holiday::where('date_holiday', '>', Carbon::now()->startOfMonth())->where('date_holiday', '<', Carbon::now()->endOfMonth())->get();
    $monthHolidaysNo = count($monthHolidays);

    // Leaves Table
    $monthLeaves = DB::table('leave_applies')->select('*')->where('status', 'Approved')->get();
    $monthLeavesCount = count($monthLeaves);

    // foreach
    foreach($users as $user)
    {
        $employee['rec_id'] = $user->rec_id;
        $employee['name'] = $user->name;
        $attend = [];
        $leaves = [];
        $schedul = [];

        foreach($attendances as $attendance)
            {
                // attendances
            if($attendance->idno == $user->rec_id)
                {
                    $attend_2['idno'] = $attendance->idno;
                    $attend_2['date'] = $attendance->date;
                    $attend_2['timein'] = $attendance->timein;
                    $attend_2['timeout'] = $attendance->timeout;
                    $attend_2['totalhours'] = $attendance->totalhours;
                    $attend_2['overtime'] = $attendance->overtime;
                    $attend_2['missedhours'] = $attendance->missedhours;
                    $attend[] = $attend_2;
                }
            }
            $employee['attendance'] = $attend;

        // Leaves
        foreach($monthLeaves as $monthLea)
            {
                if($monthLea->rec_id == $user->rec_id)
                {
                    $leave_2['from_date'] = $monthLea->from_date;
                    $leave_2['to_date'] = $monthLea->to_date;
                    $leaves[] = $leave_2;
                }
            }
            $employee['monthLea'] = $leaves;

            // Schedules
        foreach($schedules as $schedule)
        {
            if($schedule->idno == $user->rec_id)
            {
                $schedule_2['hours'] = $schedule->hours;
                $schedule_2['restday'] = $schedule->restday;
                $schedul[] = $schedule_2;
            }
        }
        $employee['schedule'] = $schedul;
        $final[] = $employee;
    }
    // dd($final);

    $month = Carbon::now()->format('m');
    $years = Carbon::now()->format('Y');
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $years);


        // Total days in the current month
    $now = Carbon::now();
    $totalMonthDay = Carbon::now()->daysInMonth;
    $startOfMonth = $now->startOfMonth()->format('Y-m-d');

    // Function to display all reccurring days in a month
    function workingDays($startDate, $totalDays)
    {
        $date_array = explode('-', $startDate);
        $day = $date_array[0];
        $month = $date_array[1];
        $year = $date_array[2];
        $working_date = array();

        for ($p = 0; $p < $totalDays; $p++) {
            $working_date[] = date('l', mktime(0, 0, 0, $month, $day +(int)$p, $year));
        }
        return $working_date;
    }
        // All days in a month
    // $getMonthAllDays = workingDays($startOfMonth, $totalMonthDay);
    
        



    // Count all Leaves of the month
        function countLeaves($startCount, $endCount)
        {
                $period = CarbonPeriod::create($startCount, $endCount);
                foreach ($period as $date) {
                    $date->format('l');
                }
                $dates[] = $period->toArray();
            return $dates;
        }
        
        // $daysThroughLeaves = countLeaves($monthLeaves, 'from_date', 'to_date');

        // foreach ($daysThroughLeaves as $restDa) {
        //     foreach ($restDa as $leave[]) {
        //     }
        // }
        // $totalLeavesOfMonth = count($leave);



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
        // $monthHolidaysEqualRestDay = countDayOverleap($monthHolidays, $days);
        // $monthHolidaysNotRestDays = ($monthHolidaysNo - $monthHolidaysEqualRestDay);


        // Number of Month Days that are rest days
        // function countDayOverleap2($tableVar, $restD)
        // {
        //     $totalMonthHolidays = 0;
        //     foreach ($restD as $day) {
        //         foreach ($tableVar as $var) {
        //             if (date('l', strtotime($var)) == $day) {
        //                 $sum = 1;
        //             } else {
        //                 $sum = 0;
        //             }
        //             $totalMonthHolidays += $sum;
        //         }
        //     }
        //     return $totalMonthHolidays;
        // }



        // function countDayOverleap2($tableVar, $restD){
        //     $common = array_intersect($tableVar, $restD);
        //     return count($common);
        // }
        // $monthDaysEqualRestDays = countDayOverleap2($getMonthAllDays, $days);
        // dd($monthDaysEqualRestDays);

// dd($getMonthAllDays);
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
        // $allCurrentLeavesOfMonth = countDayOverleap7($leave);
    


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
        // $LeaveDaysEqualRestDays = countDayOverleap3($leave, $days);
        // $LeaveDaysEqualNotDays = ($allCurrentLeavesOfMonth - $LeaveDaysEqualRestDays);


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
        // $monthLeavesEqualHolidays = countDayOverleap5($monthHolidays, $leave);
    
        // // Total working days in the current month
        // $monthWorkingDays = (count($getMonthAllDays) - $monthDaysEqualRestDays - $monthHolidaysNotRestDays - $monthLeavesEqualHolidays - $LeaveDaysEqualNotDays);
        // // Total working hours this Month
        // $monthWorkingHrs = $monthWorkingDays*$workingHrs;


        // month Days
        $getMonthAllDays = workingDays($startOfMonth, $totalMonthDay);
        
        // foreach ($users as $user) {
            // dd($final);
            // $finale = [];
            foreach ($final as $stats) {
                foreach ($stats['schedule'] as $sched) {
                    $workingHrs = $sched['hours'];
                    $restDays = $sched['restday'];
                    $days = explode(', ', $restDays);
                    $numOfRestDays = count($days);
                    // $monthDaysEqualRestDays = countDayOverleap2($getMonthAllDays, $days);
                    // $count = count($monthDaysEqualRestDays);
                    

                }
                // dd($days);

                $common = array_intersect($getMonthAllDays, $days);
                    $monthDaysEqualRestDays = count($common);
                    // dd($monthDaysEqualRestDays);
                // dd($common);
               

                // function countDayOverleap2($tableVar, $restD){
                    // $common = array_intersect($tableVar, $restD);
                    // return count($common);
                    // dd($common);
                // }
                // $monthDaysEqualRestDays = countDayOverleap2($getMonthAllDays, $days);
                // dd($count);




                // Leaves
                foreach ($stats['monthLea'] as $leaves) {
                    $daysThroughLeaves = countLeaves($leaves['from_date'], $leaves['to_date']);
                    foreach ($daysThroughLeaves as $restDa)
                    $leave = [];
                     {
                        foreach ($restDa as $leave[]) {
                        }
                    }
                }
                // dd($leave);

                // $totalLeavesOfMonth = count($leave);
                // dd($totalLeavesOfMonth);
                // Number of leaves within current month
                $allCurrentLeavesOfMonth = countDayOverleap7($leave);
                // dd($allCurrentLeavesOfMonth);

                // Number of leaves that are rest days
                $LeaveDaysEqualRestDays = countDayOverleap3($leave, $days);
                $LeaveDaysEqualNotDays = ($allCurrentLeavesOfMonth - $LeaveDaysEqualRestDays);
                // Number of leaves that are holidays
                $monthLeavesEqualHolidays = countDayOverleap5($monthHolidays, $leave);

                // Month Holidays
                $monthHolidaysEqualRestDay = countDayOverleap($monthHolidays, $days);
                $monthHolidaysNotRestDays = ($monthHolidaysNo - $monthHolidaysEqualRestDay);



                // Total working days in the current month
                $monthWorkingDays = (count($getMonthAllDays) - $monthDaysEqualRestDays - $monthHolidaysNotRestDays - $monthLeavesEqualHolidays - $LeaveDaysEqualNotDays);
                // Total working hours this Month
                // dd($monthWorkingDays);
                // $monthWorkingHrs = [];
                $monthWorkingHrs = $monthWorkingDays*$workingHrs;
                // dd($workingHrs);
                $stats['monthWorkingHrs'] = $monthWorkingHrs;
                
                $totalMonthProductivity = [];
                $monthMissedHrs = [];
                $monthOvertimeHrs = [];
                foreach ($stats['attendance'] as $att) {
                    $totalMonthProductivity[] = $att['totalhours'];
                    $monthMissedHrs[] = $att['missedhours'];
                    $monthOvertimeHrs[] = $att['overtime'];

                }
                $stats['totalMonthProductivity'] = array_sum($totalMonthProductivity);
                $stats['monthMissedHrs'] = array_sum($monthMissedHrs);
                $stats['monthOvertimeHrs'] = array_sum($monthOvertimeHrs);



                

                // dd(array_sum($totalMonthProductivity));

                $finale[] = $stats;


            }
                // dd($leave);

            // dd($totalLeavesOfMonth);
            // dd($allCurrentLeavesOfMonth);
            // $count = count($common);

                // dd($common);

            // dd($finale);



     return view('form.attendance', compact('users', 'month', 'years', 'daysInMonth', 'finale', 'attendances', 'todayAttendances', 'schedules', 'monthWorkingDays', 'monthWorkingHrs', 'workingHrs', 'now'));
    }











    public function attSearch(Request $request){

        // employees
        $users = User::select('rec_id', 'name')
        ->where('role_name', 'LIKE', 'employee')
        ->get();

        // Attendance
        $now = Carbon::now();
        $startOfMonth = $now->startOfMonth()->format('Y-m-d');
        $now = Carbon::now();
        $attendances = TimeClock::whereBetween('date', [$startOfMonth, $now])
                ->get();

        // month
        if(!empty($request->month)){
            $monthVar = $request->month;
            $month = str_replace("-", "", $monthVar);
        }else {
            $month = Carbon::now()->format('m');
        }

        // Year
        if(!empty($request->year)){
            $yearsVar = $request->year;
            $years = str_replace("-", "", $yearsVar);
        }else {
            $years = Carbon::now()->format('Y');
        }

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $years);

         // Search by name
        $name = $request->name;
         if(isset($request->name))
         {
            $users = User::select('rec_id', 'name')
            ->where('role_name', 'LIKE', 'employee')
            ->where('name','LIKE','%'.$name.'%')
            ->get();
         }

        // Search by month
        if(isset($request->month))
        {
            $attendances = DB::table('time_clocks')->select()
            ->where('date','LIKE','%'.$month.'%')
            ->get();
        }

        //  search by year
        if(isset($request->years))
        {
            $attendances = DB::table('time_clocks')->select()
            ->where('date','LIKE','%'.$years.'%')
            ->get();
        }
    
        // search by year and month
        if(isset($request->month) && isset($request->year))
        {
            $attendances = DB::table('time_clocks')
            ->where('date','LIKE','%'.$years.'%')
            ->where('date','LIKE','%'.$month.'%')
            ->get();
        }

        if (!count($users) > 0){
            $final = User::select('rec_id', 'name')
            ->where('role_name', 'LIKE', 'employee')
            ->where('name','LIKE','%'.$name.'%')
            ->get();

        }else {
            foreach($users as $user)
            {
                $employee['rec_id'] = $user->rec_id;
                $employee['name'] = $user->name;
                $attend = [];
    
                foreach($attendances as $attendance)
                {
                    if($attendance->idno == $user->rec_id)
                    {
                        $attend_2['idno'] = $attendance->idno;
                        $attend_2['date'] = $attendance->date;
                        $attend_2['timein'] = $attendance->timein;
                        $attend_2['timeout'] = $attendance->timeout;
                        $attend_2['totalhours'] = $attendance->totalhours;
                        $attend_2['overtime'] = $attendance->overtime;
                        $attend_2['missedhours'] = $attendance->missedhours;
                        $attend[] = $attend_2;
                    }
                }
                $employee['attendance'] = $attend;
                $final[] = $employee;
            }
        }
        return view('form.attendance', compact('users', 'month', 'years', 'name', 'daysInMonth', 'finale'));
    }
}
