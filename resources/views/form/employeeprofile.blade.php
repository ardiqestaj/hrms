@extends('layouts.master')
@section('content')



    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <!-- /Page Header -->
            <div class="card profile-info-card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#"><img alt="" class="" src="{{ URL::to('/assets/images/' . $user->avatar) }}" alt="{{ $user->name }}"></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name mt-0 mt-md-5 mb-0">{{ $user->name . ' ' . $user->lastname }}</h3>
                                                {{-- <h6 class="text-muted"> {{ $user->department }}</h6> --}}
                                                <small class="text-muted">{{ $user->position }}</small>
                                                <div class="staff-id">Employee ID : {{ $user->rec_id }}</div>
                                                <div class="small doj text-muted">Date of Join : {{ $user->join_date }}
                                                </div>
                                                <div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send
                                                        Message</a></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info" style="list-style-type: disc;">
                                                @if (!empty($information))
                                                    <li>
                                                        @if ($user->rec_id == $information->rec_id)
                                                            <div class="title">Email:</div>
                                                            <div class="text"><a href="mailto:{{ $information->email }}">{{ $information->email }}</a>
                                                            </div>
                                                        @else
                                                            <div class="title">Email:</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if ($user->rec_id == $information->rec_id)
                                                            <div class="title">Phone:</div>
                                                            <div class="text"><a href="tel:{{ $information->phone_number }}">{{ $information->phone_number }}</a>
                                                            </div>
                                                        @else
                                                            <div class="title">Phone:</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if ($user->rec_id == $information->rec_id)
                                                            <div class="title">Birthday:</div>
                                                            <div class="text">
                                                                {{ date('d F, Y', strtotime($information->birth_date)) }}
                                                            </div>
                                                        @else
                                                            <div class="title">Birthday:</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if ($user->rec_id == $information->rec_id)
                                                            <div class="title">Address:</div>
                                                            <div class="text">{{ $information->address }}</div>
                                                        @else
                                                            <div class="title">Address:</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if ($user->rec_id == $information->rec_id)
                                                            <div class="title">Gender:</div>
                                                            <div class="text">{{ $information->gender }}</div>
                                                        @else
                                                            <div class="title">Gender:</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    {{-- <li>
                                                        <div class="title">Reports to:</div>
                                                        <div class="text">
                                                            <div class="avatar-box">
                                                                <div class="avatar avatar-xs">
                                                                    <img src="{{ URL::to('/assets/images/' . $user->avatar) }}"
                                                                        alt="{{ $user->name }}">
                                                                </div>
                                                            </div>
                                                            <a href="profile.html">
                                                                {{ $user->name }}
                                                            </a>
                                                        </div>
                                                    </li> --}}
                                                @else
                                                    <li>
                                                        <div class="title">Birthday:</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Address:</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Gender:</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    {{-- <li>
                                                        <div class="title">Reports to:</div>
                                                        <div class="text">
                                                            <div class="avatar-box">
                                                                <div class="avatar avatar-xs">
                                                                    <img src="{{ URL::to('/assets/images/' . $user->avatar) }}"
                                                                        alt="{{ $user->name }}">
                                                                </div>
                                                            </div>
                                                            <a href="profile.html">
                                                                {{ $user->name }}
                                                            </a>
                                                        </div>
                                                    </li> --}}
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal"
                                        class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
                            <li class="nav-item"><a href="#emp_projects" data-toggle="tab" class="nav-link">Projects</a></li>
                            <li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Bank & Statutory <small class="text-danger">(Admin
                                        Only)</small></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <!-- Profile Info Tab -->
                <div id="emp_profile" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Emergency Contact
                                        {{-- <a href="#" class="edit-icon"
                                            data-toggle="modal" data-target="#emergency_contact_modal"><i
                                                class="fa fa-pencil"></i></a> --}}
                                    </h3>
                                    <hr>
                                    <ul class="personal-info">
                                        @if (!empty($families))
                                            <li>
                                                @if ($user->rec_id == $families->rec_id)
                                                    <div class="title">Full Name</div>
                                                    <div class="text">{{ $families->name }}</div>
                                                @else
                                                    <div class="title">Full Name</div>
                                                    <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                @if ($user->rec_id == $families->rec_id)
                                                    <div class="title">Relationship</div>
                                                    <div class="text">{{ $families->relationship }}</div>
                                                @else
                                                    <div class="title">Relationship</div>
                                                    <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                @if ($user->rec_id == $families->rec_id)
                                                    <div class="title">Phone </div>
                                                    <div class="text">{{ $families->phone_number }}</div>
                                                @else
                                                    <div class="title">Phone </div>
                                                    <div class="text">N/A</div>
                                                @endif
                                            </li>
                                        @else
                                            <li>
                                                <div class="title">Full Name</div>
                                                <div class="text">N/A</div>
                                            </li>
                                            <li>
                                                <div class="title">Relationship</div>
                                                <div class="text">N/A</div>
                                            </li>
                                            <li>
                                                <div class="title">Phone </div>
                                                <div class="text">N/A</div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Family Informations
                                        {{-- <a href="#" class="edit-icon"
                                            data-toggle="modal" data-target="#family_info_modal"><i
                                                class="fa fa-pencil"></i></a> --}}
                                    </h3>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Relationship</th>
                                                    <th>Date of Birth</th>
                                                    <th>Phone</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($families))
                                                    <tr>
                                                        @if ($user->rec_id == $families->rec_id)
                                                            <td>{{ $families->name }}</td>
                                                        @else
                                                            <td>N/A</td>
                                                        @endif

                                                        @if ($user->rec_id == $families->rec_id)
                                                            <td>{{ $families->relationship }}</td>
                                                        @else
                                                            <td>N/A</td>
                                                        @endif

                                                        @if ($user->rec_id == $families->rec_id)
                                                            <td>{{ $families->birthdate }}</td>
                                                        @else
                                                            <td>N/A</td>
                                                        @endif

                                                        @if ($user->rec_id == $families->rec_id)
                                                            <td>{{ $families->phone_number }}</td>
                                                        @else
                                                            <td>N/A</td>
                                                        @endif
                                                    @else
                                                        <td>N/A</td>
                                                        <td>N/A</td>
                                                        <td>N/A</td>
                                                        <td>N/A</td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Education Informations
                                        {{-- <a href="#" class="edit-icon ml-2" data-toggle="modal" data-target="#education_info">
                                            <i class="fa fa-pencil"></i>
                                            </a> --}}
                                        {{-- <a href="javascript:void(0);" class="edit-icon" data-toggle="modal"
                                            data-target="#education_info1" id="education-card-add-btn"><i
                                                class="fa fa-plus"></i> --}}
                                        </a>
                                    </h3>

                                    {{-- </div> --}}
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            @if (count($education))
                                                @foreach ($education as $edu)
                                                    <li>

                                                        <div class="experience-user">
                                                            <div class="before-circle"></div>
                                                        </div>
                                                        <div class="experience-content">

                                                            <div class="timeline-content">
                                                                {{-- <a href="#" class="edit-icon eduUpdate" data-toggle="modal"
                                                                    data-target="#education_info">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a> --}}
                                                                @if ($edu->id)
                                                                    <div hidden class="id">
                                                                        {{ $edu->id }}
                                                                    </div>

                                                                    <a href="#/" class="institution name">{{ $edu->institution }}</a>

                                                                    <div class="subject">{{ $edu->subject }}
                                                                    </div>


                                                                    <span class="time"><span class="st_date">{{ $edu->st_date }}
                                                                        </span>
                                                                        -
                                                                        <span class="end_date">{{ $edu->end_date }}</span>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <hr>
                                                @endforeach
                                            @else
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#/" class="name">N/A</a>
                                                            <br>
                                                            <br>
                                                            <div>N/A</div>
                                                            <br>
                                                            <span class="time">N/A -
                                                                N/A</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Experience</h3>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            @if (count($experience))
                                                @foreach ($experience as $exp)
                                                    <li>
                                                        <div class="experience-user">
                                                            <div class="before-circle"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">
                                                                <a href="#" class="edit-icon expUpdate" data-toggle="modal" data-target="#experience_info"><i class="fa fa-pencil"></i></a>
                                                                <span>
                                                                    <a href="#/" class="name work_company_name">{{ $exp->work_company_name }}
                                                                    </a> at <a href="#/" class="name work_address">{{ $exp->work_address }}</a>
                                                                </span>

                                                                <span class="time">
                                                                    <span class="work_period_from">{{ $exp->work_period_from }}</span>
                                                                    -
                                                                    <span class="work_period_to">{{ $exp->work_period_to }}</span>
                                                                </span>

                                                                <span class="work_position" hidden>{{ $exp->work_position }}</span>
                                                                <span class="exp_id" hidden>{{ $exp->exp_id }}</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#/" class="name">N/A at
                                                                N/A</a>
                                                            <br>
                                                            <br>
                                                            <span class="time">N/A - N/A </span>
                                                        </div>
                                                    </div>
                                                </li>
                                                {{-- <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">Web Designer at Dalt
                                                            Technology</a>
                                                        <span class="time">Jan 2013 - Present (5 years 2
                                                            months)</span>
                                                    </div>
                                                </div>
                                            </li> --}}
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Profile Info Tab -->

                <!-- Projects Tab -->
                <div class="tab-pane fade" id="emp_projects">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown profile-action">
                                        <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="project-title"><a href="project-view.html">Office Management</a></h4>
                                    <small class="block text-ellipsis m-b-15">
                                        <span class="text-xs">1</span> <span class="text-muted">open tasks,
                                        </span>
                                        <span class="text-xs">9</span> <span class="text-muted">tasks
                                            completed</span>
                                    </small>
                                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. When an unknown printer took a galley of type and
                                        scrambled it...
                                    </p>
                                    <div class="pro-deadline m-b-15">
                                        <div class="sub-title">
                                            Deadline:
                                        </div>
                                        <div class="text-muted">
                                            17 Apr 2019
                                        </div>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Project Leader :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Team :</div>
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
                                            <li>
                                                <a href="#" class="all-users">+15</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="m-b-5">Progress <span class="text-success float-right">40%</span>
                                    </p>
                                    <div class="progress progress-xs mb-0">
                                        <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown profile-action">
                                        <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="project-title"><a href="project-view.html">Project Management</a></h4>
                                    <small class="block text-ellipsis m-b-15">
                                        <span class="text-xs">2</span> <span class="text-muted">open tasks,
                                        </span>
                                        <span class="text-xs">5</span> <span class="text-muted">tasks
                                            completed</span>
                                    </small>
                                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. When an unknown printer took a galley of type and
                                        scrambled it...
                                    </p>
                                    <div class="pro-deadline m-b-15">
                                        <div class="sub-title">
                                            Deadline:
                                        </div>
                                        <div class="text-muted">
                                            17 Apr 2019
                                        </div>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Project Leader :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Team :</div>
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
                                            <li>
                                                <a href="#" class="all-users">+15</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="m-b-5">Progress <span class="text-success float-right">40%</span>
                                    </p>
                                    <div class="progress progress-xs mb-0">
                                        <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown profile-action">
                                        <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="project-title"><a href="project-view.html">Video Calling App</a></h4>
                                    <small class="block text-ellipsis m-b-15">
                                        <span class="text-xs">3</span> <span class="text-muted">open tasks,
                                        </span>
                                        <span class="text-xs">3</span> <span class="text-muted">tasks
                                            completed</span>
                                    </small>
                                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. When an unknown printer took a galley of type and
                                        scrambled it...
                                    </p>
                                    <div class="pro-deadline m-b-15">
                                        <div class="sub-title">
                                            Deadline:
                                        </div>
                                        <div class="text-muted">
                                            17 Apr 2019
                                        </div>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Project Leader :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Team :</div>
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
                                            <li>
                                                <a href="#" class="all-users">+15</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="m-b-5">Progress <span class="text-success float-right">40%</span>
                                    </p>
                                    <div class="progress progress-xs mb-0">
                                        <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown profile-action">
                                        <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="project-title"><a href="project-view.html">Hospital Administration</a></h4>
                                    <small class="block text-ellipsis m-b-15">
                                        <span class="text-xs">12</span> <span class="text-muted">open tasks,
                                        </span>
                                        <span class="text-xs">4</span> <span class="text-muted">tasks
                                            completed</span>
                                    </small>
                                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. When an unknown printer took a galley of type and
                                        scrambled it...
                                    </p>
                                    <div class="pro-deadline m-b-15">
                                        <div class="sub-title">
                                            Deadline:
                                        </div>
                                        <div class="text-muted">
                                            17 Apr 2019
                                        </div>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Project Leader :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Team :</div>
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
                                            <li>
                                                <a href="#" class="all-users">+15</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="m-b-5">Progress <span class="text-success float-right">40%</span>
                                    </p>
                                    <div class="progress progress-xs mb-0">
                                        <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Projects Tab -->
{{-- --------------------------------------------------------------------------------------------------------- --}}
                <!-- Bank Statutory Tab -->
                <div class="tab-pane fade" id="bank_statutory">
                    {{-- Full time --}}
                    <div class="card" style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                        <div class="card-body">
                            <h3 class="card-title"> Fulltime: Earnings Information</h3>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Salary amount
                                            <small class="text-muted">per
                                                month
                                            </small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="salary_amount" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4" hidden>
                                    <div class="form-group">
                                        <label class="col-form-label">Hourly
                                            Salary <small class="text-muted">
                                                Stundenlohn</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="hourly_salary" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Monthly
                                            Surcharge <small class="text-muted">
                                                FSB Zussschlag mtl</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="monthly_surcharge" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                {{-- Hidden Forms --}}
                                <div class="col-sm-4" hidden>
                                    <div class="form-group">
                                        <label class="col-form-label">Monthly
                                            Surcharge <small class="text-muted">
                                                FSB Zussschlag mtl</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="night_sunday_bon" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" hidden>
                                    <div class="form-group">
                                        <label class="col-form-label">Monthly
                                            Surcharge <small class="text-muted">
                                                FSB Zussschlag mtl</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="holiday_bon" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" hidden>
                                    <div class="form-group">
                                        <label class="col-form-label">Monthly
                                            Surcharge <small class="text-muted">
                                                FSB Zussschlag mtl</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="holiday_bon_minus" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" hidden>
                                    <div class="form-group">
                                        <label class="col-form-label">Monthly
                                            Surcharge <small class="text-muted">
                                                FSB Zussschlag mtl</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="timesupplement_night_sunday" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                                {{-- End hidden forms --}}

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">13'nth Salary
                                            <small class="text-muted">
                                                13. Monatslohn
                                                (Autocalculated)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Brutto Salary
                                            <small class="text-muted">
                                                Bruttolohn
                                                (Autocalculated)</small></label>
                                        <div class="input-group" style="border: 1px solid green; border-radius: 5px;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <h3 class="card-title"> Deductions Information</h3>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Pension
                                            Insurance <small class="text-muted">
                                                AHV Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="pension_insurance" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Unemployment
                                            Insurance <small class="text-muted">
                                                ALV Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="unemployment_insurance" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Accident
                                            Insurance <small class="text-muted">
                                                NBU Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="accident_insurance" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">UVG Erganzung
                                            Grobfahrlassigkeit
                                            <small class="text-muted">
                                                UVG</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="uvg_grb" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Pension Fund
                                            Insurance<small class="text-muted">
                                                Pensionkasse Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="pension_fund" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Medical
                                            Insurance<small class="text-muted">
                                                Krankentaggeld</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="medical_insurance" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Collective
                                            Labor
                                            Agreement<small class="text-muted">
                                                GAV Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="collective_labor" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total
                                            Deductons <small class="text-muted">
                                                Total Abzuge
                                                (autocalculated)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Netto Salary
                                            <small class="text-muted">
                                                Nettolohn
                                                (autocalculated)</small></label>
                                        <div class="input-group" style="border: 1px solid green; border-radius: 5px;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h3 class="card-title">Other Expenses</h3>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Expenses
                                            <small class="text-muted">
                                                Spesen</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="expenses" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Telephone and
                                            Shipment<small class="text-muted">
                                                Telefon und
                                                Versandspesen</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="telephone_shipment" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Mileage
                                            Compensation <small class="text-muted">
                                                Kilometerentschadingung</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="mileage_compensation" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total
                                            Expenses <small class="text-muted">
                                                Totalspesen
                                                (autocalculated)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Payout
                                            <small class="text-muted">
                                                Total Auszahlung
                                                (autocalculated)</small></label>
                                        <div class="input-group" style="border: 1px solid green; border-radius: 5px;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="submit-section d-flex justify-content-center">
                                <button type="button" class="btn btn-primary submit-btn mr-2 prev-form-btn"><i class="las la-arrow-left"></i>
                                    Back</button>

                                <button class="btn btn-primary submit-btn ml-2" type="submit"><i class="las la-save"></i>
                                    Save</button>
                            </div>
                        </div>
                    </div>
                    {{-- / Full time --}}
                    {{-- Part time --}}
                    <div class="card" style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                        <div class="card-body">
                            <h3 class="card-title">Parttime: Earnings
                                Information</h3>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Salary amount
                                            <small class="text-muted">per
                                                month
                                            </small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="salary_amount" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Monthly
                                            Surcharge <small class="text-muted">
                                                FSB Zussschlag mtl</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="monthly_surcharge" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4" hidden>
                                    <div class="form-group">
                                        <label class="col-form-label">Hourly
                                            Salary <small class="text-muted">
                                                Stundenlohn</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="hourly_salary" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" hidden>
                                    <div class="form-group">
                                        <label class="col-form-label">Night Sunday Bonus
                                            <small class="text-muted">
                                            </small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="night_sunday_bon" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" hidden>
                                    <div class="form-group">
                                        <label class="col-form-label">Holiday Bonus <small class="text-muted">
                                            </small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="holiday_bon" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" hidden>
                                    <div class="form-group">
                                        <label class="col-form-label"><small class="text-muted">
                                            </small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="holiday_bon_minus" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" hidden>
                                    <div class="form-group">
                                        <label class="col-form-label"><small class="text-muted">
                                            </small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="timesupplement_night_sunday" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">13'nth Salary
                                            <small class="text-muted">
                                                13. Monatslohn
                                                (Autocalculated)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Brutto Salary
                                            <small class="text-muted">
                                                Bruttolohn
                                                (Autocalculated)</small></label>
                                        <div class="input-group" style="border: 1px solid green; border-radius: 5px;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <h3 class="card-title"> Deductions Information</h3>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Pension
                                            Insurance <small class="text-muted">
                                                AHV Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="pension_insurance" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Unemployment
                                            Insurance <small class="text-muted">
                                                ALV Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="unemployment_insurance" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Accident
                                            Insurance <small class="text-muted">
                                                NBU Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="accident_insurance" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">UVG Erganzung
                                            Grobfahrlassigkeit
                                            <small class="text-muted">
                                                UVG</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="uvg_grb" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Pension Fund
                                            Insurance<small class="text-muted">
                                                Pensionkasse Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="pension_fund" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Medical
                                            Insurance<small class="text-muted">
                                                Krankentaggeld</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="medical_insurance" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Collective
                                            Labor
                                            Agreement<small class="text-muted">
                                                GAV Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="collective_labor" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total
                                            Deductons <small class="text-muted">
                                                Total Abzuge
                                                (autocalculated)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Netto Salary
                                            <small class="text-muted">
                                                Nettolohn
                                                (autocalculated)</small></label>
                                        <div class="input-group" style="border: 1px solid green; border-radius: 5px;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h3 class="card-title">Other Expenses</h3>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Expenses
                                            <small class="text-muted">
                                                Spesen</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="expenses" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Telephone and
                                            Shipment<small class="text-muted">
                                                Telefon und
                                                Versandspesen</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="telephone_shipment" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Mileage
                                            Compensation <small class="text-muted">
                                                Kilometerentschadingung</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="mileage_compensation" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total
                                            Expenses <small class="text-muted">
                                                Totalspesen
                                                (autocalculated)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Payout
                                            <small class="text-muted">
                                                Total Auszahlung
                                                (autocalculated)</small></label>
                                        <div class="input-group" style="border: 1px solid green; border-radius: 5px;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Type your salary amount" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="submit-section d-flex justify-content-center">
                                <button type="button" class="btn btn-primary submit-btn mr-2 prev-form-btn"><i class="las la-arrow-left"></i>
                                    Back</button>

                                <button class="btn btn-primary submit-btn ml-2" type="submit"><i class="las la-save"></i>
                                    Save</button>
                            </div>
                        </div>
                    </div>
                    {{-- / Part Time --}}
                    {{-- Hourly Part --}}
                    <div class="card" style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                        <div class="card-body">
                            <h3 class="card-title">Hourly: Earnings Information
                            </h3>
                            <div class="row">

                                <div class="col-sm-4" hidden>
                                    <div class="form-group">
                                        <label>Type of Work <span class="text-danger">*</span></label>
                                        <select class="select form-control" name="payment_type" style="width: 100%;" tabindex="-1" aria-hidden="true" id="gender" name="payment_type" required>
                                            <option value="Hourly" selected>Houly
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Hourly
                                            Salary<small class="text-muted">
                                                Stundenlohn
                                            </small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="00.00" name="hourly_salary" value="">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Night/Sunday
                                            Bonus <small class="text-muted">
                                                Nacht -
                                                Sonntagszulage</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="00.00" name="night_sunday_bon" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Holiday Bonus
                                            <small class="text-muted">
                                                Ferienentschadigung</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="00.00" name="holiday_bon" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Holiday Bonus
                                            minus<small class="text-muted">
                                                Ferienentschadigung
                                                minus</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="00.00" name="holiday_bon_minus" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Timesupplement
                                            Night/Sunday<small class="text-muted">
                                                Zeitzuschlag
                                                Nacht/Sonntag</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="00.00" name="timesupplement_night_sunday" value="">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Monthly
                                            Surcharge <small class="text-muted">
                                                FSB Zussschlag mtl</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" disabled placeholder="00.00" name="monthly_surcharge" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">13'nth Salary
                                            <small class="text-muted">
                                                13. Monatslohn
                                                (Autocalculated)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" disabled placeholder="00.00" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Brutto Salary
                                            <small class="text-muted">
                                                Bruttolohn
                                                (Autocalculated)</small></label>
                                        <div class="input-group" style="border: 1px solid green; border-radius: 5px;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="00.00" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <h3 class="card-title"> Deductions Information</h3>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Pension
                                            Insurance <small class="text-muted">
                                                AHV Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="pension_insurance" placeholder="00.00" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Unemployment
                                            Insurance <small class="text-muted">
                                                ALV Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="00.00" name="unemployment_insurance" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Accident
                                            Insurance <small class="text-muted">
                                                NBU Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="00.00" name="accident_insurance" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">UVG Erganzung
                                            Grobfahrlassigkeit
                                            <small class="text-muted">
                                                UVG</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="uvg_grb" placeholder="00.00" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Pension
                                            Fund<small class="text-muted">
                                                Pensionkasse Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="pension_fund" disabled placeholder="00.00" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Medical
                                            Insurance<small class="text-muted">
                                                Krankentaggeld</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="medical_insurance" placeholder="00.00" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Collective
                                            Labor
                                            Agreement<small class="text-muted">
                                                GAV Abzug</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" name="collective_labor" placeholder="00.00" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total
                                            Deductons <small class="text-muted">
                                                Total Abzuge
                                                (autocalculated)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="00.00" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Netto Salary
                                            <small class="text-muted">
                                                Nettolohn
                                                (autocalculated)</small></label>
                                        <div class="input-group" style="border: 1px solid green; border-radius: 5px;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="00.00" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h3 class="card-title">Other Expenses</h3>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Expenses
                                            <small class="text-muted">
                                                Spesen</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="expenses" disabled placeholder="00.00" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Telephone and
                                            Shipment<small class="text-muted">
                                                Telefon und
                                                Versandspesen</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="telephone_shipment" placeholder="00.00" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Mileage
                                            Compensation <small class="text-muted">
                                                Kilometerentschadingung</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" name="mileage_compensation" placeholder="00.00" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total
                                            Expenses <small class="text-muted">
                                                Totalspesen
                                                (autocalculated)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="00.00" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Payout
                                            <small class="text-muted">
                                                Total Auszahlung
                                                (autocalculated)</small></label>
                                        <div class="input-group" style="border: 1px solid green; border-radius: 5px;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">CHF</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="00.00" value="">
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="submit-section d-flex justify-content-center">
                                <button type="button" class="btn btn-primary submit-btn mr-2 prev-form-btn"><i class="las la-arrow-left"></i>
                                    Back</button>

                                <button class="btn btn-primary submit-btn ml-2" type="submit"><i class="las la-save"></i>
                                    Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Hourly Part -->
                </div>
                <!-- /Bank Statutory Tab -->
{{-- --------------------------------------------------------------------------------------------------------- --}}
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Profile Modal -->
        {{-- <div id="profile_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Profile Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile/information/save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-img-wrap edit-img">
                                        @if (!empty($users))
                                            <img class="inline-block"
                                                src="{{ URL::to('/assets/images/' . $users->avatar) }}"
                                                alt="{{ $users->name }}">
                                        @endif
                                        <div class="fileupload btn">
                                            <span class="btn-text">edit</span>
                                            <input class="upload" type="file" id="image" name="images">
                                            @if (!empty($users))
                                                <input type="hidden" name="hidden_image" id="e_image"
                                                    value="{{ $users->avatar }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                @if (!empty($users))
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ $users->name }}">
                                                    <input type="hidden" class="form-control" id="rec_id" name="rec_id"
                                                        value="{{ $users->rec_id }}">
                                                    <input type="hidden" class="form-control" id="email" name="email"
                                                        value="{{ $users->email }}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Birth Date</label>
                                                <div class="cal-icon">
                                                    @if (!empty($users))
                                                        <input class="form-control datetimepicker" type="text"
                                                            id="birthDate" name="birthDate"
                                                            value="{{ $users->birth_date }}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="select form-control" id="gender" name="gender">
                                                    @if (!empty($users))
                                                        <option value="{{ $users->gender }}"
                                                            {{ $users->gender == $users->gender ? 'selected' : '' }}>
                                                            {{ $users->gender }} </option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        @if (!empty($users))
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ $users->address }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        @if (!empty($users))
                                            <input type="text" class="form-control" id="state" name="state"
                                                value="{{ $users->state }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        @if (!empty($users))
                                            <input type="text" class="form-control" id="" name="country"
                                                value="{{ $users->country }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pin Code</label>
                                        @if (!empty($users))
                                            <input type="text" class="form-control" id="pin_code" name="pin_code"
                                                value="{{ $users->pin_code }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        @if (!empty($users))
                                            <input type="text" class="form-control" id="phoneNumber" name="phone_number"
                                                value="{{ $users->phone_number }}">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department <span class="text-danger">*</span></label>
                                        <select class="select" id="department" name="department">
                                            @if (!empty($users))
                                                <option value="{{ $users->department }}"
                                                    {{ $users->department == $users->department ? 'selected' : '' }}>
                                                    {{ $users->department }} </option>
                                                <option value="Web Development">Web Development</option>
                                                <option value="IT Management">IT Management</option>
                                                <option value="Marketing">Marketing</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Designation <span class="text-danger">*</span></label>
                                        <select class="select" id="designation" name="designation">
                                            @if (!empty($users))
                                                <option value="{{ $users->designation }}"
                                                    {{ $users->designation == $users->designation ? 'selected' : '' }}>
                                                    {{ $users->designation }} </option>
                                                <option value="Web Designer">Web Designer</option>
                                                <option value="Web Developer">Web Developer</option>
                                                <option value="Android Developer">Android Developer</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Reports To <span class="text-danger">*</span></label>
                                        <select class="select" id="" name="reports_to">
                                            @if (!empty($users))
                                                <option value="{{ $users->reports_to }}"
                                                    {{ $users->reports_to == $users->reports_to ? 'selected' : '' }}>
                                                    {{ $users->reports_to }} </option>
                                                @foreach ($user as $users)
                                                    <option value="{{ $users->name }}">{{ $users->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
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
        </div> --}}
        <!-- /Profile Modal -->

        <!-- Personal Info Modal -->
        {{-- <div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Personal Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Passport No</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Passport Expiry Date</label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tel</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nationality <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Religion</label>
                                        <div class="cal-icon">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Marital status <span class="text-danger">*</span></label>
                                        <select class="select form-control">
                                            <option>-</option>
                                            <option>Single</option>
                                            <option>Married</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employment of spouse</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No. of children </label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- /Personal Info Modal -->

        <!-- Family Info Modal -->
        {{-- <div id="family_info_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Family Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-scroll">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Family Member <a href="javascript:void(0);"
                                                class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Relationship <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of birth <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Education Informations <a href="javascript:void(0);"
                                                class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Relationship <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of birth <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-more">
                                            <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- /Family Info Modal -->

        <!-- Emergency Contact Modal -->
        {{-- <div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Personal Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Primary Contact</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Relationship <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone 2</label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Primary Contact</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Relationship <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone 2</label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- /Emergency Contact Modal -->

        <!-- Education Modal -->
        {{-- <div id="education_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Education Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="" id="education-form">
                            <div class="form-scroll">
                                <div class="card" id="education-card">
                                    <div class="card-body">
                                        <h3 class="card-title">Education Informations <a href="javascript:void(0);"
                                                class="delete-icon" id="education-card-delete-btn"><i
                                                    class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Oxford University"
                                                        class="form-control floating">
                                                    <label class="focus-label">Institution</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Computer Science"
                                                        class="form-control floating">
                                                    <label class="focus-label">Subject</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value="01/06/2002"
                                                            class="form-control floating datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Starting Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value="31/05/2006"
                                                            class="form-control floating datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Complete Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="BE Computer Science"
                                                        class="form-control floating">
                                                    <label class="focus-label">Degree</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Grade A" class="form-control floating">
                                                    <label class="focus-label">Grade</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" id="education-card">
                                    <div class="card-body">
                                        <h3 class="card-title">Education Informations <a href="javascript:void(0);"
                                                class="delete-icon" id="education-card-delete-btn"><i
                                                    class="fa fa-trash-o"></i></a></h3>
                                        <div class="row education-info">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="" class="form-control floating edu-info1">
                                                    <label class="focus-label">Institution</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="" class="form-control floating edu-info2">
                                                    <label class="focus-label">Subject</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value=""
                                                            class="form-control floating edu-info3 datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Starting Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value=""
                                                            class="form-control floating edu-info4 datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Complete Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="" class="form-control floating edu-info5">
                                                    <label class="focus-label">Degree</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="" class="form-control floating edu-info6">
                                                    <label class="focus-label">Grade</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-more">
                                            <a href="javascript:void(0);" id="education-card-add-btn"><i
                                                    class="fa fa-plus-circle"></i> Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- /Education Modal -->

        <!-- Experience Modal -->
        {{-- <div id="experience_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Experience Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-scroll">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Experience Informations <a href="javascript:void(0);"
                                                class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating"
                                                        value="Digital Devlopment Inc">
                                                    <label class="focus-label">Company Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="United States">
                                                    <label class="focus-label">Location</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="Web Developer">
                                                    <label class="focus-label">Job Position</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker"
                                                            value="01/07/2007">
                                                    </div>
                                                    <label class="focus-label">Period From</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker"
                                                            value="08/06/2018">
                                                    </div>
                                                    <label class="focus-label">Period To</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Experience Informations <a href="javascript:void(0);"
                                                class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating"
                                                        value="Digital Devlopment Inc">
                                                    <label class="focus-label">Company Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="United States">
                                                    <label class="focus-label">Location</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="Web Developer">
                                                    <label class="focus-label">Job Position</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker"
                                                            value="01/07/2007">
                                                    </div>
                                                    <label class="focus-label">Period From</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker"
                                                            value="08/06/2018">
                                                    </div>
                                                    <label class="focus-label">Period To</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-more">
                                            <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- /Experience Modal -->

        <!-- /Page Content -->
    </div>
@endsection
