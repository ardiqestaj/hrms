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
                        <h3 class="page-title">Report Incident</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Report Incident</li>

                        </ul>
                    </div>
                </div>
            </div>

            <!-- /Page Header -->
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row align-center ">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Previous Reports </h4>

                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table table-striped custom-table datatable">
                                    <thead>
                                        <tr>
                                            <th>Location</th>
                                            <th>Employee</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Description</th>
                                            <th class="text-right no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($reports))
                                            @foreach ($reports as $report)
                                                <tr>
                                                    <td>
                                                        {{ $report->location_name }}
                                                    </td>
                                                    <td>
                                                        {{ $report->location_name }}
                                                    </td>
                                                    <td>{{ $report->rep_date }}</td>
                                                    <td>{{ $report->rep_time }}</td>

                                                    <td class="d-inline-block text-truncate" style="max-width: 150px;">{{ $report->rep_description }}</td>
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href=""><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                <a class="dropdown-item" href="" onclick="return confirm('Are you sure to want to delete it?')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
@section('script')
@endsection
@endsection
