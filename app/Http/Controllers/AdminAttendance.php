<?php

namespace App\Http\Controllers;
use DB;
use App\Models\TimeClock;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AdminAttendance extends Controller
{
    public function AdminAttendance(){

    // employees
    $users = User::select('rec_id', 'name')
                ->where('role_name', 'LIKE', 'employee')
                ->get();

    // Attendance
    $now = Carbon::now();
    $attendances = TimeClock::whereBetween('date', ['2022-02-01', $now])
                    ->get();


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

    // dd($final);




    // $att1 = DB::table('time_clocks')->get();
                    
    // $name = $request->name;
    $month = Carbon::now()->format('m');
    $years = Carbon::now()->format('Y');
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $years);

     return view('form.attendance', compact('users', 'attendance', 'month', 'years', 'daysInMonth', 'final'));

























    //      // attendance, employee and users table
    // $employees = DB::table('employees')->select('employees.employee_id', 'employees.name', 'employees.lastname')->get();

    // foreach ($employees as $employee){
    //     $employeeId[] = $employee->employee_id;
    // }

    // $attendance = DB::table('time_clocks')
    //                 // ->join('users', 'users.rec_id', '=', 'time_clocks.idno')
    //                 ->select('time_clocks.*')
    //                 ->where('time_clocks.idno', $employeeId)
    //                 ->get();


    // $month = Carbon::now()->format('m');
    // $years = Carbon::now()->format('Y');
    // $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $years);

    //  return view('form.attendance', compact('employees', 'attendance', 'month', 'years', 'daysInMonth'));
    }
}
