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
                        <h3 class="page-title">Employee</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
                        <div class="view-icons">
                            <a href="{{ route('all/employee/card') }}" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
                            <a href="{{ route('all/employee/list') }}" class="list-view btn btn-link  active"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('all/employee/list/search') }}" method="POST">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="employee_id">
                            <label class="focus-label">Employee ID</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Employee Name</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Department</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="sumit" class="btn btn-success btn-block"> Search </button>
                    </div>
                </div>
            </form>
            <!-- Search Filter -->
            {{-- message --}}
            {!! Toastr::message() !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Employee ID</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th class="text-nowrap">Join Date</th>
                                    <th>Role</th>
                                    <th class="text-right no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $items)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('employee/profile/' . $items->rec_id) }}" class="avatar"><img alt="" src="{{ URL::to('/assets/images/' . $items->avatar) }}"></a>
                                                <a href="{{ url('employee/profile/' . $items->rec_id) }}">{{ $items->name }}<span>{{ $items->position }}</span></a>
                                            </h2>
                                        </td>
                                        <td>{{ $items->rec_id }}</td>
                                        <td><a href="mailto: {{ $items->email }}">{{ $items->email }}</a></td>
                                        <td>{{ $items->phone_number }}</td>
                                        <td>{{ $items->join_date }}</td>
                                        <td>{{ $items->role_name }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ url('all/employee/view/edit/' . $items->rec_id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="{{ url('all/employee/delete/' . $items->rec_id) }}" onclick="return confirm('Are you sure to want to delete it?')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Add Employee Modal -->
        <!-- Add Employee Modal -->
        <div id="add_employee" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('register/user') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Last Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="lastname" name="lastname" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">User Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="username" name="username" required>
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" value="{{ old('email') }}" name="email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="rec_id" name="" placeholder="Auto id employee" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Role <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Employee" value="Employee" readonly>
                                    </div>
                                </div>

                                <input type="hidden" class="image" name="image" value="photo_defaults.jpg">


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label" @error('password') is-invalid @enderror" name="password">Password <span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" id="password" name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Confirm Password <span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" id="confirmPassword" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" required id="phone_number" name="phone_number">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Birthday <span class="text-danger">*</span></label>
                                        <input class="form-control datetimepicker" type="text" id="birthDate" name="birth_date" required>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select class="select form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="gender" name="gender" required>
                                            <option value="" selected disabled>-- Select --</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Type Of Work <span class="text-danger">*</span></label>
                                        <select class="select @error('role_name') is-invalid @enderror" name="department" id="department">
                                            <option selected disabled>-- Select Dapartment --</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">
                                                    {{ $department->department }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Payment Method <span class="text-danger">*</span></label>
                                        <select class="select select2s-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="payment_method" name="payment_method" required>
                                            <option value="">-- Select --</option>
                                            <option value="Hourly">Hourly</option>
                                            <option value="Parttime">Parttime</option>
                                            <option value="Fulltime">Fulltime</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <label for="col-form-label">Possible working days and hours <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="col-form-label">Choose Rest days</label>
                                    <div class="form-group wday-box mb-4">

                                        <label class="checkbox-inline"><input type="checkbox" name="restdays[]" value="Monday">
                                            <span class="checkmark">M</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="restdays[]" value="Tuesday"><span class="checkmark">T</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="restdays[]" value="Wednesday"><span class="checkmark">W</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="restdays[]" value="Thursday"><span class="checkmark">T</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="restdays[]" value="Friday"><span class="checkmark">F</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="restdays[]" value="Saturday "><span class="checkmark">S</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="restdays[]" value="Sunday"><span class="checkmark">S</span></label>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="input-group time timepicker">
                                            <input class="form-control" type="time" id="time_start" name="time_start">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="input-group time timepicker">
                                            <input class="form-control" type="time" id="time_end" name="time_end">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="onoffswitch">
                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch_hospitalisation">
                                <label class="onoffswitch-label" for="switch_hospitalisation">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>

                            <label for="col-form-label">Possible working days and hours <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="col-form-label">Choose Rest days</label>
                                    <div class="form-group wday-box mb-4">

                                        <label class="checkbox-inline"><input type="checkbox" name="restdays_opt[]" value="Monday">
                                            <span class="checkmark">M</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="restdays_opt[]" value="Tuesday"><span class="checkmark">T</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="restdays_opt[]" value="Wednesday"><span class="checkmark">W</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="restdays_opt[]" value="Thursday"><span class="checkmark">T</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="restdays_opt[]" value="Friday"><span class="checkmark">F</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="restdays_opt[]" value="Saturday "><span class="checkmark">S</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="restdays_opt[]" value="Sunday"><span class="checkmark">S</span></label>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="input-group time timepicker">
                                            <input class="form-control" type="time" id="time_start" name="time_start_opt">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="input-group time timepicker">
                                            <input class="form-control" type="time" id="time_end" name="time_end_opt">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="table-responsive m-t-15">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>Module Permission</th>
                                            <th class="text-center">Read</th>
                                            <th class="text-center">Write</th>
                                            <th class="text-center">Create</th>
                                            <th class="text-center">Delete</th>
                                            <th class="text-center">Import</th>
                                            <th class="text-center">Export</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permission_lists as $lists)
                                            <tr>
                                                <td>{{ $lists->permission_name }}</td>
                                                <input type="hidden" name="permission[]"
                                                    value="{{ $lists->permission_name }}">
                                                <input type="hidden" name="id_count[]" value="{{ $lists->id }}">
                                                <td class="text-center">
                                                    <input type="checkbox" class="read{{ ++$key }}" id="read"
                                                        name="read[]" value="Y"
                                                        {{ $lists->read == 'Y' ? 'checked' : '' }}>
                                                    <input type="checkbox" class="read{{ ++$key1 }}" id="read"
                                                        name="read[]" value="N"
                                                        {{ $lists->read == 'N' ? 'checked' : '' }}>
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="write{{ ++$key }}" id="write"
                                                        name="write[]" value="Y"
                                                        {{ $lists->write == 'Y' ? 'checked' : '' }}>
                                                    <input type="checkbox" class="write{{ ++$key1 }}" id="write"
                                                        name="write[]" value="N"
                                                        {{ $lists->write == 'N' ? 'checked' : '' }}>
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="create{{ ++$key }}" id="create"
                                                        name="create[]" value="Y"
                                                        {{ $lists->create == 'Y' ? 'checked' : '' }}>
                                                    <input type="checkbox" class="create{{ ++$key1 }}" id="create"
                                                        name="create[]" value="N"
                                                        {{ $lists->create == 'N' ? 'checked' : '' }}>
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="delete{{ ++$key }}" id="delete"
                                                        name="delete[]" value="Y"
                                                        {{ $lists->delete == 'Y' ? 'checked' : '' }}>
                                                    <input type="checkbox" class="delete{{ ++$key1 }}" id="delete"
                                                        name="delete[]" value="N"
                                                        {{ $lists->delete == 'N' ? 'checked' : '' }}>
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="import{{ ++$key }}" id="import"
                                                        name="import[]" value="Y"
                                                        {{ $lists->import == 'Y' ? 'checked' : '' }}>
                                                    <input type="checkbox" class="import{{ ++$key1 }}" id="import"
                                                        name="import[]" value="N"
                                                        {{ $lists->import == 'N' ? 'checked' : '' }}>
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="export{{ ++$key }}" id="export"
                                                        name="export[]" value="Y"
                                                        {{ $lists->export == 'Y' ? 'checked' : '' }}>
                                                    <input type="checkbox" class="export{{ ++$key1 }}" id="export"
                                                        name="export[]" value="N"
                                                        {{ $lists->export == 'N' ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> --}}
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Employee Modal -->
        <!-- /Add Employee Modal -->
    </div>
    <!-- /Page Wrapper -->
@section('script')
    <script>
        $("input:checkbox").on('click', function() {
            var $box = $(this);
            if ($box.is(":checked")) {
                var group = "input:checkbox[class='" + $box.attr("class") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });
    </script>
    <script>
        // select auto id and email
        $('#name').on('change', function() {
            $('#employee_id').val($(this).find(':selected').data('employee_id'));
            $('#email').val($(this).find(':selected').data('email'));
        });
    </script>
@endsection
@endsection
