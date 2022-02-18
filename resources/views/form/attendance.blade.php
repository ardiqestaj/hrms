
@extends('layouts.master')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Attendance</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Attendance</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            
            <!-- Search Filter -->
            <form action="{{ route('attendance/page/search') }}" method="POST">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="name">
                            @if(isset($name))
                            <label class="focus-label">{{$name}}</label>
                            @else
                            <label class="focus-label">Employee Name</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating" name="month"> 
                                    <option> {{$month}} </option>
                                    <option value="-01-">Jan</option>
                                    <option value="-02-">Feb</option>
                                    <option value="-03-">Mar</option>
                                    <option value="-04-">Apr</option>
                                    <option value="-05-">May</option>
                                    <option value="-06-">Jun</option>
                                    <option value="-07-">Jul</option>
                                    <option value="-08-">Aug</option>
                                    <option value="-09-">Sep</option>
                                    <option value="-10-">Oct</option>
                                    <option value="-11-">Nov</option>
                                    <option value="-12-">Dec</option>
                            </select>
                            <label class="focus-label">Select Month</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating" name="year"> 
                                <option> {{$years}} </option>
                                @for ($year = 2021; $year <= 2030; $year++) 
                                <option value='{{$year}}-'>{{$year}}</option>;
                                @endfor
                            </select>
                            <label class="focus-label">Select Year</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <button type="submit" class="btn btn-success btn-block"> Search </button>  
                    </div>     
                </div>
            </form>
            <!-- /Search Filter -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    @for ($day = 1; $day <= $daysInMonth; $day++) 
                                        <td>{{$day}}</td>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($final as $attend)
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a class="avatar avatar-xs" href="profile.html"><img alt="" src="{{ URL::to('assets/img/profiles/avatar-09.jpg') }}"></a>
                                            <a href="profile.html">{{ $attend['name'] }}</a>
                                        </h2>
                                    </td>

                                  <?php 
                                    for($i = 1; $i <= $daysInMonth; $i++){
                                        $value = strlen($i);
                                        if($value==1){
                                            $k = "0".$i;
                                        }else
                                        {
                                            $k=$i;
                                        };
                                      $make_date = date("Y-m")."-".$k;
                                      $set_attendance_for_day = false;
                                      $attendance_for_day = "<i class='fa fa-close text-danger'></i> ";
                                      $daysattendance = "";
                                      $daysattendance2 = "";
                                      foreach($attend['attendance'] as $att){
                                        if($att['date'] == $make_date){
                                            
                                            // CheckOut
                                            if(empty($att['timeout'])){
                                                $daysattendance2 = "N/A";
                                            }else {
                                                $daysattendance2 = date('d F Y, h:i:s A', strtotime($att['timeout']));
                                            }

                                             // TotalHours
                                            if(empty($att['totalhours'])){
                                                $totHrs = "N/A";
                                            }else {
                                                $totHrs = $att['totalhours'];
                                            }

                                             // Overtime
                                             if(empty($att['overtime'])){
                                                $overtime = "N/A";
                                            }else {
                                                $overtime = $att['overtime'];
                                            }

                                              // Missed Hours
                                            if(empty($att['missedhours'])){
                                                $missedHrs = "N/A";
                                            }else {
                                                $missedHrs = $att['missedhours'];
                                            }

                                           $daysattendance = date('d F Y, h:i:s A', strtotime($att['timein']));
                                           $titleDate = date('d F Y', strtotime($att['date']));

                                           $attendance_for_day = '<div class="modalParent"> 
                                            <div hidden class="takeInfo">'  . $daysattendance . '</div>
                                            <div hidden class="takeInfo2">' . $daysattendance2 .  '</div>
                                            <div hidden class="takeInfo3">' . $titleDate . '</div>
                                            <div hidden class="takeInfo4">' . $totHrs .' <small>hrs</small>'. '</div>
                                            <div hidden class="takeInfo5">' . $overtime .' <small>hrs</small>'. '</div>
                                            <div hidden class="takeInfo6">' . $missedHrs .' <small>hrs</small>'. '</div>
                                            <a href="javascript:void(0);" class="adminattendancebtn" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></div>';
                                        } 
                                      } 
                                  ?>

                                  <td><?php echo $attendance_for_day; ?> </td>
                                  <?php }?>
                                </tr>
                                @empty
                                <tr><td>No Employees to show</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                    </div>
                </div>
                <div class="mx-auto mt-5">
                    @if(count($users) >= 8)
                    {{$users->links('vendor.pagination.bootstrap-4')}}
                    @endif
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        
        <!-- Attendance Modal -->
        <div class="modal custom-modal fade" id="attendance_info" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Attendance Info  <small class="text-muted" id="bringInfo3"></small></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card punch-status">
                                    <div class="card-body">
                                        <h5 class="card-title">Timesheet</h5>
                                        <div class="punch-det">
                                            <h6>Punch In at</h6>
                                            <p class="bringInfo"></p>
                                        </div>
                                        <div class="punch-info">
                                            <div class="punch-hours">
                                                <span class="bringInfo4"></span>
                                            </div>
                                        </div>
                                       
                                        <div class="punch-det">
                                            <h6>Punch Out at</h6>
                                            <p class="bringInfo2"></p>
                                        </div>
                                        

                                        <div class="statistics">
                                            <div class="row">
                                                <div class="col-md-6 col-6 text-center">
                                                    <div class="stats-box">
                                                        <p>Overtime</p>
                                                        <h6 class="bringInfo5"></h6>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 text-center">
                                                    <div class="stats-box">
                                                        <p>Missed Hours</p>
                                                        <h6 class="bringInfo6"></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ----Statistics---- --}}
                            <div class="col-md-6">
                                <div class="card att-statistics">
                                    <div class="card-body">
                                        <h5 class="card-title">Statistics</h5>
                                        <div class="stats-list">
                                            <div class="stats-info">
                                                <p>Today <strong>
                                                    {{-- @foreach ($todayAttendances as $key=>$attend)
                                                    @isset($attend->totalhours)
                                                    @if($attend->totalhours != null) 
                                                        @php
                                                            if(stripos($attend->totalhours, ".") === false) {
                                                                $h = $attend->totalhours;
                                                            } else {
                                                                $HM = explode('.', $attend->totalhours); 
                                                                $h = $HM[0]; 
                                                                $m = $HM[1];
                                                            } 
                                                        @endphp
                                                    @endif 
                                                    @if($attend->totalhours != NULL)
                                                        @if(stripos($attend->totalhours, ".") === false) 
                                                            {{ $h }} hr
                                                        @else 
                                                            {{ $h }} hr {{ $m }} mins
                                                        @endif 
                                                    @endif
                                                    @else --
                                                    @endisset 
                                                    @endforeach --}}

                                                <small><strong> <span class="bringInfo4"></span></strong> / 8 hrs</small></strong></p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-primary" id="todayPrg" role="progressbar"
                                                        aria-valuenow="25%" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        
                                            <div class="stats-info">
                                                <p>This Month <strong>{{$monthAttendances->sum('totalhours')}} <small>/ {{$monthWorkingHrs}} hrs</small></strong></p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" id="thismonthPrg"
                                                        aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="stats-info">
                                                <p>Remaining this Month<strong>{{$monthWorkingHrs - $monthAttendances->sum('totalhours')}} <small> hrs</small></strong></p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-danger" role="progressbar" id="remainthismonth"
                                                        aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="stats-info">
                                                <p>Missed Hours this Month<strong>{{$monthAttendances->sum('missedhours')}} <small>  hrs</small></strong></p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar" id="missedHrs"
                                                        aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="stats-info">
                                                <p>Overtime this Month<strong>{{$monthAttendances->sum('overtime')}} <small>  hrs</small></strong></p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-info" role="progressbar" id="overtime"
                                                        aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Attendance Modal -->
        
    </div>
    <!-- Page Wrapper -->

    <script>
        $(document).on('click', '.adminattendancebtn', function(){
            var _this = $(this).parents('.modalParent');
            $('.bringInfo').text(_this.find('.takeInfo').text());
            $('.bringInfo2').text(_this.find('.takeInfo2').text());
            $('#bringInfo3').text(_this.find('.takeInfo3').text());
            $('.bringInfo4').text(_this.find('.takeInfo4').text());
            $('.bringInfo5').text(_this.find('.takeInfo5').text());
            $('.bringInfo6').text(_this.find('.takeInfo6').text());
        });

        var productionHrs = '{{$monthAttendances->sum('totalhours')}}';
        // {{-- var scheduledHrs = '{{$schedules->hours}}';--}}
        var totalMonthHrs = '{{$monthWorkingHrs}}';
        var remainingThisMonth = '{{$monthWorkingHrs - $monthAttendances->sum('totalhours')}}';
        var missedHrs = '{{$monthAttendances->sum('missedhours')}}';
        var overtime = '{{$monthAttendances->sum('overtime')}}';

        // {{-- document.getElementById("todayPrg").style.width = (productionHrs/scheduledHrs)*100 + "%"; --}}
        document.getElementById("thismonthPrg").style.width = 100*(productionHrs/totalMonthHrs) + "%";
        document.getElementById("remainthismonth").style.width = totalMonthHrs-productionHrs + "%";
        document.getElementById("missedHrs").style.width = missedHrs + "%";
        document.getElementById("overtime").style.width = overtime + "%";
    </script>
@endsection
