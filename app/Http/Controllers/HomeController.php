<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use AUTH;
use Carbon\Carbon;
use PDF;
use App\Models\User;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Client;
use App\Models\Department;
use App\Models\LeaveTypes;




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
        // $employees= Employee::all();
        $locations = Location::all();
        $clients = Client::take(6)->get();
        $clientsCount = Client::all();


        $employees = DB::table('employees')
                        ->join('departments', 'employees.department', '=', 'departments.id')
                        ->select('employees.*', 'departments.department as dep')
                        ->take(6)->get();
        $employeesCount = DB::table('employees')
        ->join('departments', 'employees.department', '=', 'departments.id')
        ->select('employees.*', 'departments.department as dep')
        ->get();
        $department = Department::all();
        return view('dashboard.dashboard', compact('clientsCount', 'employeesCount', 'employees', 'locations', 'clients'));
    }



    // employee dashboard
    public function emDashboard()
    {
        $em_id = Auth::user()->rec_id; 
        $dt        = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        $LeaveTypes = LeaveTypes::all();
        $LeavesEvidence = DB::table('leaves_evidence')->where('rec_id', $em_id) ;
        return view('dashboard.emdashboard',compact('todayDate', 'LeaveTypes', 'LeavesEvidence'));
    }

    public function generatePDF(Request $request)
    {
        // $data = ['title' => 'Welcome to ItSolutionStuff.com'];
        // $pdf = PDF::loadView('payroll.salaryview', $data);
        // return $pdf->download('text.pdf');
        // selecting PDF view
        $pdf = PDF::loadView('payroll.salaryview');
        // download pdf file
        return $pdf->download('pdfview.pdf');
    }
}
