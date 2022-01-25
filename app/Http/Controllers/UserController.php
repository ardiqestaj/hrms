<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
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
            'type_of_work'  => 'required|string|max:255',
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
            'password'  => Hash::make($request->password),
        ]);

        $users = User::latest('rec_id')->first();

        Employee::create([
            'name'          => $request->name,
            'lastname'      => $request->lastname,
            'username'      => $request->username,
            'employee_id'   => $users->rec_id,
            'email'         => $request->email,
            'role_name'     => $request->role_name,
            'phone_number'  => $request->phone_number,
            'birth_date'    => $request->birth_date,
            'gender'        => $request->gender,
            'type_of_work'  => $request->type_of_work,
            'payment_method'=> $request->payment_method,
            'monday'        => $request->monday,
            'tuesday'       => $request->tuesday,
            'wednesday'     => $request->wednesday,
            'thursday'      => $request->thursday,
            'friday'        => $request->friday,
            'saturday'      => $request->saturday,
            'sunday'        => $request->sunday,
            'time_start'    => $request->time_start,
            'time_end'      => $request->time_end,
        ]);
        Toastr::success('Create new account successfully :)','Success');
        return redirect('all/employee/card');
    }
}
