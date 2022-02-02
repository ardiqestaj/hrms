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
            return view('settings.theme-settings', compact('ThemeSettings'));
    }


    // Website information settings
    public function WebsiteSettings(Request $request)
    {
        $request->validate([
            'website_name'      => 'required',
            'website_logo'      => 'image|nullable|max:1999',
            'website_favicon'   => 'image|nullable|max:1999',
        ]);

        // Handle file upload
        // Website Logo
        if($request->hasFile('website_logo')){
            // Get filename with the extension
            $fileNameWithExt = $request->file('website_logo')->getClientOriginalName();
            // Get just filename
            $filename = pathInfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just the extension
            $extension = $request->file('website_logo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('website_logo')->move(public_path('assets/images'), $fileNameToStore);
        }

        // Website favicon
        if($request->hasFile('website_favicon')){
            // Get filename with the extension
            $fileNameWithExt2 = $request->file('website_favicon')->getClientOriginalName();
            // Get just filename
            $filename2 = pathInfo($fileNameWithExt2, PATHINFO_FILENAME);
            // Get just the extension
            $extension2 = $request->file('website_favicon')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore2 = $filename2.'_'.time().'.'.$extension2;
            // Upload Image
            $path = $request->file('website_favicon')->move(public_path('assets/images'), $fileNameToStore2);
        }

        DB::beginTransaction();
        try{
            $ThemeSettings = ThemeSettings::updateOrCreate(['id' => $request->id]);
            $ThemeSettings->website_name          = $request->website_name;

            if ($request->hasFile('website_logo')) {
                $ThemeSettings->website_logo = $fileNameToStore;
            }

            if ($request->hasFile('website_favicon')) {
                $ThemeSettings->website_favicon = $fileNameToStore2;
            }
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
