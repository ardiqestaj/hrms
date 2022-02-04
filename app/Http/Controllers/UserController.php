<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\ProfileInformation;
use Brian2694\Toastr\Facades\Toastr;
use Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function storeUser(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'lastname'      => 'required|string|max:255',
            'username'      => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'role_name'     => 'required|string|max:255',
            'phone_number'  => 'required|string|max:255',
            'birth_date'    => 'required|string|max:255',
            'gender'        => 'required|string|max:255',
            'department'  => 'required|string|max:255',
            'payment_method'=> 'required|string|max:255',
            // 'mondey'        => 'accepted',
            // 'tuesday'       => 'accepted',
            // 'wednesday'     => 'accepted',
            // 'thursday'      => 'accepted',
            // 'friday'        => 'accepted',
            // 'saturday'      => 'accepted',
            // 'sunday'        => 'accepted',
            'time_start'    => 'required|string|max:255',
            'time_end'      => 'required|string|max:255',
            'password'      => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        User::create([
            'name'      => $request->name,
            'avatar'    => $request->image,
            'email'     => $request->email,
            'join_date' => $todayDate,
            'role_name' => $request->role_name,
            'phone_number' => $request->phone_number,
            'department' => $request->department,
            'password'  => Hash::make($request->password),
        ]);

        $users = User::latest('rec_id')->first();

        Employee::create([
            'name'              => $request->name,
            'lastname'          => $request->lastname,
            'username'          => $request->username,
            'employee_id'       => $users->rec_id,
            'email'             => $request->email,
            'role_name'         => $request->role_name,
            'phone_number'      => $request->phone_number,
            'birth_date'        => $request->birth_date,
            'gender'            => $request->gender,
            'department'        => $request->department,
            'payment_method'    => $request->payment_method,
            'monday'            => $request->monday,
            'tuesday'           => $request->tuesday,
            'wednesday'         => $request->wednesday,
            'thursday'          => $request->thursday,
            'friday'            => $request->friday,
            'saturday'          => $request->saturday,
            'sunday'            => $request->sunday,
            'time_start'        => $request->time_start,
            'time_end'          => $request->time_end,
            'monday_opt'        => $request->monday_opt,
            'tuesday_opt'       => $request->tuesday_opt,
            'wednesday_opt'     => $request->wednesday_opt,
            'thursday_opt'      => $request->thursday_opt,
            'friday_opt'        => $request->friday_opt,
            'saturday_opt'      => $request->saturday_opt,
            'sunday_opt'        => $request->sunday_opt,
            'time_start_opt'    => $request->time_start_opt,
            'time_end_opt'      => $request->time_end_opt,
        ]);

        ProfileInformation::create([
            'name'          => $request->name,
            'rec_id'        => $users->rec_id,
            'phone_number'  => $request->phone_number,
            'birth_date'    => $request->birth_date,
            'department'    => $request->department,
            'gender'        => $request->gender,
            'email'         => $request->email,
        ]);
        Toastr::success('Create new account successfully :)','Success');
        return redirect('all/employee/card');
    }
}
