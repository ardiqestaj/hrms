<?php

namespace App\Http\Controllers;
use DB;

use App\Models\Department;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class DepartmentController extends Controller
{
    // public function department()
    // {
    //     $departments = DB::table('departments')->get();
    //     return view('form.allemployeecard',compact('departments'));
    // }

    public function allDepartmet()
    {
        $departments = Department::all();
        return view('form.departments',compact('departments'));
    }

    // new department
    public function saveDepartment(Request $request)
    {
        $request->validate([
            'department' => 'required|string|max:255'
        ]);

        DB::beginTransaction();
        try {
            $department = new Department;
            $department->department = $request->department;
            $department->save();

            DB::commit();
            Toastr::success('Create New Department successfully :)','Success');
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add Department fail :)','Error');
            return redirect()->back();
        }
    }

    public function updateDepartment( Request $request)
    {
        DB::beginTransaction();
        try{
            $id           = $request->id;
            $department  = $request->department;

            $update = [

                'id'           => $id,
                'department' => $department,
            ];

            Department::where('id',$request->id)->update($update);
            DB::commit();
            Toastr::success('Department updated successfully :)','Success');
            return redirect()->back();

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Department update fail :)','Error');
            return redirect()->back();
        }

    }

    public function deleteDepartment(Request $request)
    {
        try{

        Department::destroy($request->id);
        Toastr::success('Department deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('Department delete fail :)','Error');
            return redirect()->back();
        }
    }
}
