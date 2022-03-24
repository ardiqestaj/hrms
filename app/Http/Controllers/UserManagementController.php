<?php

namespace App\Http\Controllers;

use App\Models\EducationInformation;
use App\Models\ExperienceInformation;
use App\Models\Family;
use App\Models\ProfileInformation;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Http\Request;
use Session;

class UserManagementController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_name == 'Admin') {
            $result = DB::table('users')
                ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.lastname')
                ->get();
            $role_name = DB::table('role_type_users')->get();
            $position = DB::table('position_types')->get();
            $department = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();
            return view('usermanagement.user_control', compact('result', 'role_name', 'position', 'department', 'status_user'));
        } else {
            return redirect()->route('home');
        }

    }
    // search user
    public function searchUser(Request $request)
    {
        if (Auth::user()->role_name == 'Admin') {
            $users = DB::table('users')->get();
            $result = DB::table('users')
                ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.lastname')
                ->get();
            $role_name = DB::table('role_type_users')->get();
            $position = DB::table('position_types')->get();
            $department = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();

            // search by name
            if ($request->name) {
                $result = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->where('users.name', 'LIKE', '%' . $request->name . '%')
                    ->orWhere('employees.lastname', 'LIKE', '%' . $request->name . '%')
                    ->get();
            }

            // search by role name
            if ($request->role_name) {
                $result = User::where('role_name', 'LIKE', '%' . $request->role_name . '%')->get();
            }

            // search by status
            if ($request->status) {
                $result = User::where('status', 'LIKE', '%' . $request->status . '%')->get();
            }

            // search by name and role name
            if ($request->name && $request->role_name) {
                // $result = User::where('name', 'LIKE', '%' . $request->name . '%')
                //     ->where('role_name', 'LIKE', '%' . $request->role_name . '%')
                //     ->get();

                $result = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->where('users.role_name', 'LIKE', '%' . $request->role_name . '%')
                    ->where('users.name', 'LIKE', '%' . $request->name . '%')
                    ->orWhere('employees.lastname', 'LIKE', '%' . $request->name . '%')
                    ->get();
            }

            // search by role name and status
            if ($request->role_name && $request->status) {
                $result = User::where('role_name', 'LIKE', '%' . $request->role_name . '%')
                    ->where('status', 'LIKE', '%' . $request->status . '%')
                    ->get();
            }

            // search by name and status
            if ($request->name && $request->status) {
                // $result = User::where('name', 'LIKE', '%' . $request->name . '%')
                //     ->where('status', 'LIKE', '%' . $request->status . '%')
                //     ->get();

                $result = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->where('status', 'LIKE', '%' . $request->status . '%')

                    ->where('users.name', 'LIKE', '%' . $request->name . '%')
                    ->orWhere('employees.lastname', 'LIKE', '%' . $request->name . '%')
                    ->get();
            }

            // search by name and role name and status
            if ($request->name && $request->role_name && $request->status) {
                // $result = User::where('name', 'LIKE', '%' . $request->name . '%')
                //     ->where('role_name', 'LIKE', '%' . $request->role_name . '%')
                //     ->where('status', 'LIKE', '%' . $request->status . '%')
                //     ->get();

                $result = DB::table('users')
                    ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                    ->where('status', 'LIKE', '%' . $request->status . '%')

                    ->where('users.name', 'LIKE', '%' . $request->name . '%')
                    ->orWhere('employees.lastname', 'LIKE', '%' . $request->name . '%')
                    ->get();
            }

            return view('usermanagement.user_control', compact('users', 'role_name', 'position', 'department', 'status_user', 'result'));
        } else {
            return redirect()->route('home');
        }

    }

    // use activity log
    public function activityLog()
    {
        if (Auth::user()->role_name == 'Admin') {

            $activityLog = DB::table('activity_logs')->get();
            return view('usermanagement.activity_log', compact('activityLog'));

        } else {
            return redirect()->route('home');
        }
    }
    // activity log
    public function activityLogInLogOut()
    {
        if (Auth::user()->role_name == 'Admin') {

            $activityLog = DB::table('users')
                ->join('user_activity_logs', 'users.email', '=', 'user_activity_logs.email')
                ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
                ->select('user_activity_logs.*', 'employees.lastname')
                ->get();

            // dd($activityLog[0]->lastname);
            return view('usermanagement.user_activity_log', compact('activityLog'));

        } else {
            return redirect()->route('home');
        }
    }

    // profile user
    public function profile()
    {
        $user = Auth::User();
        Session::put('user', $user);
        $user = Session::get('user');
        $profile = $user->rec_id;

        $user = DB::table('users')->get();
        $information = DB::table('profile_information')->where('rec_id', $profile)->first();
        $family = DB::table('families')->where('rec_id', $profile)->first();
        $education = DB::table('education_information')->where('rec_id', $profile)->get();
        $experience = DB::table('experience_information')->where('rec_id', $profile)->get();
        $employee = DB::table('users')
            ->join('employees', 'users.rec_id', '=', 'employees.employee_id')
            ->where('rec_id', $profile)
            ->select('users.name', 'employees.lastname')->first();
        // dd($employee);
        return view('usermanagement.profile_user', compact('information', 'education', 'employee', 'family', 'experience'));

    }

    // save profile information
    public function profileInformation(Request $request)
    {
        try {
            if (!empty($request->images)) {
                $image_name = $request->hidden_image;
                $image = $request->file('images');
                if ($image_name == 'photo_defaults.jpg') {
                    if ($image != '') {
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('/assets/images/'), $image_name);
                    }
                } else {
                    if ($image != '') {
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('/assets/images/'), $image_name);
                    }
                }
                $update = [
                    'rec_id' => $request->rec_id,
                    'name' => $request->name,
                    'avatar' => $image_name,
                ];
                User::where('rec_id', $request->rec_id)->update($update);
            }

            $information = ProfileInformation::updateOrCreate(['rec_id' => $request->rec_id]);
            $information->name = $request->name;
            $information->rec_id = $request->rec_id;
            $information->email = $request->email;
            $information->birth_date = $request->birthDate;
            $information->gender = $request->gender;
            $information->address = $request->address;
            $information->state = $request->state;
            $information->country = $request->country;
            $information->pin_code = $request->pin_code;
            $information->phone_number = $request->phone_number;
            $information->department = $request->department;
            $information->designation = $request->designation;
            $information->reports_to = $request->reports_to;
            $information->save();

            DB::commit();
            Toastr::success('Profile Information successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Add Profile Information fail :)', 'Error');
            return redirect()->back();
        }
    }

    // new family info
    public function createFamilyInfo(Request $request)
    {
        DB::beginTransaction();

        try {
            $family = Family::updateOrCreate(['rec_id' => $request->rec_id]);
            $family->name = $request->name;
            $family->rec_id = $request->rec_id;
            $family->relationship = $request->relationship;
            $family->birthdate = $request->birthdate;
            $family->phone_number = $request->phone_number;
            $family->save();

            DB::commit();
            Toastr::success('Family Information successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Add Family Information fail :)', 'Error');
            return redirect()->back();
        }
    }

    // new education info
    public function createEducationInfo(Request $request)
    {
        DB::beginTransaction();

        try {

            $education = EducationInformation::updateOrCreate(['id' => $request->id]);
            $education->rec_id = $request->rec_id;
            $education->institution = $request->institution;
            $education->subject = $request->subject;
            $education->st_date = $request->st_date;
            $education->end_date = $request->end_date;
            $education->degree = $request->degree;
            $education->grade = $request->grade;
            $education->save();

            DB::commit();
            Toastr::success('Education Information successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Add Education Information fail :)', 'Error');
            return redirect()->back();
        }

    }
    // new experience info
    public function createExperienceInfo(Request $request)
    {
        // DB::beginTransaction();

        try {

            $experience = ExperienceInformation::updateOrCreate(['exp_id' => $request->exp_id]);
            $experience->rec_id = $request->rec_id;
            $experience->work_company_name = $request->work_company_name;
            $experience->work_address = $request->work_address;
            $experience->work_position = $request->work_position;
            $experience->work_period_from = $request->work_period_from;
            $experience->work_period_to = $request->work_period_to;
            $experience->save();

            DB::commit();
            Toastr::success('Experience Information successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Add Experience Information fail :)', 'Error');
            return redirect()->back();
        }

    }

    // save new user
    public function addNewUserSave(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|min:11|numeric',
            'role_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'image' => 'required|image',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $dt = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/images'), $image);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->join_date = $todayDate;
            $user->phone_number = $request->phone;
            $user->role_name = $request->role_name;
            $user->position = $request->position;
            $user->department = $request->department;
            $user->status = $request->status;
            $user->avatar = $image;
            $user->password = Hash::make($request->password);
            $user->save();
            DB::commit();
            Toastr::success('Create new account successfully :)', 'Success');
            return redirect()->route('userManagement');
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('User add new account fail :)', 'Error');
            return redirect()->back();
        }
    }

    // update
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $rec_id = $request->rec_id;
            $name = $request->name;
            $email = $request->email;
            $role_name = $request->role_name;
            $position = $request->position;
            $phone = $request->phone;
            $department = $request->department;
            $status = $request->status;

            $dt = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
            $image_name = $request->hidden_image;
            $image = $request->file('images');
            if ($image_name == 'photo_defaults.jpg') {
                if ($image != '') {
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/assets/images/'), $image_name);
                }
            } else {

                if ($image != '') {
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/assets/images/'), $image_name);
                }
            }

            $update = [

                'rec_id' => $rec_id,
                'name' => $name,
                'role_name' => $role_name,
                'email' => $email,
                'position' => $position,
                'phone_number' => $phone,
                'department' => $department,
                'status' => $status,
                'avatar' => $image_name,
            ];

            $activityLog = [
                'user_name' => $name,
                'email' => $email,
                'phone_number' => $phone,
                'status' => $status,
                'role_name' => $role_name,
                'modify_user' => 'Update',
                'date_time' => $todayDate,
            ];

            DB::table('user_activity_logs')->insert($activityLog);
            User::where('rec_id', $request->rec_id)->update($update);
            DB::commit();
            Toastr::success('User updated successfully :)', 'Success');
            return redirect()->route('userManagement');

        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('User update fail :)', 'Error');
            return redirect()->back();
        }
    }
    // delete
    public function delete(Request $request)
    {
        $user = Auth::User();
        Session::put('user', $user);
        $user = Session::get('user');
        DB::beginTransaction();
        try {
            $fullName = $user->name;
            $email = $user->email;
            $phone_number = $user->phone_number;
            $status = $user->status;
            $role_name = $user->role_name;

            $dt = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            $activityLog = [
                'user_name' => $fullName,
                'email' => $email,
                'phone_number' => $phone_number,
                'status' => $status,
                'role_name' => $role_name,
                'modify_user' => 'Delete',
                'date_time' => $todayDate,
            ];

            DB::table('user_activity_logs')->insert($activityLog);

            if ($request->avatar == 'photo_defaults.jpg') {
                User::destroy($request->id);
            } else {
                User::destroy($request->id);
                unlink('assets/images/' . $request->avatar);
            }
            DB::commit();
            Toastr::success('User deleted successfully :)', 'Success');
            return redirect()->route('userManagement');

        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('User deleted fail :)', 'Error');
            return redirect()->back();
        }
    }

    // view change password
    public function changePasswordView()
    {
        return view('settings.changepassword');
    }

    // change password in db
    public function changePasswordDB(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        DB::commit();
        Toastr::success('User change successfully :)', 'Success');
        return redirect()->intended('home');
    }
}
