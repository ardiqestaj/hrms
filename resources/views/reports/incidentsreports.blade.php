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
                @if (isset($userAssigned))
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Report an Incident</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('form/incident/reports/new') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" class="form-control" name="rep_employee_id" value="{{ $userAssigned->employee_id }}">

                                        <div class="form-group col-6" hidden>
                                            <label class="col-form-label">Location ID</label>

                                            <input type="text" class="form-control" name="rep_location_id" value="{{ $userAssigned->location_type_work_id }}">

                                        </div>

                                        <div class="form-group col-6 ">
                                            <label class="col-form-label">Incident Date</label>

                                            <input type="text" class="form-control datetimepicker" required name="rep_date" value="">

                                        </div>

                                        <div class="form-group col-6 ">
                                            <label class="col-form-label">Incident Time</label>

                                            <input type="time" class="form-control" required name="rep_time" value="">
                                        </div>


                                        <div class="form-group col-12">
                                            <label class="col-form-label">Describe What Happened</label>

                                            <textarea name="rep_description" id="" class="form-control" rows="3" required></textarea>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="description" class="form-label">Provide Image</label>
                                            <input value="" type="file" class="form-control" name="image" placeholder="image">
                                        </div>

                                        <div class="form-group col-12 text-center">
                                            <label class="col-form-label"></label>

                                            <button type="submit" class="btn btn-primary submit-btn">Report</button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6">
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
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Description</th>
                                                {{-- <th class="text-right no-sort">Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($reports))
                                                @foreach ($reports as $report)
                                                    <tr class='clickable-row' data-href='{{ url('form/incident/report/show/' . $report->id) }}' style="cursor: pointer;">
                                                        <td>
                                                            {{ $report->location_name }}
                                                        </td>
                                                        <td>{{ $report->rep_date }}</td>
                                                        <td>{{ $report->rep_time }}</td>

                                                        <td class="d-inline-block text-truncate" style="max-width: 150px;">{{ $report->rep_description }}</td>
                                                        {{-- <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href=""><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                <a class="dropdown-item" href="" onclick="return confirm('Are you sure to want to delete it?')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </td> --}}
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
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
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($reports))
                                                @foreach ($reports as $report)
                                                    <tr class='clickable-row' data-href='{{ url('form/incident/report/show/' . $report->id) }}' style="cursor: pointer;">
                                                        <td>
                                                            {{ $report->location_name }}
                                                        </td>
                                                        <td>{{ $report->rep_date }}</td>
                                                        <td>{{ $report->rep_time }}</td>

                                                        <td class="d-inline-block text-truncate" style="max-width: 150px;">{{ $report->rep_description }}</td>
                                                        <td>
                                                            @if (isset($report->rep_image))
                                                                <img class="img-fluid" width="30px" src="{{ URL::to('/assets/images/posts/' . $report->rep_image) }}">
                                                            @else
                                                                <span class="text-muted">No Image Provided</span>
                                                            @endif

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
                @endif

            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
@section('script')
@endsection
@endsection
