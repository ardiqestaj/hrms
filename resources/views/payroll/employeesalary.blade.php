
@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">
                        <span>Main</span>
                    </li>
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-dashboard"></i>
                            <span> Dashboard</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            <li><a href="{{ route('home') }}">Admin Dashboard</a></li>
                            <li><a href="{{ route('em/dashboard') }}">Employee Dashboard</a></li>
                        </ul>
                    </li>
                    @if (Auth::user()->role_name=='Admin')
                        <li class="menu-title"> <span>Authentication</span> </li>
                        <li class="submenu">
                            <a href="#">
                                <i class="la la-user-secret"></i> <span> User Controller</span> <span class="menu-arrow"></span>
                            </a>
                            <ul style="display: none;">
                                <li><a href="{{ route('userManagement') }}">All User</a></li>
                                <li><a href="{{ route('activity/log') }}">Activity Log</a></li>
                                <li><a href="{{ route('activity/login/logout') }}">Activity User</a></li>
                            </ul>
                        </li>
                    @endif
                    <li class="menu-title">
                        <span>Employees</span>
                    </li>
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-user"></i>
                            <span> Employees</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            <li><a href="{{ route('all/employee/card') }}">All Employees</a></li>
                            <li><a href="{{ route('form/holidays/new') }}">Holidays</a></li>
                            <li><a href="{{ route('form/leaves/new') }}">Leaves (Admin) 
                                <span class="badge badge-pill bg-primary float-right">1</span></a>
                            </li>
                            <li><a href="{{route('form/leavesemployee/new')}}">Leaves (Employee)</a></li>
                            <li><a href="{{ route('form/leavesettings/page') }}">Leave Settings</a></li>
                            <li><a href="{{ route('attendance/page') }}">Attendance (Admin)</a></li>
                            <li><a href="{{ route('attendance/employee/page') }}">Attendance (Employee)</a></li>
                            <li><a href="departments.html">Departments</a></li>
                            <li><a href="designations.html">Designations</a></li>
                            <li><a href="timesheet.html">Timesheet</a></li>
                            <li><a href="shift-scheduling.html">Shift & Schedule</a></li>
                            <li><a href="overtime.html">Overtime</a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>HR</span> </li>
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-files-o"></i>
                            <span> Sales </span> 
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            <li><a href="estimates.html">Estimates</a></li>
                            <li><a class="active" href="{{ route('form/invoice/view/page') }}">Invoices</a></li>
                            <li><a href="payments.html">Payments</a></li>
                            <li><a href="expenses.html">Expenses</a></li>
                            <li><a href="provident-fund.html">Provident Fund</a></li>
                            <li><a href="taxes.html">Taxes</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" class="noti-dot">
                            <i class="la la-user"></i>
                            <span> Payroll</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            <li><a class="active" href="{{ route('form/salary/page') }}"> Employee Salary </a></li>
                            <li><a href="{{ url('form/salary/view') }}"> Payslip </a></li>
                            <li><a href="{{ route('form/payroll/items') }}"> Payroll Items </a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-pie-chart"></i>
                        <span> Reports </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('form/expense/reports/page') }}"> Expense Report </a></li>
                            <li><a href="{{ route('form/invoice/reports/page') }}"> Invoice Report </a></li>
                            <li><a href="payments-reports.html"> Payments Report </a></li>
                            <li><a href="employee-reports.html"> Employee Report </a></li>
                            <li><a href="payslip-reports.html"> Payslip Report </a></li>
                            <li><a href="attendance-reports.html"> Attendance Report </a></li>
                            <li><a href="{{ route('form/leave/reports/page') }}"> Leave Report </a></li>
                            <li><a href="{{ route('form/daily/reports/page') }}"> Daily Report </a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>Performance</span> </li>
                    <li class="submenu"> <a href="#"><i class="la la-graduation-cap"></i>
                        <span> Performance </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('form/performance/indicator/page') }}"> Performance Indicator </a></li>
                            <li><a href="{{ route('form/performance/page') }}"> Performance Review </a></li>
                            <li><a href="{{ route('form/performance/appraisal/page') }}"> Performance Appraisal </a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-edit"></i>
                        <span> Training </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('form/training/list/page') }}"> Training List </a></li>
                            <li><a href="{{ route('form/trainers/list/page') }}"> Trainers</a></li>
                            <li><a href="training-type.html"> Training Type </a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>Administration</span> </li>
                    <li> <a href="assets.html"><i class="la la-object-ungroup">
                        </i> <span>Assets</span></a>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-briefcase"></i>
                        <span> Jobs </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="user-dashboard.html"> User Dasboard </a></li>
                            <li><a href="jobs-dashboard.html"> Jobs Dasboard </a></li>
                            <li><a href="jobs.html"> Manage Jobs </a></li>
                            <li><a href="manage-resumes.html"> Manage Resumes </a></li>
                            <li><a href="shortlist-candidates.html"> Shortlist Candidates </a></li>
                            <li><a href="interview-questions.html"> Interview Questions </a></li>
                            <li><a href="offer_approvals.html"> Offer Approvals </a></li>
                            <li><a href="experiance-level.html"> Experience Level </a></li>
                            <li><a href="candidates.html"> Candidates List </a></li>
                            <li><a href="schedule-timing.html"> Schedule timing </a></li>
                            <li><a href="apptitude-result.html"> Aptitude Results </a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>Pages</span> </li>
                    <li class="submenu"> <a href="#"><i class="la la-user"></i>
                        <span> Profile </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="profile.html"> Employee Profile </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee Salary <span id="year"></span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Salary</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_salary"><i class="fa fa-plus"></i> Add Salary</a>
                    </div>
                </div>
            </div>

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Employee Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                    <div class="form-group form-focus select-focus">
                        <select class="select floating"> 
                            <option value=""> -- Select -- </option>
                            <option value="">Employee</option>
                            <option value="1">Manager</option>
                        </select>
                        <label class="focus-label">Role</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
                    <div class="form-group form-focus select-focus">
                        <select class="select floating"> 
                            <option> -- Select -- </option>
                            <option> Pending </option>
                            <option> Approved </option>
                            <option> Rejected </option>
                        </select>
                        <label class="focus-label">Leave Status</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <input class="form-control floating datetimepicker" type="text">
                        </div>
                        <label class="focus-label">From</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <input class="form-control floating datetimepicker" type="text">
                        </div>
                        <label class="focus-label">To</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                    <a href="#" class="btn btn-success btn-block"> Search </a>  
                </div>     
            </div>
            <!-- /Search Filter -->  
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Employee ID</th>
                                    <th>Email</th>
                                    <th>Join Date</th>
                                    <th>Role</th>
                                    <th>Salary</th>
                                    <th>Payslip</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $items)
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="{{ url('employee/profile/'.$items->rec_id) }}" class="avatar"><img alt="" src="{{ URL::to('/assets/images/'. $items->avatar) }}"></a>
                                            <a href="{{ url('employee/profile/'.$items->rec_id) }}">{{ $items->name }}<span>{{ $items->position }}</span></a>
                                        </h2>
                                    </td>
                                    <td>{{ $items->rec_id }}</td>
                                    <td hidden class="id">{{ $items->id }}</td>
                                    <td hidden class="name">{{ $items->name }}</td>
                                    <td hidden class="basic">{{ $items->basic }}</td>
                                    <td hidden class="da">{{ $items->da }}</td>
                                    <td hidden class="hra">{{ $items->hra }}</td>
                                    <td hidden class="conveyance">{{ $items->conveyance }}</td>
                                    <td hidden class="allowance">{{ $items->allowance }}</td>
                                    <td hidden class="medical_allowance">{{ $items->medical_allowance }}</td>
                                    <td hidden class="tds">{{ $items->tds }}</td>
                                    <td hidden class="esi">{{ $items->esi }}</td>
                                    <td hidden class="pf">{{ $items->pf }}</td>
                                    <td hidden class="leave">{{ $items->leave }}</td>
                                    <td hidden class="prof_tax">{{ $items->prof_tax }}</td>
                                    <td hidden class="labour_welfare">{{ $items->labour_welfare }}</td>
                                    <td>{{ $items->email }}</td>
                                    <td>{{ $items->join_date }}</td>
                                    <td>{{ $items->role_name }}</td>
                                    <td>${{ $items->salary }}</td>
                                    <td hidden class="salary">{{ $items->salary }}</td>
                                    <td><a class="btn btn-sm btn-primary" href="{{ url('form/salary/view/'.$items->rec_id) }}">Generate Slip</a></td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item userSalary" href="#" data-toggle="modal" data-target="#edit_salary"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item salaryDelete" href="#" data-toggle="modal" data-target="#delete_salary"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->

        <!-- Add Salary Modal -->
        <div id="add_salary" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Staff Salary</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/salary/save') }}" method="POST">
                            @csrf
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>Select Staff</label>
                                        <select class="select select2s-hidden-accessible @error('name') is-invalid @enderror" style="width: 100%;" tabindex="-1" aria-hidden="true" id="name" name="name">
                                            <option value="">-- Select --</option>
                                            @foreach ($userList as $key=>$user )
                                                <option value="{{ $user->name }}" data-employee_id={{ $user->rec_id }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input class="form-control" type="hidden" name="rec_id" id="employee_id" readonly>
                                <div class="col-sm-6"> 
                                    <label>Net Salary</label>
                                    <input class="form-control @error('salary') is-invalid @enderror" type="number" name="salary" id="salary" value="{{ old('salary') }}" placeholder="Enter net salary">
                                    @error('salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <h4 class="text-primary">Earnings</h4>
                                    <div class="form-group">
                                        <label>Basic</label>
                                        <input class="form-control @error('basic') is-invalid @enderror" type="number" name="basic" id="basic" value="{{ old('basic') }}" placeholder="Enter basic">
                                        @error('basic')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>DA(40%)</label>
                                        <input class="form-control @error('da') is-invalid @enderror" type="number"  name="da" id="da" value="{{ old('da') }}" placeholder="Enter DA(40%)">
                                        @error('da')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>HRA(15%)</label>
                                        <input class="form-control @error('hra') is-invalid @enderror" type="number"  name="hra" id="hra" value="{{ old('hra') }}" placeholder="Enter HRA(15%)">
                                        @error('hra')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Conveyance</label>
                                        <input class="form-control @error('conveyance') is-invalid @enderror" type="number"  name="conveyance" id="conveyance" value="{{ old('conveyance') }}" placeholder="Enter conveyance">
                                        @error('conveyance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Allowance</label>
                                        <input class="form-control @error('allowance') is-invalid @enderror" type="number"  name="allowance" id="allowance" value="{{ old('allowance') }}" placeholder="Enter allowance">
                                        @error('allowance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Medical  Allowance</label>
                                        <input class="form-control @error('medical_allowance') is-invalid @enderror" type="number" name="medical_allowance" id="medical_allowance" value="{{ old('medical_allowance') }}" placeholder="Enter medical  allowance">
                                        @error('medical_allowance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">  
                                    <h4 class="text-primary">Deductions</h4>
                                    <div class="form-group">
                                        <label>TDS</label>
                                        <input class="form-control @error('tds') is-invalid @enderror" type="number" name="tds" id="tds" value="{{ old('tds') }}" placeholder="Enter TDS">
                                        @error('tds')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                    <div class="form-group">
                                        <label>ESI</label>
                                        <input class="form-control @error('esi') is-invalid @enderror" type="number" name="esi" id="esi" value="{{ old('esi') }}" placeholder="Enter ESI">
                                        @error('esi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>PF</label>
                                        <input class="form-control @error('pf') is-invalid @enderror" type="number" name="pf" id="pf" value="{{ old('pf') }}" placeholder="Enter PF">
                                        @error('pf')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Leave</label>
                                        <input class="form-control @error('leave') is-invalid @enderror" type="text" name="leave" id="leave" value="{{ old('leave') }}" placeholder="Enter leave">
                                        @error('leave')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Prof. Tax</label>
                                        <input class="form-control @error('prof_tax') is-invalid @enderror" type="number" name="prof_tax" id="prof_tax" value="{{ old('prof_tax') }}" placeholder="Enter Prof. Tax">
                                        @error('prof_tax')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Loan</label>
                                        <input class="form-control @error('labour_welfare') is-invalid @enderror" type="number" name="labour_welfare" id="labour_welfare" value="{{ old('labour_welfare') }}" placeholder="Enter Loan">
                                        @error('labour_welfare')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Salary Modal -->
        
        <!-- Edit Salary Modal -->
        <div id="edit_salary" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Staff Salary</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/salary/update') }}" method="POST">
                            @csrf
                            <input class="form-control" type="hidden" name="id" id="e_id" value="" readonly>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>Name Staff</label>
                                        <input class="form-control " type="text" name="name" id="e_name" value="" readonly>
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Net Salary</label>
                                    <input class="form-control" type="text" name="salary" id="e_salary" value="">
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <h4 class="text-primary">Earnings</h4>
                                    <div class="form-group">
                                        <label>Basic</label>
                                        <input class="form-control" type="text" name="basic" id="e_basic" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>DA(40%)</label>
                                        <input class="form-control" type="text"  name="da" id="e_da" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>HRA(15%)</label>
                                        <input class="form-control" type="text"  name="hra" id="e_hra" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Conveyance</label>
                                        <input class="form-control" type="text"  name="conveyance" id="e_conveyance" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Allowance</label>
                                        <input class="form-control" type="text"  name="allowance" id="e_allowance" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Medical  Allowance</label>
                                        <input class="form-control" type="text" name="medical_allowance" id="e_medical_allowance" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6">  
                                    <h4 class="text-primary">Deductions</h4>
                                    <div class="form-group">
                                        <label>TDS</label>
                                        <input class="form-control" type="text" name="tds" id="e_tds" value="">
                                    </div> 
                                    <div class="form-group">
                                        <label>ESI</label>
                                        <input class="form-control" type="text" name="esi" id="e_esi" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>PF</label>
                                        <input class="form-control" type="text" name="pf" id="e_pf" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Leave</label>
                                        <input class="form-control" type="text" name="leave" id="e_leave" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Prof. Tax</label>
                                        <input class="form-control" type="text" name="prof_tax" id="e_prof_tax" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Loan</label>
                                        <input class="form-control" type="text" name="labour_welfare" id="e_labour_welfare" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Salary Modal -->
        
        <!-- Delete Salary Modal -->
        <div class="modal custom-modal fade" id="delete_salary" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Salary</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/salary/delete') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <input type="hidden" name="id" class="e_id" value="">
                                        <button type="submit" class="btn btn-primary continue-btn submit-btn">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Salary Modal -->
     
    </div>
    <!-- /Page Wrapper -->
    @section('script')
        <script>
            $(document).ready(function() {
                $('.select2s-hidden-accessible').select2({
                    closeOnSelect: false
                });
            });
        </script>
        <script>
            // select auto id and email
            $('#name').on('change',function()
            {
                $('#employee_id').val($(this).find(':selected').data('employee_id'));
            });
        </script>
        {{-- update js --}}
        <script>
            $(document).on('click','.userSalary',function()
            {
                var _this = $(this).parents('tr');
                $('#e_id').val(_this.find('.id').text());
                $('#e_name').val(_this.find('.name').text());
                $('#e_salary').val(_this.find('.salary').text());
                $('#e_basic').val(_this.find('.basic').text());
                $('#e_da').val(_this.find('.da').text());
                $('#e_hra').val(_this.find('.hra').text());
                $('#e_conveyance').val(_this.find('.conveyance').text());
                $('#e_allowance').val(_this.find('.allowance').text());
                $('#e_medical_allowance').val(_this.find('.medical_allowance').text());
                $('#e_tds').val(_this.find('.tds').text());
                $('#e_esi').val(_this.find('.esi').text());
                $('#e_pf').val(_this.find('.pf').text());
                $('#e_leave').val(_this.find('.leave').text());
                $('#e_prof_tax').val(_this.find('.prof_tax').text());
                $('#e_labour_welfare').val(_this.find('.labour_welfare').text());
            });
        </script>
         {{-- delete js --}}
    <script>
        $(document).on('click','.salaryDelete',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    @endsection
@endsection
