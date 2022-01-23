@extends('layouts.job')
@section('content')
    <div class="main-wrapper">
        <!-- Header -->
        <div class="header">
            <!-- Logo -->
            <div class="header-left">
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ URL::to('assets/img/logo.png') }}" width="40" height="40" alt="">
                </a>
            </div>
            <!-- /Logo -->
            <!-- Header Title -->
            <div class="page-title-box float-left">
                <h3>Admin Dashboard</h3>
            </div>
            <!-- /Header Title -->
            <!-- Header Menu -->
            <ul class="nav user-menu">
                <!-- Search -->
                <li class="nav-item">
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                    </a>
                        <form action="search.html">
                            <input class="form-control" type="text" placeholder="Search here">
                            <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </li>
                <!-- /Search -->
            
                <!-- Flag -->
                <li class="nav-item dropdown has-arrow flag-nav">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                        <img src="{{ URL::to('assets/img/flags/us.png') }}" alt="" height="20"> <span>English</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{ URL::to('assets/img/flags/us.png') }}" alt="" height="16"> English
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{ URL::to('assets/img/flags/kh.png') }}" alt="" height="16"> Khmer 
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{ URL::to('assets/img/flags/fr.png') }}" alt="" height="16"> French
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{ URL::to('assets/img/flags/es.png') }}" alt="" height="16"> Spanish
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{ URL::to('assets/img/flags/de.png') }}" alt="" height="16"> German
                        </a>
                    </div>
                </li>
                <!-- /Flag -->
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            </ul>
            <!-- /Header Menu -->
            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                    <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                </div>
            </div>
            <!-- /Mobile Menu -->
        </div>
        <!-- /Header -->
        <!-- Page Wrapper -->
        <div class="page-wrapper job-wrapper">
            <!-- Page Content -->
            <div class="content container">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Jobs</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Jobs</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row">
                    <div class="col-md-6">
                        <a class="job-list" href="{{ route('form/job/view') }}">
                            <div class="job-list-det">
                                <div class="job-list-desc">
                                    <h3 class="job-list-title">Web Devloper</h3>
                                    <h4 class="job-department">Development</h4>
                                </div>
                                <div class="job-type-info">
                                    <span class="job-types">Full Time</span>
                                </div>
                            </div>
                            <div class="job-list-footer">
                                <ul>
                                    <li><i class="fa fa-map-signs"></i> California</li>
                                    <li><i class="fa fa-money"></i> $35000-$38000</li>
                                    <li><i class="fa fa-clock-o"></i> 2 days ago</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="job-list" href="{{ route('form/job/view') }}">
                            <div class="job-list-det">
                                <div class="job-list-desc">
                                    <h3 class="job-list-title">Android Devloper</h3>
                                    <h4 class="job-department">App Development</h4>
                                </div>
                                <div class="job-type-info">
                                    <span class="job-types">Part Time</span>
                                </div>
                            </div>
                            <div class="job-list-footer">
                                <ul>
                                    <li><i class="fa fa-map-signs"></i> California</li>
                                    <li><i class="fa fa-money"></i> $35000-$38000</li>
                                    <li><i class="fa fa-clock-o"></i> 2 days ago</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="job-list" href="{{ route('form/job/view') }}">
                            <div class="job-list-det">
                                <div class="job-list-desc">
                                    <h3 class="job-list-title">Web Devloper</h3>
                                    <h4 class="job-department">Development</h4>
                                </div>
                                <div class="job-type-info">
                                    <span class="job-types">Full Time</span>
                                </div>
                            </div>
                            <div class="job-list-footer">
                                <ul>
                                    <li><i class="fa fa-map-signs"></i> California</li>
                                    <li><i class="fa fa-money"></i> $35000-$38000</li>
                                    <li><i class="fa fa-clock-o"></i> 2 days ago</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="job-list" href="{{ route('form/job/view') }}">
                            <div class="job-list-det">
                                <div class="job-list-desc">
                                    <h3 class="job-list-title">Android Devloper</h3>
                                    <h4 class="job-department">App Development</h4>
                                </div>
                                <div class="job-type-info">
                                    <span class="job-types">Part Time</span>
                                </div>
                            </div>
                            <div class="job-list-footer">
                                <ul>
                                    <li><i class="fa fa-map-signs"></i> California</li>
                                    <li><i class="fa fa-money"></i> $35000-$38000</li>
                                    <li><i class="fa fa-clock-o"></i> 2 days ago</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="job-list" href="{{ route('form/job/view') }}">
                            <div class="job-list-det">
                                <div class="job-list-desc">
                                    <h3 class="job-list-title">Web Devloper</h3>
                                    <h4 class="job-department">Development</h4>
                                </div>
                                <div class="job-type-info">
                                    <span class="job-types">Full Time</span>
                                </div>
                            </div>
                            <div class="job-list-footer">
                                <ul>
                                    <li><i class="fa fa-map-signs"></i> California</li>
                                    <li><i class="fa fa-money"></i> $35000-$38000</li>
                                    <li><i class="fa fa-clock-o"></i> 2 days ago</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="job-list" href="{{ route('form/job/view') }}">
                            <div class="job-list-det">
                                <div class="job-list-desc">
                                    <h3 class="job-list-title">Android Devloper</h3>
                                    <h4 class="job-department">App Development</h4>
                                </div>
                                <div class="job-type-info">
                                    <span class="job-types">Part Time</span>
                                </div>
                            </div>
                            <div class="job-list-footer">
                                <ul>
                                    <li><i class="fa fa-map-signs"></i> California</li>
                                    <li><i class="fa fa-money"></i> $35000-$38000</li>
                                    <li><i class="fa fa-clock-o"></i> 2 days ago</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="job-list" href="{{ route('form/job/view') }}">
                            <div class="job-list-det">
                                <div class="job-list-desc">
                                    <h3 class="job-list-title">Web Devloper</h3>
                                    <h4 class="job-department">Development</h4>
                                </div>
                                <div class="job-type-info">
                                    <span class="job-types">Full Time</span>
                                </div>
                            </div>
                            <div class="job-list-footer">
                                <ul>
                                    <li><i class="fa fa-map-signs"></i> California</li>
                                    <li><i class="fa fa-money"></i> $35000-$38000</li>
                                    <li><i class="fa fa-clock-o"></i> 2 days ago</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="job-list" href="{{ route('form/job/view') }}">
                            <div class="job-list-det">
                                <div class="job-list-desc">
                                    <h3 class="job-list-title">Android Devloper</h3>
                                    <h4 class="job-department">App Development</h4>
                                </div>
                                <div class="job-type-info">
                                    <span class="job-types">Part Time</span>
                                </div>
                            </div>
                            <div class="job-list-footer">
                                <ul>
                                    <li><i class="fa fa-map-signs"></i> California</li>
                                    <li><i class="fa fa-money"></i> $35000-$38000</li>
                                    <li><i class="fa fa-clock-o"></i> 2 days ago</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Wrapper -->
    </div>
@endsection
