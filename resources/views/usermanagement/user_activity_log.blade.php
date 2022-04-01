@extends('layouts.master')
{{-- @section('menu')
@extends('sidebar.dashboard')
@endsection --}}
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">User Activity Log</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User Activity Log</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- /Search Filter -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Status</th>
                                    <th>Role Name</th>
                                    <th>Modify</th>
                                    <th>Date Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activityLogAdmin as $key => $aAdmin)
                                    <tr>
                                        <td>{{ $aAdmin->user_name }}</td>
                                        <td>{{ $aAdmin->email }}</td>
                                        <td>{{ $aAdmin->phone_number }}</td>
                                        <td>{{ $aAdmin->status }}</td>
                                        <td>{{ $aAdmin->role_name }}</td>
                                        <td>{{ $aAdmin->modify_user }}</td>
                                        <td>{{ $aAdmin->date_time }}</td>
                                    </tr>
                                @endforeach
                                @foreach ($activityLog as $key => $item)
                                    <tr>
                                        @if (isset($item->lastname))
                                            <td>{{ $item->user_name . ' ' . $item->lastname }}</td>
                                        @else
                                            <td>{{ $item->user_name }}</td>
                                        @endif
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone_number }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->role_name }}</td>
                                        <td>{{ $item->modify_user }}</td>
                                        <td>{{ $item->date_time }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
@endsection
