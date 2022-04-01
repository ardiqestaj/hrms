<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\TimeClock;
use App\Models\User;
use AUTH;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EditedAttendanceNotification;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Illuminate\Http\Request;

class AdminAttendance extends Controller
{
    public function AdminAttendance()
    {
        if (Auth::user()->role_name == 'Admin') {
            $month = Carbon::now()->format('m');
            $years = Carbon::now()->format('Y');
            $thisYear = '';

            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $years);

            // $users = User::select('rec_id', 'name')
            //     ->where('role_name', 'LIKE', 'employee')->get();
            // if (count($users) > 8) {
            //     $users = User::select('rec_id', 'name')
            //         ->where('role_name', 'LIKE', 'employee')->paginate(8);
            // } else {
            //     $users = User::select('rec_id', 'name')
            //         ->where('role_name', 'LIKE', 'employee')->get();
            // }

            $users = DB::table('users')
                ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                ->select('rec_id', 'employees.name', 'lastname')
                ->where('users.role_name', 'LIKE', 'employee')->get();
            if (count($users) > 8) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('rec_id', 'employees.name', 'lastname')
                    ->where('users.role_name', 'LIKE', 'employee')->paginate(8);
            } else {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('rec_id', 'employees.name', 'lastname')
                    ->where('users.role_name', 'LIKE', 'employee')->get();
            }
            // dd($users);
            $userList = DB::table('users')->get();
            $permission_lists = DB::table('permission_lists')->get();
            // dd($userList);
            // Attendance
            $now = Carbon::now();
            $startOfMonth = $now->startOfMonth()->format('Y-m-d');
            $now = Carbon::now();
            $attendances = TimeClock::whereBetween('date', [$startOfMonth, $now])->get();
            $todayAttendances = DB::table('time_clocks')->where('date', Carbon::today())->get();

            $schedules = DB::table('assignment_employees')
                ->join('schedules', 'schedules.idno', '=', 'assignment_employees.location_type_work_id')
                ->select('employee_id', 'idno', 'hours', 'restday')->get();
            //  DB::table('schedules')->select('idno', 'hours', 'restday')->get();

            $monthHolidays = Holiday::where('start', '>', Carbon::now()->startOfMonth())->where('start', '<', Carbon::now()->endOfMonth())->get();
            $monthHolidaysNo = count($monthHolidays);

            // Leaves Table
            $monthLeaves = DB::table('leave_applies')->select('*')->where('status', 'Approved')->get();
            $monthLeavesCount = count($monthLeaves);
            $final = [];
            $finale = [];
            $monthWorkingDays = '';
            $monthWorkingHrs = '';

            // foreach
            foreach ($users as $user) {
                $employee['rec_id'] = $user->rec_id;
                $employee['name'] = $user->name;
                $employee['lastname'] = $user->lastname;
                $attend = [];
                $leaves = [];
                $schedul = [];

                foreach ($attendances as $attendance) {
                    // attendances
                    if ($attendance->idno == $user->rec_id) {
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
                foreach ($monthLeaves as $monthLea) {
                    if ($monthLea->rec_id == $user->rec_id) {
                        $leave_2['from_date'] = $monthLea->from_date;
                        $leave_2['to_date'] = $monthLea->to_date;
                        $leaves[] = $leave_2;
                    }
                }
                $employee['monthLea'] = $leaves;
                // Schedules
                foreach ($schedules as $schedule) {
                    if ($schedule->employee_id == $user->rec_id) {
                        $schedule_2['hours'] = $schedule->hours;
                        $schedule_2['restday'] = $schedule->restday;
                        $schedul[] = $schedule_2;
                    }
                }
                $employee['schedule'] = $schedul;
                $final[] = $employee;
            }

            // $month = Carbon::now()->format('m');
            // $years = Carbon::now()->format('Y');
            // $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $years);

            // Total days in the current month
            $now = Carbon::now();
            // $totalMonthDay = Carbon::now()->daysInMonth;
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
                    $working_date[] = date('l', mktime(0, 0, 0, $month, $day + (int) $p, $year));
                }
                return $working_date;
            }

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

            // Number of Holidays that are Rest Days
            function countDayOverleap($tableVar, $restD)
            {
                $totalMonthHolidays = 0;
                foreach ($restD as $day) {
                    foreach ($tableVar as $var) {
                        if (date('l', strtotime($var->start)) == $day) {
                            $sum = 1;
                        } else {
                            $sum = 0;
                        }
                        $totalMonthHolidays += $sum;
                    }
                }
                return $totalMonthHolidays;
            }
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

            //Number of Leaves that are also holidays
            function countDayOverleap5($tableVar, $restD)
            {
                $totalMonthHolidays = 0;
                foreach ($restD as $day) {
                    foreach ($tableVar as $var) {
                        if ($var->start == date('Y-m-d', strtotime($day)) && $day->isCurrentMonth()) {
                            $sum = 1;
                        } else {
                            $sum = 0;
                        }
                        $totalMonthHolidays += $sum;
                    }
                }
                return $totalMonthHolidays;
            }

            // month Days
            $getMonthAllDays = workingDays($startOfMonth, $daysInMonth);
            $days[] = '';
            $workingHrs = 1;
            foreach ($final as $stats) {
                foreach ($stats['schedule'] as $sched) {
                    $workingHrs = $sched['hours'];
                    $restDays = $sched['restday'];
                    $days = explode(', ', $restDays);
                    $numOfRestDays = count($days);
                }

                $common = array_intersect($getMonthAllDays, $days);
                $monthDaysEqualRestDays = count($common);

                // Leaves
                $leave = [];
                foreach ($stats['monthLea'] as $leaves) {
                    $daysThroughLeaves = countLeaves($leaves['from_date'], $leaves['to_date']);
                    foreach ($daysThroughLeaves as $restDa) {
                        $leave = [];
                    }

                    {
                        foreach ($restDa as $leave[]) {
                        }
                    }
                }
                if (isset($leave)) {
                    $allCurrentLeavesOfMonth = countDayOverleap7($leave);
                } else {
                    $allCurrentLeavesOfMonth = '';
                }

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

                $monthWorkingHrs = $monthWorkingDays * $workingHrs;

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

                $finale[] = $stats;

            }
            $thisMonth = Carbon::now()->format('m');
            switch ($thisMonth) {
                case '01':
                    $thisMonth = 'Jan';
                    break;
                case '02':
                    $thisMonth = 'Fab';
                    break;
                case '03':
                    $thisMonth = 'Mar';
                    break;
                case '04':
                    $thisMonth = 'Apr';
                    break;
                case '05':
                    $thisMonth = 'May';
                    break;
                case '06':
                    $thisMonth = 'Jun';
                    break;
                case '07':
                    $thisMonth = 'Jul';
                    break;
                case '08':
                    $thisMonth = 'Aug';
                    break;
                case '09':
                    $thisMonth = 'Sep';
                    break;
                case '10':
                    $thisMonth = 'Oct';
                    break;
                case '11';
                    $thisMonth = 'Nov';
                    break;
                case '12':
                    $thisMonth = 'Dec';
                    break;
            }

            return view('form.attendance', compact('users', 'month', 'thisYear', 'daysInMonth', 'finale', 'attendances', 'todayAttendances', 'schedules', 'monthWorkingDays', 'monthWorkingHrs', 'workingHrs', 'now', 'userList', 'permission_lists', 'thisMonth'));
        } else {
            return redirect()->route('home');
        }
    }

    // Manual Entrance
    public function manualEntrance(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'time_in' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            if (isset($request->time_out)) {
                $date = date("Y-m-d", strtotime($request->date));
                $timeOut = date("h:i A", strtotime($request->time_out));
                $timeOUT = $date . " " . $timeOut;
                $timeIn = date("h:i A", strtotime($request->time_in));
                $timeIN = $date . " " . $timeIn;

                $start = new Carbon($timeIN);
                $end = new Carbon($timeOUT);
                $totalhour = $start->diff($end)->format('%H.%I');

                $scheduless = DB::table('assignment_employees')
                    ->join('schedules', 'schedules.idno', '=', 'assignment_employees.location_type_work_id')
                    ->where('assignment_employees.employee_id', $request->rec_id)->first();

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

            } else {
                $date = $request->date;
                $timeIn = date("h:i A", strtotime($request->time_in));
                $timeIN = $date . " " . $timeIn;

                $missedhours = null;
                $overtime = null;
                $totalhour = null;
                $timeOUT = null;
            }

            $entry = new TimeClock;
            $entry->employee = $request->name;
            $entry->date = date("Y-m-d", strtotime($request->date));
            $entry->timein = $timeIN;
            $entry->timeout = $timeOUT;
            $entry->idno = $request->rec_id;
            $entry->totalhours = $totalhour;
            $entry->overtime = $overtime;
            $entry->missedhours = $missedhours;

            $entry->save();

            DB::commit();
            Toastr::success('Manual attendance created successfully :)', 'Success');
            return redirect()->route('attendance/page');

        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Creating Manual attendance failed :)', 'Error');
            return redirect()->route('attendance/page');
        }
    }

    // Manual Entrance
    public function edit(Request $request)
    {
        $request->validate([
            'time_in' => 'required|string|max:255',
            'time_out' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $date = date("Y-m-d", strtotime($request->date));
            $idno = $request->rec_id;

            $timeOut = date("h:i:s A", strtotime($request->time_out));
            $timeOUT = $date . " " . $timeOut;

            $timeIn = date("h:i:s A", strtotime($request->time_in));
            $timeIN = $date . " " . $timeIn;

            $start = new Carbon($timeIN);
            $end = new Carbon($timeOUT);
            $totalhour = $start->diff($end)->format('%H.%I');

            $scheduless = DB::table('assignment_employees')
                ->join('schedules', 'schedules.idno', '=', 'assignment_employees.location_type_work_id')
                ->where('assignment_employees.employee_id', $request->rec_id)->first();

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

            $update = [
                'timein' => $timeIN,
                'timeout' => $timeOUT,
                'totalhours' => $totalhour,
                'overtime' => $overtime,
                'missedhours' => $missedhours,
            ];

            TimeClock::where('date', $date)->where('idno', $idno)->update($update);

            $users1 = User::where('rec_id', $request->rec_id)->first();
            Notification::send($users1, new EditedAttendanceNotification($request));

            DB::commit();
            Toastr::success('Attendance edit successfull :)', 'Success');
            return redirect()->route('attendance/page');
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Attendance edit failed :)', 'Error');
            return redirect()->route('attendance/page');
        }
    }

    public function delete(Request $request)
    {
        $date = $request->date;
        $idno = $request->rec_id;

        try {
            TimeClock::where('date', $date)->where('idno', $idno)->delete();
            Toastr::success('Attendance Deleted successfully :)', 'Success');
            return redirect()->route('attendance/page');

        } catch (\Exception$e) {

            DB::rollback();
            Toastr::error('Attendance Deleted failed :)', 'Error');
            return redirect()->route('attendance/page');
        }
    }

    public function attSearch(Request $request)
    {
        if (Auth::user()->role_name == 'Admin') {
            // month
            $thisYear = Carbon::now()->format('Y');
            $thisMonth = Carbon::now()->format('m');
            $name = '';

            switch ($thisMonth) {
                case '01':
                    $thisMonth = 'Jan';
                    break;
                case '02':
                    $thisMonth = 'Fab';
                    break;
                case '03':
                    $thisMonth = 'Mar';
                    break;
                case '04':
                    $thisMonth = 'Apr';
                    break;
                case '05':
                    $thisMonth = 'May';
                    break;
                case '06':
                    $thisMonth = 'Jun';
                    break;
                case '07':
                    $thisMonth = 'Jul';
                    break;
                case '08':
                    $thisMonth = 'Aug';
                    break;
                case '09':
                    $thisMonth = 'Sep';
                    break;
                case '10':
                    $thisMonth = 'Oct';
                    break;
                case '11';
                    $thisMonth = 'Nov';
                    break;
                case '12':
                    $thisMonth = 'Dec';
                    break;

            }

            if (!empty($request->month)) {
                $monthVar = $request->month;
                $month = str_replace("-", "", $monthVar);
                $thisMonth = $month;
                $thisYear = '';
                switch ($thisMonth) {
                    case '01':
                        $thisMonth = 'Jan';
                        break;
                    case '02':
                        $thisMonth = 'Fab';
                        break;
                    case '03':
                        $thisMonth = 'Mar';
                        break;
                    case '04':
                        $thisMonth = 'Apr';
                        break;
                    case '05':
                        $thisMonth = 'May';
                        break;
                    case '06':
                        $thisMonth = 'Jun';
                        break;
                    case '07':
                        $thisMonth = 'Jul';
                        break;
                    case '08':
                        $thisMonth = 'Aug';
                        break;
                    case '09':
                        $thisMonth = 'Sep';
                        break;
                    case '10':
                        $thisMonth = 'Oct';
                        break;
                    case '11';
                        $thisMonth = 'Nov';
                        break;
                    case '12':
                        $thisMonth = 'Dec';
                        break;

                }
            } else {
                $month = Carbon::now()->format('m');
            }

            // Year
            if (!empty($request->year)) {
                $yearsVar = $request->year;
                $years = str_replace("-", "", $yearsVar);
                $thisYear = $years;

                $thisMonth = str_replace("-", "", $request->month);

                switch ($thisMonth) {
                    case '01':
                        $thisMonth = 'Jan';
                        break;
                    case '02':
                        $thisMonth = 'Fab';
                        break;
                    case '03':
                        $thisMonth = 'Mar';
                        break;
                    case '04':
                        $thisMonth = 'Apr';
                        break;
                    case '05':
                        $thisMonth = 'May';
                        break;
                    case '06':
                        $thisMonth = 'Jun';
                        break;
                    case '07':
                        $thisMonth = 'Jul';
                        break;
                    case '08':
                        $thisMonth = 'Aug';
                        break;
                    case '09':
                        $thisMonth = 'Sep';
                        break;
                    case '10':
                        $thisMonth = 'Oct';
                        break;
                    case '11';
                        $thisMonth = 'Nov';
                        break;
                    case '12':
                        $thisMonth = 'Dec';
                        break;

                }

            } else {
                $years = Carbon::now()->format('Y');
            }

            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $years);

            $dt = $years . '-' . $month . '-' . '01';
            $searchDt = $years . '-' . $month;
            // dd($searchDt);
            $startOfMonth = date('Y-m-d', strtotime($dt));
            $endOfMonth = date("Y-m-t", strtotime($dt));
            // dd($dt);

            $now = Carbon::now();
            // $startOfMonth = $now->startOfMonth()->format('Y-m-d');
            $users = DB::table('users')
                ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                ->select('rec_id', 'employees.name', 'lastname')
                ->where('users.role_name', 'LIKE', 'employee')->get();

            // Search by name
            $name = $request->name;
            if (isset($request->name)) {
                $users = User::select('rec_id', 'name')
                    ->where('role_name', 'LIKE', 'employee')
                    ->where('name', 'LIKE', '%' . $name . '%')
                    ->get();
                $name = $request->name;
                if (count($users) > 8) {
                    $users = User::select('rec_id', 'name')
                        ->where('role_name', 'LIKE', 'employee')
                        ->where('name', 'LIKE', '%' . $name . '%')
                        ->paginate(8);
                } else {
                    $users = User::select('rec_id', 'name')
                        ->where('role_name', 'LIKE', 'employee')
                        ->where('name', 'LIKE', '%' . $name . '%')
                        ->get();
                }
            }

            if (!count($users) > 0) {
                $final = User::select('rec_id', 'name')
                    ->where('role_name', 'LIKE', 'employee')
                    ->where('name', 'LIKE', '%' . $name . '%')
                    ->get();
            }

            $userList = DB::table('users')->get();
            $permission_lists = DB::table('permission_lists')->get();

            // Attendance
            $attendances = TimeClock::whereBetween('date', [$startOfMonth, $endOfMonth])->get();
            $todayAttendances = DB::table('time_clocks')->where('date', Carbon::today())->get();

            $schedules = DB::table('assignment_employees')
                ->join('schedules', 'schedules.idno', '=', 'assignment_employees.location_type_work_id')
                ->select('employee_id', 'idno', 'hours', 'restday')->get();

            $monthHolidays = Holiday::where('start', '>', $startOfMonth)->where('start', '<', $endOfMonth)->get();
            $monthHolidaysNo = count($monthHolidays);

            // Leaves Table
            $monthLeaves = DB::table('leave_applies')->select('*')->where('status', 'Approved')->get();
            $monthLeavesCount = count($monthLeaves);

            // foreach
            foreach ($users as $user) {
                $employee['rec_id'] = $user->rec_id;
                $employee['name'] = $user->name;
                $employee['lastname'] = $user->lastname;
                $attend = [];
                $leaves = [];
                $schedul = [];

                foreach ($attendances as $attendance) {
                    // attendances
                    if ($attendance->idno == $user->rec_id) {
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
                foreach ($monthLeaves as $monthLea) {
                    if ($monthLea->rec_id == $user->rec_id) {
                        $leave_2['from_date'] = $monthLea->from_date;
                        $leave_2['to_date'] = $monthLea->to_date;
                        $leaves[] = $leave_2;
                    }
                }
                $employee['monthLea'] = $leaves;

                // Schedules
                foreach ($schedules as $schedule) {
                    if ($schedule->employee_id == $user->rec_id) {
                        $schedule_2['hours'] = $schedule->hours;
                        $schedule_2['restday'] = $schedule->restday;
                        $schedul[] = $schedule_2;
                    }
                }
                $employee['schedule'] = $schedul;
                $final[] = $employee;
            }

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

            // Number of Holidays that are Rest Days
            function countDayOverleap($tableVar, $restD)
            {
                $totalMonthHolidays = 0;
                foreach ($restD as $day) {
                    foreach ($tableVar as $var) {
                        if (date('l', strtotime($var->start)) == $day) {
                            $sum = 1;
                        } else {
                            $sum = 0;
                        }
                        $totalMonthHolidays += $sum;
                    }
                }
                return $totalMonthHolidays;
            }
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

            //Number of Leaves that are also holidays
            function countDayOverleap5($tableVar, $restD)
            {
                $totalMonthHolidays = 0;
                foreach ($restD as $day) {
                    foreach ($tableVar as $var) {
                        if ($var->start == date('Y-m-d', strtotime($day)) && $day->isCurrentMonth()) {
                            $sum = 1;
                        } else {
                            $sum = 0;
                        }
                        $totalMonthHolidays += $sum;
                    }
                }
                return $totalMonthHolidays;
            }

            // month Days
            $getMonthAllDays = workingDays($startOfMonth, $daysInMonth);
            $finale = [];
            foreach ($final as $stats) {
                foreach ($stats['schedule'] as $sched) {
                    $workingHrs = $sched['hours'];
                    $restDays = $sched['restday'];
                    $days = explode(', ', $restDays);
                    $numOfRestDays = count($days);
                }

                $common = array_intersect($getMonthAllDays, $days);
                $monthDaysEqualRestDays = count($common);
                $leave = [];
                // Leaves
                foreach ($stats['monthLea'] as $leaves) {
                    $daysThroughLeaves = countLeaves($leaves['from_date'], $leaves['to_date']);
                    foreach ($daysThroughLeaves as $restDa) {
                        $leave = [];
                    }

                    {
                        foreach ($restDa as $leave[]) {
                        }
                    }
                }

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

                $monthWorkingHrs = $monthWorkingDays * $workingHrs;

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

                $finale[] = $stats;
            }
            // dd($finale);
            return view('form.attendance', compact('users', 'month', 'thisYear', 'daysInMonth', 'finale', 'attendances', 'todayAttendances', 'schedules', 'now', 'userList', 'permission_lists', 'searchDt', 'thisMonth', 'name'));
        } else {
            return redirect()->route('em/dashboard');
        }
    }
}
