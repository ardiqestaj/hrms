<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ProfileInformation;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'birth_date' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'time_start' => 'required|string|max:255',
            'time_end' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        $restdays = ($request->restdays != null) ? implode(', ', $request->restdays) : null;
        $restdays_opt = ($request->restdays_opt != null) ? implode(', ', $request->restdays_opt) : null;

        User::create([
            'name' => $request->name,
            'avatar' => $request->image,
            'email' => $request->email,
            'join_date' => $todayDate,
            'role_name' => $request->role_name,
            'phone_number' => $request->phone_number,
            'department' => $request->department,
            'password' => Hash::make($request->password),
        ]);

        $users = User::latest('rec_id')->first();

        Employee::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'employee_id' => $users->rec_id,
            'email' => $request->email,
            'role_name' => $request->role_name,
            'phone_number' => $request->phone_number,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'department' => $request->department,
            'payment_method' => $request->payment_method,
            'restdays' => $restdays,
            'time_start' => date("h:i A", strtotime($request->time_start)),
            'time_end' => date("h:i A", strtotime($request->time_end)),
            'restdays_opt' => $restdays_opt,
            'time_start_opt' => date("h:i A", strtotime($request->time_start_opt)),
            'time_end_opt' => date("h:i A", strtotime($request->time_end_opt)),
        ]);

        ProfileInformation::create([
            'name' => $request->name,
            'rec_id' => $users->rec_id,
            'phone_number' => $request->phone_number,
            'birth_date' => $request->birth_date,
            'department' => $request->department,
            'gender' => $request->gender,
            'email' => $request->email,
        ]);
        Toastr::success('Create new account successfully :)', 'Success');
        return redirect('all/employee/card');
    }
}
