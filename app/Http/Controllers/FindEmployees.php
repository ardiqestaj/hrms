<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\AssignmentEmployees;
use DB;
use App\Models\Employee;


class FindEmployees extends Controller
{
    public function find(Request $request, $id) {

        $location_type_work = DB::table('location_type_works')
                        ->join('locations', 'locations.id', '=', 'location_type_works.location_id')
                        ->join('billing_addresses', 'locations.id', '=', 'billing_addresses.location_id')
                        ->join('departments', 'departments.id', '=', 'location_type_works.type_work_id')
                        ->join('schedules', 'schedules.idno', '=', 'location_type_works.location_type_work_id')
                        ->select('location_type_works.location_type_work_id','location_type_works.type_work_id', 'location_type_works.number_of_employees', 'locations.*', 'departments.department', 'schedules.intime', 'schedules.outime', 'schedules.hours', 'schedules.restday')
                        ->where('location_type_work_id',$id)
                        ->first();
        $assignments = DB::table('assignment_employees')
                    ->join('employees', 'employees.employee_id', '=', 'assignment_employees.employee_id')
                    ->select('employees.name', 'employees.lastname', 'employees.employee_id as em_id', 'employees.restdays', 'employees.time_start', 'employees.time_end')
                    ->where('assignment_employees.location_type_work_id',$id)
                    ->get();


        $employees = Employee::select('employee_id', 'name', 'restdays')
                    ->where('employees.department', 'LIKE', '%'.$location_type_work->type_work_id.'%')
                    ->get();

        $finale = [];
        foreach ($employees as $employee) {
            $final = [];
            $foundEmployees['employee_id'] = $employee->employee_id;
            $foundEmployees['name'] = $employee->name;
            $foundEmployees['restdays'] = $employee->restdays;

            $foundEmployees['schedule'] = $location_type_work->restday;

            $final[] = $foundEmployees;

            $fin = [];
            foreach ($final as $fin) {
                $restDays = $foundEmployees['restdays'];
                $empRestDays = explode(', ', $restDays);
                $numEmpRestDays = count($empRestDays);

                $locSched = $foundEmployees['schedule'];
                $schedRestDays = explode(', ', $locSched);

                $common = array_intersect($empRestDays, $schedRestDays);
                $countCommon = count($common);
                if($countCommon == $numEmpRestDays){
                    $fin['equalDays'] = $countCommon;
                    $finale[] = $fin; 
                } 
            }
        }



    
       













        
    // $employeess = DB::table('employees')->get();


        // foreach ($employeess as $employees1) {
            // for ($i=0; $i < count($employeess); $i++) { 
              

        // $employees = DB::table('employees')
        // ->join('departments', 'employees.department', '=', 'departments.id')
        // ->join('location_type_works','location_type_works.type_work_id', '=', 'departments.id' )
        // ->join('schedules', 'schedules.idno', '=', 'location_type_works.location_type_work_id')
        // ->select('employees.*', 'schedules.*','location_type_works.*', 'departments.*' )
        // ->where('schedules.restday', 'LIKE', '%' .'employees.restdays'.'%' )
        // ->where('schedules.intime', 'LIKE', '%'.$employeess[$i]->time_start.'%')
        // ->where('schedules.outime', 'LIKE', '%'.$employeess[$i]->time_end.'%')
        // ->where('departments.id', 'LIKE', '%'.$employeess[$i]->department.'%')
        // ->get();
    // }
    // dd($employees);
    // }




    // for ($i=0; $i < count($employeess); $i++) { 

    //     $employees = DB::table('location_type_works')
    //     ->join('departments', 'departments.id', '=', 'location_type_works.type_work_id')
    //     ->join('schedules', 'schedules.idno', '=', 'location_type_works.location_type_work_id')
    //     ->where('schedules.restday', 'LIKE', '%' .$employees1->restdays.'%' )
    //     ->where('schedules.intime', 'LIKE', '%'.$employees1->time_start.'%')
    //     ->where('schedules.outime', 'LIKE', '%'.$employees1->time_end.'%')
    //     ->where('departments.id', 'LIKE', '%'.$employees1->department.'%')
    //     ->where('location_type_work_id',$id)
    //     ->get();
    // }
    // dd($employees);

    // $employees = DB::table('employees')->select('employees.*')
    // ->where('employees.department', 'LIKE', '%'.$location_type_work->type_work_id.'%')
    // ->where('employees.restdays','LIKE','%'.$location_type_work->restday.'%')
    // ->where('employees.time_start', 'LIKE', '%'.$location_type_work->intime.'%')
    // ->where('employees.time_end', 'LIKE', '%'.$location_type_work->outime.'%')
    // ->get();

        return view('locations.findemployees', compact('finale', 'location_type_work', 'assignments'));

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
