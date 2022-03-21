<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fulltimeConfig = DB::table('payment_methods')->where('payment_type', '=', "Fulltime")->first();
        $parttimeConfig = DB::table('payment_methods')->where('payment_type', '=', "Parttime")->first();
        $hourlyConfig = DB::table('payment_methods')->where('payment_type', '=', "Hourly")->first();

        return view('payroll.paymentMethod', compact('fulltimeConfig', 'parttimeConfig', 'hourlyConfig'));
    }

    // Fulltime Configuration
    public function FulltimeConfig(Request $request)
    {
        DB::beginTransaction();
        try {
            $fulltimeConfig = PaymentMethod::updateOrCreate(['payment_type' => $request->payment_type]);
            $fulltimeConfig->salary_amount = $request->salary_amount;
            $fulltimeConfig->monthly_surcharge = $request->monthly_surcharge;
            $fulltimeConfig->pension_insurance = $request->pension_insurance;
            $fulltimeConfig->unemployment_insurance = $request->unemployment_insurance;
            $fulltimeConfig->accident_insurance = $request->accident_insurance;
            $fulltimeConfig->uvg_grb = $request->uvg_grb;
            $fulltimeConfig->pension_fund = $request->pension_fund;
            $fulltimeConfig->medical_insurance = $request->medical_insurance;
            $fulltimeConfig->collective_labor = $request->collective_labor;
            $fulltimeConfig->expenses = $request->expenses;
            $fulltimeConfig->telephone_shipment = $request->telephone_shipment;
            $fulltimeConfig->mileage_compensation = $request->mileage_compensation;
            $fulltimeConfig->save();

            DB::commit();
            Toastr::success('Fulltime Configuraton updated successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Updating Fulltime Configuraton failed :)', 'Error');
            return redirect()->back();
        }
    }

    // Parttime Configuration
    public function ParttimeConfig(Request $request)
    {
        DB::beginTransaction();
        try {
            $parttimeConfig = PaymentMethod::updateOrCreate(['payment_type' => $request->payment_type]);
            $parttimeConfig->salary_amount = $request->salary_amount;
            $parttimeConfig->monthly_surcharge = $request->monthly_surcharge;
            $parttimeConfig->pension_insurance = $request->pension_insurance;
            $parttimeConfig->unemployment_insurance = $request->unemployment_insurance;
            $parttimeConfig->accident_insurance = $request->accident_insurance;
            $parttimeConfig->uvg_grb = $request->uvg_grb;
            $parttimeConfig->pension_fund = $request->pension_fund;
            $parttimeConfig->medical_insurance = $request->medical_insurance;
            $parttimeConfig->collective_labor = $request->collective_labor;
            $parttimeConfig->expenses = $request->expenses;
            $parttimeConfig->telephone_shipment = $request->telephone_shipment;
            $parttimeConfig->mileage_compensation = $request->mileage_compensation;
            $parttimeConfig->save();

            DB::commit();
            Toastr::success('Parttime Configuraton updated successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Updating Parttime Configuraton  failed :)', 'Error');
            return redirect()->back();
        }
    }

    // Hourly Configuration
    public function HourlyConfig(Request $request)
    {
        DB::beginTransaction();
        try {
            $hourlyConfig = PaymentMethod::updateOrCreate(['payment_type' => $request->payment_type]);
            $hourlyConfig->hourly_salary = $request->hourly_salary;
            $hourlyConfig->night_sunday_bon = $request->night_sunday_bon;
            $hourlyConfig->holiday_bon = $request->holiday_bon;
            $hourlyConfig->holiday_bon_minus = $request->holiday_bon_minus;
            $hourlyConfig->timesupplement_night_sunday = $request->timesupplement_night_sunday;
            $hourlyConfig->monthly_surcharge = $request->monthly_surcharge;
            $hourlyConfig->pension_insurance = $request->pension_insurance;
            $hourlyConfig->unemployment_insurance = $request->unemployment_insurance;
            $hourlyConfig->accident_insurance = $request->accident_insurance;
            $hourlyConfig->uvg_grb = $request->uvg_grb;
            $hourlyConfig->pension_fund = $request->pension_fund;
            $hourlyConfig->medical_insurance = $request->medical_insurance;
            $hourlyConfig->collective_labor = $request->collective_labor;
            $hourlyConfig->expenses = $request->expenses;
            $hourlyConfig->telephone_shipment = $request->telephone_shipment;
            $hourlyConfig->mileage_compensation = $request->mileage_compensation;
            $hourlyConfig->save();

            DB::commit();
            Toastr::success('Houly Configuraton updated successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Updating Houly Configuraton failed :)', 'Error');
            return redirect()->back();
        }
    }

}
