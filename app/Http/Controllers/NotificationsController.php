<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Auth;
use DB;


class NotificationsController extends Controller
{
    public function index()
    {

        $notifications =  Auth()->user()->notifications()->paginate(4); 

        return view('notifications.allnotifications', compact('notifications'));
    }

    public function show($id)
    {
        if ($id) {
            Auth()->user()->notifications->where('id',$id)->markAsRead();
        }
        $notifications =  Auth()->user()->notifications->where('id',$id)->first();

        // dd($notifications);

        return view('notifications.shownotifications', compact('notifications'));
    }

    public function markAll()
    {
       
        Auth()->user()->notifications->markAsRead();
        return redirect()->back();

    }


    public function delete($id)
    {
        
        try {

            if ($id) {
                Auth()->user()->notifications()->where('id',$id)->delete();
            }
            Toastr::success('Notifications deleted successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception$e) {

            DB::rollback();
            Toastr::error('Notifications deleted fail :)', 'Error');
            return redirect()->back();
        }

    }

    public function deleteone($id)
    {
        try {
            if ($id) {
                Auth()->user()->notifications()->where('id',$id)->delete();
            }
            Toastr::success('Notifications deleted successfully :)', 'Success');
            return redirect()->route('all/notification');

        } catch (\Exception$e) {

            DB::rollback();
            Toastr::error('Notifications deleted fail :)', 'Error');
            return redirect()->route('all/notification');
        }

    }
}