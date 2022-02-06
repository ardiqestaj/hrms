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
                        <h3 class="page-title">Profile</h3>
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
                                                <h3 class="user-name">{{ $locations->location_name }}</h3>
                                                {{-- <h5 class="company-role m-t-0 mb-0">{{$client->contact_person}}</h5> --}}
                                                <small class="text-muted"></small>
                                                <div class="staff-id">Location ID : {{ $locations->id }}</div>
                                                <div class="staff-msg"><a href="chat.html" class="btn btn-custom">Send
                                                        Message</a></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Mobile Phone:</span>
                                                    <span class="text"><a href="">{{ $locations->location_phone_number }}</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="mailto: {{ $locations->location_email }}">{{ $locations->location_email }}</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Address</span>
                                                    <span class="text">{{ $locations->location_address }}</span>
                                                </li>
                                                {{-- <li>
															<span class="title">Address:</span>
															<span class="text">5754 Airport Rd, Coosada, AL, 36020</span>
														</li> --}}
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
            {{-- Add Departament button --}}
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_location_type"><i class="fa fa-plus"></i> Add Sector </a>
            </div>

            <!-- Add Client Modal -->
            <div id="add_location_type" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Client</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('location/type/add') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="{{ $locations->id }}">
                                            <label class="col-form-label">Dapartament <span class="text-danger">*</span></label>
                                            <select class="select" name="type_work_id" id="rec_cli_id">
                                                <option selected disabled>-- Select type of work --
                                                </option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">
                                                        {{ $department->department }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Number of Employeer <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="number_of_employees">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Start Time</label>
                                            <div class="input-group time timepicker">
                                                <input class="form-control" type="time" id="time_start" name="intime">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">End Time <span class="text-danger">*</span></label>
                                            <div class="input-group time timepicker">
                                                <input class="form-control" type="time" id="time_start" name="outime">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>From <span class="text-danger">*</span></label>
                                            <div class="cal-icon">
                                                <input type="text" class="form-control datetimepicker" id="to_date" name="datefrom">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>To <span class="text-danger">*</span></label>
                                            <div class="cal-icon">
                                                <input type="text" class="form-control datetimepicker" id="to_date" name="dateto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Total Hours</label>
                                            <input class="form-control" name="hours" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        {{-- <div class="form-group"> --}}
                                        <label class="col-form-label">Choose Rest days</label>
                                        <div class="form-group wday-box mb-4">

                                            <label class="checkbox-inline"><input type="checkbox" name="restday[]" value="Monday">
                                                <span class="checkmark">M</span></label>

                                            <label class="checkbox-inline"><input type="checkbox" name="restday[]" value="Tuesday"><span class="checkmark">T</span></label>

                                            <label class="checkbox-inline"><input type="checkbox" name="restday[]" value="Wednesday"><span class="checkmark">W</span></label>

                                            <label class="checkbox-inline"><input type="checkbox" name="restday[]" value="Thursday"><span class="checkmark">T</span></label>

                                            <label class="checkbox-inline"><input type="checkbox" name="restday[]" value="Friday"><span class="checkmark">F</span></label>

                                            <label class="checkbox-inline"><input type="checkbox" name="restday[]" value="Saturday "><span class="checkmark">S</span></label>

                                            <label class="checkbox-inline"><input type="checkbox" name="restday[]" value="Sunday"><span class="checkmark">S</span></label>
                                        </div>
                                        {{-- </div> --}}
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
            <!-- /Add Client Modal -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content profile-tab-content">
                        <!-- Projects Tab -->
                        <div id="myprojects" class="tab-pane fade show active">
                            <div class="row">
                                @foreach ($locations_types as $locations_type)
                                    <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="dropdown profile-action more">
                                                    <div hidden class="idd">{{ $locations_type->location_type_work_id }}</div>

                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_location_type{{ $locations_type->location_type_work_id }}"><i class="fa fa-pencil m-r-5"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item deleteLocation" href="#" data-toggle="modal" data-target="#delete_location_type"><i class="fa fa-trash-o m-r-5"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                                <h4 class="project-title"><a href="project-view.html">{{ $locations_type->department }}</a>
                                                </h4>
                                                <small class="block text-ellipsis m-b-15">
                                                    <span class="text-xs">{{ $locations_type->number_of_employees }}</span>
                                                    <span class="text-muted"> Employees needed. With
                                                        {{ $locations_type->hours }}hours work</span>
                                                    {{-- <span class="text-xs">9</span> <span
                                                        class="text-muted">tasks
                                                        completed</span> --}}
                                                </small>
                                                {{-- <p class="text-muted">Lorem Ipsum is simply dummy text of the printing
                                                    and
                                                    typesetting industry. When an unknown printer took a galley of type and
                                                    scrambled it...
                                                </p> --}}
                                                <div class="pro-deadline m-b-15">
                                                    <div class="sub-title">
                                                        Schedule:
                                                    </div>
                                                    <div class="text-muted">
                                                        From {{ $locations_type->intime }}
                                                    </div>
                                                    <div class="text-muted">
                                                        To
                                                        {{ $locations_type->outime }}
                                                    </div>
                                                </div>
                                                <div class="project-members m-b-15">
                                                    <div>Rest Day :</div>
                                                    <ul class="team-members">
                                                        <li>
                                                            <div class="text-muted">
                                                                {{ $locations_type->restday }}
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="project-members m-b-15">
                                                    <div>Employees:</div>
                                                    <ul class="team-members">
                                                        <li>
                                                            <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="assets/img/profiles/avatar-05.jpg"></a>
                                                        </li>
                                                        <li class="dropdown avatar-dropdown">
                                                            <a href="#" class="all-users dropdown-toggle" data-toggle="dropdown" aria-expanded="false">+15</a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <div class="avatar-group">
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="assets/img/profiles/avatar-02.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="assets/img/profiles/avatar-09.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="assets/img/profiles/avatar-10.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="assets/img/profiles/avatar-05.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="assets/img/profiles/avatar-11.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="assets/img/profiles/avatar-12.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="assets/img/profiles/avatar-13.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="assets/img/profiles/avatar-01.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="assets/img/profiles/avatar-16.jpg">
                                                                    </a>
                                                                </div>
                                                                <div class="avatar-pagination">
                                                                    <ul class="pagination">
                                                                        <li class="page-item">
                                                                            <a class="page-link" href="#" aria-label="Previous">
                                                                                <span aria-hidden="true">«</span>
                                                                                <span class="sr-only">Previous</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                        <li class="page-item">
                                                                            <a class="page-link" href="#" aria-label="Next">
                                                                                <span aria-hidden="true">»</span>
                                                                                <span class="sr-only">Next</span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                                                <div class="progress progress-xs mb-0">
                                                    <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="40%" style="width: 40%"></div>
                                                </div>
                                                <div class="project-members m-b-10 m-t-15">
                                                    <h4 class="project-title"><a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_location_type{{ $locations_type->location_type_work_id }}"><i style="font-size: 20px" class="las la-search-plus"></i>
                                                            Find Employees</a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Edit Location Modal --}}
                                    <div id="edit_location_type{{ $locations_type->location_type_work_id }}" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Sector</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('location/type/edit') }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="id" value="{{ $locations_type->location_type_work_id }}">
                                                                    <label class="col-form-label">Dapartament <span class="text-danger">*</span></label>
                                                                    <select class="select" name="type_work_id">
                                                                        <option value="{{ $locations_type->did }}" selected>
                                                                            {{ $locations_type->department }}
                                                                        </option>
                                                                        @foreach ($departments as $department)
                                                                            <option value="{{ $department->id }}">
                                                                                {{ $department->department }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Number of Employeer <span class="text-danger">*</span></label>
                                                                    <input class="form-control" type="text" value="{{ $locations_type->number_of_employees }}" name="number_of_employees">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Start Time</label>
                                                                    <div class="input-group time timepicker">
                                                                        <input class="form-control" type="tim" id="time_start" value="{{ date('H:i A', strtotime($locations_type->intime)) }}" name="intime">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">End Time <span class="text-danger">*</span></label>
                                                                    <div class="input-group time ">
                                                                        <input class="form-control timepicker" type="tim" value="{{ $locations_type->outime }}" id="e_outime" name="outime">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>From <span class="text-danger">*</span></label>
                                                                    <div class="cal-icon">
                                                                        <input type="text" class="form-control datetimepicker" value="{{ $locations_type->datefrom }}" name="datefrom">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>To <span class="text-danger">*</span></label>
                                                                    <div class="cal-icon">
                                                                        <input type="text" class="form-control" value="{{ $locations_type->dateto }}" name="dateto">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Total Hours</label>
                                                                    <input class="form-control" value="{{ $locations_type->hours }}" name="hours" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                {{-- <div class="form-group"> --}}
                                                                <label class="col-form-label">Choose Rest days</label>
                                                                <div class="form-group wday-box mb-4">

                                                                    <label class="checkbox-inline"><input type="checkbox" name="restday[]" value="Monday" @if (in_array('Monday', explode(', ', $locations_type->restday)) == true) checked @endif>
                                                                        <span class="checkmark">M</span></label>

                                                                    <label class="checkbox-inline"><input type="checkbox" name="restday[]" value="Tuesday" @if (in_array('Tuesday', explode(', ', $locations_type->restday))) == true) checked @endif><span class="checkmark">T</span></label>

                                                                    <label class="checkbox-inline"><input type="checkbox" name="restday[]" value="Wednesday" @if (in_array('Wednesday', explode(', ', $locations_type->restday))) == true) checked @endif><span class="checkmark">W</span></label>

                                                                    <label class="checkbox-inline"><input type="checkbox" name="restday[]" value="Thursday" @if (in_array('Thursday', explode(', ', $locations_type->restday))) == true) checked @endif><span class="checkmark">T</span></label>

                                                                    <label class="checkbox-inline"><input type="checkbox" name="restday[]" value="Friday" @if (in_array('Friday', explode(', ', $locations_type->restday))) == true) checked @endif><span class="checkmark">F</span></label>

                                                                    <label class="checkbox-inline"><input type="checkbox" name="restday[]" value="Saturday" @if (in_array('Saturday', explode(', ', $locations_type->restday))) == true) checked @endif><span class="checkmark">S</span></label>

                                                                    <label class="checkbox-inline"><input type="checkbox" name="restday[]" value="Sunday" @if (in_array('Sunday', explode(', ', $locations_type->restday))) == true) checked @endif><span class="checkmark">S</span></label>
                                                                </div>
                                                                {{-- </div> --}}
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
                                    {{-- Edit Location Modal --}}
                                @endforeach
                            </div>
                        </div>
                        <!-- /Projects Tab -->

                        <!-- Task Tab -->
                        <div id="tasks" class="tab-pane fade">
                            <div class="project-task">
                                <ul class="nav nav-tabs nav-tabs-top nav-justified mb-0">
                                    <li class="nav-item"><a class="nav-link active" href="#all_tasks" data-toggle="tab" aria-expanded="true">All Tasks</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#pending_tasks" data-toggle="tab" aria-expanded="false">Pending Tasks</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#completed_tasks" data-toggle="tab" aria-expanded="false">Completed Tasks</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="all_tasks">
                                        <div class="task-wrapper">
                                            <div class="task-list-container">
                                                <div class="task-list-body">
                                                    <ul id="task-list">
                                                        <li class="task">
                                                            <div class="task-container">
                                                                <span class="task-action-btn task-check">
                                                                    <span class="action-circle large complete-btn" title="Mark Complete">
                                                                        <i class="material-icons">check</i>
                                                                    </span>
                                                                </span>
                                                                <span class="task-label" contenteditable="true">Patient
                                                                    appointment booking</span>
                                                                <span class="task-action-btn task-btn-right">
                                                                    <span class="action-circle large" title="Assign">
                                                                        <i class="material-icons">person_add</i>
                                                                    </span>
                                                                    <span class="action-circle large delete-btn" title="Delete Task">
                                                                        <i class="material-icons">delete</i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li class="task">
                                                            <div class="task-container">
                                                                <span class="task-action-btn task-check">
                                                                    <span class="action-circle large complete-btn" title="Mark Complete">
                                                                        <i class="material-icons">check</i>
                                                                    </span>
                                                                </span>
                                                                <span class="task-label" contenteditable="true">Appointment booking with payment
                                                                    gateway</span>
                                                                <span class="task-action-btn task-btn-right">
                                                                    <span class="action-circle large" title="Assign">
                                                                        <i class="material-icons">person_add</i>
                                                                    </span>
                                                                    <span class="action-circle large delete-btn" title="Delete Task">
                                                                        <i class="material-icons">delete</i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li class="completed task">
                                                            <div class="task-container">
                                                                <span class="task-action-btn task-check">
                                                                    <span class="action-circle large complete-btn" title="Mark Complete">
                                                                        <i class="material-icons">check</i>
                                                                    </span>
                                                                </span>
                                                                <span class="task-label">Doctor available module</span>
                                                                <span class="task-action-btn task-btn-right">
                                                                    <span class="action-circle large" title="Assign">
                                                                        <i class="material-icons">person_add</i>
                                                                    </span>
                                                                    <span class="action-circle large delete-btn" title="Delete Task">
                                                                        <i class="material-icons">delete</i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li class="task">
                                                            <div class="task-container">
                                                                <span class="task-action-btn task-check">
                                                                    <span class="action-circle large complete-btn" title="Mark Complete">
                                                                        <i class="material-icons">check</i>
                                                                    </span>
                                                                </span>
                                                                <span class="task-label" contenteditable="true">Patient
                                                                    and Doctor video conferencing</span>
                                                                <span class="task-action-btn task-btn-right">
                                                                    <span class="action-circle large" title="Assign">
                                                                        <i class="material-icons">person_add</i>
                                                                    </span>
                                                                    <span class="action-circle large delete-btn" title="Delete Task">
                                                                        <i class="material-icons">delete</i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li class="task">
                                                            <div class="task-container">
                                                                <span class="task-action-btn task-check">
                                                                    <span class="action-circle large complete-btn" title="Mark Complete">
                                                                        <i class="material-icons">check</i>
                                                                    </span>
                                                                </span>
                                                                <span class="task-label" contenteditable="true">Private
                                                                    chat module</span>
                                                                <span class="task-action-btn task-btn-right">
                                                                    <span class="action-circle large" title="Assign">
                                                                        <i class="material-icons">person_add</i>
                                                                    </span>
                                                                    <span class="action-circle large delete-btn" title="Delete Task">
                                                                        <i class="material-icons">delete</i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li class="task">
                                                            <div class="task-container">
                                                                <span class="task-action-btn task-check">
                                                                    <span class="action-circle large complete-btn" title="Mark Complete">
                                                                        <i class="material-icons">check</i>
                                                                    </span>
                                                                </span>
                                                                <span class="task-label" contenteditable="true">Patient
                                                                    Profile add</span>
                                                                <span class="task-action-btn task-btn-right">
                                                                    <span class="action-circle large" title="Assign">
                                                                        <i class="material-icons">person_add</i>
                                                                    </span>
                                                                    <span class="action-circle large delete-btn" title="Delete Task">
                                                                        <i class="material-icons">delete</i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="task-list-footer">
                                                    <div class="new-task-wrapper">
                                                        <textarea id="new-task" placeholder="Enter new task here. . ."></textarea>
                                                        <span class="error-message hidden">You need to enter a task
                                                            first</span>
                                                        <span class="add-new-task-btn btn" id="add-task">Add Task</span>
                                                        <span class="btn" id="close-task-panel">Close</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="pending_tasks"></div>
                                    <div class="tab-pane" id="completed_tasks"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /Task Tab -->

                    </div>
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
