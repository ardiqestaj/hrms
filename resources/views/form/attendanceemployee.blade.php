
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

            <div class="row">
                <div class="col-md-4">
                    <div class="card punch-status">
                        <div class="card-body">
              
                            <div class="container-fluid">
                                <div class="fixedcenter">
                                    <div class="clockwrapper">
                                        <div class="clockinout">
                                            <button class="btnclock timein active" data-type="timein">{{ __("Time In") }}</button>
                                            <button class="btnclock timeout" data-type="timeout">{{ __("Time Out") }}</button>
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
                                                @isset($cc)
                                                    @if($cc == "on") 
                                                        <div class="inline field comment">
                                                            <textarea name="comment" class="uppercase lightblue" rows="1" placeholder="Enter comment" value=""></textarea>
                                                        </div> 
                                                    @endif
                                                @endisset
                                                <div class="inline field">
                                                    <input @if($rfid == 'on') id="rfid" @endif class="enter_idno uppercase @if($rfid == 'on') mr-0 @endif" name="idno" value="" type="text" placeholder="{{ __("ENTER YOUR ID") }}" required autofocus>
                        
                                                    @if($rfid !== "on")
                                                        <button id="btnclockin" type="button" class="ui positive large icon button">{{ __("Confirm") }}</button>
                                                    @endif
                                                    <input type="hidden" id="_url" value="{{url('/')}}">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                        
                                    <div class="message-after">
                                        <p> 
                                            <span id="greetings">{{ __("Welcome!") }}</span> 
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
                                {{-- </div>
                            </div> --}}
                        
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card att-statistics">
                        <div class="card-body">
                            <h5 class="card-title">Statistics</h5>
                            <div class="stats-list">
                                <div class="stats-info">
                                    <p>Today <strong>3.45 <small>/ 8 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>This Week <strong>28 <small>/ 40 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>This Month <strong>90 <small>/ 160 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Remaining <strong>90 <small>/ 160 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Overtime <strong>4</strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card recent-activity">
                        <div class="card-body">
                            <h5 class="card-title">Today Activity</h5>
                            <ul class="res-activity-list">
                                <li>
                                    <p class="mb-0">Punch In at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        10.00 AM.
                                    </p>
                                </li>
                                <li>
                                    <p class="mb-0">Punch Out at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        11.00 AM.
                                    </p>
                                </li>
                                <li>
                                    <p class="mb-0">Punch In at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        11.15 AM.
                                    </p>
                                </li>
                                <li>
                                    <p class="mb-0">Punch Out at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        1.30 PM.
                                    </p>
                                </li>
                                <li>
                                    <p class="mb-0">Punch In at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        2.00 PM.
                                    </p>
                                </li>
                                <li>
                                    <p class="mb-0">Punch Out at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        7.30 PM.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-3">  
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <input type="text" class="form-control floating datetimepicker">
                        </div>
                        <label class="focus-label">Date</label>
                    </div>
                </div>
                <div class="col-sm-3"> 
                    <div class="form-group form-focus select-focus">
                        <select class="select floating"> 
                            <option>-</option>
                            <option>Jan</option>
                            <option>Feb</option>
                            <option>Mar</option>
                            <option>Apr</option>
                            <option>May</option>
                            <option>Jun</option>
                            <option>Jul</option>
                            <option>Aug</option>
                            <option>Sep</option>
                            <option>Oct</option>
                            <option>Nov</option>
                            <option>Dec</option>
                        </select>
                        <label class="focus-label">Select Month</label>
                    </div>
                </div>
                <div class="col-sm-3"> 
                    <div class="form-group form-focus select-focus">
                        <select class="select floating"> 
                            <option>-</option>
                            <option>2019</option>
                            <option>2018</option>
                            <option>2017</option>
                            <option>2016</option>
                            <option>2015</option>
                        </select>
                        <label class="focus-label">Select Year</label>
                    </div>
                </div>
                <div class="col-sm-3">  
                    <a href="#" class="btn btn-success btn-block"> Search </a>  
                </div>     
            </div>
            <!-- /Search Filter -->
            
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
                                    <th>Break</th>
                                    <th>Overtime</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>19 Feb 2019</td>
                                    <td>10 AM</td>
                                    <td>7 PM</td>
                                    <td>9 hrs</td>
                                    <td>1 hrs</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>20 Feb 2019</td>
                                    <td>10 AM</td>
                                    <td>7 PM</td>
                                    <td>9 hrs</td>
                                    <td>1 hrs</td>
                                    <td>0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        </div>
        <!-- /Page Wrapper -->
    </div>
@endsection

   
@section('script')
<script type="text/javascript">


// elements day, time, date
var elTime = document.getElementById('show_time');
var elDate = document.getElementById('show_date');
var elDay = document.getElementById('show_day');

// time function to prevent the 1s delay
var setTime = function() {
    // initialize clock with timezone
    var time = moment().tz(timezone);

    // set time in html
    @if($tf == 1) 
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

$("#rfid").on("input", function(){
    var url, type, idno, comment;
    url = $("#_url").val();
    type = $('.btnclock.active').data("type");
    idno = $('input[name="idno"]').val();
    idno.toUpperCase();
    comment = $('textarea[name="comment"]').val();

    setTimeout(() => {
        $(this).val("");
    }, 600);

    $.ajax({ url: url + '/attendance/add', 
            type: 'POST', 
            dataType: 'json', 
            data: {
                idno: idno, 
                type: type, 
                clockin_comment: comment
            }, 
                headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },

        success: function(response) {
            if(response['error'] != null) 
            {
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
                $('#time').html('<span id=clocktime>' + response['time'] + '</span>' + '.' + '<span id=clockstatus> {{ __("Success!") }}</span>');
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

    $.ajax({url: url + '/attendance/add',
            type: 'POST',
            dataType: 'json',
            data: {
                idno: idno, 
                type: type, 
                clockin_comment: comment
            },
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') 
            },

        success: function(response) {
            if(response['error'] != null) 
            {
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
                $('#time').html('<span id=clocktime>' + response['time'] + '</span>' + '.' + '<span id=clockstatus> {{ __("Success!") }}</span>');
                $('.message-after').slideToggle().slideDown('400');
            }
        }
    })
});
</script> 

@endsection


