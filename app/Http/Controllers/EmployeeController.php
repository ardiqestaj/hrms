<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\StaffSalary;
use App\Models\User;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // all employee card view
    public function cardAllEmployee(Request $request)
    {
        if (Auth::user()->role_name == 'Admin') {

            $users = DB::table('users')
                ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company', 'employees.lastname')
                ->paginate(11);
            $userList = DB::table('users')->get();
            $departments = DB::table('departments')->get();
            // $permission_lists = DB::table('permission_lists')->get();
            return view('form.allemployeecard', compact('users', 'userList', 'departments'));
        } else {
            return redirect()->route('em/dashboard');
        }
    }
    // all employee list
    public function listAllEmployee()
    {
        if (Auth::user()->role_name == 'Admin') {

            $users = DB::table('users')
                ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->get();
            $userList = DB::table('users')->get();
            $departments = DB::table('departments')->get();
            // $permission_lists = DB::table('permission_lists')->get();
            return view('form.employeelist', compact('users', 'userList', 'departments'));
        } else {
            return redirect()->route('em/dashboard');
        }
    }

    // save data employee
    public function saveRecord(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'birthDate' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'employee_id' => 'required|string|max:255',
            'company' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $employees = Employee::where('email', '=', $request->email)->first();
            if ($employees === null) {

                $employee = new Employee;
                $employee->name = $request->name;
                $employee->email = $request->email;
                $employee->birth_date = $request->birthDate;
                $employee->gender = $request->gender;
                $employee->employee_id = $request->employee_id;
                $employee->company = $request->company;
                $employee->save();

                for ($i = 0; $i < count($request->id_count); $i++) {
                    $module_permissions = [
                        'employee_id' => $request->employee_id,
                        'module_permission' => $request->permission[$i],
                        'id_count' => $request->id_count[$i],
                        'read' => $request->read[$i],
                        'write' => $request->write[$i],
                        'create' => $request->create[$i],
                        'delete' => $request->delete[$i],
                        'import' => $request->import[$i],
                        'export' => $request->export[$i],
                    ];
                    DB::table('module_permissions')->insert($module_permissions);
                }

                DB::commit();
                Toastr::success('Add new employee successfully :)', 'Success');
                return redirect()->route('all/employee/card');
            } else {
                DB::rollback();
                Toastr::error('Add new employee exits :)', 'Error');
                return redirect()->back();
            }
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Add new employee fail :)', 'Error');
            return redirect()->back();
        }
    }
    // view edit record
    public function viewRecord($employee_id)
    {
        if (Auth::user()->role_name == 'Admin') {

            $permission = DB::table('employees')
                ->join('module_permissions', 'employees.employee_id', '=', 'module_permissions.employee_id')
                ->select('employees.*', 'module_permissions.*', )
                ->where('employees.employee_id', '=', $employee_id)
                ->get();

            $employees = DB::table('employees')
                ->join('departments', 'employees.department', '=', 'departments.id')
                ->select('employees.*', 'employees.department as dep_id', 'departments.department as dep')
                ->where('employee_id', $employee_id)->get();
            $departments = DB::table('departments')->get();
            return view('form.edit.editemployee', compact('employees', 'permission', 'departments'));
        } else {
            return redirect()->route('em/dashboard');
        }
    }
    // update record employee
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            $restdays = ($request->restdays != null) ? implode(', ', $request->restdays) : null;
            $restdays_opt = ($request->restdays_opt != null) ? implode(', ', $request->restdays_opt) : null;

            // update table Employee
            $updateEmployee = [
                'employee_id' => $request->id,
                'name' => $request->name,
                'lastname' => $request->lastname,
                'username' => $request->username,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'department' => $request->department,
                'payment_method' => $request->payment_method,
                'restdays' => $restdays,
                'time_start' => date("h:i A", strtotime($request->time_start)),
                'time_end' => date("h:i A", strtotime($request->time_end)),
                'restdays_opt' => $restdays_opt,
                'time_start_opt' => date("h:i A", strtotime($request->time_start_opt)),
                'time_end_opt' => date("h:i A", strtotime($request->time_end_opt)),
            ];
            // update table user
            $updateUser = [
                'rec_id' => $request->id,
                'name' => $request->name,
                'email' => $request->email,
            ];

            // update table module_permissions
            // for($i=0;$i<count($request->id_permission);$i++)
            // {
            //     $UpdateModule_permissions = [
            //         'employee_id' => $request->employee_id,
            //         'module_permission' => $request->permission[$i],
            //         'id'                => $request->id_permission[$i],
            //         'read'              => $request->read[$i],
            //         'write'             => $request->write[$i],
            //         'create'            => $request->create[$i],
            //         'delete'            => $request->delete[$i],
            //         'import'            => $request->import[$i],
            //         'export'            => $request->export[$i],
            //     ];
            //     module_permission::where('id',$request->id_permission[$i])->update($UpdateModule_permissions);
            // }

            User::where('rec_id', $request->id)->update($updateUser);
            Employee::where('employee_id', $request->id)->update($updateEmployee);

            DB::commit();
            Toastr::success('updated record successfully :)', 'Success');
            return redirect()->route('all/employee/card');
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('updated record fail :)', 'Error');
            return redirect()->back();
        }
    }
    // delete record
    public function deleteRecord(Request $request)
    {
        DB::beginTransaction();
        try {

            Employee::where('employee_id', $request->employee_id)->delete();
            User::where('rec_id', $request->employee_id)->delete();
            StaffSalary::where('rec_id', $request->employee_id)->delete();

            // module_permission::where('employee_id',$employee_id)->delete();

            DB::commit();
            Toastr::success('Delete record successfully :)', 'Success');
            return redirect()->route('all/employee/card');

        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Delete record fail :)', 'Error');
            return redirect()->back();
        }
    }
    // employee search
    public function employeeSearch(Request $request)
    {
        if (Auth::user()->role_name == 'Admin') {

            $users = DB::table('users')
                ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company', 'employees.lastname')
                ->get();
            $departments = DB::table('departments')->get();
            // $permission_lists = DB::table('permission_lists')->get();
            $userList = DB::table('users')->get();

            // search by id
            if ($request->employee_id) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company', 'employees.lastname')
                    ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                    ->latest()->paginate(11);
            }
            // search by name
            if ($request->name) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company', 'employees.lastname')
                    ->where('users.name', 'LIKE', '%' . $request->name . '%')
                    ->orWhere('employees.lastname', 'LIKE', '%' . $request->name . '%')
                    ->latest()->paginate(11);
            }
            // search by department
            if ($request->department) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company', 'employees.lastname')
                    ->where('users.department', 'LIKE', '%' . $request->department . '%')
                    ->latest()->paginate(11);
            }

            // search by name and id
            if ($request->employee_id && $request->name) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company', 'employees.lastname')
                    ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                    ->where('users.name', 'LIKE', '%' . $request->name . '%')
                    ->latest()->paginate(11);
            }
            // search by department and id
            if ($request->employee_id && $request->department) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company', 'employees.lastname')
                    ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                    ->where('users.department', 'LIKE', '%' . $request->department . '%')
                    ->latest()->paginate(11);
            }
            // search by name and department
            if ($request->name && $request->department) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company', 'employees.lastname')
                    ->where('users.name', 'LIKE', '%' . $request->name . '%')
                    ->where('users.department', 'LIKE', '%' . $request->department . '%')
                    ->latest()->paginate(11);
            }
            // search by name and department and id
            if ($request->employee_id && $request->name && $request->department) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company', 'employees.lastname')
                    ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                    ->where('users.name', 'LIKE', '%' . $request->name . '%')
                    ->where('users.department', 'LIKE', '%' . $request->department . '%')
                    ->latest()->paginate(11);
            }
            return view('form.allemployeecard', compact('users', 'userList', 'departments'));
        } else {
            return redirect()->route('em/dashboard');
        }
    }
    public function employeeListSearch(Request $request)
    {
        if (Auth::user()->role_name == 'Admin') {

            $users = DB::table('users')
                ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->get();
            $permission_lists = DB::table('permission_lists')->get();
            $userList = DB::table('users')->get();

            // search by id
            if ($request->employee_id) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                    ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                    ->get();
            }
            // search by name
            if ($request->name) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                    ->where('users.name', 'LIKE', '%' . $request->name . '%')
                    ->get();
            }
            // search by name
            if ($request->position) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                    ->where('users.position', 'LIKE', '%' . $request->position . '%')
                    ->get();
            }

            // search by name and id
            if ($request->employee_id && $request->name) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                    ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                    ->where('users.name', 'LIKE', '%' . $request->name . '%')
                    ->get();
            }
            // search by position and id
            if ($request->employee_id && $request->position) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                    ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                    ->where('users.position', 'LIKE', '%' . $request->position . '%')
                    ->get();
            }
            // search by name and position
            if ($request->name && $request->position) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                    ->where('users.name', 'LIKE', '%' . $request->name . '%')
                    ->where('users.position', 'LIKE', '%' . $request->position . '%')
                    ->get();
            }
            // search by name and position and id
            if ($request->employee_id && $request->name && $request->position) {
                $users = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                    ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                    ->where('users.name', 'LIKE', '%' . $request->name . '%')
                    ->where('users.position', 'LIKE', '%' . $request->position . '%')
                    ->get();
            }
            return view('form.employeelist', compact('users', 'userList', 'permission_lists'));
        } else {
            return redirect()->route('em/dashboard');
        }
    }

    // employee profile
    public function profileEmployee($rec_id)
    {
        if (Auth::user()->role_name == 'Admin') {

            $information = DB::table('profile_information')

                ->where('rec_id', '=', $rec_id)
                ->first();

            $userAdmin = DB::table('users')->where('rec_id', $rec_id)->first();

            $user = DB::table('users')
                ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.lastname')
                ->where('rec_id', $rec_id)->first();
            $education = DB::table('education_information')->where('rec_id', $rec_id)->get();
            $families = DB::table('families')->where('rec_id', $rec_id)->first();
            $experience = DB::table('experience_information')->where('rec_id', $rec_id)->get();

            return view('form.employeeprofile', compact('user', 'information', 'education', 'families', 'experience'));
        } else {
            return redirect()->route('em/dashboard');
        }
    }
}
