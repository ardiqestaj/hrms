<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\ThemeSettings;
use DB;
use Session;

use Auth;


class ThemeSettingsController extends Controller
{
    public function WebsiteStore(){
            $ThemeSettings = DB::table('theme_settings')->first();
            return view('settings.companysettings', compact('ThemeSettings'));
    }

    // Company information settings
    public function WebsiteSettings(Request $request)
    {
        DB::beginTransaction();
        try{
            $websiteLogo = $request->website_logo;
            $request->website_logo->move(public_path('assets/images'), $websiteLogo);

            $websiteFavicon = $request->website_favicon;
            $request->website_favicon->move(public_path('assets/images'), $websiteFavicon);

            $ThemeSettings = CompanyInfo::updateOrCreate(['id' => $request->id]);
            $ThemeSettings->Website_name          = $request->Website_name;
            $ThemeSettings->Website_logo          = $websiteLogo;
            $ThemeSettings->Website_favicon       = $websiteFavicon;
            $ThemeSettings->save();

            DB::commit();
            Toastr::success('Theme Information updated successfully :)','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Updating Theme Information failed :)','Error');
            return redirect()->back();
        }
    }
}
