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
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee Salary <span id="year"></span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Salary</li>
                        </ul>
                    </div>
                    {{-- <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_salary"><i
                                class="fa fa-plus"></i> Add Salary</a>
                    </div> --}}
                </div>
            </div>

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Employee Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option value=""> -- Select -- </option>
                            <option value="">Employee</option>
                            <option value="1">Manager</option>
                        </select>
                        <label class="focus-label">Role</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option> -- Select -- </option>
                            <option> Fulltime </option>
                            <option> Partime </option>
                            <option> Hourly </option>
                        </select>
                        <label class="focus-label">Payment Method</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <input class="form-control floating datetimepicker" type="text">
                        </div>
                        <label class="focus-label">From</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <input class="form-control floating datetimepicker" type="text">
                        </div>
                        <label class="focus-label">To</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <a href="#" class="btn btn-success btn-block"> Search </a>
                </div>
            </div>
            <!-- /Search Filter -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Employee ID</th>
                                    <th>Email</th>
                                    <th>Payment Method</th>
                                    <th>Role</th>
                                    <th>Salary</th>
                                    <th>Payslip</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $items)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('employee/profile/' . $items->rec_id) }}"
                                                    class="avatar"><img alt=""
                                                        src="{{ URL::to('/assets/images/' . $items->avatar) }}"></a>
                                                <a
                                                    href="{{ url('employee/profile/' . $items->rec_id) }}">{{ $items->name }}<span>{{ $items->position }}</span></a>
                                            </h2>
                                        </td>
                                        <td>{{ $items->rec_id }}</td>
                                        <td hidden class="id">{{ $items->id }}</td>
                                        <td hidden class="name">{{ $items->name }}</td>
                                        <td hidden class="salary_amount">{{ $items->salary_amount }}</td>
                                        <td hidden class="hourly_salary">{{ $items->hourly_salary }}</td>
                                        <td hidden class="night_sunday_bon">{{ $items->night_sunday_bon }}</td>
                                        <td hidden class="holiday_bon">{{ $items->holiday_bon }}</td>
                                        <td hidden class="timesupplement_night_sunday">
                                            {{ $items->timesupplement_night_sunday }}</td>
                                        <td hidden class="monthly_surcharge">{{ $items->monthly_surcharge }}</td>
                                        <td hidden class="pension_insurance">{{ $items->pension_insurance }}</td>
                                        <td hidden class="unemployment_insurance">{{ $items->unemployment_insurance }}
                                        </td>
                                        <td hidden class="accident_insurance">{{ $items->accident_insurance }}</td>
                                        <td hidden class="uvg_grb">{{ $items->uvg_grb }}</td>
                                        <td hidden class="pension_fund">{{ $items->pension_fund }}</td>
                                        <td hidden class="medical_insurance">{{ $items->medical_insurance }}</td>
                                        <td hidden class="collective_labor">{{ $items->collective_labor }}</td>
                                        <td hidden class="expenses">{{ $items->expenses }}</td>
                                        <td hidden class="telephone_shipment">{{ $items->telephone_shipment }}</td>
                                        <td hidden class="mileage_compensation">{{ $items->mileage_compensation }}</td>

                                        <td>{{ $items->email }}</td>
                                        <td>{{ $items->payment_method }}</td>
                                        <td>{{ $items->role_name }}</td>
                                        <td>${{ $items->salary }}</td>
                                        <td hidden class="salary">{{ $items->salary }}</td>
                                        <td><a class="btn btn-sm btn-primary"
                                                href="{{ url('form/salary/view/' . $items->rec_id) }}">Generate
                                                Slip</a>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item userSalary" href="#" data-toggle="modal"
                                                        data-target="#edit_salary"><i class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item salaryDelete" href="#" data-toggle="modal"
                                                        data-target="#delete_salary"><i class="fa fa-trash-o m-r-5"></i>
                                                        Delete</a>
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

        <!-- Add Salary Modal -->
        {{-- <div id="add_salary" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Staff Salary</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/salary/save') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select Staff</label>
                                        <select
                                            class="select select2s-hidden-accessible @error('name') is-invalid @enderror"
                                            style="width: 100%;" tabindex="-1" aria-hidden="true" id="name" name="name">
                                            <option value="">-- Select --</option>
                                            @foreach ($userList as $key => $user)
                                                <option value="{{ $user->name }}" data-employee_id={{ $user->rec_id }}
                                                    data-payment_method={{ $user->payment_method }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input class="form-control" type="hidden" name="rec_id" id="employee_id" readonly>

                            </div>
                            <div class="pm-fulltime" style="display: none;">
                                <div class="row">
                                    <h4 class="text-primary col-12">Earnings</h4>
                                    <div class="form-group col-6">
                                        <label>Base Wage</label>
                                        <input class="form-control @error('salary_amount') is-invalid @enderror" type="number"
                                            name="salary_amount" id="salary_amount" value="{{ old('salary_amount') }}"
                                            placeholder="Enter Monatslohn">
                                        @error('salary_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Monthly Surcharge</label>
                                        <input class="form-control @error('da') is-invalid @enderror" type="number"
                                            name="da" id="da" value="{{ old('da') }}"
                                            placeholder="Enter FSB Zuschlag mtl">
                                        @error('da')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>13th Month Salary </label>
                                        <input class="form-control @error('hra') is-invalid @enderror" type="number"
                                            name="hra" id="hra" value="{{ old('hra') }}"
                                            placeholder="13. Monatslohn (Auto Calculated)">
                                        @error('hra')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Brutto Wage</label>
                                    <input style="border: 1px solid #55CE63;"
                                        class="form-control @error('conveyance') is-invalid @enderror" type="number"
                                        name="conveyance" id="conveyance" value="{{ old('conveyance') }}"
                                        placeholder="Bruttolohn (Auto Calculated)">
                                    @error('conveyance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="row">
                                    <h4 class="text-primary col-12">Deductions</h4>
                                    <div class="form-group col-6">
                                        <label>Pension Insurance</label>
                                        <input class="form-control @error('medical_allowance') is-invalid @enderror"
                                            type="number" name="medical_allowance" id="medical_allowance"
                                            value="{{ old('medical_allowance') }}" placeholder="Enter AHV Abzug">
                                        @error('medical_allowance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Unemployment Insurance</label>
                                        <input class="form-control @error('tds') is-invalid @enderror" type="number"
                                            name="tds" id="tds" value="{{ old('tds') }}" placeholder="ALV Abzug">
                                        @error('tds')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Accident Insurance </label>
                                        <input class="form-control @error('esi') is-invalid @enderror" type="number"
                                            name="esi" id="esi" value="{{ old('esi') }}" placeholder="NBU Abzug">
                                        @error('esi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>UVG Erganzung Grob...</label>
                                        <input class="form-control @error('labour_welfare') is-invalid @enderror"
                                            type="number" name="labour_welfare" id="labour_welfare"
                                            value="{{ old('labour_welfare') }}"
                                            placeholder="UVG Erganzung Grobfahrlassigkeit">
                                        @error('labour_welfare')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Pension Fund Insurance</label>
                                        <input class="form-control @error('pf') is-invalid @enderror" type="number"
                                            name="pf" id="pf" value="{{ old('pf') }}" placeholder="Pensionkasse Abzug">
                                        @error('pf')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Medical Insurance</label>
                                        <input class="form-control @error('leave') is-invalid @enderror" type="text"
                                            name="leave" id="leave" value="{{ old('leave') }}"
                                            placeholder="Krankentaggeld">
                                        @error('leave')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Collective Labor Agreement</label>
                                        <input class="form-control @error('prof_tax') is-invalid @enderror" type="number"
                                            name="prof_tax" id="prof_tax" value="{{ old('prof_tax') }}"
                                            placeholder="GAV Abzug">
                                        @error('prof_tax')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Total Deductons</label>
                                        <input class="form-control @error('labour_welfare') is-invalid @enderror"
                                            type="number" name="labour_welfare" id="labour_welfare"
                                            value="{{ old('labour_welfare') }}"
                                            placeholder="Total Abzüge (Auto Calculated)">
                                        @error('labour_welfare')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Netto Wage </label>
                                    <input class="form-control @error('medical_allowance') is-invalid @enderror"
                                        type="number" name="medical_allowance" id="medical_allowance"
                                        value="{{ old('medical_allowance') }}" placeholder="Nettolohn (Auto Calculated)"
                                        style="border: 1px solid #55CE63;">
                                    @error('medical_allowance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <h4 class="text-primary col-12">Other Expenses</h4>
                                    <div class="form-group col-6">
                                        <label>Expenses</label>
                                        <input class="form-control @error('conveyance') is-invalid @enderror"
                                            type="number" name="conveyance" id="conveyance"
                                            value="{{ old('conveyance') }}" placeholder="Enter Spesen">
                                        @error('conveyance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Telephone and Shipment</label>
                                        <input class="form-control @error('allowance') is-invalid @enderror" type="number"
                                            name="allowance" id="allowance" value="{{ old('allowance') }}"
                                            placeholder="Telefon und Versandspesen">
                                        @error('allowance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Mileage Compensation</label>
                                        <input class="form-control @error('medical_allowance') is-invalid @enderror"
                                            type="number" name="medical_allowance" id="medical_allowance"
                                            value="{{ old('medical_allowance') }}"
                                            placeholder="Enter Kilometerentschadingung">
                                        @error('medical_allowance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Total Expenses </label>
                                        <input class="form-control @error('medical_allowance') is-invalid @enderror"
                                            type="number" name="medical_allowance" id="medical_allowance"
                                            value="{{ old('medical_allowance') }}"
                                            placeholder="Totalspesen (Auto Calculated)">
                                        @error('medical_allowance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Total Payout </label>
                                    <input class="form-control @error('medical_allowance') is-invalid @enderror"
                                        type="number" name="medical_allowance" id="medical_allowance"
                                        value="{{ old('medical_allowance') }}"
                                        placeholder="Total Auszahlung (Auto Calculated)" style="border: 1px solid #55CE63;">
                                    @error('medical_allowance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    </div>

                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- /Add Salary Modal -->

    <!-- Edit Salary Modal -->
    <div id="edit_salary" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Staff Salary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('form/salary/update') }}" method="POST">
                        @csrf
                        <input class="form-control" type="hidden" name="id" id="e_id" value="" readonly>
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name Staff</label>
                                    <input class="form-control " type="text" name="name" id="e_name" value="" readonly>
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label>Net Salary</label>
                                <input class="form-control" type="text" name="salary" id="e_salary" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="text-primary">Earnings</h4>
                                <div class="form-group">
                                    <label>Basic</label>
                                    <input class="form-control" type="text" name="salary_amount" id="e_salary_amount"
                                        value="">
                                </div>
                                <div class="form-group">
                                    <label>DA(40%)</label>
                                    <input class="form-control" type="text" name="da" id="e_da" value="">
                                </div>
                                <div class="form-group">
                                    <label>HRA(15%)</label>
                                    <input class="form-control" type="text" name="hra" id="e_hra" value="">
                                </div>
                                <div class="form-group">
                                    <label>Conveyance</label>
                                    <input class="form-control" type="text" name="conveyance" id="e_conveyance" value="">
                                </div>
                                <div class="form-group">
                                    <label>Allowance</label>
                                    <input class="form-control" type="text" name="allowance" id="e_allowance" value="">
                                </div>
                                <div class="form-group">
                                    <label>Medical Allowance</label>
                                    <input class="form-control" type="text" name="medical_allowance"
                                        id="e_medical_allowance" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="text-primary">Deductions</h4>
                                <div class="form-group">
                                    <label>TDS</label>
                                    <input class="form-control" type="text" name="tds" id="e_tds" value="">
                                </div>
                                <div class="form-group">
                                    <label>ESI</label>
                                    <input class="form-control" type="text" name="esi" id="e_esi" value="">
                                </div>
                                <div class="form-group">
                                    <label>PF</label>
                                    <input class="form-control" type="text" name="pf" id="e_pf" value="">
                                </div>
                                <div class="form-group">
                                    <label>Leave</label>
                                    <input class="form-control" type="text" name="leave" id="e_leave" value="">
                                </div>
                                <div class="form-group">
                                    <label>Prof. Tax</label>
                                    <input class="form-control" type="text" name="prof_tax" id="e_prof_tax" value="">
                                </div>
                                <div class="form-group">
                                    <label>Loan</label>
                                    <input class="form-control" type="text" name="labour_welfare" id="e_labour_welfare"
                                        value="">
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Salary Modal -->

    <!-- Delete Salary Modal -->
    <div class="modal custom-modal fade" id="delete_salary" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Salary</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="{{ route('form/salary/delete') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <input type="hidden" name="id" class="e_id" value="">
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
    <!-- /Delete Salary Modal -->

    </div>
    <!-- /Page Wrapper -->
@section('script')
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
            if ($(this).find(':selected').data('payment_method') == "Fulltime") {
                $('.pm-fulltime').css('display', 'block');
            } else if ($(this).find(':selected').data('payment_method') == "Parttime") {
                $('.pm-parttime').css('display', 'block');
            } else {
                $('.pm-hourly').css('display', 'block');
            }
        });
    </script>
    {{-- update js --}}
    <script>
        $(document).on('click', '.userSalary', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_name').val(_this.find('.name').text());
            $('#e_salary').val(_this.find('.salary').text());
            $('#e_salary_amount').val(_this.find('.salary_amount').text());
            $('#e_da').val(_this.find('.da').text());
            $('#e_hra').val(_this.find('.hra').text());
            $('#e_conveyance').val(_this.find('.conveyance').text());
            $('#e_allowance').val(_this.find('.allowance').text());
            $('#e_medical_allowance').val(_this.find('.medical_allowance').text());
            $('#e_tds').val(_this.find('.tds').text());
            $('#e_esi').val(_this.find('.esi').text());
            $('#e_pf').val(_this.find('.pf').text());
            $('#e_leave').val(_this.find('.leave').text());
            $('#e_prof_tax').val(_this.find('.prof_tax').text());
            $('#e_labour_welfare').val(_this.find('.labour_welfare').text());
        });
    </script>
    {{-- delete js --}}
    <script>
        $(document).on('click', '.salaryDelete', function() {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
@endsection
@endsection
