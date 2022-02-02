<?php

namespace App\Http\Controllers;

use App\Models\ClockTimeSettings;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class ClockTimeSettingsController extends Controller
{
    public function index() 
    {
        $data = DB::table('clock_time_settings')->where('id', 1)->first();
        return view('settings.timeclocksettings', compact('data'));
    }


    // Updating Settings Information
    public function update(Request $request) 
    {
        DB::beginTransaction();
        try {
            $v = $request->validate([
            'country' => 'required|max:100',
            'timezone' => 'required|timezone|max:100',
            'iprestriction' => 'max:1600',
            'time_format' => 'max:1',
            'clock_comment' => 'max:2',
            'rfid' => 'max:2',
        ]);

            $country = $request->country;
            $timezone = $request->timezone;
            $clock_comment = $request->clock_comment;
            $iprestriction = $request->iprestriction;
            $time_format = $request->time_format;
            $rfid = $request->rfid;
        
            if ($timezone != null) {
                $t = ClockTimeSettings::where('id', 1)->value('timezone');
                $path = base_path('.env');
            
                if (file_exists($path)) {
                    file_put_contents($path, str_replace('APP_TIMEZONE='.$t, 'APP_TIMEZONE='.$timezone, file_get_contents($path)));
                }
            }

            // table::settings()
            ClockTimeSettings::where('id', 1)
        ->update([
                'country' => $country,
                'timezone' => $timezone,
                'clock_comment' => $clock_comment,
                'iprestriction' => $iprestriction,
                'time_format' => $time_format,
                'rfid' => $rfid,
        ]);
            DB::commit();
            Toastr::success('Status Updated :)', 'Success');
            return redirect()->route('timeclock/settings');
        }
        catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Status updatet fail :)','Error');
            return redirect()->route('timeclock/settings');
        }
    }
}
