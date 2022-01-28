<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">



            <ul class="sidebar-main-menu">
                    <!-- Admin Dashboard -->
                @if (Auth::user()->role_name == 'Admin')
                <li class="submenu-click">
                    <a href="{{ route('home') }}" class="text-center">
                        <i class="la la-dashboard"></i>
                        <span class="dash-category"> Dashboard</span>
                        <!-- <span class="menu-arrow"></span> -->
                    </a>
                    <!-- <ul style="display: none;">
                        <li><a class="" href="{{ route('home') }}">Dashboard</a></li>
                        <li><a href="{{ route('em/dashboard') }}">Dashboard</a></li>
                    </ul> -->
                </li>
                @endif

                <!-- Employee Dashboard -->
                @if (Auth::user()->role_name == 'Employee')
                <li>
                    <a href="{{ route('em/dashboard') }}" class="text-center">
                        <i class="la la-dashboard"></i>
                        <span class="dash-category"> Dashboard</span>
                        <!-- <span class="menu-arrow"></span> -->
                    </a>
                    <!-- <ul style="display: none;">
                        <li><a class="" href="{{ route('home') }}">Dashboard</a></li>
                        <li><a href="{{ route('em/dashboard') }}">Dashboard</a></li>
                    </ul> -->
                </li>
                @endif


                <!-- Admin User Controller -->
                @if (Auth::user()->role_name == 'Admin')
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


                <!-- Employees Admin  -->
                <li class="submenu">
                    <a href="#" class="">
                        <i class="las la-user-friends"></i>
                        <span class="dash-category"> Employees</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                     @if (Auth::user()->role_name == 'Admin')
                        <li><a href="{{ route('all/employee/card') }}">All Employees</a></li>
                        <li><a href="{{ route('form/holidays/new') }}">Holidays</a></li>
                        <li><a href="{{ route('form/leaves/new') }}">Leaves</a></li>
                        <li><a href="{{ route('attendance/employee/page') }}">Attendance</a></li>
                        <li><a href="{{ route('form/department/new') }}">Departments</a></li>
                    @endif

                <!-- Employees Employee -->
                    @if (Auth::user()->role_name == 'Employee')
                        <li><a href="{{ route('form/leavesemployee/new') }}">Leaves</a></li>
                        <li><a href="{{ route('attendance/page') }}">Attendance</a></li>
                        <!-- <li><a href="designations.html">Designations</a></li>
                            <li><a href="timesheet.html">Timesheet</a></li>
                            <li><a href="shift-scheduling.html">Shift & Schedule</a></li>
                            <li><a href="overtime.html">Overtime</a></li> -->
                    @endif
                    </ul>
                </li>


                <!--Admin - Clents -->
                @if (Auth::user()->role_name == 'Admin')
                <li class="submenu-click">
                    <a href="{{ route('clients/clients') }}">
                        <i class="las la-briefcase"></i>
                        <span class="dash-category">Clients</span>
                    </a>
                </li>
                @endif


                <!--Admin - Locations -->
                @if (Auth::user()->role_name == 'Admin')
                <li class="submenu">
                    <a href="#" class="">
                        <i class="las la-map-marked-alt"></i>
                        <span class="dash-category">Locations</span>
                        <!-- <span class="menu-arrow"></span> -->
                    </a>
                    <!-- <ul style="display: none;">
                        <li><a class="" href="{{ route('all/employee/card') }}">All Employees</a></li>
                        <li><a href="{{ route('form/holidays/new') }}">Holidays</a></li>
                        <li><a href="{{ route('form/leaves/new') }}">Leaves (Admin)
                                <span class=""></span></a>
                        </li>
                    </ul> -->
                </li>
                @endif


                <!-- <li class="menu-title">
                        <span>HR</span>
                    </li> -->
                <!-- <li class="submenu">
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
                    </li> -->
                <li class="submenu"> <a href="#"><i class="las la-wallet"></i>
                        <span> Payroll </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('form/salary/page') }}"> Employee Salary </a></li>
                        <li><a href="{{ url('form/salary/view') }}"> Payslip </a></li>
                        <li><a href="{{ route('form/payroll/items') }}"> Payroll Items </a></li>
                    </ul>
                </li>

                <!-- Admin settings -->
                @if (Auth::user()->role_name == 'Admin')
                <li class="submenu"> <a href="#"><i class="las la-cog"></i>
                        <span> Settings </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('company/settings/page') }}"> Company Settings </a></li>
                        <li><a href="{{ route('form/leavesettings/page') }}">Leave Settings</a></li>
                        <li><a href="{{ route('theme/settings/page') }}"> Theme Settings </a></li>
                        <li><a href="{{ route('change/password') }} "> Change Password </a></li>
                        <li><a href="{{ route('roles/permissions/page') }}"> Role Permissions </a></li>
                    </ul>
                </li>
                @endif

                <!-- <li class="submenu"> <a href="#"><i class="la la-pie-chart"></i>
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
                    </li> -->
                <!-- <li class="menu-title"> <span>Performance</span> </li>
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
                    </li> -->
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
