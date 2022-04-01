@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Configure Payment Methods</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Salary</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <!-- /Page Header -->


            <div class="card m-0" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item"><a href="#fulltime" data-toggle="tab"
                                    class="nav-link active">Fulltime</a></li>
                            <li class="nav-item"><a href="#parttime" data-toggle="tab"
                                    class="nav-link">Parttime</a></li>
                            <li class="nav-item"><a href="#hourly" data-toggle="tab" class="nav-link">Hourly
                                    <small class="text-danger">
                                    </small></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <!-- Fulltime Tab -->
                <div class="tab-pane fade show active" id="fulltime">
                    <div class="card" style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                        <div class="card-body">
                            <h3 class="card-title">Fulltime: Earnings Information</h3>
                            <form action="{{ route('form/salary/fulltime') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4" hidden>
                                        <div class="form-group">
                                            <label>Gender <span class="text-danger">*</span></label>
                                            <select class="select form-control" name="payment_type" style="width: 100%;"
                                                tabindex="-1" aria-hidden="true" id="gender" name="gender" required>
                                                <option value="Fulltime" selected>Fulltime</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Salary amount <small class="text-muted">per
                                                    month
                                                </small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" name="salary_amount"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $fulltimeConfig->salary_amount }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Monthly Surcharge <small class="text-muted">
                                                    FSB Zussschlag mtl</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" name="monthly_surcharge"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $fulltimeConfig->monthly_surcharge }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">13'nth Salary <small class="text-muted">
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
                                            <label class="col-form-label">Brutto Salary <small class="text-muted">
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
                                            <label class="col-form-label">Pension Insurance <small class="text-muted">
                                                    AHV Abzug</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" name="pension_insurance"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $fulltimeConfig->pension_insurance }}">
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
                                                <input type="text" class="form-control" name="unemployment_insurance"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $fulltimeConfig->unemployment_insurance }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Accident Insurance <small class="text-muted">
                                                    NBU Abzug</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" name="accident_insurance"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $fulltimeConfig->accident_insurance }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">UVG Erganzung Grobfahrlassigkeit
                                                <small class="text-muted">
                                                    UVG</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" name="uvg_grb"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $fulltimeConfig->uvg_grb }}">
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
                                                <input type="text" class="form-control" name="pension_fund"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $fulltimeConfig->pension_fund }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Medical Insurance<small class="text-muted">
                                                    Krankentaggeld</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" name="medical_insurance"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $fulltimeConfig->medical_insurance }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Collective Labor Agreement<small
                                                    class="text-muted">
                                                    GAV Abzug</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" name="collective_labor"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $fulltimeConfig->collective_labor }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Total Deductons <small class="text-muted">
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
                                            <label class="col-form-label">Netto Salary <small class="text-muted">
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
                                            <label class="col-form-label">Expenses <small class="text-muted">
                                                    Spesen</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" name="expenses"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $fulltimeConfig->expenses }}">
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
                                                <input type="text" class="form-control" name="telephone_shipment"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $fulltimeConfig->telephone_shipment }}">
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
                                                <input type="text" class="form-control" name="mileage_compensation"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $fulltimeConfig->mileage_compensation }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Total Expenses <small class="text-muted">
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
                                            <label class="col-form-label">Total Payout <small class="text-muted">
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

                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Fulltime Tab -->

                <!-- Parttime Tab -->
                <div class="tab-pane fade" id="parttime">
                    <div class="card" style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                        <div class="card-body">
                            <h3 class="card-title">Parttime: Earnings Information</h3>
                            <form action="{{ route('form/salary/parttime') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4" hidden>
                                        <div class="form-group">
                                            <label>Gender <span class="text-danger">*</span></label>
                                            <select class="select form-control" name="payment_type" style="width: 100%;"
                                                tabindex="-1" aria-hidden="true" id="gender" name="gender" required>
                                                <option value="Parttime" selected>Parttime</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Salary amount <small class="text-muted">per
                                                    month
                                                </small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" name="salary_amount"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $parttimeConfig->salary_amount }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Monthly Surcharge <small class="text-muted">
                                                    FSB Zussschlag mtl</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" name="monthly_surcharge"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $parttimeConfig->monthly_surcharge }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">13'nth Salary <small class="text-muted">
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
                                            <label class="col-form-label">Brutto Salary <small class="text-muted">
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
                                            <label class="col-form-label">Pension Insurance <small class="text-muted">
                                                    AHV Abzug</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" name="pension_insurance"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $parttimeConfig->pension_insurance }}">
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
                                                <input type="text" class="form-control" name="unemployment_insurance"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $parttimeConfig->unemployment_insurance }}">
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
                                                <input type="text" class="form-control" name="accident_insurance"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $parttimeConfig->accident_insurance }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">UVG Erganzung Grobfahrlassigkeit
                                                <small class="text-muted">
                                                    UVG</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" name="uvg_grb"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $parttimeConfig->uvg_grb }}">
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
                                                <input type="text" class="form-control" name="pension_fund"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $parttimeConfig->pension_fund }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Medical Insurance<small class="text-muted">
                                                    Krankentaggeld</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" name="medical_insurance"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $parttimeConfig->medical_insurance }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Collective Labor Agreement<small
                                                    class="text-muted">
                                                    GAV Abzug</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" name="collective_labor"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $parttimeConfig->collective_labor }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Total Deductons <small class="text-muted">
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
                                            <label class="col-form-label">Netto Salary <small class="text-muted">
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
                                            <label class="col-form-label">Expenses <small class="text-muted">
                                                    Spesen</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" name="expenses"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $parttimeConfig->expenses }}">
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
                                                <input type="text" class="form-control" name="telephone_shipment"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $parttimeConfig->telephone_shipment }}">
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
                                                <input type="text" class="form-control" name="mileage_compensation"
                                                    placeholder="Type your salary amount"
                                                    value="{{ $parttimeConfig->mileage_compensation }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Total Expenses <small class="text-muted">
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
                                            <label class="col-form-label">Total Payout <small class="text-muted">
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

                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Parttime Tab -->

                <!-- Hourly Tab -->
                <div class="tab-pane fade show" id="hourly">
                    <div class="card" style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                        <div class="card-body">
                            <h3 class="card-title">Hourly: Earnings Information</h3>
                            <form action="{{ route('form/salary/hourly') }}" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-sm-4" hidden>
                                        <div class="form-group">
                                            <label>Type of Work <span class="text-danger">*</span></label>
                                            <select class="select form-control" name="payment_type" style="width: 100%;"
                                                tabindex="-1" aria-hidden="true" id="gender" name="payment_type" required>
                                                <option value="Hourly" selected>Houly</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Hourly Salary<small class="text-muted">
                                                    Stundenlohn
                                                </small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="00.00"
                                                    name="hourly_salary" value="{{ $hourlyConfig->hourly_salary }}">
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
                                                <input type="text" class="form-control" placeholder="00.00"
                                                    name="night_sunday_bon"
                                                    value="{{ $hourlyConfig->night_sunday_bon }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Holiday Bonus <small class="text-muted">
                                                    Ferienentschadigung</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="00.00"
                                                    name="holiday_bon" value="{{ $hourlyConfig->holiday_bon }}">
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
                                                <input type="text" class="form-control" placeholder="00.00"
                                                    name="holiday_bon_minus" value="{{ $hourlyConfig->holiday_bon }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Timesupplement Night/Sunday<small
                                                    class="text-muted">
                                                    Zeitzuschlag Nacht/Sonntag</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="00.00"
                                                    name="timesupplement_night_sunday"
                                                    value="{{ $hourlyConfig->timesupplement_night_sunday }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Monthly Surcharge <small class="text-muted">
                                                    FSB Zussschlag mtl</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" disabled placeholder="00.00"
                                                    name="monthly_surcharge"
                                                    value="{{ $hourlyConfig->monthly_surcharge }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">13'nth Salary <small class="text-muted">
                                                    13. Monatslohn (Autocalculated)</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" disabled placeholder="00.00"
                                                    value="{{ $hourlyConfig->holiday_bon_minus }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Brutto Salary <small class="text-muted">
                                                    Bruttolohn (Autocalculated)</small></label>
                                            <div class="input-group"
                                                style="border: 1px solid green; border-radius: 5px;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="00.00" value="0.00">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <h3 class="card-title"> Deductions Information</h3>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Pension Insurance <small class="text-muted">
                                                    AHV Abzug</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" name="pension_insurance"
                                                    placeholder="00.00" value="{{ $hourlyConfig->pension_insurance }}">
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
                                                <input type="text" class="form-control" placeholder="00.00"
                                                    name="unemployment_insurance"
                                                    value="{{ $hourlyConfig->unemployment_insurance }}">
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
                                                <input type="text" class="form-control" placeholder="00.00"
                                                    name="accident_insurance"
                                                    value="{{ $hourlyConfig->accident_insurance }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">UVG Erganzung Grobfahrlassigkeit <small
                                                    class="text-muted">
                                                    UVG</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" name="uvg_grb"
                                                    placeholder="00.00" value="{{ $hourlyConfig->uvg_grb }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Pension Fund<small class="text-muted">
                                                    Pensionkasse Abzug</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" name="pension_fund" disabled
                                                    placeholder="00.00" value="{{ $hourlyConfig->pension_fund }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Medical Insurance<small class="text-muted">
                                                    Krankentaggeld</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" name="medical_insurance"
                                                    placeholder="00.00" value="{{ $hourlyConfig->medical_insurance }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Collective Labor Agreement<small
                                                    class="text-muted">
                                                    GAV Abzug</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" name="collective_labor"
                                                    placeholder="00.00" value="{{ $hourlyConfig->collective_labor }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Total Deductons <small class="text-muted">
                                                    Total Abzuge (autocalculated)</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="00.00" value="0.00">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Netto Salary <small class="text-muted">
                                                    Nettolohn (autocalculated)</small></label>
                                            <div class="input-group"
                                                style="border: 1px solid green; border-radius: 5px;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="00.00" value="0.00">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h3 class="card-title">Other Expenses</h3>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Expenses <small class="text-muted">
                                                    Spesen</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" name="expenses" disabled
                                                    placeholder="00.00" value="{{ $hourlyConfig->expenses }}">
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
                                                <input type="text" class="form-control" name="telephone_shipment"
                                                    placeholder="00.00" value="{{ $hourlyConfig->telephone_shipment }}">
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
                                                <input type="text" class="form-control" name="mileage_compensation"
                                                    placeholder="00.00"
                                                    value="{{ $hourlyConfig->mileage_compensation }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Total Expenses <small class="text-muted">
                                                    Totalspesen (autocalculated)</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="00.00" value="0.00">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Total Payout <small class="text-muted">
                                                    Total Auszahlung (autocalculated)</small></label>
                                            <div class="input-group"
                                                style="border: 1px solid green; border-radius: 5px;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">CHF</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="00.00" value="0.00">
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Hourly Tab -->
            </div>
        </div>
        <!-- /Page Content -->

        <!-- /Experience Modal -->


        <!-- /Page Content -->
    </div>
@endsection
