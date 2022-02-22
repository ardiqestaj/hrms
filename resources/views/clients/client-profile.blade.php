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
                        <h3 class="page-title">Cilents</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
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
                                                <h3 class="user-name">{{ $client->client_name }}</h3>
                                                <h5 class="company-role m-t-0 mb-0">{{ $client->contact_person }}</h5>
                                                <small class="text-muted"></small>
                                                <div class="staff-id">Client ID : {{ $client->rec_client_id }}</div>
                                                <div class="staff-msg"><a href="chat.html" class="btn btn-custom">Send Message</a></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Mobile Phone:</span>
                                                    <span class="text"><a href="">{{ $client->client_mobile_phone }}</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Fax Phone:</span>
                                                    <span class="text">{{ $client->client_fax_phone }}</span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="mailto: {{ $client->client_email }}">{{ $client->client_email }}</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Address</span>
                                                    <span class="text">{{ $client->client_address }}</span>
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

            <!-- Add Location Modal -->
            <div id="add_location" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Location</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('location/new') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Client <span class="text-danger">*</span></label>
                                            <select class="select" name="rec_client_id" id="rec_cli_id">
                                                <option selected disabled>-- Select Client --</option>
                                                @foreach ($client_list as $cli)
                                                    <option value="{{ $cli->rec_client_id }}">
                                                        {{ $cli->client_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Location Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="location_name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Location Address <span class="text-danger">*</span></label>
                                            <input class="form-control" name="location_address" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Location Email <span class="text-danger">*</span></label>
                                            <input class="form-control floating" name="location_email" type="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Location Phone Number</label>
                                            <input class="form-control" name="location_phone_number" type="text">
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Billing Address</h5>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Address identifier</label>
                                            <input class="form-control" name="address_identifier" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Firstname <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="text" name="firstname">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Lastname <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="text" name="lastname">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Street Address <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="text" name="street_address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">City <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="text" name="city">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">State/Province <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="text" name="state">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Country/Region <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="text" name="country">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Zip/Postal Code <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="text" name="zip_code">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="text" name="phone_number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="text" name="email">
                                        </div>
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

            <div class="row">
                <!-- Add Location Modal Button-->
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_location"><i class="fa fa-plus"></i> Add Location</a>
                </div>

                <div class="col-lg-12">
                    <div class="tab-content profile-tab-content">

                        <!-- Projects Tab -->
                        <div id="myprojects" class="tab-pane fade show active">
                            <div class="row">
                                @foreach ($clients as $cli)
                                    <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                        <div class="card">
                                            <div hidden class="id">{{ $cli->id }}</div>

                                            <div hidden class="location_name">{{ $cli->location_name }}</div>
                                            <div hidden class="location_address">{{ $cli->location_address }}</div>
                                            <div hidden class="location_email">{{ $cli->location_email }}</div>
                                            <div hidden class="location_phone_number">{{ $cli->location_phone_number }}</div>
                                            <div hidden class="address_identifier">{{ $cli->address_identifier }}</div>
                                            <div hidden class="firstname">{{ $cli->firstname }}</div>
                                            <div hidden class="lastname">{{ $cli->lastname }}</div>
                                            <div hidden class="street_address">{{ $cli->street_address }}</div>
                                            <div hidden class="city">{{ $cli->city }}</div>
                                            <div hidden class="state">{{ $cli->state }}</div>
                                            <div hidden class="country">{{ $cli->country }}</div>
                                            <div hidden class="zip_code">{{ $cli->zip_code }}</div>
                                            <div hidden class="phone_number">{{ $cli->phone_number }}</div>
                                            <div hidden class="email">{{ $cli->email }}</div>
                                            <div class="card-body">
                                                <div class="dropdown profile-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item locationUpdate" href="#" data-toggle="modal" data-target="#edit_location"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item locationDelete" href="#" data-toggle="modal" data-target="#delete_location"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                                <h4 class="project-title text-xl"><a href="{{ url('location/locations/profile/' . $cli->id) }}">{{ $cli->location_name }} <i class="las la-external-link-alt"></i></a></h4>
                                                <small class="block text-ellipsis m-b-15">
                                                    <span class="text-xs text-muted">Location address: {{ $cli->location_address }} </span>
                                                </small>
                                                <div class="project-members m-b-15">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div>Billing Address :</div>
                                                            <ul class="team-members">
                                                                <div class="text-muted">
                                                                    {{ $cli->street_address }}, <br>
                                                                    {{ $cli->city }}, <br>
                                                                    {{ $cli->zip_code }} - {{ $cli->state }}, <br>
                                                                    {{ $cli->country }} <br>
                                                                </div>
                                                            </ul>
                                                            <hr>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div>Contact Person :</div>
                                                            <ul class="team-members">
                                                                <div class="text-muted">
                                                                    {{ $cli->firstname }} {{ $cli->lastname }} <br>
                                                                    {{ $cli->phone_number }}, <br>
                                                                    {{ $cli->email }}
                                                                </div>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="project-members m-b-15">
                                                    <div>Type of work : <div class="text-danger">
                                                            {{-- @foreach ($typeOfWorks as $typeOfWork)
                                                                {{ $typeOfWork->department }}
                                                            @endforeach --}}
                                                        </div>
                                                    </div>
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
                                            </div>
                                        </div>
                                    </div>

                                    <div id="edit_location" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Location</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('location/edit') }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="hidden" id="e_id" name="id">

                                                                <div class="form-group">
                                                                    <label class="col-form-label">Location Name <span class="text-danger">*</span></label>
                                                                    <input class="form-control" type="text" id="e_location_name" name="location_name" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Location Address <span class="text-danger">*</span></label>
                                                                    <input class="form-control" id="e_location_address" name="location_address" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Location Email <span class="text-danger">*</span></label>
                                                                    <input class="form-control floating" id="e_location_email" name="location_email" type="email">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Phone Number</label>
                                                                    <input class="form-control" id="e_location_phone_number" name="location_phone_number" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Add Billing Address</h5>
                                                            </div>
                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Address identifier</label>
                                                                    <input class="form-control" id="e_address_identifier" name="address_identifier" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Firstname <span class="text-danger">*</span></label>
                                                                    <input class="form-control floating" type="text" id="e_firstname" name="firstname">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Lastname <span class="text-danger">*</span></label>
                                                                    <input class="form-control floating" type="text" id="e_lastname" name="lastname">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Street Address <span class="text-danger">*</span></label>
                                                                    <input class="form-control floating" type="text" id="e_street_address" name="street_address">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">City <span class="text-danger">*</span></label>
                                                                    <input class="form-control floating" type="text" id="e_city" name="city">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">State/Province <span class="text-danger">*</span></label>
                                                                    <input class="form-control floating" id="e_state" type="text" id="e_state" name="state">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Country/Region <span class="text-danger">*</span></label>
                                                                    <input class="form-control floating" type="text" id="e_country" name="country">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Zip/Postal Code <span class="text-danger">*</span></label>
                                                                    <input class="form-control floating" type="text" id="e_zip_code" name="zip_code">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                                                                    <input class="form-control floating" type="text" id="e_phone_number" name="phone_number">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                                                    <input class="form-control floating" type="text" id="e_email" name="email">
                                                                </div>
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
                                @endforeach

                            </div>
                        </div>

                        <!-- Edit Location Modal -->

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
                                                                <span class="task-label" contenteditable="true">Patient appointment booking</span>
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
                                                                <span class="task-label" contenteditable="true">Appointment booking with payment gateway</span>
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
                                                                <span class="task-label" contenteditable="true">Patient and Doctor video conferencing</span>
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
                                                                <span class="task-label" contenteditable="true">Private chat module</span>
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
                                                                <span class="task-label" contenteditable="true">Patient Profile add</span>
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
                                                        <span class="error-message hidden">You need to enter a task first</span>
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
        <!-- /Delete Location Modal -->
        <div class="modal custom-modal fade" id="delete_location" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Location</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('location/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="d_id" value="">
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
        <!-- /Delete Location Modal -->
        <!-- /Page Content -->

    </div>

    {{-- Edit Modal --}}

    <script>
        $(document).on('click', '.locationUpdate', function() {
            var _this = $(this).parents('.card');
            $('#e_id').val(_this.find('.id').text());
            $('#e_location_name').val(_this.find('.location_name').text());
            $('#e_location_address').val(_this.find('.location_address').text());
            $('#e_location_email').val(_this.find('.location_email').text());
            $('#e_location_phone_number').val(_this.find('.location_phone_number').text());
            $('#e_address_identifier').val(_this.find('.address_identifier').text());
            $('#e_firstname').val(_this.find('.firstname').text());
            $('#e_lastname').val(_this.find('.lastname').text());
            $('#e_street_address').val(_this.find('.street_address').text());
            $('#e_city').val(_this.find('.city').text());
            $('#e_state').val(_this.find('.state').text());
            $('#e_country').val(_this.find('.country').text());
            $('#e_zip_code').val(_this.find('.zip_code').text());
            $('#e_phone_number').val(_this.find('.phone_number').text());
            $('#e_email').val(_this.find('.email').text());

            // $('#e_client_fax_phone').val(_this.find('.client_fax_phone').text());
            // $('#e_rec_client_id').val(_this.find('.rec_client_id').text());
        });
    </script>

    {{-- Delete Modal --}}
    <script>
        $(document).on('click', '.locationDelete', function() {
            var _this = $(this).parents('.card');
            $('#d_id').val(_this.find('.id').text());
        });
    </script>
    <!-- /Main Wrapper -->
@endsection
