@extends('layouts.master')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Posts <span id="year"></span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Posts</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            {{-- message --}}
            {!! Toastr::message() !!}

            @php
                use Carbon\Carbon;
                $today_date = Carbon::today()->format('d-m-Y');
            @endphp

            <div class="mt-4">
                {{-- <div class="item"> --}}
                @if ($notifications->type == 'App\Notifications\ApproveEmployeeLeaveNotify')
                <div class="item">
                    <div class="card content-post">
                        <div class="card-body ">
                        <h5 class="card-title d-flex justify-content-between">Leaves Status<span style="font-size: 0.8rem" class="text-muted">
                            @php 
                            $time_created = $notifications->created_at;
                            echo Carbon::createFromFormat('Y-m-d H:i:s', $time_created)->diffForHumans(); 
                            @endphp</span> </h5>
                        <h4 class="card-text text-muted">Your <strong>{{$leavetypes->leave_names}}</strong> applie has been <strong>{{$notifications->data['status']}}</strong>.</h4>
                        {{-- <div class="truncate"> --}}
                        <p class="card-text">Your leaves applies applies was from <strong>{{$notifications->data['from_date']}} </strong>  to  <strong>{{$notifications->data['to_date']}}</strong>.</p>
                        {{-- </div> --}}
                        <div class="d-flex justify-content-end">
                        <a href="{{ url('deleteone/notification/' . $notifications->id) }}" class="btn btn-danger"> <i class="las la-trash-alt"></i></a>
                        <span style="font-size: 0.8rem" class="text-muted align-self-end">
                        {{-- Author: {{$post->name}} --}}
                            </span>
                        </div>
                        </div>
                    </div>
                </div>
                @endif
                @if ($notifications->type == 'App\Notifications\EditedAttendanceNotification')
                <div class="item">
                    <div class="card content-post">
                        <div class="card-body ">
                        <h5 class="card-title d-flex justify-content-between">Attendance Updated<span style="font-size: 0.8rem" class="text-muted">
                            @php 
                            $time_created = $notifications->created_at;
                            echo Carbon::createFromFormat('Y-m-d H:i:s', $time_created)->diffForHumans(); 
                            @endphp</span> </h5>
                        <h4 class="card-text text-muted">Your attendance on this date <strong>{{$notifications->data['date']}}</strong> has been <strong>Updated</strong>.</h4>
                        {{-- <div class="truncate"> --}}
                        <p class="card-text">Time in <strong>{{$notifications->data['time_in']}} </strong>  and Time out  <strong>{{$notifications->data['time_out']}}</strong>.</p>
                        {{-- </div> --}}
                        <div class="d-flex justify-content-end">
                        <a href="{{ url('deleteone/notification/' . $notifications->id) }}" class="btn btn-danger"> <i class="las la-trash-alt"></i></a>
                        <span style="font-size: 0.8rem" class="text-muted align-self-end">
                        {{-- Author: {{$post->name}} --}}
                            </span>
                        </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@section('script')
    <script type="text/javascript">
    <script>
        $(document).on('click', '.holidayDelete', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
@endsection

@endsection
