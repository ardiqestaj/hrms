<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    public function CompanyStore()
    {
        if (Auth::user()->role_name == 'Admin') {
            $CompanyInfo = DB::table('company_infos')->first();
            return view('settings.companysettings', compact('CompanyInfo'));
        } else {
            return redirect()->route('em/dashboard');
        }
    }

    // Company information settings
    public function CompanySettings(Request $request)
    {
        DB::beginTransaction();
        try {
            $CompanyInfo = CompanyInfo::updateOrCreate(['id' => $request->id]);
            $CompanyInfo->company_name = $request->company_name;
            $CompanyInfo->company_contact = $request->company_contact;
            $CompanyInfo->company_address = $request->company_address;
            $CompanyInfo->company_country = $request->company_country;
            $CompanyInfo->company_city = $request->company_city;
            $CompanyInfo->company_province = $request->company_province;
            $CompanyInfo->company_postal_code = $request->company_postal_code;
            $CompanyInfo->company_email = $request->company_email;
            $CompanyInfo->company_phone_number = $request->company_phone_number;
            $CompanyInfo->company_mobile_number = $request->company_mobile_number;
            $CompanyInfo->company_fax = $request->company_fax;
            $CompanyInfo->company_website = $request->company_website;
            $CompanyInfo->save();

            DB::commit();
            Toastr::success('Company Information updated successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Update Company Information failed :)', 'Error');
            return redirect()->back();
        }
    }

}
