<?php

namespace App\Http\Controllers;

use App\Models\IncidentReport;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class IncidentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->rec_id;

        $userAssigned = DB::table('assignment_employees')->where('employee_id', $user)->first();

        $reports = DB::table('incident_reports')
            ->join('locations', 'incident_reports.rep_location_id', '=', 'locations.id')
            ->where('rep_employee_id', $user)
            ->select('incident_reports.*', 'locations.location_name')
            ->get();

        return view('reports.incidentsreports', compact('userAssigned', 'reports'));
    }

    public function indexAdmin()
    {
        $user = Auth::user()->rec_id;

        // $userAssigned = DB::table('assignment_employees')->where('employee_id', $user)->first();

        $reports = DB::table('incident_reports')
            ->join('locations', 'incident_reports.rep_location_id', '=', 'locations.id')
            ->join('employees', 'incident_reports.rep_employee_id', '=', 'employees.employee_id')
            ->select('incident_reports.*', 'locations.location_name', 'employees.name', 'employees.lastname')
            ->get();

        return view('reports.incidentsreportsadmin', compact('reports'));
    }

    public function showReport($id)
    {
        $date = Carbon::now();

        try {
            $update = [

                'id' => $id,
                'read_at' => $date,
            ];

            IncidentReport::where('id', $id)->update($update);
            DB::commit();

            $reports = DB::table('incident_reports')
                ->join('locations', 'incident_reports.rep_location_id', '=', 'locations.id')
                ->join('employees', 'incident_reports.rep_employee_id', '=', 'employees.employee_id')
                ->where('incident_reports.id', $id)
                ->select('incident_reports.*', 'locations.location_name', 'employees.name', 'employees.lastname')
                ->first();
            return view('reports.showincidentsreports', compact('reports'));

        } catch (\Exception$e) {
            DB::rollback();
            return redirect()->back();
        }

    }

    public function createReport(Request $request)
    {
        $request->validate([

            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        if ($request->filled('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->move(public_path('assets/images/posts'), $image);
        } else {
            $image = null;
        }
        try {
            $report = new IncidentReport;
            $report->rep_employee_id = $request->rep_employee_id;
            $report->rep_location_id = $request->rep_location_id;
            $report->rep_date = $request->rep_date;
            $report->rep_time = $request->rep_time;
            $report->rep_description = $request->rep_description;
            $report->rep_image = $image;
            $report->save();

            DB::commit();
            Toastr::success('Create new report successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Add Report fail :)', 'Error');
            return redirect()->back();
        }
    }

}
