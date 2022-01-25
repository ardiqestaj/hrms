<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\LeavesAdmin;
use App\Models\leaveSettings;
use DB;
use DateTime;

class LeavesController extends Controller
{
    // -------------------------------------------------------------------------------------------------------
    // leaves Admin 
    public function leaves()
    {
        $leaves = DB::table('leaves_admins')
                    ->join('users', 'users.rec_id', '=', 'leaves_admins.rec_id')
                    ->select('leaves_admins.*', 'users.position','users.name','users.avatar')
                    ->get();

        return view('form.leaves',compact('leaves'));
    }
    // save record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'leave_type'   => 'required|string|max:255',
            'from_date'    => 'required|string|max:255',
            'to_date'      => 'required|string|max:255',
            'leave_reason' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $from_date = new DateTime($request->from_date);
            $to_date = new DateTime($request->to_date);
            $day     = $from_date->diff($to_date);
            $days    = $day->d;

            $leaves = new LeavesAdmin;
            $leaves->rec_id        = $request->rec_id;
            $leaves->leave_type    = $request->leave_type;
            $leaves->from_date     = $request->from_date;
            $leaves->to_date       = $request->to_date;
            $leaves->day           = $days;
            $leaves->leave_reason  = $request->leave_reason;
            $leaves->save();
            
            DB::commit();
            Toastr::success('Create new Leaves successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Leaves fail :)','Error');
            return redirect()->back();
        }
    }

    // edit record
    public function editRecordLeave(Request $request)
    {
        DB::beginTransaction();
        try {

            $from_date = new DateTime($request->from_date);
            $to_date = new DateTime($request->to_date);
            $day     = $from_date->diff($to_date);
            $days    = $day->d;

            $update = [
                'id'           => $request->id,
                'leave_type'   => $request->leave_type,
                'from_date'    => $request->from_date,
                'to_date'      => $request->to_date,
                'day'          => $days,
                'leave_reason' => $request->leave_reason,
            ];

            LeavesAdmin::where('id',$request->id)->update($update);
            DB::commit();
            
            DB::commit();
            Toastr::success('Updated Leaves successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Update Leaves fail :)','Error');
            return redirect()->back();
        }
    }

    // delete record
    public function deleteLeave(Request $request)
    {
        try {

            LeavesAdmin::destroy($request->id);
            Toastr::success('Leaves admin deleted successfully :)','Success');
            return redirect()->back();
        
        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('Leaves admin delete fail :)','Error');
            return redirect()->back();
        }
    }
    // ------------------------------------------------------------------
    // leaveSettings
    public function leaveSettings()
    {
        $leaves = DB::table('leave_settings')
                    ->get();
        return view('form.leavesettings',compact('leaves'));
    }

    public function saveLeaveSettings(Request $request)
    {
        $request->validate([
            'leave_names' => 'required|string|max:255',
            'leave_days' => 'required|string|max:255',
        ]);
        
        DB::beginTransaction();
        try {
            $leavesettings = new leaveSettings;
            $leavesettings->leave_names = $request->leave_names;
            $leavesettings->leave_days  = $request->leave_days;
            $leavesettings->save();
            
            DB::commit();
            Toastr::success('Create new leave :)','Success');
            return redirect()->back();
            
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add leave fail :)','Error');
            return redirect()->back();
        }
    }
     // delete recordSetting
     public function deleteSetting($leave_id)
     {
         try {
            leaveSettings::where('leave_id',$leave_id)->delete();
             Toastr::success('Leaves deleted successfully :)','Success');
             return redirect()->back();
         
         } catch(\Exception $e) {
 
             DB::rollback();
             Toastr::error('Leaves admin delete fail :)','Error');
             return redirect()->back();
         }
        // return DD ('OK');
     }

    public function editLeaveSetting(Request $request, $leave_id)
    {
     DB::beginTransaction();
     try {
         $update = [

             'leave_names'  => $request->leave_names,
             'leave_days'  => $request->leave_days
         ];

         leaveSettings::where('leave_id',$leave_id)->update($update);
         DB::commit();
         
         DB::commit();
         Toastr::success('Updated Leaves successfully :)','Success');
         return redirect()->back();
     } catch(\Exception $e) {
         DB::rollback();
         Toastr::error('Update Leaves fail :)','Error');
         return redirect()->back();
     }
    }

    // -----------------------------------------------------------------------------------------------------------
      // leaves Employee
      public function leavesEmployee()
      {
          return view('form.leavesemployee');
      }





    //   ----------------------------------------------------------------------------------------------------------
    // attendance admin
    public function attendanceIndex()
    {
        return view('form.attendance');
    }

    // attendance employee
    public function AttendanceEmployee()
    {
        return view('form.attendanceemployee');
    }

  

    // shiftscheduling
    public function shiftScheduLing()
    {
        return view('form.shiftscheduling');
    }

    // shiftList
    public function shiftList()
    {
        return view('form.shiftlist');
    }
}
