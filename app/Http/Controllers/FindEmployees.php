<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\AssignmentEmployees;
use App\Models\Employee;
use DB;



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

                    $oneH = 3600;

                    $timeS = $location_type_work->intime;
                    $ts = strtotime($timeS);
                    $tsdiff = $ts - $oneH;
                    $tssum = $ts + $oneH;
                    $timeSDiff = date('h:i A', $tsdiff);
                    $timeSSum = date('h:i A', $tssum);

                    $timeE = $location_type_work->outime;
                    $te = strtotime($timeE);
                    $tediff = $te - $oneH;
                    $tesum = $te + $oneH;
                    $timeEDiff = date('h:i A', $tediff);
                    $timeESum = date('h:i A', $tesum);

                    // dd($timeEDiff);

        // $schedRestDays = preg_split('/\s+/', $location_type_work->restday);
        $employees = Employee::select('employees.*')
                    ->where('employees.department', 'LIKE', '%'.$location_type_work->type_work_id.'%')
                    ->whereBetween('employees.time_start', array($timeSDiff, $timeSSum))
                    ->whereBetween('employees.time_end', array($timeEDiff, $timeESum))
                    ->get();

        $finale = [];


        foreach ($employees as $employee) {

            $final = [];
            $foundEmployees['employee_id'] = $employee->employee_id;
            $foundEmployees['name'] = $employee->name;
            $foundEmployees['lastname'] = $employee->lastname;
            $foundEmployees['time_start'] = $employee->time_start;
            $foundEmployees['time_end'] = $employee->time_end;
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

















        // $days = explode(', ', $location_type_work->restday);

        //         # code...
        //         // $employeess = DB::where('restdays', $request->restday)->get();
        //         // $employeess = DB::table('employees')->get();

        //         for ($i=0; $i < count($days); $i++) {

        // $employeess = DB::table('employees')->get();
        // // foreach ($employees as $employee) {
        // dd($employeess[0]);

        //     $i=0;
        // do {

        //     $employees[$i] = DB::table('employees')
        //         ->select('employees.*')
        //         ->join('departments', 'employees.department', '=', 'departments.id')
        //         ->join('location_type_works','location_type_works.type_work_id', '=', 'departments.id' )
        //         ->join('schedules', 'schedules.idno', '=', 'location_type_works.location_type_work_id')
        //         ->where('location_type_work_id',$id)
        //         ->where('employees.department', $location_type_work->type_work_id)
        //         ->where('schedules.restday', 'LIKE', '%' .$employeess[$i]->restdays.'%' )
        //         // // // ->where('schedules.intime', 'LIKE', '%'.$employeess[$i]->time_start.'%')
        //         // // // ->where('schedules.outime', 'LIKE', '%'.$employeess[$i]->time_end.'%')

        //         ->get();

        //         $i++;
        //         // dd($location_type_work->type_work_id);
        // }while ($i < count($employeess));
        // dd($employees);


        // dd($location_type_work->type_work_id);

        // $employees = DB::table('employees')
        // ->select('employees.*')
        // ->join('departments', 'employees.department', '=', 'departments.id')
        // ->join('location_type_works','location_type_works.type_work_id', '=', 'departments.id' )
        // ->join('schedules', 'schedules.idno', '=', 'location_type_works.location_type_work_id')
        // ->where('schedules.restday', 'LIKE', '%' .$employees1->restdays.'%' )
        // // // ->where('schedules.intime', 'LIKE', '%'.$employeess[$i]->time_start.'%')
        // // // ->where('schedules.outime', 'LIKE', '%'.$employeess[$i]->time_end.'%')
        // // // ->where('departments.id', 'LIKE', '%'.$employeess[$i]->department.'%')
        // ->get();
    // dd($employeess[$j]);

    // }



// }


    // }




    // for ($i=0; $i < count($employeess); $i++) {

    //     $employees = DB::table('location_type_works')
    //     ->join('departments', 'departments.id', '=', 'location_type_works.type_work_id')
    //     ->join('schedules', 'schedules.idno', '=', 'location_type_works.location_type_work_id')
    //     ->where('schedules.restday', 'LIKE', '%'.$employeess[$i]->restdays.'%' )
    //     // ->where('schedules.intime', 'LIKE', '%'.$employees1->time_start.'%')
    //     // ->where('schedules.outime', 'LIKE', '%'.$employees1->time_end.'%')
    //     // ->where('departments.id', 'LIKE', '%'.$employees1->department.'%')
    //     // ->where('location_type_work_id',$id)
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
