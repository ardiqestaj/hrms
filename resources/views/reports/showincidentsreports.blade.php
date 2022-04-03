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
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-8 align-self-center">
                                    <h4 class="card-text">
                                        <div class="row ">
                                            <div class="col-4"> <strong> Location: </strong></div>


                                            <div class="col-8"> <span class=" text-muted">{{ $reports->location_name }}</span></div>
                                        </div>
                                    </h4>

                                    <h4 class="card-text">
                                        <div class="row ">
                                            <div class="col-4"> <strong> Employee Fullname: </strong></div>


                                            <div class="col-8"> <span class=" text-muted">{{ $reports->name . ' ' . $reports->lastname }}</span></div>
                                        </div>
                                    </h4>

                                    <h4 class="card-text">
                                        <div class="row">
                                            <div class="col-4"> <strong> Date and Time: </strong></div>

                                            <div class="col-8"> <span class="text-muted">{{ $reports->rep_date }}, {{ $reports->rep_time }}</span></div>

                                        </div>
                                    </h4>
                                    <h4 class="card-text">
                                        <div class="row">
                                            <div class="col-4"> <strong>Incident Description: </strong></div>
                                            <div class="col-8 text-muted"> {{ $reports->rep_description }}</div>

                                        </div>
                                    </h4>
                                </div>

                                <div class="col-12 col-md-4 mt-3">
                                    @if ($reports->rep_image !== null)
                                        <h4 class="card-text"><strong>Provided Incident Image</strong></h4>

                                        <img class="img-fluid" width="200px" src="{{ URL::to('/assets/images/posts/' . $reports->rep_image) }}" alt="Incident Image">
                                    @else
                                        <h4 class="card-text"><strong>No Incident Image Provided</strong></h4>
                                    @endif

                                </div>
                            </div>
                            {{-- <a href="{{ url('posts/show/' . $posts->id) }}" class="btn btn-primary">Visit</a> --}}
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
