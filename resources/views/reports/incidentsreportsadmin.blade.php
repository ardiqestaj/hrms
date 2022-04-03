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
                                <table class="table custom-table datatable">
                                    <thead>
                                        <tr>
                                            <th>Location</th>
                                            <th>Employee</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Description</th>
                                            <th>Provided Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($reports))
                                            @foreach ($reports as $report)
                                                @if (!isset($report->read_at))
                                                    <tr class='clickable-row' data-href='{{ url('form/incident/report/show/' . $report->id) }}' style="cursor: pointer;">
                                                        <td>
                                                            {{ $report->location_name }}

                                                        </td>
                                                        <td>
                                                            {{ $report->name . ' ' . $report->lastname }}
                                                        </td>
                                                        <td>
                                                            {{ $report->rep_date }}
                                                        </td>
                                                        <td>
                                                            {{ $report->rep_time }}
                                                        </td>

                                                        <td>
                                                            <span class="d-inline-block text-truncate" style="max-width: 150px;">{{ $report->rep_description }}</span>

                                                        </td>

                                                        <td>
                                                            @if (isset($report->rep_image))
                                                                <img class="img-fluid" width="30px" src="{{ URL::to('/assets/images/posts/' . $report->rep_image) }}">
                                                            @else
                                                                <span class="text-muted">No Image Provided</span>
                                                            @endif

                                                        </td>

                                                    </tr>
                                                @else
                                                    <tr class='clickable-row' data-href='{{ url('form/incident/report/show/' . $report->id) }}' style="cursor: pointer; background-color: #F5F7F7">
                                                        <td>
                                                            {{ $report->location_name }}

                                                        </td>
                                                        <td>
                                                            {{ $report->name . ' ' . $report->lastname }}
                                                        </td>
                                                        <td>
                                                            {{ $report->rep_date }}
                                                        </td>
                                                        <td>
                                                            {{ $report->rep_time }}
                                                        </td>

                                                        <td>
                                                            <span class="d-inline-block text-truncate" style="max-width: 150px;">{{ $report->rep_description }}</span>
                                                        </td>

                                                        <td>
                                                            @if (isset($report->rep_image))
                                                                <img class="img-fluid" width="30px" src="{{ URL::to('/assets/images/posts/' . $report->rep_image) }}">
                                                            @else
                                                                <span class="text-muted">No Image Provided</span>
                                                            @endif

                                                        </td>

                                                    </tr>
                                                @endif
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
