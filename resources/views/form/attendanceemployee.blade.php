@extends('layouts.master')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
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

            {{-- ----Time Clock---- --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="card punch-status">
                        <div class="card-body">

                            <div class="container-fluid">
                                <div class="fixedcenter">
                                    <div class="clockwrapper">
                                        <div class="clockinout">
                                            <button class="btnclock timein active"
                                                data-type="timein">{{ __('Punch In') }}</button>
                                            <button class="btnclock timeout"
                                                data-type="timeout">{{ __('Punch Out') }}</button>
                                        </div>
                                    </div>
                                    <div class="clockwrapper">
                                        <div class="timeclock">
                                            <span id="show_day" class="clock-text"></span>
                                            <span id="show_time" class="clock-time"></span>
                                            <span id="show_date" class="clock-day"></span>
                                        </div>
                                    </div>

                                    <div class="clockwrapper">
                                        <div class="userinput">
                                            <form action="" method="get" accept-charset="utf-8" class="ui form">
                                                @csrf
                                                @isset($cc)
                                                    @if ($cc == 'on')
                                                        <div class="inline field comment">
                                                            <textarea name="comment" class="uppercase lightblue" rows="1"
                                                                placeholder="Enter comment" value=""></textarea>
                                                        </div>
                                                    @endif
                                                @endisset
                                                <div class="inline field">
                                                    <input @if ($rfid == 'on') id="rfid" @endif class="enter_idno uppercase @if ($rfid == 'on') mr-0 @endif" name="idno" value="" type="text"
                                                        placeholder="{{ __('ENTER YOUR ID') }}" required autofocus>

                                                    @if ($rfid !== 'on')
                                                        <button id="btnclockin" type="button"
                                                            class="ui positive large icon button">{{ __('Confirm') }}</button>
                                                    @endif
                                                    <input type="hidden" id="_url" value="{{ url('/') }}">
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="message-after">
                                        <p>
                                            <span id="greetings">{{ __('Welcome!') }}</span>
                                            <span id="fullname"></span>
                                        </p>
                                        <p id="messagewrap">
                                            <span id="type"></span>
                                            <span id="message"></span>
                                            <span id="time"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- ----End Time Clock---- --}}

            {{-- ----Statistics---- --}}
                <div class="col-md-4">
                    <div class="card att-statistics">
                        <div class="card-body">
                            <h5 class="card-title">Statistics {{$workingHrs}}</h5>
                            <div class="stats-list">
                                <div class="stats-info">
                                    <p>Today <strong>
                                        @foreach ($todayAttendance as $key=>$attend)
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
                                        @endforeach
                                    <small>/ {{$schedules->hours}} hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" id="todayPrg" role="progressbar"
                                            aria-valuenow="25%" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                               
                                <div class="stats-info">
                                    <p>This Month <strong>{{$monthAttendance->sum('totalhours')}} <small>/ {{$monthWorkingHrs}} hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" id="thismonthPrg"
                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Remaining this Month<strong>{{$monthWorkingHrs - $monthAttendance->sum('totalhours')}} <small> hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" id="remainthismonth"
                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Missed Hours this Month<strong>{{$monthAttendance->sum('missedhours')}} <small>  hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" id="missedHrs"
                                            aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Overtime this Month<strong>{{$monthAttendance->sum('overtime')}} <small>  hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" id="overtime"
                                            aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- ----Statistics---- --}}

            {{-- ----Today CheckIn/CheckOut---- --}}
                <div class="col-md-4">
                    <div class="card recent-activity">
                        <div class="card-body">
                            <h5 class="card-title">Today Activity</h5>
                            <ul class="res-activity-list">
                                <li>
                                    <p class="mb-0">Punch In at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        @foreach ($todayAttendance as $key=>$attend)
                                        @php
                                        if($attend->timein != null) {
                                            if ($timeFormat == 1) {
                                                echo e(date('h:i:s A', strtotime($attend->timein)));
                                            } else {
                                                echo e(date('H:i:s', strtotime($attend->timein)));
                                            }
                                        }
                                        @endphp
                                        @endforeach
                                    </p>
                                </li>
                                <li>
                                    <p class="mb-0">Punch Out at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        @foreach ($todayAttendance as $key=>$attend)
                                        @php
                                        if($attend->timeout != null) {
                                            if ($timeFormat == 1) {
                                                echo e(date('h:i:s A', strtotime($attend->timeout)));
                                            } else {
                                                echo e(date('H:i:s', strtotime($attend->timeout)));
                                            }
                                        } else 
                                        @endphp
                                        @endforeach
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ----End Today CheckIn/CheckOut---- --}}


            <!-- Search Filter -->
            <form action="{{ route('attendance/search') }}" method="POST">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-3">
                        <div class="focused form-group form-focus focus focused">
                            <div class="cal-icon">
                                <input type="text" class="form-control floating datetimepicker" name="date">
                            </div>
                            <label class="focus-label">Date</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-focus select-focus">
                            <select class="select floating" name="month">
                                {{-- @if(isset($month))
                                <option> {{$month}} </option>
                                @else 
                                <option> - </option>
                                @endif --}}
                                <option> - </option>
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
                    <div class="col-sm-3">
                        <div class="form-group form-focus select-focus">
                            <select class="select floating" name="year">
                                <option> - </option>
                                <?php
                                for ($year = 2021; $year <= 2030; $year++) {
                                echo "<option value='{$year}-'>$year</option>";
                                }
                                ?>
                            </select>
                            <label class="focus-label">Select Year</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-success btn-block"> Search </button>
                    </div>
                </div>
            </form>
            <!-- /Search Filter -->


            {{-- --Personal Attendence --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date </th>
                                    <th>Punch In</th>
                                    <th>Punch Out</th>
                                    <th>Production</th>
                                    <th>Status (In/Out)</th>
                                    <th>Overtime</th>
                                    <th>Missed Hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($attendance)
                                @foreach ($attendance as $key=>$attend)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$attend->date}}</td>
                                    
                                    {{-- Punch In --}}
                                    <td>
                                        @php
                                        if($attend->timein != null) {
                                            if ($timeFormat == 1) {
                                                echo e(date('h:i:s A', strtotime($attend->timein)));
                                            } else {
                                                echo e(date('H:i:s', strtotime($attend->timein)));
                                            }
                                        }
                                    @endphp
                                    </td>

                                    {{-- Punch Out --}}
                                    <td>
                                        @php
                                        if($attend->timeout != null) {
                                            if ($timeFormat == 1) {
                                                echo e(date('h:i:s A', strtotime($attend->timeout)));
                                            } else {
                                                echo e(date('H:i:s', strtotime($attend->timeout)));
                                            }
                                        } else echo "--"
                                        @endphp
                                    </td>

                                    {{-- Total Hours --}}
                                    <td>
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
                                    </td>

                                    {{-- Status In/Out --}}
                                    <td>
                                        @if($attend->status_timein != '' && $attend->status_timeout != '') 
                                        <span class="@if($attend->status_timein == 'Late In') orange @else blue @endif">{{ $attend->status_timein }}</span> / 
                                        <span class="@if($attend->status_timeout == 'Early Out') red @else green @endif">{{ $attend->status_timeout }}</span> 
                                    @elseif($attend->status_timein == 'Late In') 
                                        <span class="orange">{{ $attend->status_timein }}</span>
                                    @else 
                                        <span class="blue">{{ $attend->status_timein }}</span>
                                    @endif 
                                    </td>

                                    {{-- Overtme Hours --}}
                                    <td>
                                        {{$attend->overtime}} hrs
                                    </td>

                                    {{-- Short Time  Hours --}}
                                    <td>
                                        {{$attend->missedhours}} hrs
                                    </td>
                                </tr>
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- --End Personal Attendence --}}

        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    </div>

@endsection


@section('script')
    <script type="text/javascript">
        // TimeClock javascript
        // elements day, time, date
        var elTime = document.getElementById('show_time');
        var elDate = document.getElementById('show_date');
        var elDay = document.getElementById('show_day');

        // time function to prevent the 1s delay
        var setTime = function() {
            // initialize clock with timezone
            var time = moment().tz(timezone);

            // set time in html
            @if ($tf == 1)
                elTime.innerHTML= time.format("hh:mm:ss A");
            @else
                elTime.innerHTML= time.format("kk:mm:ss");
            @endif

            // set date in html
            elDate.innerHTML = time.format('MMMM D, YYYY');

            // set day in html
            elDay.innerHTML = time.format('dddd');
        }

        setTime();
        setInterval(setTime, 1000);

        $('.btnclock').click(function(event) {
            var is_comment = $(this).data("type");
            if (is_comment == "timein") {
                $('.comment').slideDown('200').show();
            } else {
                $('.comment').slideUp('200');
            }
            $('input[name="idno"]').focus();
            $('.btnclock').removeClass('active animated fadeIn')
            $(this).toggleClass('active animated fadeIn');
        });

        $("#rfid").on("input", function() {
            var url, type, idno, comment;
            url = $("#_url").val();
            type = $('.btnclock.active').data("type");
            idno = $('input[name="idno"]').val();
            idno.toUpperCase();
            comment = $('textarea[name="comment"]').val();

            setTimeout(() => {
                $(this).val("");
            }, 600);

            $.ajax({
                url: url + '/attendance/add',
                type: 'POST',
                dataType: 'json',
                data: {
                    idno: idno,
                    type: type,
                    clockin_comment: comment
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {
                    if (response['error'] != null) {
                        $('.message-after').addClass('notok').hide();
                        $('#type, #fullname').text("").hide();
                        $('#time').html("").hide();
                        $('.message-after').removeClass("ok");
                        $('#message').text(response['error']);
                        $('#fullname').text(response['employee']);
                        $('.message-after').slideToggle().slideDown('400');
                    } else {
                        function type(clocktype) {
                            if (clocktype == "timein") {
                                return "{{ __('Time In at') }}";
                            } else {
                                return "{{ __('Time Out at') }}";
                            }
                        }
                        $('.message-after').addClass('ok').hide();
                        $('.message-after').removeClass("notok");
                        $('#type, #fullname, #message').text("").show();
                        $('#time').html("").show();
                        $('#type').text(type(response['type']));
                        $('#fullname').text(response['firstname'] + ' ' + response['lastname']);
                        $('#time').html('<span id=clocktime>' + response['time'] + '</span>' + '.' +
                            '<span id=clockstatus> {{ __('Success!') }}</span>');
                        $('.message-after').slideToggle().slideDown('400');
                    }
                }
            })
        });

        $('#btnclockin').click(function(event) {
            var url, type, idno, comment;
            url = $("#_url").val();
            type = $('.btnclock.active').data("type");
            idno = $('input[name="idno"]').val();
            idno.toUpperCase();
            comment = $('textarea[name="comment"]').val();

            $.ajax({
                url: url + '/attendance/add',
                type: 'POST',
                dataType: 'json',
                data: {
                    idno: idno,
                    type: type,
                    clockin_comment: comment
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {
                    if (response['error'] != null) {
                        $('.message-after').addClass('notok').hide();
                        $('#type, #fullname').text("").hide();
                        $('#time').html("").hide();
                        $('.message-after').removeClass("ok");
                        $('#message').text(response['error']);
                        $('#fullname').text(response['employee']);
                        $('.message-after').slideToggle().slideDown('400');
                    } else {
                        function type(clocktype) {
                            if (clocktype == "timein") {
                                return "{{ __('Time In at') }}";
                            } else {
                                return "{{ __('Time Out at') }}";
                            }
                        }
                        $('.message-after').addClass('ok').hide();
                        $('.message-after').removeClass("notok");
                        $('#type, #fullname, #message').text("").show();
                        $('#time').html("").show();
                        $('#type').text(type(response['type']));
                        $('#fullname').text(response['firstname'] + ' ' + response['lastname']);
                        $('#time').html('<span id=clocktime>' + response['time'] + '</span>' + '.' +
                            '<span id=clockstatus> {{ __('Success!') }}</span>');
                        $('.message-after').slideToggle().slideDown('400');
                    }
                }
            })
        });


        var productionHrs = '{{$monthAttendance->sum('totalhours')}}';
        var scheduledHrs = '{{$schedules->hours}}';
        var totalMonthHrs = '{{$monthWorkingHrs}}';
        var remainingThisMonth = '{{$monthWorkingHrs - $monthAttendance->sum('totalhours')}}';
        var missedHrs = '{{$monthAttendance->sum('missedhours')}}';
        var overtime = '{{$monthAttendance->sum('overtime')}}';

        document.getElementById("todayPrg").style.width = (productionHrs/scheduledHrs)*100 + "%";
        document.getElementById("thismonthPrg").style.width = 100*(productionHrs/totalMonthHrs) + "%";
        document.getElementById("remainthismonth").style.width = totalMonthHrs-productionHrs + "%";
        document.getElementById("missedHrs").style.width = missedHrs + "%";
        document.getElementById("overtime").style.width = overtime + "%";


    </script>
@endsection
