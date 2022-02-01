
@extends('layouts.master')
@section('content')
    

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            {!! Toastr::message() !!}
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
                        <a href="#" class="btn add-btn AddLeave" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Leave</a>
                    </div>
                </div>
            </div>
            
            <!-- Leave Statistics -->
            <div class="row">
            @foreach ($LeaveTypes as $LeaveType ) 
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>{{$LeaveType->leave_names}}</h6>
                        <h4>{{$LeaveType->leave_days}}</h4>
                        <h6>Remaining {{$LeaveType->leave_days - $LeavesEvidence->where('leave_type_id', $LeaveType->leave_id)->sum('day')}}</h6>
                    </div>
                </div>
            @endforeach
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Remaining Leave</h6>
                        <h4>{{$LeaveTypes->sum('leave_days') - $LeavesEvidence->where('status', 'Approved')->sum('day')}}</h4>
                        <h6>All<h6>
                    </div>
                </div>
            </div>
            <!-- /Leave Statistics -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>No of Days</th>
                                    <th>Reason</th>
                                    <th class="text-center">Status</th>
                                    <th>Approved by</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(!empty($leavesapplies))
                                    @foreach ($leavesapplies as $leavesapplie )  
                                <tr>
                                    <td hidden class="id">{{$leavesapplie->leave_applies_id}}</td>
                                    <td hidden class="from_date">{{ $leavesapplie->from_date }}</td>
                                    <td hidden class="to_date">{{$leavesapplie->to_date}}</td>
                                    <td>{{$leavesapplie->leave_names}}</td>
                                    <td>{{date('d F, Y',strtotime($leavesapplie->from_date)) }}</td>
                                    <td>{{date('d F, Y',strtotime($leavesapplie->to_date)) }}</td>
                                    <td class="day">{{$leavesapplie->day}} Days</td>
                                    <td class="leave_reason"> {{$leavesapplie->leave_reason}}</td>
                                    <td class="text-center">
                                        <div class="action-label">
                                        <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                            @if($leavesapplie->status == 'New' )
                                            <i class="fa fa-dot-circle-o text-purple"></i>
                                                New
                                            @elseif($leavesapplie->status == 'Pending')
                                            <i class="fa fa-dot-circle-o text-danger"></i>
                                                Pending
                                            @elseif($leavesapplie->status == 'Approved')
                                            <i class="fa fa-dot-circle-o text-success"></i>
                                                Approved
                                            @else
                                            <i class="fa fa-dot-circle-o text-danger"></i>
                                                Declined
                                            @endif
                                        </a>
                                        </div>
                                    </td>
                                    <td>
                                        <h2 class="table-avatar">
                                        @foreach($users as $user)
                                            <a href="#"> 
                                                @if($user->rec_id == $leavesapplie->approved_by)
                                                {{$user->name}}
                                             @endif
                                             </a>
                                        @endforeach
                                        @if('Not Yet' == $leavesapplie->approved_by)
                                                Waiting...
                                             @endif
                                        </h2>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item leaveUpdate" href="#" data-toggle="modal" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item leaveDelete" href="#" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>                                    
                                    </td>
                                </tr>
                                @endforeach
                            @endif
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
                                    @foreach($LeaveTypes as $LeaveType)
                                    <option value="{{$LeaveType->leave_id}}">{{$LeaveType->leave_names}}</option>
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
                            {{-- <div class="form-group">
                                <label>Number of days <span class="text-danger">*</span></label>
                                <input class="form-control" readonly type="text">
                            </div>
                            <div class="form-group">
                                <label>Remaining Leaves <span class="text-danger">*</span></label>
                                <input class="form-control" readonly value="14" type="text">
                            </div> --}}
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
                                @foreach($LeaveTypes as $LeaveType)
                                    <option value="{{$LeaveType->leave_id}}">{{$LeaveType->leave_names}}</option>
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
                                <label>Remaining Leaves <span class="text-danger">*</span></label>
                                <input class="form-control" readonly value="12" type="text">
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
        
        <!-- Delete Leave Modal -->
        <div class="modal custom-modal fade" id="delete_approve" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Leave</h3>
                            <p>Are you sure want to Cancel this leave?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/leavesemployee/delete') }}" method="POST">
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
    <!-- {{-- update js --}} -->
    <script>
        $(document).on('click','.leaveUpdate',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_number_of_days').val(_this.find('.day').text());
            $('#e_from_date').val(_this.find('.from_date').text());  
            $('#e_to_date').val(_this.find('.to_date').text());  
            $('#e_leave_reason').val(_this.find('.leave_reason').text());
            var leave_type = (_this.find(".leave_type").text());
            var _option = '<option selected value="' + leave_type+ '">' + _this.find('.leave_type').text() + '</option>'
            $( _option).appendTo("#e_leave_type");
        });
    </script>
    <script>
        $(document).on('click','.AddLeave',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_number_of_days').val(_this.find('.day').text());
            $('#e_from_date').val(_this.find('.from_date').text());  
            $('#e_to_date').val(_this.find('.to_date').text());  
            $('#e_leave_reason').val(_this.find('.leave_reason').text());
            var leave_type = (_this.find(".leave_type").text());
            var _option = '<option selected value="' + leave_type+ '">' + _this.find('.leave_type').text() + '</option>'
            $( _option).appendTo("#e_leave_type");
        });
    </script>
    <!-- Delete leaveby employees -->
    <script>
        $(document).on('click','.leaveDelete',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
@endsection
