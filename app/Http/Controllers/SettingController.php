<?php

namespace App\Http\Controllers;

use App\Models\RolesPermissions;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // company/settings/page
    public function companySettings()
    {
        if (Auth::user()->role_name == 'Admin') {

            return view('settings.companysettings');
        } else {
            return redirect()->route('em/dashboard');
        }
    }

    // theme/settings/page
    public function themeSettings()
    {
        if (Auth::user()->role_name == 'Admin') {
            return view('settings.theme-settings');
        } else {
            return redirect()->route('em/dashboard');
        }
    }

    // Roles & Permissions
    public function rolesPermissions()
    {
        if (Auth::user()->role_name == 'Admin') {
            $rolesPermissions = RolesPermissions::All();
            return view('settings.rolespermissions', compact('rolesPermissions'));
        } else {
            return redirect()->route('em/dashboard');
        }
    }

    // add role permissions
    public function addRecord(Request $request)
    {
        $request->validate([
            'roleName' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $roles = RolesPermissions::where('permissions_name', '=', $request->roleName)->first();
            if ($roles === null) {
                // roles name doesn't exist
                $role = new RolesPermissions;
                $role->permissions_name = $request->roleName;
                $role->save();
            } else {

                // roles name exits
                DB::rollback();
                Toastr::error('Roles name exits :)', 'Error');
                return redirect()->back();
            }

            DB::commit();
            Toastr::success('Create new role successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Add Role fail :)', 'Error');
            return redirect()->back();
        }
    }

    // edit roles permissions
    public function editRolesPermissions(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->id;
            $roleName = $request->roleName;

            $update = [
                'id' => $id,
                'permissions_name' => $roleName,
            ];

            RolesPermissions::where('id', $id)->update($update);
            DB::commit();
            Toastr::success('Role Name updated successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Role Name update fail :)', 'Error');
            return redirect()->back();
        }
    }
    // delete roles permissions
    public function deleteRolesPermissions(Request $request)
    {
        try {
            RolesPermissions::destroy($request->id);
            Toastr::success('Role Name deleted successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Role Name delete fail :)', 'Error');
            return redirect()->back();
        }
    }
}
