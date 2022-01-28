@extends('layouts.master')
@section('content')
    
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Change Password</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    <form method="POST" action="{{ route('change/password/db') }}">
                        @csrf
                        <div class="form-group">
                            <label>Old password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror " name="current_password" value="{{ old('current_password') }}" placeholder="Enter Old Password">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror
                        </div>
                        <div class="form-group">
                            <label>New password</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="Enter Current Password">
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm password</label>
                            <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" placeholder="Choose Confirm Password">
                            @error('new_confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
@endsection