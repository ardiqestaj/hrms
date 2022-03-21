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
                        {{-- <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a> --}}
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
            {{-- message --}}

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

            <!-- Employee List -->
            <div class="row staff-grid-row">
                <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3 employeeclass">
                    <div class="card" style="height: 83%;">
                        <div class="card-body d-flex align-items-center justify-content-center">

                            <a href="#" class="btn text-muted stretched-link" data-toggle="modal"
                                data-target="#add_employee" style="border: none;"><i class="fa fa-3x fa-plus"></i> <br> Add
                                Employee </a>

                        </div>
                    </div>
                </div>
                @foreach ($users as $lists)
                    <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3 employeeclass">

                        <div class="profile-widget">
                            <div hidden class="id">{{ $lists->rec_id }}</div>
                            {{-- <input type="text" class="id" value="{{ $lists->rec_id }}"> --}}

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
                                    <a class="dropdown-item employeeDelete" href="#" data-toggle="modal"
                                        data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile.html">{{ $lists->name }}</a>
                            </h4>
                            <div class="small text-muted">{{ $lists->position }}</div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="mx-auto mt-5">
                @if (count($users) >= 1)
                    {{ $users->links() }}
                @endif
            </div>
            <!-- End Employee List -->
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
                        {{-- Add employee menu --}}
                        <div class="card"
                            style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;">
                            <div class="row user-tabs">
                                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                                    <ul class="nav nav-tabs nav-tabs-bottom ">
                                        <li class="nav-item"><a href="#emp_profile" data-toggle="tab"
                                                class="nav-link active emp_profile">Personal Information</a></li>
                                        <li class="nav-item"><a href="#emp_salary" data-toggle="tab"
                                                class="nav-link emp_salary">Salary Information</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- End Add employee menu --}}

                        {{-- Add employee form --}}
                        <form action="{{ route('register/user') }}" method="POST">
                            @csrf
                            <div class="tab-content pt-0">
                                {{-- Personal Info --}}
                                <div class="tab-pane fade show active" id="emp_profile">
                                    <div class="card"
                                        style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Name <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control @error('name') is-invalid @enderror"
                                                            type="text" id="name" name="name" value="{{ old('name') }}"
                                                            required>
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
                                                        <input class="form-control" type="text" id="lastname"
                                                            name="lastname" required>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">User Name <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" id="username"
                                                            name="username" required>
                                                    </div>
                                                </div>


                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Email <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control @error('email') is-invalid @enderror"
                                                            type="email" id="email" value="{{ old('email') }}"
                                                            name="email" required>
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
                                                        <label class="col-form-label">Role <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="role_name"
                                                            name="role_name" placeholder="Employee" value="Employee"
                                                            readonly>
                                                    </div>
                                                </div>

                                                <input type="hidden" class="image" name="image"
                                                    value="photo_defaults.jpg">


                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label"
                                                            @error('password') is-invalid @enderror"
                                                            name="password">Password <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="password" id="password"
                                                            name="password" required>
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
                                                            name="password_confirmation" required>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Phone Number <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" required
                                                            id="phone_number" name="phone_number">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Birthday <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control datetimepicker" type="text"
                                                            id="birthDate" name="birth_date" required>

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gender <span class="text-danger">*</span></label>
                                                        <select class="select form-control" style="width: 100%;"
                                                            tabindex="-1" aria-hidden="true" id="gender" name="gender"
                                                            required>
                                                            <option value="" selected disabled>-- Select --</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Type Of Work <span
                                                                class="text-danger">*</span></label>
                                                        <select class="select @error('role_name') is-invalid @enderror"
                                                            name="department" id="department">
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
                                                        <label class="col-form-label">Payment Method <span
                                                                class="text-danger">*</span></label>
                                                        <p class="errMsg text-danger m-0 p-0" style="display: none;">
                                                            Please
                                                            select
                                                            an option.</p>
                                                        <div class="select-border" style="border-radius: 5px;">
                                                            <select class="select select2s-hidden-accessible"
                                                                style="width: 100%;" tabindex="-1" aria-hidden="true"
                                                                id="payment_method" name="payment_method" required>
                                                                <option value="selectcard">-- Select --</option>
                                                                <option value="Fulltime">Fulltime</option>
                                                                <option value="Parttime">Parttime</option>
                                                                <option value="Hourly">Hourly</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <label for="col-form-label">Possible working days and hours <span
                                                    class="text-danger">*</span></label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">Choose Rest days</label>
                                                    <div class="form-group wday-box mb-4">

                                                        <label class="checkbox-inline"><input type="checkbox"
                                                                name="restdays[]" value="Monday">
                                                            <span class="checkmark">M</span></label>

                                                        <label class="checkbox-inline"><input type="checkbox"
                                                                name="restdays[]" value="Tuesday"><span
                                                                class="checkmark">T</span></label>

                                                        <label class="checkbox-inline"><input type="checkbox"
                                                                name="restdays[]" value="Wednesday"><span
                                                                class="checkmark">W</span></label>

                                                        <label class="checkbox-inline"><input type="checkbox"
                                                                name="restdays[]" value="Thursday"><span
                                                                class="checkmark">T</span></label>

                                                        <label class="checkbox-inline"><input type="checkbox"
                                                                name="restdays[]" value="Friday"><span
                                                                class="checkmark">F</span></label>

                                                        <label class="checkbox-inline"><input type="checkbox"
                                                                name="restdays[]" value="Saturday "><span
                                                                class="checkmark">S</span></label>

                                                        <label class="checkbox-inline"><input type="checkbox"
                                                                name="restdays[]" value="Sunday"><span
                                                                class="checkmark">S</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="input-group time timepicker">
                                                            <input class="form-control" type="time" id="time_start"
                                                                name="time_start">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="input-group time timepicker">
                                                            <input class="form-control" type="time" id="time_end"
                                                                name="time_end">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="onoffswitch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                                                    id="switch_hospitalisation">
                                                <label class="onoffswitch-label" for="switch_hospitalisation">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>

                                            <div class="display-on-toggle">
                                                <label for="col-form-label">Possible working days and hours <span
                                                        class="text-danger">*</span></label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">Choose Rest days</label>
                                                        <div class="form-group wday-box mb-4">

                                                            <label class="checkbox-inline"><input type="checkbox"
                                                                    name="restdays_opt[]" value="Monday">
                                                                <span class="checkmark">M</span></label>

                                                            <label class="checkbox-inline"><input type="checkbox"
                                                                    name="restdays_opt[]" value="Tuesday"><span
                                                                    class="checkmark">T</span></label>

                                                            <label class="checkbox-inline"><input type="checkbox"
                                                                    name="restdays_opt[]" value="Wednesday"><span
                                                                    class="checkmark">W</span></label>

                                                            <label class="checkbox-inline"><input type="checkbox"
                                                                    name="restdays_opt[]" value="Thursday"><span
                                                                    class="checkmark">T</span></label>

                                                            <label class="checkbox-inline"><input type="checkbox"
                                                                    name="restdays_opt[]" value="Friday"><span
                                                                    class="checkmark">F</span></label>

                                                            <label class="checkbox-inline"><input type="checkbox"
                                                                    name="restdays_opt[]" value="Saturday "><span
                                                                    class="checkmark">S</span></label>

                                                            <label class="checkbox-inline"><input type="checkbox"
                                                                    name="restdays_opt[]" value="Sunday"><span
                                                                    class="checkmark">S</span></label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="input-group time timepicker">
                                                                <input class="form-control" type="time" id="time_start"
                                                                    name="time_start_opt">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="input-group time timepicker">
                                                                <input class="form-control" type="time" id="time_end"
                                                                    name="time_end_opt">
                                                            </div>
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
                                        {{-- </div> --}}

                                            <div class="submit-section">
                                                <button id="next-form-btn" type="button" class="btn btn-primary submit-btn"
                                                    onclick="fun()">Next <i class="mt-2 las la-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Personal Info --}}

                                <div class="tab-pane fade" id="emp_salary">
                                    <!-- Fulltime Tab -->
                                    <div style="display: none;" id="fulltime">
                                        <div class="card"
                                            style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                                            <div class="card-body">
                                                <h3 class="card-title"> Earnings Information</h3>

                                                <div class="row">
                                                    <div class="col-sm-4" hidden>
                                                        <div class="form-group">
                                                            <label>Gender <span class="text-danger">*</span></label>
                                                            <select class="select form-control" name="payment_type"
                                                                style="width: 100%;" tabindex="-1" aria-hidden="true"
                                                                id="gender" name="gender" required>
                                                                <option value="Fulltime" selected>Fulltime</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Salary amount <small
                                                                    class="text-muted">per
                                                                    month
                                                                </small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="salary_amount"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Monthly Surcharge <small
                                                                    class="text-muted">
                                                                    FSB Zussschlag mtl</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="monthly_surcharge"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">13'nth Salary <small
                                                                    class="text-muted">
                                                                    13. Monatslohn (Autocalculated)</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Type your salary amount" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Brutto Salary <small
                                                                    class="text-muted">
                                                                    Bruttolohn (Autocalculated)</small></label>
                                                            <div class="input-group"
                                                                style="border: 1px solid green; border-radius: 5px;">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Type your salary amount" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <h3 class="card-title"> Deductions Information</h3>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Pension Insurance <small
                                                                    class="text-muted">
                                                                    AHV Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="pension_insurance"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Unemployment Insurance <small
                                                                    class="text-muted">
                                                                    ALV Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="unemployment_insurance"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Accident Insurance <small
                                                                    class="text-muted">
                                                                    NBU Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="accident_insurance"
                                                                    placeholder="Type your salary amount" value="00.00">
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
                                                                <input type="text" class="form-control" name="uvg_grb"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Pension Fund Insurance<small
                                                                    class="text-muted">
                                                                    Pensionkasse Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="pension_fund"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Medical Insurance<small
                                                                    class="text-muted">
                                                                    Krankentaggeld</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="medical_insurance"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Collective Labor
                                                                Agreement<small class="text-muted">
                                                                    GAV Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="collective_labor"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Total Deductons <small
                                                                    class="text-muted">
                                                                    Total Abzuge (autocalculated)</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Type your salary amount" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Netto Salary <small
                                                                    class="text-muted">
                                                                    Nettolohn (autocalculated)</small></label>
                                                            <div class="input-group"
                                                                style="border: 1px solid green; border-radius: 5px;">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Type your salary amount" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>
                                                <h3 class="card-title">Other Expenses</h3>

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Expenses <small
                                                                    class="text-muted">
                                                                    Spesen</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control" name="expenses"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Telephone and Shipment<small
                                                                    class="text-muted">
                                                                    Telefon und Versandspesen</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="telephone_shipment"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Mileage Compensation <small
                                                                    class="text-muted">
                                                                    Kilometerentschadingung</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="mileage_compensation"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Total Expenses <small
                                                                    class="text-muted">
                                                                    Totalspesen (autocalculated)</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Type your salary amount" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Total Payout <small
                                                                    class="text-muted">
                                                                    Total Auszahlung (autocalculated)</small></label>
                                                            <div class="input-group"
                                                                style="border: 1px solid green; border-radius: 5px;">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Type your salary amount" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="submit-section d-flex justify-content-center">
                                                    <button type="button"
                                                        class="btn btn-primary submit-btn mr-2 prev-form-btn"><i
                                                            class="las la-arrow-left"></i> Back</button>

                                                    <button class="btn btn-primary submit-btn ml-2" type="submit"><i
                                                            class="las la-save"></i> Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Fulltime Tab -->

                                    <!-- Parttime Tab -->
                                    <div style="display: none;" id="parttime">
                                        <div class="card"
                                            style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                                            <div class="card-body">
                                                <h3 class="card-title">Parttime: Earnings Information</h3>

                                                <div class="row">
                                                    <div class="col-sm-4" hidden>
                                                        <div class="form-group">
                                                            <label>Gender <span class="text-danger">*</span></label>
                                                            <select class="select form-control" name="payment_type"
                                                                style="width: 100%;" tabindex="-1" aria-hidden="true"
                                                                id="gender" name="gender" required>
                                                                <option value="Parttime" selected>Parttime</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Salary amount <small
                                                                    class="text-muted">per
                                                                    month
                                                                </small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="salary_amount"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Monthly Surcharge <small
                                                                    class="text-muted">
                                                                    FSB Zussschlag mtl</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="monthly_surcharge"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">13'nth Salary <small
                                                                    class="text-muted">
                                                                    13. Monatslohn (Autocalculated)</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Type your salary amount" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Brutto Salary <small
                                                                    class="text-muted">
                                                                    Bruttolohn (Autocalculated)</small></label>
                                                            <div class="input-group"
                                                                style="border: 1px solid green; border-radius: 5px;">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Type your salary amount" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <h3 class="card-title"> Deductions Information</h3>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Pension Insurance <small
                                                                    class="text-muted">
                                                                    AHV Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="pension_insurance"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Unemployment Insurance <small
                                                                    class="text-muted">
                                                                    ALV Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="unemployment_insurance"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Accident Insurance <small
                                                                    class="text-muted">
                                                                    NBU Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="accident_insurance"
                                                                    placeholder="Type your salary amount" value="00.00">
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
                                                                <input type="text" class="form-control" name="uvg_grb"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Pension Fund Insurance<small
                                                                    class="text-muted">
                                                                    Pensionkasse Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="pension_fund"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Medical Insurance<small
                                                                    class="text-muted">
                                                                    Krankentaggeld</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="medical_insurance"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Collective Labor
                                                                Agreement<small class="text-muted">
                                                                    GAV Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="collective_labor"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Total Deductons <small
                                                                    class="text-muted">
                                                                    Total Abzuge (autocalculated)</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Type your salary amount" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Netto Salary <small
                                                                    class="text-muted">
                                                                    Nettolohn (autocalculated)</small></label>
                                                            <div class="input-group"
                                                                style="border: 1px solid green; border-radius: 5px;">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Type your salary amount" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>
                                                <h3 class="card-title">Other Expenses</h3>

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Expenses <small
                                                                    class="text-muted">
                                                                    Spesen</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control" name="expenses"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Telephone and Shipment<small
                                                                    class="text-muted">
                                                                    Telefon und Versandspesen</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="telephone_shipment"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Mileage Compensation <small
                                                                    class="text-muted">
                                                                    Kilometerentschadingung</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="mileage_compensation"
                                                                    placeholder="Type your salary amount" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Total Expenses <small
                                                                    class="text-muted">
                                                                    Totalspesen (autocalculated)</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Type your salary amount" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Total Payout <small
                                                                    class="text-muted">
                                                                    Total Auszahlung (autocalculated)</small></label>
                                                            <div class="input-group"
                                                                style="border: 1px solid green; border-radius: 5px;">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Type your salary amount" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="submit-section d-flex justify-content-center">
                                                    <button type="button"
                                                        class="btn btn-primary submit-btn mr-2 prev-form-btn"><i
                                                            class="las la-arrow-left"></i> Back</button>

                                                    <button class="btn btn-primary submit-btn ml-2" type="submit"><i
                                                            class="las la-save"></i> Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Parttime Tab -->

                                    <!-- Hourly Tab -->
                                    <div style="display: none;" id="hourly">
                                        <div class="card"
                                            style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                                            <div class="card-body">
                                                <h3 class="card-title">Hourly: Earnings Information</h3>
                                                <div class="row">

                                                    <div class="col-sm-4" hidden>
                                                        <div class="form-group">
                                                            <label>Type of Work <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="select form-control" name="payment_type"
                                                                style="width: 100%;" tabindex="-1" aria-hidden="true"
                                                                id="gender" name="payment_type" required>
                                                                <option value="Hourly" selected>Houly</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Hourly Salary<small
                                                                    class="text-muted">
                                                                    Stundenlohn
                                                                </small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="00.00" name="hourly_salary" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Night/Sunday Bonus <small
                                                                    class="text-muted">
                                                                    Nacht - Sonntagszulage</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="00.00" name="night_sunday_bon"
                                                                    value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Holiday Bonus <small
                                                                    class="text-muted">
                                                                    Ferienentschadigung</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="00.00" name="holiday_bon" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Holiday Bonus minus<small
                                                                    class="text-muted">
                                                                    Ferienentschadigung minus</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="00.00" name="holiday_bon_minus"
                                                                    value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Timesupplement
                                                                Night/Sunday<small class="text-muted">
                                                                    Zeitzuschlag Nacht/Sonntag</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="00.00" name="timesupplement_night_sunday"
                                                                    value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Monthly Surcharge <small
                                                                    class="text-muted">
                                                                    FSB Zussschlag mtl</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control" disabled
                                                                    placeholder="00.00" name="monthly_surcharge"
                                                                    value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">13'nth Salary <small
                                                                    class="text-muted">
                                                                    13. Monatslohn (Autocalculated)</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control" disabled
                                                                    placeholder="00.00" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Brutto Salary <small
                                                                    class="text-muted">
                                                                    Bruttolohn (Autocalculated)</small></label>
                                                            <div class="input-group"
                                                                style="border: 1px solid green; border-radius: 5px;">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="00.00" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <h3 class="card-title"> Deductions Information</h3>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Pension Insurance <small
                                                                    class="text-muted">
                                                                    AHV Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="pension_insurance" placeholder="00.00"
                                                                    value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Unemployment Insurance <small
                                                                    class="text-muted">
                                                                    ALV Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="00.00" name="unemployment_insurance"
                                                                    value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Accident Insurance <small
                                                                    class="text-muted">
                                                                    NBU Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="00.00" name="accident_insurance"
                                                                    value="00.00">
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
                                                                <input type="text" class="form-control" name="uvg_grb"
                                                                    placeholder="00.00" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Pension Fund<small
                                                                    class="text-muted">
                                                                    Pensionkasse Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="pension_fund" disabled placeholder="00.00"
                                                                    value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Medical Insurance<small
                                                                    class="text-muted">
                                                                    Krankentaggeld</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="medical_insurance" placeholder="00.00"
                                                                    value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Collective Labor
                                                                Agreement<small class="text-muted">
                                                                    GAV Abzug</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="collective_labor" placeholder="00.00"
                                                                    value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Total Deductons <small
                                                                    class="text-muted">
                                                                    Total Abzuge (autocalculated)</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="00.00" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Netto Salary <small
                                                                    class="text-muted">
                                                                    Nettolohn (autocalculated)</small></label>
                                                            <div class="input-group"
                                                                style="border: 1px solid green; border-radius: 5px;">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="00.00" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>
                                                <h3 class="card-title">Other Expenses</h3>

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Expenses <small
                                                                    class="text-muted">
                                                                    Spesen</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control" name="expenses"
                                                                    disabled placeholder="00.00" value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Telephone and Shipment<small
                                                                    class="text-muted">
                                                                    Telefon und Versandspesen</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="telephone_shipment" placeholder="00.00"
                                                                    value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Mileage Compensation <small
                                                                    class="text-muted">
                                                                    Kilometerentschadingung</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="mileage_compensation" placeholder="00.00"
                                                                    value="00.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Total Expenses <small
                                                                    class="text-muted">
                                                                    Totalspesen (autocalculated)</small></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="00.00" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Total Payout <small
                                                                    class="text-muted">
                                                                    Total Auszahlung (autocalculated)</small></label>
                                                            <div class="input-group"
                                                                style="border: 1px solid green; border-radius: 5px;">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">CHF</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    placeholder="00.00" value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="submit-section d-flex justify-content-center">
                                                    <button type="button"
                                                        class="btn btn-primary submit-btn mr-2 prev-form-btn"><i
                                                            class="las la-arrow-left"></i> Back</button>

                                                    <button class="btn btn-primary submit-btn ml-2" type="submit"><i
                                                            class="las la-save"></i> Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Hourly Tab -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Employee Modal -->


    <!-- Delete Leave Modal -->
    <div class="modal custom-modal fade" id="delete_approve" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Employee</h3>
                        <p>Are you sure want to delete this employee?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="{{ route('all/employee/delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="employee_id" id="e_id" value="">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn submit-btn">Delete</button>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal"
                                        class="btn btn-primary cancel-btn">Cancel</a>
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
        $(document).on('click', '.employeeDelete', function() {
            var _this = $(this).parents('.profile-widget');
            $('#e_id').val(_this.find('.id').text());
        });



        function fun() {
            var ddl = document.getElementById("payment_method");
            var selectedValue = ddl.options[ddl.selectedIndex].value;
            if (selectedValue == "selectcard") {
                $('.select-border').css('border', '1px solid #ff0000');
                $('.errMsg').css("display", 'block');
            } else {
                // $('#next-form-btn').click();

                $('#next-form-btn').on('click', function(e) {
                    $('.emp_salary').click();
                    $('.select-border').css('border', 'none');
                    $('.errMsg').css("display", 'none');
                });

                $('.prev-form-btn').on('click', function(e) {
                    $('.emp_profile').click();
                    $('.select-border').css('border', 'none');
                    $('.errMsg').css("display", 'none');
                });

            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.select2s-hidden-accessible').select2({
                // closeOnSelect: false
            });

            $(document).ready(function() {
                $(".display-on-toggle").toggle();

                $("#switch_hospitalisation").click(function() {
                    $(".display-on-toggle").toggle();
                    $(this).hide();
                });
            });

            $('#payment_method').on('change', function(e) {
                if ($("#payment_method :selected").val() == "Fulltime") {
                    $('#fulltime').css("display", 'block');
                    $('#parttime').css("display", 'none');
                    $('#hourly').css("display", 'none');
                } else if ($("#payment_method :selected").val() == "Parttime") {
                    $('#fulltime').css("display", 'none');
                    $('#parttime').css("display", 'block');
                    $('#hourly').css("display", 'none');
                } else {
                    $('#fulltime').css("display", 'none');
                    $('#parttime').css("display", 'none');
                    $('#hourly').css("display", 'block');
                }
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
