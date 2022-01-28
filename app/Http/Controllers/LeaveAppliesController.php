<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
// use App\Models\LeavesAdmin;
use App\Models\leaveSettings;
use App\Models\LeaveApplies;
use DB;
// use DateTime;


class LeaveAppliesController extends Controller
{
     // profile user
     public function leaveAppliesEmployee()
     {   
         $user = Auth::User();
         Session::put('user', $user);
         $user=Session::get('user');
         $profile = $user->rec_id;
        
         $user = DB::table('users')->get();
         $employees = DB::table('leave_applies')->where('rec_id',$profile)->first();
         $LeaveTypes = leaveSettings::all();
         return view('form.leavesemployee',compact('$LeaveTypes'));

 
         if(empty($employees))
         {
             $Leaveapplies = DB::table('leave_applies')->where('rec_id',$profile)->first();
             return view('form.leavesemployee',compact('Leaveapplies','user'));
 
         }else{
             $rec_id = $employees->rec_id;
             if($rec_id == $profile)
             {
                 $Leaveapplies = DB::table('leave_applies')->where('rec_id',$profile)->first();
                 return view('form.leavesemployee',compact('Leaveapplies','user'));
             }else{
                 $Leaveapplies = LeaveApplies::all();
                 return view('form.leavesemployee',compact('Leaveapplies','user'));
             } 
         }
        
     }
}
