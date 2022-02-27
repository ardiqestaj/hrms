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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('clients/clients') }}">Clients</a></li>
                            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Client Location</a></li>
                            <li class="breadcrumb-item active">Menage Department</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="card mb-0">
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

                                                <div class="staff-msg"><a href="chat.html" class="btn btn-custom">Send
                                                        Message</a></div>
                                                <ul class="personal-info">
                                                    <li>
                                                        <span class="title">Mobile Phone:</span>
                                                        <span class="text"><a href="tel: {{ $location_type_work->location_phone_number }}">{{ $location_type_work->location_phone_number }}</a></span>
                                                    </li>
                                                    <li>
                                                        <span class="title">Email:</span>
                                                        <span class="text"><a href="mailto: {{ $location_type_work->location_email }}">{{ $location_type_work->location_email }}</a></span>
                                                    </li>
                                                    <li>
                                                        <span class="title">Address:</span>
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
                                                    <span class="title">Type Of Work:</span>
                                                    <span class="text">{{ $location_type_work->department }}</span>
                                                </li>
                                                <li>
                                                    <span class="title">No. of Employees:</span>
                                                    <span class="text">{{ $location_type_work->number_of_employees }} Employees</span>
                                                </li>
                                                <li>
                                                    <span class="title">In Time/ Out Time:</span>
                                                    <span class="text">{{ $location_type_work->intime }} - {{ $location_type_work->outime }}</span>
                                                </li>
                                                <li>
                                                    <span class="title">Hours:</span>
                                                    <span class="text">{{ $location_type_work->hours }} Hours</span>
                                                </li>
                                                <li>
                                                    <span class="title">Restdays:</span>
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

            {{-- <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item col-sm-3"><a class="nav-link active" data-toggle="tab" href="#myprojects">Projects</a></li>
                            <li class="nav-item col-sm-3"><a class="nav-link" data-toggle="tab" href="#tasks">Tasks</a></li>
                        </ul>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-12 p-0 mt-5">
                    <form action="{{ url('location/profile/assignment/' . $location_type_work->location_type_work_id) }}" method="POST">
                        @csrf
                        <div class="form-group leave-duallist " style="border: none; background: transparent;">
                            <h3 class="mb-4">Assign Employees on this dapartement</h3>

                            <div class="row">

                                <div class="col-lg-5 col-sm-5">
                                    <h4 class="mb-2 text-muted">Recommended Employees <i class="fa fa-arrow-down"></i></h4>

                                    <select name="customleave_from" id="customleave_select" class="form-control" size="{{ count($finale) }}" multiple="multiple" style="height: 45vh; border-radius: 20px; padding: 15px; background-color: white;">
                                        @if (isset($finale))
                                            @foreach ($finale as $employee)
                                                <option value="{{ $employee['employee_id'] }}">{{ $employee['name'] }} {{ $employee['lastname'] }} -
                                                    <span style="color: blue;" id="text-muted-employees">{{ $employee['time_start'] }} - {{ $employee['time_end'] }} / {{ $employee['restdays'] }}</span>

                                                </option>
                                            @endforeach
                                            <br>
                                        @else
                                            <option value="">NO EMPLOYEES
                                                {{ $employee->lastname }} -
                                                <span style="color: blue;" id="text-muted-employees">{{ $employee->time_start }} - {{ $employee->time_end }} / {{ $employee->restdays }}</span>

                                            </option>
                                        @endif
                                        <option class="manual-assign-opt" style="display: none;" value=""></option>


                                    </select>


                                    <div class="d-flex mt-3">

                                        <input id="custom_field1" name="custom_field1" type="text" list="emails" class="form-control" style="border-radius:0; border-top-left-radius: 10px; border-bottom-left-radius: 10px; background-color: white;" placeholder="Manualy Select Employees">

                                        <datalist id="emails">
                                            @foreach ($employeeList as $emp)
                                                <option class="manual-assign" data-name="{{ $emp->name }}" data-lastname="{{ $emp->lastname }}" data-start="{{ $emp->time_start }}" data-end="{{ $emp->time_end }}" data-restday="{{ $emp->restdays }}" value="{{ $emp->employee_id }}">{{ $emp->name }} {{ $emp->lastname }}</option>
                                            @endforeach
                                        </datalist>
                                        <button id="manual-assign-btn" class="btn btn-outline" style="border-radius:0; border-top-right-radius: 10px; border-bottom-right-radius: 10px; background: #fff; border: 1px solid #ccc; "><i class="fa fa-plus"></i></button>
                                    </div>

                                </div>
                                <div class="multiselect-controls col-lg-2 col-sm-2 my-auto">
                                    <button type="button" id="customleave_select_rightAll" class="btn btn-block btn-white mb-3" style="border-radius: 10px;">Assign All &nbsp;<i class="fa fa-forward"></i></i></button>
                                    <button type="button" id="customleave_select_rightSelected" class="btn btn-block btn-white mb-3" style="border-radius: 10px;">Assign &nbsp;<i class="fa fa-arrow-right"></i></button>
                                    <button type="button" id="customleave_select_leftSelected" class="btn btn-block btn-white mb-3" style="border-radius: 10px;">Remove &nbsp;<i class="fa fa-arrow-left"></i></button>
                                    <button type="button" id="customleave_select_leftAll" class="btn btn-block btn-white" style="border-radius: 10px;">Remove All &nbsp;<i class="fa fa-backward"></i></button>
                                </div>

                                <div class="col-lg-5 col-sm-5">
                                    <h4 class="mb-2 text-muted">Assigned Employees <i class="fa fa-arrow-down"></i></h4>

                                    <select name="customleave_to[]" id="customleave_select_to" class="form-control selectpicker" size="{{ $location_type_work->number_of_employees }}" multiple="multiple" style="height: 45vh; border-radius: 20px; padding: 15px; background-color: white;">
                                        {{-- <optgroup data-max-options="{{ $location_type_work->number_of_employees }}"> --}}
                                        @if (count($assignments) <= $location_type_work->number_of_employees)
                                            @foreach ($assignments as $assignment)
                                                <option value="{{ $assignment->em_id }}">{{ $assignment->name }} {{ $assignment->lastname }} -
                                                    {{ $assignment->time_start }} - {{ $assignment->time_end }} / {{ $assignment->restdays }}
                                                </option>
                                            @endforeach
                                        @else
                                        @endif


                                        {{-- </optgroup> --}}

                                    </select>
                                    {{-- <h4 class="mb-2 text-muted">Manualy Select Employees <i class="fa fa-arrow-down"></i></h4> --}}


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

        $('#customleave_select').on('change', function() {
            if (this.selectedOptions.length <= {{ $location_type_work->number_of_employees }}) {
                $(this).find(':selected').addClass('selected');
                $(this).find(':not(:selected)').removeClass('selected');
            } else
                $(this)
                .find(':selected:not(.selected)')
                .prop('selected', false);
        });

        $(document).ready(function() {

            $("#custom_field1").change(function() {
                var proName = $("#custom_field1").val();
                var name = $('#emails option').filter(function() {
                    return this.value == proName;
                }).data('name');

                var lastname = $('#emails option').filter(function() {
                    return this.value == proName;
                }).data('lastname');

                var start = $('#emails option').filter(function() {
                    return this.value == proName;
                }).data('start');

                var end = $('#emails option').filter(function() {
                    return this.value == proName;
                }).data('end');

                var restday = $('#emails option').filter(function() {
                    return this.value == proName;
                }).data('restday');

                $('#manual-assign-btn').on('click', function(e) {
                    $('.manual-assign-opt').css('display', 'block');
                    $('#customleave_select').find('.manual-assign-opt').text(name + " " + lastname + " - " + start + " - " + end + " / " + restday);
                    $('#customleave_select').find('.manual-assign-opt').val($("#custom_field1").val());
                    // $('#custom_field1').val($(this).attr('data-name'))

                    e.preventDefault();
                });
            });


        });
    </script>
@endsection
