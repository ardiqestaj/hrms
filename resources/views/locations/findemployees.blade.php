@extends('layouts.master')
@section('content')

    {{-- message --}}
    {!! Toastr::message() !!}

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Manage Employees on this dapartement </h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="card profile-info-card  mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="">
                                            <img src={{ URL::to('/assets/images/photo_defaults.jpg') }} alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name">{{ $location_type_work->location_name }}</h3>
                                                {{-- <h5 class="company-role m-t-0 mb-0">{{$client->contact_person}}</h5> --}}
                                                <small class="text-muted"></small>
                                                <div class="staff-id">Location ID : {{ $location_type_work->id }}</div>
                                                <div class="staff-msg"><a href="chat.html" class="btn btn-custom">Send
                                                        Message</a></div>
                                                <ul class="personal-info">
                                                    <li>
                                                        <span class="title">Mobile Phone:</span>
                                                        <span class="text"><a href="">{{ $location_type_work->location_phone_number }}</a></span>
                                                    </li>
                                                    <li>
                                                        <span class="title">Email:</span>
                                                        <span class="text"><a href="mailto: {{ $location_type_work->location_email }}">{{ $location_type_work->location_email }}</a></span>
                                                    </li>
                                                    <li>
                                                        <span class="title">Address</span>
                                                        <span class="text">{{ $location_type_work->location_address }}</span>
                                                    </li>
                                                    {{-- <li>
                                                                        <span class="title">Address:</span>
                                                                        <span class="text">5754 Airport Rd, Coosada, AL, 36020</span>
                                                                    </li> --}}
                                                </ul>

                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Type Of Work</span>
                                                    <span class="text"><a href="">{{ $location_type_work->department }}</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">No. of Employees</span>
                                                    <span class="text"><a href="">{{ $location_type_work->number_of_employees }}</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">In Time/ Out Time</span>
                                                    <span class="text">{{ $location_type_work->intime }} - {{ $location_type_work->outime }}</span>
                                                </li>
                                                <li>
                                                    <span class="title">Hours</span>
                                                    <span class="text">{{ $location_type_work->hours }} </span>
                                                </li>
                                                <li>
                                                    <span class="title">Restdays</span>
                                                    <span class="text">{{ $location_type_work->restday }} </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item col-sm-3"><a class="nav-link active" data-toggle="tab" href="#myprojects">Projects</a></li>
                            <li class="nav-item col-sm-3"><a class="nav-link" data-toggle="tab" href="#tasks">Tasks</a></li>
                        </ul>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-12 mt-5">
                    <form action="{{ url('location/profile/assignment/' . $location_type_work->location_type_work_id) }}" method="POST">
                        @csrf
                        <div class="form-group leave-duallist">
                            <label>Posible employees</label>
                            <div class="row">
                                <div class="col-lg-5 col-sm-5">
                                    <select name="customleave_from" id="customleave_select" class="form-control" size="{{ count($employees) }}" multiple="multiple">
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->employee_id }}">{{ $employee->name }} {{ $employee->lastname }} -
                                                <span style="color: blue;" id="text-muted-employees">{{ $employee->time_start }} - {{ $employee->time_end }} / {{ $employee->restdays }}</span>

                                            </option>
                                        @endforeach
                                    </select>


                                </div>
                                <div class="multiselect-controls col-lg-2 col-sm-2">
                                    <button type="button" id="customleave_select_rightAll" class="btn btn-block btn-white"><i class="fa fa-forward"></i></button>
                                    <button type="button" id="customleave_select_rightSelected" class="btn btn-block btn-white"><i class="fa fa-chevron-right"></i></button>
                                    <button type="button" id="customleave_select_leftSelected" class="btn btn-block btn-white"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" id="customleave_select_leftAll" class="btn btn-block btn-white"><i class="fa fa-backward"></i></button>
                                </div>
                                <div class="col-lg-5 col-sm-5">
                                    <select name="customleave_to[]" id="customleave_select_to" class="form-control" size="{{ $location_type_work->number_of_employees }}" multiple="multiple">
                                        @foreach ($assignments as $assignment)
                                            <option value="{{ $assignment->em_id }}">{{ $assignment->name }} {{ $assignment->lastname }} -
                                                <span style="color: blue;" id="text-muted-employees">{{ $assignment->time_start }} - {{ $assignment->time_end }} / {{ $assignment->restdays }}</span>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Delete Leave Modal -->
        <div class="modal custom-modal fade" id="delete_location_type" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Leave</h3>
                            <p>Are you sure want to delete this leave?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('location/type/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="e_id" value="">
                                <div class="row">
                                    <div class="col-6">
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
        <!-- /Delete Leave Modal -->


    </div>
    <!-- /Main Wrapper -->
    <script>
        $(document).on('click', '.deleteLocation', function() {
            var _this = $(this).parents('.more');
            $('#e_id').val(_this.find('.idd').text());
        });
    </script>
@endsection
{{-- Find Employees Modal --}}
<div id="find_employees_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Custom Policy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
{{-- // Find Employees Modal --}}
