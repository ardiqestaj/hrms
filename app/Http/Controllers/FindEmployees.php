<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\AssignmentEmployees;
use DB;


class FindEmployees extends Controller
{
    public function find(Request $request, $id) {

        $location_type_work = DB::table('location_type_works')
                        ->join('locations', 'locations.id', '=', 'location_type_works.location_id')
                        ->join('billing_addresses', 'locations.id', '=', 'billing_addresses.location_id')
                        ->join('departments', 'departments.id', '=', 'location_type_works.type_work_id')
                        ->join('schedules', 'schedules.idno', '=', 'location_type_works.location_type_work_id')
                        ->select('location_type_works.location_type_work_id', 'location_type_works.number_of_employees', 'locations.*', 'departments.department', 'schedules.intime', 'schedules.outime', 'schedules.hours', 'schedules.restday')
                        ->where('location_type_work_id',$id)
                        ->first();
        $employees = DB::table('employees')->select('employees.name', 'employees.lastname', 'employees.employee_id',)->get();

        $assignments = DB::table('assignment_employees')
                    ->join('employees', 'employees.employee_id', '=', 'assignment_employees.employee_id')
                    ->select('employees.name', 'employees.lastname', 'employees.employee_id as em_id', 'employees.restdays', 'employees.time_start', 'employees.time_end')
                    ->where('assignment_employees.location_type_work_id',$id)
                    ->get();

        return view('locations.findemployees', compact('employees', 'location_type_work', 'assignments'));

    }

    public function assignment(Request $request, $id) {

    DB::beginTransaction();
    try {

        // foreach ($request->customleave_to as $insert) {
            AssignmentEmployees::where('location_type_work_id',$id)->delete();

            if ($request->customleave_to) {
                $assignment = $request->customleave_to;
                for ($i=0; $i < count($assignment) ; $i++) { 
                    
                $saveRecord = [
                    'location_type_work_id' => $id,
                    'employee_id' => $assignment[$i],
    
                ];
                AssignmentEmployees::create($saveRecord);
            }
           
        }
       
        DB::commit();
        Toastr::success('Assignment successfully :)','Success');
        return redirect()->back();
    } catch(\Exception $e) {
        DB::rollback();
        Toastr::error('Assignment fail :)','Error');
        return redirect()->back();
    }}
    
}
