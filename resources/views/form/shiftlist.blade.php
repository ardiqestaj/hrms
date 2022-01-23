
@extends('layouts.master')
@section('content')
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
                        <a href="#" class="noti-dot">
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
                            <li><a class="active" href="{{ route('attendance/page') }}">Attendance (Admin)</a></li>
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
                            <li><a href="{{ route('form/invoice/view/page') }}">Invoices</a></li>
                            <li><a href="payments.html">Payments</a></li>
                            <li><a href="expenses.html">Expenses</a></li>
                            <li><a href="provident-fund.html">Provident Fund</a></li>
                            <li><a href="taxes.html">Taxes</a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-money"></i>
                        <span> Payroll </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('form/salary/page') }}"> Employee Salary </a></li>
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
                    <li><a href="promotion.html"><i class="la la-bullhorn"></i> <span>Promotion</span></a></li>
                    <li><a href="resignation.html"><i class="la la-external-link-square"></i> <span>Resignation</span></a></li>
                    <li><a href="termination.html"><i class="la la-times-circle"></i> <span>Termination</span></a></li>
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
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Shift List</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('all/employee/list') }}">Employees</a></li>
                            <li class="breadcrumb-item active">Shift List</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn m-r-5" data-toggle="modal" data-target="#add_shift">Add Shifts</a>
                        <a href="#" class="btn add-btn m-r-5" data-toggle="modal" data-target="#add_schedule"> Assign Shifts</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Shift Name</th>
                                    <th>Min Start Time</th>
                                    <th>Start Time</th>
                                    <th>Max Start Time</th>
                                    <th>Min End Time</th>
                                    <th>End Time</th>
                                    <th>Max End Time</th>
                                    <th>Break Time</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>10'o clock Shift</td>
                                    <td>09:00:00 am</td>
                                    <td>10:00:00 am</td>
                                    <td>10:30:00 am</td>
                                    <td>06:00:00 pm</td>
                                    <td>06:30:00 pm</td>
                                    <td>07:00:00 pm</td>
                                    <td>30 mins</td>
                                    <td class="text-center">
                                        <div class="action-label">
                                            <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                                <i class="fa fa-dot-circle-o text-success"></i> Active
                                            </a>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_shift"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>10:30 shift</td>
                                    <td>10:00:00 am</td>
                                    <td>10:30:00 am	</td>
                                    <td>11:00:00 am</td>
                                    <td>06:30:00 pm</td>
                                    <td>07:00:00 pm</td>
                                    <td>07:30:00 pm	</td>
                                    <td>45 mins</td>
                                    <td class="text-center">
                                        <div class="action-label">
                                            <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                                <i class="fa fa-dot-circle-o text-success"></i> Active
                                            </a>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_shift"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Daily Rout</td>
                                    <td>06:00:00 am</td>
                                    <td>06:30:00 am</td>
                                    <td>07:00:00 am</td>
                                    <td>03:00:00 pm</td>
                                    <td>03:30:00 pm</td>
                                    <td>04:00:00 pm</td>
                                    <td>60 mins</td>
                                    <td class="text-center">
                                        <div class="action-label">
                                            <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                                <i class="fa fa-dot-circle-o text-success"></i> Active
                                            </a>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_shift"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>New Shift</td>
                                    <td>06:11:00 am</td>
                                    <td>06:30:00 am</td>
                                    <td>08:12:00 am</td>
                                    <td>09:12:00 pm	</td>
                                    <td>09:30:00 pm</td>
                                    <td>09:45:00 pm</td>
                                    <td>45 mins</td>
                                    <td class="text-center">
                                        <div class="action-label">
                                            <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                                <i class="fa fa-dot-circle-o text-success"></i> Active
                                            </a>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_shift"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Recurring Shift</td>
                                    <td>08:30:00 am</td>
                                    <td>09:00:00 am</td>
                                    <td>09:30:00 am</td>
                                    <td>05:30:00 pm</td>
                                    <td>06:00:00 pm</td>
                                    <td>06:30:00 pm</td>
                                    <td>60 mins</td>
                                    <td class="text-center">
                                        <div class="action-label">
                                            <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                                <i class="fa fa-dot-circle-o text-success"></i> Active
                                            </a>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_shift"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Content End -->


        </div>
        <!-- /Page Content -->
     
        <!-- Add Shift Modal -->
        <div id="add_shift" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Shift</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Shift Name <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label>Min Start Time <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start Time <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>									
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Max Start Time <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>											
                                    </div>
                                </div>		
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label>Min End Time <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End Time <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>									
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Max End Time <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>											
                                    </div>
                                </div>	
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Break Time (In Minutes) </label>
                                        <input type="text" class="form-control">											
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Recurring Shift</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Repeat Every</label>
                                        <select class="select">
                                            <option value="">1 </option>
                                            <option value="1">2</option>
                                            <option value="2">3</option>
                                            <option value="3">4</option>
                                            <option  selected value="4">5</option>
                                            <option value="3">6</option>
                                        </select>
                                        <label class="col-form-label">Week(s)</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group wday-box">
                                        <label class="checkbox-inline"><input type="checkbox" value="monday" class="days recurring" checked=""><span class="checkmark">M</span></label>
    
                                        <label class="checkbox-inline"><input type="checkbox" value="tuesday" class="days recurring" checked=""><span class="checkmark">T</span></label>
                                    
                                        <label class="checkbox-inline"><input type="checkbox" value="wednesday" class="days recurring" checked=""><span class="checkmark">W</span></label>
                                    
                                        <label class="checkbox-inline"><input type="checkbox" value="thursday" class="days recurring" checked=""><span class="checkmark">T</span></label>
                                    
                                        <label class="checkbox-inline"><input type="checkbox" value="friday" class="days recurring" checked=""><span class="checkmark">F</span></label>
                                    
                                        <label class="checkbox-inline"><input type="checkbox" value="saturday" class="days recurring"><span class="checkmark">S</span></label>
                                    
                                        <label class="checkbox-inline"><input type="checkbox" value="sunday" class="days recurring"><span class="checkmark">S</span></label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">End On <span class="text-danger">*</span></label>
                                        <div class="cal-icon"><input class="form-control datetimepicker" type="text"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">Indefinite</label>
                                    </div>
                                </div>								
                        
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Add Tag </label>
                                        <input type="text" class="form-control">											
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Add Note </label>
                                        <textarea class="form-control"></textarea>											
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Shift Modal -->

        <!-- Edit Shift Modal -->
        <div id="edit_shift" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Shift</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Shift Name <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label>Min Start Time <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start Time <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>									
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Max Start Time <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>											
                                    </div>
                                </div>		
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label>Min End Time <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End Time <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>									
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Max End Time <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>											
                                    </div>
                                </div>	
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Break Time (In Minutes) </label>
                                        <input type="text" class="form-control">											
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3">Recurring Shift</label>
                                        </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Repeat Every</label>
                                        <select class="select">
                                            <option value="">1 </option>
                                            <option value="1">2</option>
                                            <option value="2">3</option>
                                            <option value="3">4</option>
                                            <option  selected value="4">5</option>
                                            <option value="3">6</option>
                                        </select>
                                        <label class="col-form-label">Week(s)</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group wday-box">
                                        <label class="checkbox-inline"><input type="checkbox" value="monday" class="days recurring" checked=""><span class="checkmark">M</span></label>
    
                                        <label class="checkbox-inline"><input type="checkbox" value="tuesday" class="days recurring" checked=""><span class="checkmark">T</span></label>
                                    
                                        <label class="checkbox-inline"><input type="checkbox" value="wednesday" class="days recurring" checked=""><span class="checkmark">W</span></label>
                                    
                                        <label class="checkbox-inline"><input type="checkbox" value="thursday" class="days recurring" checked=""><span class="checkmark">T</span></label>
                                    
                                        <label class="checkbox-inline"><input type="checkbox" value="friday" class="days recurring" checked=""><span class="checkmark">F</span></label>
                                    
                                        <label class="checkbox-inline"><input type="checkbox" value="saturday" class="days recurring"><span class="checkmark">S</span></label>
                                    
                                        <label class="checkbox-inline"><input type="checkbox" value="sunday" class="days recurring"><span class="checkmark">S</span></label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">End On <span class="text-danger">*</span></label>
                                        <div class="cal-icon"><input class="form-control datetimepicker" type="text"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck4">
                                        <label class="custom-control-label" for="customCheck4">Indefinite</label>
                                        </div>
                                </div>								
                        
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Add Tag </label>
                                        <input type="text" class="form-control">											
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Add Note </label>
                                        <textarea class="form-control"></textarea>											
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Shift Modal -->

        <!-- Add Schedule Modal -->
        <div id="add_schedule" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Department <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option value="">Select</option>
                                            <option value="">Development</option>
                                            <option value="1">Finance</option>
                                            <option value="2">Finance and Management</option>
                                            <option value="3">Hr & Finance</option>
                                            <option value="4">ITech</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Employee Name <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option value="">Select </option>
                                            <option value="1">Richard Miles </option>
                                            <option value="2">John Smith</option>
                                            <option value="3">Mike Litorus </option>
                                            <option value="4">Wilmer Deluna</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Date</label>
                                        <div class="cal-icon"><input class="form-control datetimepicker" type="text"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Shifts <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option value="">Select </option>
                                            <option value="1">10'o clock Shift</option>
                                            <option value="2">10:30 shift</option>
                                            <option value="3">Daily Shift </option>
                                            <option value="4">New Shift</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Min Start Time  <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Start Time  <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Max Start Time  <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Min End Time  <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">End Time   <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Max End Time <span class="text-danger">*</span></label>
                                        <div class="input-group time timepicker">
                                            <input class="form-control"><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Break Time  <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Accept Extra Hours </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked="">
                                            <label class="custom-control-label" for="customSwitch1"></label>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Publish </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch2" checked="">
                                            <label class="custom-control-label" for="customSwitch2"></label>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Schedule Modal -->
            
        <!-- Delete Shift Modal -->
        <div class="modal custom-modal fade" id="delete_employee" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Shift</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Employee Modal -->
      
    </div>
    <!-- Page Wrapper -->
@endsection
