@extends('layouts.master')
@section('content')
    <!-- Page Wrapper -->

    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Company Settings</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                        {{-- message --}}
                        {!! Toastr::message() !!}
                        @if(!empty($CompanyInfo))
                        
                    <form action="{{ route('company/settings') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Company Name <span class="text-danger">*</span></label>
                                    <input class="form-control" name="company_name" type="text" value="{{$CompanyInfo->company_name}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Company Contact</label>
                                    <input type="hidden" name="id" value="{{$CompanyInfo->id}}">
                                    <input class="form-control" name="company_contact" value="{{$CompanyInfo->company_contact}}" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control " name="company_address" value="{{$CompanyInfo->company_address}}" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input class="form-control" name="company_country" value="{{$CompanyInfo->company_country}}" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" name="company_city" value="{{$CompanyInfo->company_city}}" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>State/Province</label>
                                        <input class="form-control" name="company_province" value="{{$CompanyInfo->company_province}}" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input class="form-control" name="company_postal_code" value="{{$CompanyInfo->company_postal_code}}" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="company_email" value="{{$CompanyInfo->company_email}}" type="email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control" name="company_phone_number" value="{{$CompanyInfo->company_phone_number}}" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input class="form-control" name="company_mobile_number" value="{{$CompanyInfo->company_mobile_number}}" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fax</label>
                                    <input class="form-control" name="company_fax" value="{{$CompanyInfo->company_fax}}" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Website Url</label>
                                    <input class="form-control" name="company_website" value="{{$CompanyInfo->company_website}}" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>

                    @else
                    <form action="{{ route('company/settings') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Company Name <span class="text-danger">*</span></label>
                                    <input type="hidden" name="id">
                                    <input class="form-control" type="text" name="company_name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Company Contact</label>
                                    <input class="form-control" name="company_contact"  type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" name="company_address" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input class="form-control" name="company_country"  type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" name="company_city"  type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>State/Province</label>
                                    <input class="form-control" name="company_province"  type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input class="form-control" name="company_postal_code" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="company_email" type="email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control" name="company_phone_number" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input class="form-control" name="company_mobile_number" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fax</label>
                                    <input class="form-control" name="company_fax" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Website Url</label>
                                    <input class="form-control" name="company_website" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                    @endif

                    
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
@endsection