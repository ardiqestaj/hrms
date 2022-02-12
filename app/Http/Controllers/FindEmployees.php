<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\AssignmentEmployees;

class FindEmployees extends Controller
{
    public function find(Request $request, $id) {

        $locations = DB::table('locations')
                        ->join('billing_addresses', 'locations.id', '=', 'billing_addresses.location_id')
                        ->select('locations.*', 'billing_addresses.*')
                        ->where('locations.id',$id)
                        ->first();
        $location_type_work = DB::table('location_type_works')
                        ->select('location_type_works.location_type_work_id')
                        ->where('location_type_work_id',$id);
        $employees = DB::table('employees')->select('employees.name', 'employees.lastname', 'employees.employee_id',)->get();

        return view('locations.findemployees', compact('locations', 'employees', 'location_type_work'));

    }

    public function assignment(Request $request) {

    // $request->validate([
    //     'number_of_employees' => 'required',
    // ]);
    // $restday = ($request->restday != null) ? implode(', ', $request->restday) : null ;

    DB::beginTransaction();
    try {

        $assignmentEmployees = new AssignmentEmployees;
        $assignmentEmployees->location_type_work_id         = $request->location_type_work_id ;
        $assignmentEmployees->employee_id                   = $request->employee_id;
        $assignmentEmployees->save();

        DB::commit();
        Toastr::success('Create new Sector successfully :)','Success');
        return redirect()->back();
    } catch(\Exception $e) {
        DB::rollback();
        Toastr::error('Add Sector fail :)','Error');
        return redirect()->back();
    }
    }
}
