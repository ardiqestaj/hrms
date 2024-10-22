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
                        <h3 class="page-title">Leaves <span id="year"></span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Leaves</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Leave</a>
                    </div>
                </div>
            </div>
            <!-- Leave Statistics -->
            <div class="row">
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>New Request</h6>
                        <h4>{{ $leaves->where('status', 'New')->count() }}</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Planned Leaves</h6>
                        <h4>8 <span>Today</span></h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Unplanned Leaves</h6>
                        <h4>0 <span>Today</span></h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Pending Requests</h6>
                        <h4>{{ $leaves->where('status', 'Pending')->count() }}</h4>
                    </div>
                </div>
            </div>
            <!-- /Leave Statistics -->
            <!-- Search Filter -->
            <form action="{{ route('form/leaves/search') }}" method="POST">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="name">
                            <label class="focus-label">Employee Name</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <div class="form-group form-focus select-focus">
                            <select class="select" name="leave_names">
                                <option selected disabled>-- Select Role Name --</option>
                                @foreach ($LeaveTypes as $LeaveType)
                                    <option value="{{ $LeaveType->leave_names }}">{{ $LeaveType->leave_names }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="focus-label">Leave Type</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <div class="form-group form-focus ">
                            {{-- <select class="select floating" name="status1">
                                <option> -- Select -- </option>
                                <option value="Pending"> Pending </option>
                                <option value="Approved"> Approved </option>
                                <option value="Declined"> Declined </option>
                                <option value="New"> New </option>
                            </select> --}}
                            <input type="text" name="status" class="form-control floating">
                            <label class="focus-label">Leave Status</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="from_date">
                            </div>
                            <label class="focus-label">From</label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text" name="to_date">
                            </div>
                            <label class="focus-label">To</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <button type="sumit" class="btn btn-success btn-block"> Search </button>
                    </div>
                </div>
            </form>
            <!-- /Search Filter -->

            <!-- /Page Header -->
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Leave Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>No of Days</th>
                                    <th>Reason</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Actions</th>
                                    <th hidden="hidden"></th>
                                    <th hidden="hidden"></th>
                                    <th hidden="hidden"></th>
                                    <th hidden="hidden"></th>
                                    <th hidden="hidden"></th>
                                    <th hidden="hidden"></th>
                                    <th hidden="hidden"></th>
                                </tr>
                            </thead>


                            <tbody>
                                {{-- @if (!empty($leaves)) --}}
                                @foreach ($leavesAdmin as $lAdmin)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('employee/profile/' . $lAdmin->rec_id) }}" class="avatar"><img alt="" src="{{ URL::to('/assets/images/' . $lAdmin->avatar) }}" alt="{{ $lAdmin->name }}"></a>
                                                <a href="#">{{ $lAdmin->name }}<span>{{ $lAdmin->position }}</span></a>
                                            </h2>
                                        </td>
                                        <td hidden class="id">{{ $lAdmin->leave_applies_id }}</td>
                                        <td hidden class="rec_id">{{ $lAdmin->rec_id }}</td>
                                        <td hidden class="leave_type_id">{{ $lAdmin->leave_type_id }}</td>
                                        <td hidden class="status">{{ $lAdmin->status }}</td>
                                        <td hidden class="days">{{ $lAdmin->day }}</td>
                                        <td class="leave_type">{{ $lAdmin->leave_names }}</td>
                                        <td hidden class="from_date">{{ $lAdmin->from_date }}</td>
                                        <td>{{ date('d F, Y', strtotime($lAdmin->from_date)) }}</td>
                                        <td hidden class="to_date">{{ $lAdmin->to_date }}</td>
                                        <td>{{ date('d F, Y', strtotime($lAdmin->to_date)) }}</td>
                                        <td class="day">{{ $lAdmin->day }} Day</td>
                                        <td class="leave_reason">{{ $lAdmin->leave_reason }}</td>
                                        <td class="text-center">
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    @if ($lAdmin->status == 'New')
                                                        <i class="fa fa-dot-circle-o text-purple"></i>
                                                        New
                                                    @elseif($lAdmin->status == 'Pending')
                                                        <i class="fa fa-dot-circle-o text-danger"></i>
                                                        Pending
                                                    @elseif($lAdmin->status == 'Approved')
                                                        <i class="fa fa-dot-circle-o text-success"></i>
                                                        Approved
                                                    @else
                                                        <i class="fa fa-dot-circle-o text-danger"></i>
                                                        Declined
                                                    @endif
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#new_leave"><i class="fa fa-dot-circle-o text-purple"></i> New</a> -->
                                                    <a class="dropdown-item PendingLeave" href="#" data-toggle="modal" data-target="#pending_leave"><i class="fa fa-dot-circle-o text-info"></i> Pending</a>
                                                    <a class="dropdown-item ApproveLeave" href="#" data-toggle="modal" data-target="#approve_leave"><i class="fa fa-dot-circle-o text-success"></i> Approved</a>
                                                    <a class="dropdown-item DeclinedLeave" href="#" data-toggle="modal" data-target="#declined_leave"><i class="fa fa-dot-circle-o text-danger"></i> Declined</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item leaveUpdate" data-toggle="modal" data-id="'.$items->id.'" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item leaveDelete" href="#" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($leaves as $items)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('employee/profile/' . $items->rec_id) }}" class="avatar"><img alt="" src="{{ URL::to('/assets/images/' . $items->avatar) }}" alt="{{ $items->name }}"></a>
                                                <a href="#">{{ $items->name . ' ' . $items->lastname }}<span>{{ $items->position }}</span></a>
                                            </h2>
                                        </td>
                                        <td hidden class="id">{{ $items->leave_applies_id }}</td>
                                        <td hidden class="rec_id">{{ $items->rec_id }}</td>
                                        <td hidden class="leave_type_id">{{ $items->leave_type_id }}</td>
                                        <td hidden class="status">{{ $items->status }}</td>
                                        <td hidden class="days">{{ $items->day }}</td>
                                        <td class="leave_type">{{ $items->leave_names }}</td>
                                        <td hidden class="from_date">{{ $items->from_date }}</td>
                                        <td>{{ date('d F, Y', strtotime($items->from_date)) }}</td>
                                        <td hidden class="to_date">{{ $items->to_date }}</td>
                                        <td>{{ date('d F, Y', strtotime($items->to_date)) }}</td>
                                        <td class="day">{{ $items->day }} Day</td>
                                        <td class="leave_reason">{{ $items->leave_reason }}</td>
                                        <td class="text-center">
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    @if ($items->status == 'New')
                                                        <i class="fa fa-dot-circle-o text-purple"></i>
                                                        New
                                                    @elseif($items->status == 'Pending')
                                                        <i class="fa fa-dot-circle-o text-danger"></i>
                                                        Pending
                                                    @elseif($items->status == 'Approved')
                                                        <i class="fa fa-dot-circle-o text-success"></i>
                                                        Approved
                                                    @else
                                                        <i class="fa fa-dot-circle-o text-danger"></i>
                                                        Declined
                                                    @endif
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#new_leave"><i class="fa fa-dot-circle-o text-purple"></i> New</a> -->
                                                    <a class="dropdown-item PendingLeave" href="#" data-toggle="modal" data-target="#pending_leave"><i class="fa fa-dot-circle-o text-info"></i> Pending</a>
                                                    <a class="dropdown-item ApproveLeave" href="#" data-toggle="modal" data-target="#approve_leave"><i class="fa fa-dot-circle-o text-success"></i> Approved</a>
                                                    <a class="dropdown-item DeclinedLeave" href="#" data-toggle="modal" data-target="#declined_leave"><i class="fa fa-dot-circle-o text-danger"></i> Declined</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item leaveUpdate" data-toggle="modal" data-id="'.$items->id.'" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item leaveDelete" href="#" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- @endif --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Add Leave Modal -->
        <div id="add_leave" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Leave</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/leaves/save') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Leave Type <span class="text-danger">*</span></label>
                                <select class="select" id="leaveType" name="leave_type_id">
                                    <option selected disabled>Select Leave Type</option>
                                    @foreach ($LeaveTypes as $LeaveType)
                                        <option value="{{ $LeaveType->leave_id }}">{{ $LeaveType->leave_names }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" class="form-control" id="rec_id" name="rec_id" value="{{ Auth::user()->rec_id }}">
                            <div class="form-group">
                                <label>From <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" id="from_date" name="from_date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>To <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" id="to_date" name="to_date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Number of days <span class="text-danger">*</span></label>
                                <input class="form-control" readonly type="text">
                            </div>
                            <div class="form-group">
                                <label>Remaining Leaves <span class="text-danger">*</span></label>
                                <input class="form-control" readonly value="12" type="text">
                            </div>
                            <div class="form-group">
                                <label>Leave Reason <span class="text-danger">*</span></label>
                                <textarea rows="4" class="form-control" id="leave_reason" name="leave_reason"></textarea>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Leave Modal -->

        <!-- Edit Leave Modal -->
        <div id="edit_leave" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Leave</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/leaves/edit') }}" method="POST">
                            @csrf
                            <input type="hidden" id="e_id" name="id" value="">
                            <div class="form-group">
                                <label>Leave Type <span class="text-danger">*</span></label>
                                <select class="select" id="e_leave_typ" name="leave_type_id">
                                    @foreach ($LeaveTypes as $LeaveType)
                                        <option value="{{ $LeaveType->leave_id }}">{{ $LeaveType->leave_names }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>From <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" id="e_from_date" name="from_date" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>To <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" id="e_to_date" name="to_date" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Number of days <span class="text-danger">*</span></label>
                                <input class="form-control" readonly type="text" id="e_number_of_days" name="number_of_days" value="">
                            </div>
                            <div class="form-group">
                                <label>Leave Reason <span class="text-danger">*</span></label>
                                <textarea rows="4" class="form-control" id="e_leave_reason" name="leave_reason" value=""></textarea>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Leave Modal -->

        <!-- Approve Leave Modal -->
        <div class="modal custom-modal fade" id="approve_leave" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Leave Approve</h3>
                            <p>Are you sure want to approve for this leave?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/leaves/status') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <input type="hidden" name="id" id="a_id" value="">
                                        <input type="hidden" name="leave_type_id" id="a_leave_type_id" value="">
                                        <input type="hidden" name="rec_id" id="a_rec_id" value="">
                                        <input type="hidden" name="day" id="a_day" value="">
                                        <input type="hidden" name="approved_by" value="{{ Auth::user()->rec_id }}">
                                        <input type="hidden" name="status" id="" value="Approved">
                                        <input type="hidden" name="from_date" id="a_from_date" value="">
                                        <input type="hidden" name="to_date" id="a_to_date" value="">
                                        <button type="submit" class="btn btn-primary submit-btn continue-btn">Approve</button>
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
        <!-- /Approve Leave Modal -->
        <!-- Pending Leave Modal -->
        <div class="modal custom-modal fade" id="pending_leave" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Leave Approve</h3>
                            <p>Are you sure want to pending for this leave?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/leaves/status') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <input type="hidden" name="id" id="p_id" value="">
                                        <input type="hidden" name="leave_type_id" id="p_leave_type_id" value="">
                                        <input type="hidden" name="rec_id" id="p_rec_id" value="">
                                        <input type="hidden" name="day" id="p_day" value="">
                                        <input type="hidden" name="approved_by" value="{{ Auth::user()->rec_id }}">
                                        <input type="hidden" name="status" class="" value="Pending">
                                        <input type="hidden" name="from_date" id="p_from_date" value="">
                                        <input type="hidden" name="to_date" id="p_to_date" value="">
                                        <button type="submit" class="btn btn-primary submit-btn continue-btn">Pending</button>
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
        <!-- /pending Leave Modal -->
        <!-- Declined Leave Modal -->
        <div class="modal custom-modal fade" id="declined_leave" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Leave Approve</h3>
                            <p>Are you sure want to decline for this leave?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/leaves/status') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="d_id" value="">
                                <input type="hidden" name="leave_type_id" id="d_leave_type_id" value="">
                                <input type="hidden" name="rec_id" id="d_rec_id" value="">
                                <input type="hidden" name="day" id="d_day" value="">
                                <input type="hidden" name="approved_by" value="{{ Auth::user()->rec_id }}">
                                <input type="hidden" name="status" class="" value="Declined">
                                <input type="hidden" name="from_date" id="d_from_date" value="">
                                <input type="hidden" name="to_date" id="d_to_date" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn submit-btn">Declined</button>
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
        <!-- /Declined Leave Modal -->
        <!-- Delete Leave Modal -->
        <div class="modal custom-modal fade" id="delete_approve" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Leave</h3>
                            <p>Are you sure want to delete this leave?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/leaves/edit/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
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
    <!-- /Page Wrapper -->
@section('script')
    <script>
        document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>
    {{-- update js --}}
    <script>
        $(document).on('click', '.leaveUpdate', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_number_of_days').val(_this.find('.day').text());
            $('#e_from_date').val(_this.find('.from_date').text());
            $('#e_to_date').val(_this.find('.to_date').text());
            $('#e_leave_reason').val(_this.find('.leave_reason').text());
            var leave_type = (_this.find(".leave_type").text());
            var _option = '<option selected value="' + leave_type + '">' + _this.find('.leave_type').text() +
                '</option>'
            $(_option).appendTo("#e_leave_type");
        });
    </script>
    {{-- delete model --}}
    <script>
        $(document).on('click', '.leaveDelete', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    {{-- Approve model --}}
    <script>
        $(document).on('click', '.ApproveLeave', function() {
            var _this = $(this).parents('tr');
            $('#a_id').val(_this.find('.id').text());
            $('#a_leave_type_id').val(_this.find('.leave_type_id').text());
            $('#a_rec_id').val(_this.find('.rec_id').text());
            $('#a_day').val(_this.find('.days').text());
            $('#a_from_date').val(_this.find('.from_date').text());
            $('#a_to_date').val(_this.find('.to_date').text());


        });
    </script>
    {{-- Pending model --}}
    <script>
        $(document).on('click', '.PendingLeave', function() {
            var _this = $(this).parents('tr');
            $('#p_id').val(_this.find('.id').text());
            $('#p_leave_type_id').val(_this.find('.leave_type_id').text());
            $('#p_rec_id').val(_this.find('.rec_id').text());
            $('#p_day').val(_this.find('.days').text());
            $('#p_from_date').val(_this.find('.from_date').text());
            $('#p_to_date').val(_this.find('.to_date').text());
        });
    </script>
    {{-- Declined model --}}
    <script>
        $(document).on('click', '.DeclinedLeave', function() {
            var _this = $(this).parents('tr');
            $('#d_id').val(_this.find('.id').text());
            $('#d_leave_type_id').val(_this.find('.leave_type_id').text());
            $('#d_rec_id').val(_this.find('.rec_id').text());
            $('#d_day').val(_this.find('.days').text());
            $('#d_from_date').val(_this.find('.from_date').text());
            $('#d_to_date').val(_this.find('.to_date').text());
        });
    </script>
@endsection
@endsection
