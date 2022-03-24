<?php

namespace App\Http\Controllers;

use App\Models\StaffSalary;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Http\Request;
use PDF;

class PayrollController extends Controller
{
    // view page salary
    public function salary()
    {

        $users = DB::table('users')
            ->join('staff_salaries', 'users.rec_id', '=', 'staff_salaries.rec_id')
            ->join('employees', 'employees.employee_id', '=', 'users.rec_id')
            ->select('users.*', 'staff_salaries.*', 'employees.payment_method')
            ->get();
        $userList = DB::table('users')
            ->join('employees', 'employees.employee_id', '=', 'users.rec_id')
            ->select('users.*', 'employees.payment_method')
            ->get();

        $permission_lists = DB::table('permission_lists')->get();
        return view('payroll.employeesalary', compact('users', 'userList', 'permission_lists'));
    }

    // // save record
    // public function saveRecord(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'rec_id' => 'required|string|max:255',
    //         'payment_type' => 'required|string|max:255',
    //         'salary_amount' => 'required|string|max:255',
    //         'hourly_salary' => 'required|string|max:255',
    //         'monthly_surcharge' => 'required|string|max:255',
    //         'night_sunday_bon' => 'required|string|max:255',
    //         'holiday_bon' => 'required|string|max:255',
    //         'holiday_bon_minus' => 'required|string|max:255',
    //         'timesupplement_night_sunday' => 'required|string|max:255',
    //         'pension_insurance' => 'required|string|max:255',
    //         'unemployment_insurance' => 'required|string|max:255',
    //         'accident_insurance' => 'required|string|max:255',
    //         'uvg_grb' => 'required|string|max:255',
    //         'pension_fund' => 'required|string|max:255',
    //         'medical_insurance' => 'required|string|max:255',
    //         'collective_labor' => 'required|string|max:255',
    //         'expenses' => 'required|string|max:255',
    //         'telephone_shipment' => 'required|string|max:255',
    //         'mileage_compensation' => 'required|string|max:255',

    //     ]);

    //     DB::beginTransaction();
    //     try {
    //         $salary = StaffSalary::updateOrCreate(['rec_id' => $request->rec_id]);
    //         $salary->hourly_salary = $request->hourly_salary;
    //         $salary->salary_amount = $request->salary_amount;
    //         $salary->night_sunday_bon = $request->night_sunday_bon;
    //         $salary->holiday_bon = $request->holiday_bon;
    //         $salary->holiday_bon_minus = $request->holiday_bon_minus;
    //         $salary->timesupplement_night_sunday = $request->timesupplement_night_sunday;
    //         $salary->monthly_surcharge = $request->monthly_surcharge;
    //         $salary->pension_insurance = $request->pension_insurance;
    //         $salary->unemployment_insurance = $request->unemployment_insurance;
    //         $salary->accident_insurance = $request->accident_insurance;
    //         $salary->uvg_grb = $request->uvg_grb;
    //         $salary->pension_fund = $request->pension_fund;
    //         $salary->medical_insurance = $request->medical_insurance;
    //         $salary->collective_labor = $request->collective_labor;
    //         $salary->expenses = $request->expenses;
    //         $salary->telephone_shipment = $request->telephone_shipment;
    //         $salary->mileage_compensation = $request->mileage_compensation;
    //         $salary->save();

    //         DB::commit();
    //         Toastr::success('Create new Salary successfully :)', 'Success');
    //         return redirect()->back();
    //     } catch (\Exception$e) {
    //         DB::rollback();
    //         Toastr::error('Add Salary fail :)', 'Error');
    //         return redirect()->back();
    //     }
    // }

    // salary view detail
    public function salaryView($rec_id)
    {
        $users = DB::table('users')
            ->join('staff_salaries', 'users.rec_id', '=', 'staff_salaries.rec_id')
            ->join('profile_information', 'users.rec_id', '=', 'profile_information.rec_id')
            ->select('users.*', 'staff_salaries.*', 'profile_information.*')
            ->where('staff_salaries.rec_id', $rec_id)
            ->first();
        // $users = DB::table('users')
        //         // ->join('staff_salaries', 'users.rec_id', '=', 'staff_salaries.rec_id')
        //         ->join('profile_information', 'users.rec_id', '=', 'profile_information.rec_id')
        //         ->select('users.*','profile_information.*')
        //         ->where('=.rec_id',$rec_id)
        //         ->first();
        return view('payroll.salaryview', compact('users'));
    }

    // update record
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            $update = [
                'name' => $request->name,
                'rec_id' => $request->rec_id,
                'salary_amount' => $request->salary_amount,
                'hourly_salary' => $request->hourly_salary,
                'night_sunday_bon' => $request->night_sunday_bon,
                'holiday_bon' => $request->holiday_bon,
                'timesupplement_night_sunday' => $request->timesupplement_night_sunday,
                'monthly_surcharge' => $request->monthly_surcharge,
                'pension_insurance' => $request->pension_insurance,
                'unemployment_insurance' => $request->unemployment_insurance,
                'accident_insurance' => $request->accident_insurance,
                'uvg_grb' => $request->uvg_grb,
                'pension_fund' => $request->pension_fund,
                'medical_insurance' => $request->medical_insurance,
                'collective_labor' => $request->collective_labor,
                'expenses' => $request->expenses,
                'telephone_shipment' => $request->telephone_shipment,
                'mileage_compensation' => $request->mileage_compensation,
            ];

            StaffSalary::where('id', $request->id)->update($update);
            DB::commit();
            Toastr::success('Salary updated successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Salary update fail :)', 'Error');
            return redirect()->back();
        }
    }

    // delete record
    public function deleteRecord(Request $request)
    {
        DB::beginTransaction();
        try {

            StaffSalary::destroy($request->id);

            DB::commit();
            Toastr::success('Salary deleted successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Salary deleted fail :)', 'Error');
            return redirect()->back();
        }
    }

    // payroll Items
    public function payrollItems()
    {
        return view('payroll.payrollitems');
    }

    public function createPDF($rec_id)
    {
        $users = DB::table('users')
            ->join('staff_salaries', 'users.rec_id', '=', 'staff_salaries.rec_id')
            ->join('profile_information', 'users.rec_id', '=', 'profile_information.rec_id')
            ->select('users.*', 'staff_salaries.*', 'profile_information.*')
            ->where('staff_salaries.rec_id', $rec_id)
            ->first();

        // $data = ['title' => 'Welcome to ItSolutionStuff.com'];
        // view()->share('payroll.salaryview', compact('users'));
        // dd($users);
        $pdf = PDF::loadView('payroll.pdfpayslip', compact('users'));
        // return $pdf->download('text.pdf');
        // selecting PDF view
        // $pdf = PDF::loadView('payroll.salaryview');
        // download pdf file
        return $pdf->download('pdfview.pdf');
    }
}
