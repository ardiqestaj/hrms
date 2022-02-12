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

    //  Create Location Type
    public function create(Request $request)
    {
        $request->validate([
            'number_of_employees' => 'required',
        ]);
        $restday = ($request->restday != null) ? implode(', ', $request->restday) : null ;

        DB::beginTransaction();
        try {

            $leaves = new LocationTypeWork;
            $leaves->location_id        = $request->id;
            $leaves->type_work_id    = $request->type_work_id;
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
            Toastr::success('Create new Sector successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Sector fail :)','Error');
            return redirect()->back();
        }
    }
    // Edit location Type of Work
    public function Edit(Request $request)
    {

        $restday = ($request->restday != null) ? implode(', ', $request->restday) : null ;
        DB::beginTransaction();

        try {
            $updateLocationTypeWork = [
            'type_work_id'          => $request->type_work_id,
            'number_of_employees'   => $request->number_of_employees
            ];

            $updateSchedule = [
            'intime'       => date("h:i A", strtotime($request->intime)),
            'outime'       => date("h:i A", strtotime($request->outime)),
            'datefrom'     => $request->datefrom,
            'dateto'       => $request->dateto,
            'hours'        => $request->hours,
            'restday'      =>$restday
            ];

            LocationTypeWork::where('location_type_work_id',$request->id)->update($updateLocationTypeWork);
            Schedule::where('idno',$request->id)->update($updateSchedule);
            DB::commit();

            // DB::commit();
            Toastr::success('Updated sector successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Updated sector fail :)','Error');
            return redirect()->back();
        }
    }
    
    // Delete Location Type
    public function delete(Request $request)
    {
        try {

            LocationTypeWork::where('location_type_work_id',$request->id)->delete();
            Schedule::where('idno',$request->id)->delete();

            Toastr::success('Sector successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('Sector deleted fail :)','Error');
            return redirect()->back();
        }
    }

   
}
