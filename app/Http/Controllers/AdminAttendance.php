<?php

namespace App\Http\Controllers;
use DB;
use App\Models\TimeClock;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AdminAttendance extends Controller
{
    public function AdminAttendance(){

    // attendance, employee and users table
    $employees = DB::table('employees')
    ->select('employees.employee_id', 'employees.name', 'employees.lastname')
    ->get();

    $attendance = DB::table('time_clocks')
                    ->select('time_clocks.*')
                    // ->groupBy('time_clocks.idno')
                    ->get();

    $month = Carbon::now()->format('m');
    $years = Carbon::now()->format('Y');

    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $years);
    // dd($daysInMonth);

     return view('form.attendance', compact('employees', 'attendance', 'month', 'years', 'daysInMonth'));

























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
