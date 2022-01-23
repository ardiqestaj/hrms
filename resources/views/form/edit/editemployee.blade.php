
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
                            <li><a class="active" href="{{ route('all/employee/card') }}">All Employees</a></li>
                            <li><a href="{{ route('form/holidays/new') }}">Holidays</a></li>
                            <li><a href="{{ route('form/leaves/new') }}">Leaves (Admin) 
                                <span class="badge badge-pill bg-primary float-right">1</span></a>
                            </li>
                            <li><a href="leaves-employee.html">Leaves (Employee)</a></li>
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
                    <li class="submenu"> <a href="#"><i class="la la-money"></i>
                        <span> Payroll </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('form/salary/page') }}"> Employee Salary </a></li>
                            <li><a href="salary-view.html"> Payslip </a></li>
                            <li><a href="payroll-items.html"> Payroll Items </a></li>
                        </ul>
                    </li>
                    <li> <a href="policies.html">
                        <i class="la la-file-pdf-o"></i>
                        <span>Policies</span></a>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-pie-chart"></i>
                        <span> Reports </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="expense-reports.html"> Expense Report </a></li>
                            <li><a href="invoice-reports.html"> Invoice Report </a></li>
                            <li><a href="payments-reports.html"> Payments Report </a></li>
                            <li><a href="project-reports.html"> Project Report </a></li>
                            <li><a href="task-reports.html"> Task Report </a></li>
                            <li><a href="user-reports.html"> User Report </a></li>
                            <li><a href="employee-reports.html"> Employee Report </a></li>
                            <li><a href="payslip-reports.html"> Payslip Report </a></li>
                            <li><a href="attendance-reports.html"> Attendance Report </a></li>
                            <li><a href="leave-reports.html"> Leave Report </a></li>
                            <li><a href="daily-reports.html"> Daily Report </a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>Performance</span> </li>
                    <li class="submenu"> <a href="#"><i class="la la-graduation-cap"></i>
                        <span> Performance </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="performance-indicator.html"> Performance Indicator </a></li>
                            <li><a href="performance.html"> Performance Review </a></li>
                            <li><a href="performance-appraisal.html"> Performance Appraisal </a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-edit"></i>
                        <span> Training </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="training.html"> Training List </a></li>
                            <li><a href="trainers.html"> Trainers</a></li>
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
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee View</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee View Edit</li>
                        </ul>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Employee edit</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('all/employee/update') }}" method="POST">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $employees[0]->id }}">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Full Name</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $employees[0]->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Email</label>
                                    <div class="col-md-10">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $employees[0]->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Birth Date</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control datetimepicker" id="birth_date" name="birth_date" value="{{ $employees[0]->birth_date }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Gender</label>
                                    <div class="col-md-10">
                                        <select class="select form-control" id="gender" name="gender">
                                            <option value="{{ $employees[0]->gender }}" {{ ( $employees[0]->gender == $employees[0]->gender) ? 'selected' : '' }}>{{ $employees[0]->gender }} </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Employee ID</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ $employees[0]->employee_id }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Company</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="company" name="company" value="{{ $employees[0]->company }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Employee Permission</label>
                                    <div class="col-md-10">
                                        <div class="table-responsive m-t-15">
                                            <table class="table table-striped custom-table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Permission</th>
                                                        <th class="text-center">Read</th>
                                                        <th class="text-center">Write</th>
                                                        <th class="text-center">Create</th>
                                                        <th class="text-center">Delete</th>
                                                        <th class="text-center">Import</th>
                                                        <th class="text-center">Export</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $key = 0;
                                                    $key1 = 0;
                                                    ?>
                                                    @foreach ($permission as $items )
                                                    <tr>
                                                        <td>{{ $items->module_permission }}</td>
                                                        <input type="hidden" name="permission[]" value="{{ $items->module_permission }}">
                                                        <input type="hidden" name="id_permission[]" value="{{ $items->id }}">
                                                        <td class="text-center">
                                                            <input type="checkbox" class="read{{ ++$key }}" id="read" name="read[]" value="Y"{{ $items->read =="Y" ? 'checked' : ''}} >
                                                            <input type="checkbox" class="read{{ ++$key1 }}" id="read" name="read[]" value="N" {{ $items->read =="N" ? 'checked' : ''}}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="write{{ ++$key }}" id="write" name="write[]" value="Y" {{ $items->write =="Y" ? 'checked' : ''}}>
                                                            <input type="checkbox" class="write{{ ++$key1 }}" id="write" name="write[]" value="N" {{ $items->write =="N" ? 'checked' : ''}}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="create{{ ++$key }}" id="create" name="create[]" value="Y" {{ $items->create =="Y" ? 'checked' : ''}}>
                                                            <input type="checkbox" class="create{{ ++$key1 }}" id="create" name="create[]" value="N" {{ $items->create =="N" ? 'checked' : ''}}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="delete{{ ++$key }}" id="delete" name="delete[]" value="Y" {{ $items->delete =="Y" ? 'checked' : ''}}>
                                                            <input type="checkbox" class="delete{{ ++$key1 }}" id="delete" name="delete[]" value="N" {{ $items->delete =="N" ? 'checked' : ''}}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="import{{ ++$key }}" id="import" name="import[]" value="Y" {{ $items->import =="Y" ? 'checked' : ''}}>
                                                            <input type="checkbox" class="import{{ ++$key1 }}" id="import" name="import[]" value="N" {{ $items->import =="N" ? 'checked' : ''}}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="export{{ ++$key }}" id="export" name="export[]" value="Y" {{ $items->export =="Y" ? 'checked' : ''}}>
                                                            <input type="checkbox" class="export{{ ++$key1 }}" id="export" name="export[]" value="N" {{ $items->export =="N" ? 'checked' : ''}}>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2"></label>
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        
    </div>
    <!-- /Page Wrapper -->
    @section('script')
    <script>
        $("input:checkbox").on('click', function()
        {
            var $box = $(this);
            if ($box.is(":checked"))
            {
                var group = "input:checkbox[class='" + $box.attr("class") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            }
            else
            {
                $box.prop("checked", false);
            }
        });
    </script>
    @endsection

@endsection
