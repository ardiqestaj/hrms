@extends('layouts.master')
{{-- @section('menu')
@extends('sidebar.dashboard')
@endsection --}}
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="welcome-box">
                        <div class="welcome-img">
                            <img src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                        </div>
                        <div class="welcome-det">
                            <h3>Welcome, {{ $employee->name . ' ' . $employee->lastname }}!</h3>
                            <p>{{ $todayDate }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <section class="dash-section">
                        <h1 class="dash-sec-title">Today</h1>
                        <div class="dash-sec-content">
                            {{-- <div class="dash-info-list">
                                <div href="#" class="dash-card">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-hourglass-o"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>Richard Miles is off sick today</p>
                                        </div>

                                    </div>


                                    <div class="dash-card-container mt-3">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-suitcase"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>You are away today</p>
                                        </div>

                                    </div>

                                    <div class="dash-card-container mt-3">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-suitcase"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>You are away today</p>
                                        </div>

                                    </div>

                                </div>
                            </div> --}}

                            <div class="dash-info-list">
                                <a href="#" class="dash-card">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-suitcase"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>You are away today</p>
                                        </div>
                                        <div class="dash-card-avatars">
                                            <div class="e-avatar"><img src="{{ URL::to('assets/img/profiles/avatar-02.jpg') }}" alt=""></div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="dash-info-list">
                                <a href="#" class="dash-card">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-building-o"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>You are working from home today</p>
                                        </div>
                                        <div class="dash-card-avatars">
                                            <div class="e-avatar"><img src="{{ URL::to('assets/img/profiles/avatar-02.jpg') }}" alt=""></div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </section>

                    <section class="dash-section">
                        <h1 class="dash-sec-title">Tomorrow</h1>
                        <div class="dash-sec-content">
                            <div class="dash-info-list">
                                <div class="dash-card">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-suitcase"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>2 people will be away tomorrow</p>
                                        </div>
                                        <div class="dash-card-avatars">
                                            <a href="#" class="e-avatar"><img src="{{ URL::to('assets/img/profiles/avatar-04.jpg') }}" alt=""></a>
                                            <a href="#" class="e-avatar"><img src="{{ URL::to('assets/img/profiles/avatar-08.jpg') }}" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="dash-section">
                        <h1 class="dash-sec-title">Next seven days</h1>
                        <div class="dash-sec-content">
                            <div class="dash-info-list">
                                <div class="dash-card">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-suitcase"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>2 people are going to be away</p>
                                        </div>
                                        <div class="dash-card-avatars">
                                            <a href="#" class="e-avatar"><img src="{{ URL::to('assets/img/profiles/avatar-05.jpg') }}" alt=""></a>
                                            <a href="#" class="e-avatar"><img src="{{ URL::to('assets/img/profiles/avatar-07.jpg') }}" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dash-info-list">
                                <div class="dash-card">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-user-plus"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>Your first day is going to be on Thursday</p>
                                        </div>
                                        <div class="dash-card-avatars">
                                            <div class="e-avatar"><img src="{{ URL::to('assets/img/profiles/avatar-02.jpg') }}" alt=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dash-info-list">
                                <a href="" class="dash-card">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="dash-card-content">
                                            <p>It's Spring Bank Holiday on Monday</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="dash-sidebar">
                        <section>
                            <h5 class="dash-title">Projects</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div id='calendar'></div>
                                    <div class="request-btn mt-4">
                                        <a class="btn btn-primary" href="{{ url('fullcalender') }}">View Calendar</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <h5 class="dash-title">Your Leave</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="time-list">
                                        <div class="dash-stats-list">
                                            <h4>{{ $LeavesEvidence->where('status', 'Approved')->sum('day') }}</h4>
                                            <p>Leave Taken</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            <h4>{{ $LeaveTypes->sum('leave_days') - $LeavesEvidence->where('status', 'Approved')->sum('day') }}</h4>
                                            <p>Remaining</p>
                                        </div>
                                    </div>
                                    <div class="request-btn">
                                        <a class="btn btn-primary" href="{{ url('form/leavesemployee/new') }}">Apply Leave</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <h5 class="dash-title">Your time off allowance</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="time-list">
                                        <div class="dash-stats-list">
                                            <h4>5.0 Hours</h4>
                                            <p>Approved</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            <h4>15 Hours</h4>
                                            <p>Remaining</p>
                                        </div>
                                    </div>
                                    <div class="request-btn">
                                        <a class="btn btn-primary" href="#">Apply Time Off</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <h5 class="dash-title">Upcoming Holiday</h5>
                            <div class="card">
                                <div class="card-body text-center">
                                    @if (isset($nextHoliday))
                                        <h4 class="holiday-title mb-0">{{ $nextHoliday->title }} - {{ $totalTime }}</h4>
                                    @else
                                        <h4 class="holiday-title mb-0">No Upcoming Holidays</h4>
                                    @endif

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->

    <script>
        $(document).ready(function() {

            var SITEURL = "{{ url('/') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: true,
                events: SITEURL + "/fullcalender",
                displayEventTime: false,
                editable: true,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                        $.ajax({
                            url: SITEURL + "/fullcalenderAjax",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                type: 'add'
                            },
                            type: "POST",
                            success: function(data) {
                                displayMessage("Event Created Successfully");

                                calendar.fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                }, true);

                                calendar.fullCalendar('unselect');
                            }
                        });
                    }
                },
                eventDrop: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                    $.ajax({
                        url: SITEURL + '/fullcalenderAjax',
                        data: {
                            title: event.title,
                            start: start,
                            end: end,
                            id: event.id,
                            type: 'update'
                        },
                        type: "POST",
                        success: function(response) {
                            displayMessage("Event Updated Successfully");
                        }
                    });
                },
                eventClick: function(event) {
                    var deleteMsg = confirm("Do you really want to delete?");
                    if (deleteMsg) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/fullcalenderAjax',
                            data: {
                                id: event.id,
                                type: 'delete'
                            },
                            success: function(response) {
                                calendar.fullCalendar('removeEvents', event.id);
                                displayMessage("Event Deleted Successfully");
                            }
                        });
                    }
                }

            });

        });

        function displayMessage(message) {
            toastr.success(message, 'Event');
        }
    </script>
@endsection
