<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock',
        ]);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $email = $request->email;
        $password = $request->password;

        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        // dd($logInUser);
        $activityLog = [

            'name' => $email,
            'email' => $email,
            'description' => 'has log in',
            'date_time' => $todayDate,
        ];
        if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 'Active', 'role_name' => 'Admin'])) {
            DB::table('activity_logs')->insert($activityLog);
            Toastr::success('Login successfully :)', 'Success');
            return redirect()->intended('home');
        } elseif (Auth::attempt(['email' => $email, 'password' => $password, 'status' => null, 'role_name' => 'Admin'])) {
            DB::table('activity_logs')->insert($activityLog);
            Toastr::success('Login successfully :)', 'Success');
            return redirect()->intended('home');
        } elseif (Auth::attempt(['email' => $email, 'password' => $password, 'status' => null, 'role_name' => 'Employee'])) {
            DB::table('activity_logs')->insert($activityLog);
            Toastr::success('Login successfully :)', 'Success');
            return redirect()->intended('em/dashboard');
        } elseif (Auth::attempt(['email' => $email, 'password' => $password, 'role_name' => 'Employee'])) {
            DB::table('activity_logs')->insert($activityLog);
            Toastr::success('Login successfully :)', 'Success');
            return redirect()->intended('em/dashboard');
        } else {
            Toastr::error('fail, WRONG USERNAME OR PASSWORD :)', 'Error');
            return redirect('login');
        }

    }

    public function logout()
    {
        $user = Auth::User();
        Session::put('user', $user);
        $user = Session::get('user');

        $name = $user->name;
        $email = $user->email;
        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        $activityLog = [

            'name' => $name,
            'email' => $email,
            'description' => 'has logged out',
            'date_time' => $todayDate,
        ];
        DB::table('activity_logs')->insert($activityLog);
        Auth::logout();
        Toastr::success('Logout successfully :)', 'Success');
        return redirect('login');
    }

}
