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
                        <h3 class="page-title">Employee View</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee View Edit</li>

                        </ul>
                    </div>
                </div>
            </div>

            <!-- /Page Header -->
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Employee edit</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('all/employee/update') }}" method="POST">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id"
                                    value="{{ $employees[0]->employee_id }}">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Name</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $employees[0]->name }}">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Lastname</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="lastname" name="lastname"
                                            value="{{ $employees[0]->lastname }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Username</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="username" name="username"
                                            value="{{ $employees[0]->username }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Email</label>
                                    <div class="col-md-10">
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $employees[0]->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Phone Number</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                                            value="{{ $employees[0]->phone_number }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Birth Date</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control datetimepicker" id="birthDate"
                                            name="birth_date" value="{{ $employees[0]->birth_date }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Gender</label>
                                    <div class="col-md-10">
                                        <select class="select form-control" id="gender" name="gender">
                                            <option value="{{ $employees[0]->gender }}" selected>
                                                {{ $employees[0]->gender }} </option>
                                            @if ($employees[0]->gender == 'Male')
                                                <option value="Female">Female</option>
                                            @else
                                                <option value="Male">Male</option>

                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Department</label>
                                    <div class="col-md-10">
                                        <select class="select form-control" name="department">
                                            <option value="{{ $employees[0]->department }}" selected>
                                                {{ $employees[0]->department }} </option>
                                            @foreach ($departments as $department)

                                                <option value="{{ $department->department }}">
                                                    {{ $department->department }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Payment Method</label>
                                    <div class="col-md-10">
                                        <select class="select form-control" id="payment_method" name="payment_method">
                                            <option value="{{ $employees[0]->payment_method }}" selected>
                                                {{ $employees[0]->payment_method }} </option>
                                            @if ($employees[0]->payment_method == 'Hourly')
                                                <option value="Parttime">Parttime</option>
                                                <option value="Fulltime">Fulltime</option>
                                            @elseif ($employees[0]->payment_method == 'Parttime')
                                                <option value="Hourly">Hourly</option>
                                                <option value="Fulltime">Fulltime</option>
                                            @else
                                                <option value="Hourly">Hourly</option>
                                                <option value="Parttime">Parttime</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="form-group wday-box">
                                        <label class="checkbox-inline"><input type="checkbox" name="monday" value="Y"
                                                {{ $employees[0]->monday == 'Y' ? 'checked' : '' }}><span
                                                class="checkmark">M</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="tuesday" value="Y"
                                                {{ $employees[0]->tuesday == 'Y' ? 'checked' : '' }}><span
                                                class="checkmark">T</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="wednesday" value="Y"
                                                {{ $employees[0]->wednesday == 'Y' ? 'checked' : '' }}><span
                                                class="checkmark">W</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="thursday" value="Y"
                                                {{ $employees[0]->thursday == 'Y' ? 'checked' : '' }}><span
                                                class="checkmark">T</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="friday" value="Y"
                                                {{ $employees[0]->friday == 'Y' ? 'checked' : '' }}><span
                                                class="checkmark">F</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="saturday" value="Y"
                                                {{ $employees[0]->saturday == 'Y' ? 'checked' : '' }}><span
                                                class="checkmark">S</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="sunday" value="Y"
                                                {{ $employees[0]->sunday == 'Y' ? 'checked' : '' }}><span
                                                class="checkmark">S</span></label>
                                    </div>
                                </div>


                                <div class="row">
                                    <label class="col-form-label col-md-2">Possible Working Hours</label>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group time timepicker">
                                                <input class="form-control" type="text" name="time_start"
                                                    value="{{ $employees[0]->time_start }}"><span
                                                    class="input-group-append input-group-addon"><span
                                                        class="input-group-text"><i
                                                            class="fa fa-clock-o"></i></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group time timepicker">
                                                <input class="form-control" type="text" name="time_end"
                                                    value="{{ $employees[0]->time_end }}"><span
                                                    class="input-group-append input-group-addon"><span
                                                        class="input-group-text"><i
                                                            class="fa fa-clock-o"></i></span></span>
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

                                <div class="form-group row">
                                    <div class="form-group wday-box">
                                        <label class="checkbox-inline"><input type="checkbox" name="monday_opt" value="Y"
                                                {{ $employees[0]->monday_opt == 'Y' ? 'checked' : '' }}><span
                                                class="checkmark">M</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="tuesday_opt" value="Y"
                                                {{ $employees[0]->tuesday_opt == 'Y' ? 'checked' : '' }}><span
                                                class="checkmark">T</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="wednesday_opt" value="Y"
                                                {{ $employees[0]->wednesday_opt == 'Y' ? 'checked' : '' }}><span
                                                class="checkmark">W</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="thursday_opt" value="Y"
                                                {{ $employees[0]->thursday_opt == 'Y' ? 'checked' : '' }}><span
                                                class="checkmark">T</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="friday_opt" value="Y"
                                                {{ $employees[0]->friday_opt == 'Y' ? 'checked' : '' }}><span
                                                class="checkmark">F</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="saturday_opt" value="Y"
                                                {{ $employees[0]->saturday_opt == 'Y' ? 'checked' : '' }}><span
                                                class="checkmark">S</span></label>

                                        <label class="checkbox-inline"><input type="checkbox" name="sunday_opt" value="Y"
                                                {{ $employees[0]->sunday_opt == 'Y' ? 'checked' : '' }}><span
                                                class="checkmark">S</span></label>
                                    </div>
                                </div>


                                <div class="row">
                                    <label class="col-form-label col-md-2">Possible Working Hours</label>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group time timepicker">
                                                <input class="form-control" type="text" name="time_start_opt"
                                                    value="{{ $employees[0]->time_start_opt }}"><span
                                                    class="input-group-append input-group-addon"><span
                                                        class="input-group-text"><i
                                                            class="fa fa-clock-o"></i></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group time timepicker">
                                                <input class="form-control" type="text" name="time_end_opt"
                                                    value="{{ $employees[0]->time_end_opt }}"><span
                                                    class="input-group-append input-group-addon"><span
                                                        class="input-group-text"><i
                                                            class="fa fa-clock-o"></i></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-form-label col-md-2">Employee Permission</label>
                                    <div class="col-md-10">
                                        <div class="table-responsive m-t-15">
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

                                                    @foreach ($permission as $items)
                                                        <tr>
                                                            <td>{{ $items->module_permission }}</td>
                                                            <input type="hidden" name="permission[]"
                                                                value="{{ $items->module_permission }}">
                                                            <input type="hidden" name="id_permission[]"
                                                                value="{{ $items->id }}">
                                                            <td class="text-center">
                                                                <input type="checkbox" class="read{{ ++$key }}"
                                                                    id="read" name="read[]" value="Y"
                                                                    {{ $items->read == 'Y' ? 'checked' : '' }}>
                                                                <input type="checkbox" class="read{{ ++$key1 }}"
                                                                    id="read" name="read[]" value="N"
                                                                    {{ $items->read == 'N' ? 'checked' : '' }}>
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="checkbox" class="write{{ ++$key }}"
                                                                    id="write" name="write[]" value="Y"
                                                                    {{ $items->write == 'Y' ? 'checked' : '' }}>
                                                                <input type="checkbox" class="write{{ ++$key1 }}"
                                                                    id="write" name="write[]" value="N"
                                                                    {{ $items->write == 'N' ? 'checked' : '' }}>
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="checkbox" class="create{{ ++$key }}"
                                                                    id="create" name="create[]" value="Y"
                                                                    {{ $items->create == 'Y' ? 'checked' : '' }}>
                                                                <input type="checkbox" class="create{{ ++$key1 }}"
                                                                    id="create" name="create[]" value="N"
                                                                    {{ $items->create == 'N' ? 'checked' : '' }}>
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="checkbox" class="delete{{ ++$key }}"
                                                                    id="delete" name="delete[]" value="Y"
                                                                    {{ $items->delete == 'Y' ? 'checked' : '' }}>
                                                                <input type="checkbox" class="delete{{ ++$key1 }}"
                                                                    id="delete" name="delete[]" value="N"
                                                                    {{ $items->delete == 'N' ? 'checked' : '' }}>
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="checkbox" class="import{{ ++$key }}"
                                                                    id="import" name="import[]" value="Y"
                                                                    {{ $items->import == 'Y' ? 'checked' : '' }}>
                                                                <input type="checkbox" class="import{{ ++$key1 }}"
                                                                    id="import" name="import[]" value="N"
                                                                    {{ $items->import == 'N' ? 'checked' : '' }}>
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="checkbox" class="export{{ ++$key }}"
                                                                    id="export" name="export[]" value="Y"
                                                                    {{ $items->export == 'Y' ? 'checked' : '' }}>
                                                                <input type="checkbox" class="export{{ ++$key1 }}"
                                                                    id="export" name="export[]" value="N"
                                                                    {{ $items->export == 'N' ? 'checked' : '' }}>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2"></label>
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

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

@endsection

@endsection
