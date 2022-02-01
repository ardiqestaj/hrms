<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\LeaveTypes;
use App\Models\LeaveApplies;
use App\Models\LeavesEvidence;
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
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->get();
        $LeaveTypes = DB::table('leave_types')->get();


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
    // leaveTypes
    public function leaveTypes()
    {
        $leaves = DB::table('leave_types')
                    ->get();
        return view('form.leavetypes',compact('leaves'));
    }

    public function saveLeaveTypes(Request $request)
    {
        $request->validate([
            'leave_names' => 'required|string|max:255',
            'leave_days' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $LeaveTypes = new LeaveTypes;
            $LeaveTypes->leave_names = $request->leave_names;
            $LeaveTypes->leave_days  = $request->leave_days;
            $LeaveTypes->save();

            DB::commit();
            Toastr::success('Create new leave :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add leave fail :)','Error');
            return redirect()->back();
        }
    }
     // delete recordTypes
     public function deleteTypes($leave_id)
     {
         try {
            LeaveTypes::where('leave_id',$leave_id)->delete();
             Toastr::success('Leaves deleted successfully :)','Success');
             return redirect()->back();

         } catch(\Exception $e) {

             DB::rollback();
             Toastr::error('Leaves admin delete fail :)','Error');
             return redirect()->back();
         }
        // return DD ('OK');
     }
// Update leave Types -------------------------------------------------------------------------------------
    public function editLeaveTypes(Request $request, $leave_id)
    {
     DB::beginTransaction();
     try {
         $update = [

             'leave_names'  => $request->leave_names,
             'leave_days'  => $request->leave_days
         ];

         LeaveTypes::where('leave_id',$leave_id)->update($update);
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

            $LeavesEvidence = LeavesEvidence::updateOrCreate(['leave_applies_id' => $request->id]);
            $LeavesEvidence->leave_type_id          = $request->leave_type_id;
            $LeavesEvidence->leave_applies_id       = $request->id;
            $LeavesEvidence->rec_id                 = $request->rec_id;
            $LeavesEvidence->day                    = $request->day;
            $LeavesEvidence->status                 = $request->status;
            $LeavesEvidence->save();

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


        $leavesapplies = DB::table('leave_applies')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*','leave_types.leave_names','leave_types.leave_id')
                    ->where('leave_applies.rec_id',$profile)
                    ->get();
        $users = DB::table('users')->get();
        $LeaveTypes = LeaveTypes::all();
        $LeavesEvidence = DB::table('leaves_evidence')
        ->where('leaves_evidence.rec_id',$profile)
        ->where('leaves_evidence.status','Approved')
        ->get();


        return view('form.leavesemployee',compact('LeaveTypes','leavesapplies','users','LeavesEvidence'));
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

    // Leaves search
    public function searchLeave(Request $request)
    {
        $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->get();
        $LeaveTypes = LeaveTypes::all();
        // search by name
        if($request->name) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('users.name', 'LIKE', '%'.$request->name.'%')
                    ->get();
        }
        // search by leave name
        if($request->leave_names) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('leave_types.leave_names', 'LIKE', '%'.$request->leave_names.'%')
                    ->get();
        }
        // search by status
        if($request->status) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('leave_applies.status', 'LIKE', '%'.$request->status.'%')
                    ->get();
        }
        // search by leave start
        if($request->from_date) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('leave_applies.from_date', 'LIKE', '%'.$request->from_date.'%')
                    ->get();
        }
        // search by leave end
        if($request->to_date) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('leave_applies.to_date', 'LIKE', '%'.$request->to_date.'%')
                    ->get();
        }
        // search by name and leave name
        if($request->name && $request->leave_names) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('users.name', 'LIKE', '%'.$request->name.'%')
                    ->where('leave_types.leave_names', 'LIKE', '%'.$request->leave_names.'%')
                    ->get();
        }
        // search by name and status
        if($request->name && $request->status) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('users.name', 'LIKE', '%'.$request->name.'%')
                    ->where('leave_applies.status', 'LIKE', '%'.$request->status.'%')
                    ->get();
        }
        // search by name and leave start
        if($request->name && $request->from_date) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('users.name', 'LIKE', '%'.$request->name.'%')
                    ->where('leave_applies.from_date', 'LIKE', '%'.$request->from_date.'%')
                    ->get();
        }
        // search by name and leave end
        if($request->name && $request->to_date) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('users.name', 'LIKE', '%'.$request->name.'%')
                    ->where('leave_applies.to_date', 'LIKE', '%'.$request->to_date.'%')
                    ->get();
        }
        // search by leave name and status
        if($request->leave_names && $request->status) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('leave_types.leave_names', 'LIKE', '%'.$request->leave_names.'%')
                    ->where('leave_applies.status', 'LIKE', '%'.$request->status.'%')
                    ->get();
        }
        // search by leave name and leave start
        if($request->leave_names && $request->from_date) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('leave_types.leave_names', 'LIKE', '%'.$request->leave_names.'%')
                    ->where('leave_applies.from_date', 'LIKE', '%'.$request->from_date.'%')
                    ->get();
        }
        // search by leave name and leave end
        if($request->leave_names && $request->to_date) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('leave_types.leave_names', 'LIKE', '%'.$request->leave_names.'%')
                    ->where('leave_applies.to_date', 'LIKE', '%'.$request->to_date.'%')
                    ->get();
        }
        // search by status and leave start
        if($request->status && $request->from_date) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('leave_applies.status', 'LIKE', '%'.$request->status.'%')
                    ->where('leave_applies.from_date', 'LIKE', '%'.$request->from_date.'%')
                    ->get();
        }
        // search by status and leave start
        if($request->status && $request->to_date) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('leave_applies.status', 'LIKE', '%'.$request->status.'%')
                    ->where('leave_applies.to_date', 'LIKE', '%'.$request->to_date.'%')
                    ->get();
        }
        // search by leave start and leave end
        if($request->from_date && $request->to_date) {
            $leaves = DB::table('leave_applies')
                    ->join('users', 'users.rec_id', '=', 'leave_applies.rec_id')
                    ->join('leave_types', 'leave_types.leave_id', '=', 'leave_applies.leave_type_id')
                    ->select('leave_applies.*', 'users.position','users.name','users.avatar','leave_types.leave_names','leave_types.leave_id')
                    ->where('leave_applies.from_date', 'LIKE', '%'.$request->from_date.'%')
                    ->where('leave_applies.to_date', 'LIKE', '%'.$request->to_date.'%')
                    ->get();
        }

        return view('form.leaves',compact('leaves', 'LeaveTypes'));
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
