<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ProfileInformation;
use App\Models\StaffSalary;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function storeUser(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                // Personal Information
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

                // Salary Information
                // 'name' => 'required|string|max:255',
                // 'rec_id' => 'required|string|max:255',
                // 'payment_type' => 'required|string|max:255',
                // 'salary_amount' => 'required|string|max:255',
                // 'hourly_salary' => 'required|string|max:255',
                // 'monthly_surcharge' => 'required|string|max:255',
                // 'night_sunday_bon' => 'required|string|max:255',
                // 'holiday_bon' => 'required|string|max:255',
                // 'holiday_bon_minus' => 'required|string|max:255',
                // 'timesupplement_night_sunday' => 'required|string|max:255',
                // 'pension_insurance' => 'required|string|max:255',
                // 'unemployment_insurance' => 'required|string|max:255',
                // 'accident_insurance' => 'required|string|max:255',
                // 'uvg_grb' => 'required|string|max:255',
                // 'pension_fund' => 'required|string|max:255',
                // 'medical_insurance' => 'required|string|max:255',
                // 'collective_labor' => 'required|string|max:255',
                // 'expenses' => 'required|string|max:255',
                // 'telephone_shipment' => 'required|string|max:255',
                // 'mileage_compensation' => 'required|string|max:255',
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

            // save record

            $request->validate([
                // 'name' => 'required|string|max:255',
                // 'rec_id' => 'required|string|max:255',
                // 'payment_type' => 'required|string|max:255',
                'salary_amount' => 'required|string|max:255',
                'hourly_salary' => 'required|string|max:255',
                'monthly_surcharge' => 'required|string|max:255',
                'night_sunday_bon' => 'required|string|max:255',
                'holiday_bon' => 'required|string|max:255',
                'holiday_bon_minus' => 'required|string|max:255',
                'timesupplement_night_sunday' => 'required|string|max:255',
                'pension_insurance' => 'required|string|max:255',
                'unemployment_insurance' => 'required|string|max:255',
                'accident_insurance' => 'required|string|max:255',
                'uvg_grb' => 'required|string|max:255',
                'pension_fund' => 'required|string|max:255',
                'medical_insurance' => 'required|string|max:255',
                'collective_labor' => 'required|string|max:255',
                'expenses' => 'required|string|max:255',
                'telephone_shipment' => 'required|string|max:255',
                'mileage_compensation' => 'required|string|max:255',
            ]);

            $salary = StaffSalary::updateOrCreate(['rec_id' => $request->rec_id]);
            $salary->name = $request->name;
            $salary->rec_id = $request->rec_id;
            $salary->payment_type = $request->payment_method;
            $salary->hourly_salary = $request->hourly_salary;
            $salary->salary_amount = $request->salary_amount;
            $salary->night_sunday_bon = $request->night_sunday_bon;
            $salary->holiday_bon = $request->holiday_bon;
            $salary->holiday_bon_minus = $request->holiday_bon_minus;
            $salary->timesupplement_night_sunday = $request->timesupplement_night_sunday;
            $salary->monthly_surcharge = $request->monthly_surcharge;
            $salary->pension_insurance = $request->pension_insurance;
            $salary->unemployment_insurance = $request->unemployment_insurance;
            $salary->accident_insurance = $request->accident_insurance;
            $salary->uvg_grb = $request->uvg_grb;
            $salary->pension_fund = $request->pension_fund;
            $salary->medical_insurance = $request->medical_insurance;
            $salary->collective_labor = $request->collective_labor;
            $salary->expenses = $request->expenses;
            $salary->telephone_shipment = $request->telephone_shipment;
            $salary->mileage_compensation = $request->mileage_compensation;
            $salary->save();

            DB::commit();
            Toastr::success('Create new Salary successfully :)', 'Success');
            // // return redirect()->back();
            return redirect('all/employee/card');
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Add Salary fail :)', 'Error');
            // // return redirect()->back();
            return redirect('all/employee/card');
            // }
        }
        // Toastr::success('Create new account successfully :)', 'Success');
        // return redirect('all/employee/card');

    }
}
