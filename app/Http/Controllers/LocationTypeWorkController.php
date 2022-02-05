<?php

namespace App\Http\Controllers;

use App\Models\LocationTypeWork;
use App\Models\AssignmentEmployees;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;


class LocationTypeWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            // 'location_id'   => 'required|string|max:255',
            // 'from_date'    => 'required|string|max:255',
            // 'to_date'      => 'required|string|max:255',
            'number_of_employees' => 'required',
            // 'status' => 'required|string|max:255',
        ]);
        $restday = ($request->restday != null) ? implode(', ', $request->restday) : null ;

        DB::beginTransaction();
        try {

            // $from_date = new DateTime($request->from_date);
            // $to_date = new DateTime($request->to_date);
            // $day     = $from_date->diff($to_date);
            // $days    = $day->d;


            $leaves = new LocationTypeWork;
            $leaves->location_id        = $request->id;
            $leaves->type_work_id    = $request->type_of_work;
            $leaves->number_of_employees     = $request->number_of_employees;
            $leaves->save();

            $location = LocationTypeWork::latest('location_type_work_id')->first();

            $leaves = new Schedule;
            $leaves->idno    = $location->location_type_work_id;
            $leaves->intime    = date("h:i A", strtotime($request->intime)) ;
            $leaves->outime     = date("h:i A", strtotime($request->outime)) ;
            $leaves->datefrom     = $request->datefrom;
            $leaves->dateto     = $request->dateto;
            $leaves->hours     = $request->hours;
            $leaves->restday     = $restday;
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

   
}
