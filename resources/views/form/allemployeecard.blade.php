@extends('layouts.master')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-lists-center">
                    <div class="col">
                        <h3 class="page-title">Employee</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i
                                class="fa fa-plus"></i> Add Employee</a>
                        <div class="view-icons">
                            <a href="{{ route('all/employee/card') }}" class="grid-view btn btn-link active"><i
                                    class="fa fa-th"></i></a>
                            <a href="{{ route('all/employee/list') }}" class="list-view btn btn-link"><i
                                    class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            {{-- message --}}
            {!! Toastr::message() !!}
            <!-- Search Filter -->
            <form action="{{ route('all/employee/search') }}" method="POST">
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
                            <input type="text" class="form-control floating" name="name">
                            <label class="focus-label">Employee Name</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="department">
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
            <div class="row staff-grid-row">
                @foreach ($users as $lists)
                    <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                        <div class="profile-widget">
                            <div class="profile-img">
                                <a href="{{ url('employee/profile/' . $lists->rec_id) }}" class="avatar"><img
                                        src="{{ URL::to('/assets/images/' . $lists->avatar) }}"
                                        alt="{{ $lists->avatar }}" alt="{{ $lists->avatar }}"></a>
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item"
                                        href="{{ url('all/employee/view/edit/' . $lists->rec_id) }}"><i
                                            class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ url('all/employee/delete/' . $lists->rec_id) }}"
                                        onclick="return confirm('Are you sure to want to delete it?')"><i
                                            class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile.html">{{ $lists->name }}</a>
                            </h4>
                            <div class="small text-muted">{{ $lists->position }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- /Page Content -->

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
                                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                                            id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Last Name <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="lastname" name="lastname" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">User Name <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="username" name="username" required>
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                                            id="email" value="{{ old('email') }}" name="email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Employee ID <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="rec_id" name=""
                                            placeholder="Auto id employee" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Role <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="role_name" name="role_name"
                                            placeholder="Employee" value="Employee" readonly>
                                    </div>
                                </div>

                                <input type="hidden" class="image" name="image" value="photo_defaults.jpg">


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label" @error('password') is-invalid @enderror"
                                            name="password">Password <span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" id="password" name="password"
                                            required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Confirm Password <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="password" id="confirmPassword"
                                            name="password_confirmation">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone Number <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="phone_number" name="phone_number">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Birthday <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control datetimepicker" type="text" id="birthDate"
                                            name="birth_date" required>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select class="select form-control" style="width: 100%;" tabindex="-1"
                                            aria-hidden="true" id="gender" name="gender" required>
                                            <option value="" selected disabled>-- Select --</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Department <span
                                                class="text-danger">*</span></label>
                                        <select class="select @error('role_name') is-invalid @enderror" name="department"
                                            id="department">
                                            <option selected disabled>-- Select Role Name --</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->department }}">
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
                                        <label class="col-form-label">Payment Method <span
                                                class="text-danger">*</span></label>
                                        <select class="select select2s-hidden-accessible" style="width: 100%;"
                                            tabindex="-1" aria-hidden="true" id="payment_method" name="payment_method"
                                            required>
                                            <option value="">-- Select --</option>
                                            <option value="Hourly">Hourly</option>
                                            <option value="Parttime">Parttime</option>
                                            <option value="Fulltime">Fulltime</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <label for="col-form-label">Possible working days and hours <span
                                    class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group wday-box">

                                            <label class="checkbox-inline"><input type="checkbox" name="monday" value="Y"
                                                    class="days recurring" checked=""> <span
                                                    class="checkmark">M</span></label>

                                            <label class="checkbox-inline"><input type="checkbox" name="tuesday" value="Y"
                                                    class="days recurring" checked=""><span
                                                    class="checkmark">T</span></label>

                                            <label class="checkbox-inline"><input type="checkbox" name="wednesday"
                                                    value="Y" class="days recurring" checked=""><span
                                                    class="checkmark">W</span></label>

                                            <label class="checkbox-inline"><input type="checkbox" name="thursday" value="Y"
                                                    class="days recurring" checked=""><span
                                                    class="checkmark">T</span></label>

                                            <label class="checkbox-inline"><input type="checkbox" name="friday" value="Y"
                                                    class="days recurring" checked=""><span
                                                    class="checkmark">F</span></label>

                                            <label class="checkbox-inline"><input type="checkbox" name="saturday" value="Y"
                                                    class="days recurring"><span class="checkmark">S</span></label>

                                            <label class="checkbox-inline"><input type="checkbox" name="sunday" value="Y"
                                                    class="days recurring"><span class="checkmark">S</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="input-group time timepicker">
                                            <input class="form-control" type="text" name="time_start"><span
                                                class="input-group-append input-group-addon"><span
                                                    class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="input-group time timepicker">
                                            <input class="form-control" type="text" name="time_end"><span
                                                class="input-group-append input-group-addon"><span
                                                    class="input-group-text"><i class="fa fa-clock-o"></i></span></span>
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
        $(document).ready(function() {
            $('.select2s-hidden-accessible').select2({
                closeOnSelect: false
            });
        });
    </script>
    <script>
        // select auto id and email
        $('#name').on('change', function() {
            $('#employee_id').val($(this).find(':selected').data('employee_id'));
            $('#email').val($(this).find(':selected').data('email'));
        });
    </script>
    {{-- update js --}}
    <script>
        $(document).on('click', '.userUpdate', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_name').val(_this.find('.name').text());
            $('#e_email').val(_this.find('.email').text());
            $('#e_phone_number').val(_this.find('.phone_number').text());
            $('#e_image').val(_this.find('.image').text());

            var name_role = (_this.find(".role_name").text());
            var _option = '<option selected value="' + name_role + '">' + _this.find('.role_name').text() +
                '</option>'
            $(_option).appendTo("#e_role_name");

            var position = (_this.find(".position").text());
            var _option = '<option selected value="' + position + '">' + _this.find('.position').text() +
                '</option>'
            $(_option).appendTo("#e_position");

            var department = (_this.find(".department").text());
            var _option = '<option selected value="' + department + '">' + _this.find('.department').text() +
                '</option>'
            $(_option).appendTo("#e_department");

            var statuss = (_this.find(".statuss").text());
            var _option = '<option selected value="' + statuss + '">' + _this.find('.statuss').text() + '</option>'
            $(_option).appendTo("#e_status");

        });
    </script>
@endsection

@endsection
