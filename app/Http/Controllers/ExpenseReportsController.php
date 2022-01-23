<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ExpenseReportsController extends Controller
{
    // view page
    public function index()
    {
        return view('reports.expensereport');
    }

    // view page
    public function invoiceReports()
    {
        return view('reports.invoicereports');
    }

    // invoice view detail
    public function invoiceView()
    {
        return view('reports.invoiceview');
    }

    // daily report page
    public function dailyReport()
    {
        return view('reports.dailyreports');
    }

    // leave reports page
    public function leaveReport()
    {
        $leaves = DB::table('leaves_admins')
                    ->join('users', 'users.rec_id', '=', 'leaves_admins.rec_id')
                    ->select('leaves_admins.*', 'users.*')
                    ->get();
        return view('reports.leavereports',compact('leaves'));
    }
}
