<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\leaveSettings;
use App\Models\LeaveApplies;
use DB;
use DateTime;
use Session;

use Auth;


class LeavesController extends Controller
{
    // -------------------------------------------------------------------------------------------------------
    // leaves Admin 
    public function leaves()
    {
        $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_settings', 'leave_settings.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_settings.leave_names','leave_settings.leave_id')
                    ->get();
        $LeaveTypes = DB::table('leave_settings')->get();

        return view('form.leaves',compact('leaves', 'LeaveTypes'));
    }
    // save record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'leave_type_id'   => 'required|string|max:255',
            'from_date'    => 'required|string|max:255',
            'to_date'      => 'required|string|max:255',
            'leave_reason' => 'required|string|max:255',
            // 'status' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $from_date = new DateTime($request->from_date);
            $to_date = new DateTime($request->to_date);
            $day     = $from_date->diff($to_date);
            $days    = $day->d;

            $leaves = new LeaveApplies;
            $leaves->rec_id        = $request->rec_id;
            $leaves->leave_type_id    = $request->leave_type_id;
            $leaves->from_date     = $request->from_date;
            $leaves->to_date       = $request->to_date;
            $leaves->day           = $days;
            $leaves->leave_reason  = $request->leave_reason;
            // $leaves->status  = $request->status;
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
                'leave_applies_id'           => $request->id,
                'leave_type_id'   => $request->leave_type_id,
                'from_date'    => $request->from_date,
                'to_date'      => $request->to_date,
                'day'          => $days,
                'leave_reason' => $request->leave_reason,
            ];

            LeaveApplies::where('leave_applies_id',$request->id)->update($update);
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

            LeaveApplies::destroy($request->id);
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
// Update leave setting -------------------------------------------------------------------------------------
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
    // Aprrove status from admin -------------------------------------------------------------------------------
    public function statusLeave(Request $request)
    {
        DB::beginTransaction();
        try {

            $update = [
                'status' => $request->status,
                'approved_by' => $request->approved_by
            ];

            LeaveApplies::where('leave_applies_id',$request->id)->update($update);
            DB::commit();
            
            DB::commit();
            Toastr::success('Status Updated :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Status updatet fail :)','Error');
            return redirect()->back();
        }
    }
      // add leaves Employee -------------------------------------------------------------------------
      public function leavesEmployee()
      {
        $user = Auth::User();
        Session::put('user', $user);
        $user=Session::get('user');
        $profile = $user->rec_id;
        $not = 'Not Yet';


        $leavesapplies = DB::table('leave_applies')
                    ->join('leave_settings', 'leave_settings.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*','leave_settings.leave_names','leave_settings.leave_id')
                    ->where('leave_applies.rec_id',$profile)
                    ->get();
        $users = DB::table('users')->get();
        $LeaveTypes = leaveSettings::all();
        return view('form.leavesemployee',compact('LeaveTypes','leavesapplies','users'));
      }
      
      // edit leaves Employee record
    public function editLeavesEmployee(Request $request)
    {
        DB::beginTransaction();
        try {

            $from_date = new DateTime($request->from_date);
            $to_date = new DateTime($request->to_date);
            $day     = $from_date->diff($to_date);
            $days    = $day->d;

            $update = [
                'leave_applies_id'           => $request->id,
                'leave_type_id'   => $request->leave_type_id,
                'from_date'    => $request->from_date,
                'to_date'      => $request->to_date,
                'day'          => $days,
                'leave_reason' => $request->leave_reason,
            ];

            LeaveApplies::where('leave_applies_id',$request->id)->update($update);
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

      // Delete leaves Employee -------------------------------------------------------------------------
      public function deleteLeavesEmployee(Request $request) {
        try {

            LeaveApplies::destroy($request->id);
            Toastr::success('Leaves admin deleted successfully :)','Success');
            return redirect()->back();
        
        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('Leaves admin delete fail :)','Error');
            return redirect()->back();
        }

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
