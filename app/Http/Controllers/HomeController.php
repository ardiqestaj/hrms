<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Department;
use App\Models\LeaveTypes;
use App\Models\Location;
use App\Models\User;
use AUTH;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // main dashboard
    public function index()
    {
        if (Auth::user()->role_name == 'Admin') {
            // $employees= Employee::all();
            $locations = Location::all();
            $clients = Client::take(6)->get();
            $clientsCount = Client::all();

            $employees = DB::table('employees')
                ->join('departments', 'employees.department', '=', 'departments.id')
                ->join('users', 'users.rec_id', '=', 'employees.employee_id')
                ->select('employees.*', 'departments.department as dep', 'users.avatar')
                ->take(6)->get();
            $employeesCount = DB::table('employees')
                ->join('departments', 'employees.department', '=', 'departments.id')
                ->select('employees.*', 'departments.department as dep')
                ->get();
            $department = Department::all();
            $dt = Carbon::now();
            // $dt = $dth->format("Y-m-d");

            $nextHoliday1 = DB::table('holidays')->get();

            $nextHoliday = $nextHoliday1->sortBy('start')->where('start', '>=', $dt)->first();
            // dd($sorted);
            // $nextHoliday = Holiday::where('start', '>=', $dt)->first();

            $dt = Carbon::now();

            $checkHolidays = DB::table('holidays')->get();
            // dd($checkHolidays);
            // $totalTime = $dt->diffForHumans($nextHoliday->start)->format('%D Days and %H Hours');
            if (isset($nextHoliday)) {
                $totalTimeM = $dt->diff($nextHoliday->start)->format('%M');
                $totalTimeD = $dt->diff($nextHoliday->start)->format('%D');
                $totalTimeH = $dt->diff($nextHoliday->start)->format('%H');
                $totalTimeMin = $dt->diff($nextHoliday->start)->format('%I');
            } else {
                $totalTimeM = 999;
                $totalTimeD = 999;
                $totalTimeH = 999;
                $totalTimeMin = 999;

            }

            return view('dashboard.dashboard', compact('clientsCount', 'employeesCount', 'employees', 'locations', 'clients', 'nextHoliday', 'totalTimeD', 'totalTimeH', 'totalTimeM', 'totalTimeMin', 'checkHolidays'));
        } else {
            return redirect()->route('em/dashboard');
        }
    }

    // employee dashboard
    public function emDashboard()
    {
        if (Auth::user()->role_name == 'Employee') {
            $em_id = Auth::user()->rec_id;
            $dt = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
            $LeaveTypes = LeaveTypes::all();
            $LeavesEvidence = DB::table('leaves_evidence')->where('rec_id', $em_id);
            $dt = Carbon::now();
            $nextHoliday1 = DB::table('holidays')->get();

            $nextHoliday = $nextHoliday1->sortBy('start')->where('start', '>=', $dt)->first();
            $dt = Carbon::now();
            if (isset($nextHoliday)) {
                $totalTime = $dt->diff($nextHoliday->start)->format('%D Days, %H Hours and %I Minutes');} else {
                $totalTime = 99999;
            }
            return view('dashboard.emdashboard', compact('todayDate', 'LeaveTypes', 'LeavesEvidence', 'nextHoliday', 'totalTime'));
        } else {
            return redirect()->route('home');
        }
    }

    // public function generatePDF(Request $request)
    // {
    //     // $data = ['title' => 'Welcome to ItSolutionStuff.com'];
    //     // $pdf = PDF::loadView('payroll.salaryview', $data);
    //     // return $pdf->download('text.pdf');
    //     // selecting PDF view
    //     $pdf = PDF::loadView('payroll.salaryview');
    //     // download pdf file
    //     return $pdf->download('pdfview.pdf');
    // }

}
