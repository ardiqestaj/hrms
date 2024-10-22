<!-- Header -->
{{-- @yield('nav') --}}
<div class="header">
    <!-- Logo -->
    <div class="header-left">
        <li class="nav-item dropdown has-arrow main-drop ">
            <!-- <a href="#" class="nav-link p-0 mb-4 nav-profile"  data-toggle="dropdown">
      <span class="user-img d-flex align-items-center justify-content-center">
      <img src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" class="profile-img"  style="border: 1px solid black" alt="{{ Auth::user()->name }}">
      </span>
      <h4 class="d-block text-dark mt-2">{{ Auth::user()->name }}</h4>
     </a>
     <div class="dropdown-menu profile-list-items"  style="border: 1px solid black">
      <a class="dropdown-item" href="{{ route('profile_user') }}">My Profile</a>
      <a class="dropdown-item" href="{{ route('company/store') }}">Settings</a>
      <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
     </div> -->

            <!-- <li class="nav-item dropdown has-arrow main-drop">
      <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
       <span class="user-img"><img src="assets/img/profiles/avatar-21.jpg" alt="">
       <span class="status online"></span></span>
       <span>Admin</span>
      </a>
      <div class="dropdown-menu">
       <a class="dropdown-item" href="profile.html">My Profile</a>
       <a class="dropdown-item" href="settings.html">Settings</a>
       <a class="dropdown-item" href="login.html">Logout</a>
      </div>
     </li> -->

            <!-- mobile menu -->
            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('profile_user') }}">My Profile</a>
                    <a class="dropdown-item" href="{{ route('company/store') }}">Settings</a>
                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </li>
        <a href="{{ route('home') }}" class="logo"> <img src="{{ URL::to('/assets/images/' . $ThemeSettings->website_logo) }}" height="40" alt=""> </a>
    </div>
    <!-- /Logo -->
    <a id="toggle_btn" href="javascript:void(0);">
        <span class="bar-icon"><span></span><span></span><span></span></span>
    </a>
    <!-- Header Title -->
    <div class="page-title-box ml-4">
        <h3 class="text-dark">
            @foreach (\App\Models\ThemeSettings::all() as $companyName)
                {{ $companyName->website_name }}
            @endforeach
        </h3>
    </div>
    <!-- /Header Title -->
    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
    <!-- Header Menu -->
    <ul class="nav user-menu">
        <!-- Search -->
        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search"> <i class="fa fa-search text-dark"></i> </a>
                <form action="search.html">
                    <input class="form-control bg-white text-dark" type="text" placeholder="Search here">
                    <button class="btn text-dark" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </li>
        <!-- /Search -->
        <!-- Flag -->
        <!-- <li class="nav-item dropdown has-arrow flag-nav">
     <a class="nav-link dropdown-toggle text-muted" data-toggle="dropdown" href="#" role="button"> <img src="{{ URL::to('assets/img/flags/us.png') }}" alt="" height="20"> <span class="text-muted">English</span> </a>
     <div class="dropdown-menu dropdown-menu-right">
      <a href="javascript:void(0);" class="dropdown-item text-muted"> <img src="{{ URL::to('assets/img/flags/us.png') }}" alt="" height="16"> English </a>
      <a href="javascript:void(0);" class="dropdown-item text-muted"> <img src="{{ URL::to('assets/img/flags/kh.png') }}" alt="" height="16"> Khmer </a>
     </div>
    </li> -->
        <!-- /Flag -->
        <!-- Notifications -->
        <li class="nav-item dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <i class="fa fa-bell-o text-dark"></i> <span class="badge badge-pill bg-dark">{{count(Auth()->user()->unreadNotifications)}}</span></a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header"> <span class="notification-title">Notifications</span> <a href="{{route('markall/notification')}}" class="clear-noti"> Mark as read </a> </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        @php
                        use Carbon\Carbon;
                        @endphp
                        @forelse (Auth()->user()->unreadNotifications as $notification)
                        @if ($notification->type == 'App\Notifications\ApproveEmployeeLeaveNotify')
                        <li class="notification-message">
                            <a href="{{ url('show/notification/' . $notification->id) }}">
                                <div class="media"> <span class="avatar">
                                            <img alt="" src="{{ URL::to('assets/images/' . Auth()->user()->avatar) }}">
                                        </span>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">{{Auth()->user()->name}}</span> About your leaves applies  <span class="noti-title">Your leaves has been {{$notification->data['status']}}</span></p>
                                        <p class="noti-time"><span class="notification-time">
                                        @php 
                                        $time_created = $notification->created_at;
                                        echo Carbon::createFromFormat('Y-m-d H:i:s', $time_created)->diffForHumans(); 
                                        @endphp</span> </h5>
                                        </span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endif
                        @if ($notification->type == 'App\Notifications\EditedAttendanceNotification')
                        <li class="notification-message">
                            <a href="{{ url('show/notification/' . $notification->id) }}"">
                                <div class="media"> <span class="avatar">
                                            <img alt="" src="{{ URL::to('assets/images/' . Auth()->user()->avatar) }}">
                                        </span>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">{{Auth()->user()->name}}</span> Your attendance on this date {{$notification->data['date']}}  <span class="noti-title">has been updated </span></p>
                                        <p class="noti-time"><span class="notification-time">
                                        @php 
                                        $time_created = $notification->created_at;
                                        echo Carbon::createFromFormat('Y-m-d H:i:s', $time_created)->diffForHumans(); 
                                        @endphp</span> </h5>
                                        </span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endif
								
								@empty
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar">
													<img alt="" src="{{ URL::to('assets/images/' . Auth()->user()->avatar) }}">
												</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Empty</span> No new notification <span class="noti-title"></span></p>
												{{-- <p class="noti-time"><span class="notification-time">4 mins ago</span></p> --}}
                                            </div>
										</div>
									</a>
								</li> 
                         @endforelse

                        {{-- <li class="notification-message">
									<a href="activities.html">
										<div class="media"> <span class="avatar">
													<img alt="" src="{{ URL::to('assets/img/profiles/avatar-03.jpg') }}">
												</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
												<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="activities.html">
										<div class="media"> <span class="avatar">
													<img alt="" src="{{ URL::to('assets/img/profiles/avatar-06.jpg') }}">
												</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
												<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="activities.html">
										<div class="media"> <span class="avatar">
													<img alt="" src="{{ URL::to('assets/img/profiles/avatar-17.jpg') }}">
												</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
												<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="activities.html">
										<div class="media"> <span class="avatar">
													<img alt="" src="{{ URL::to('assets/img/profiles/avatar-13.jpg') }}">
												</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
												<p class="noti-time"><span class="notification-time">2 days ago</span></p>
											</div>
										</div>
									</a>
								</li> --}}
                    </ul>
                </div>
                <div class="topnav-dropdown-footer"> <a href="{{ route('all/notification') }}">View all Notifications</a> </div>
            </div>
        </li>
        <!-- /Notifications -->
        <!-- Message Notifications -->
        <!-- <li class="nav-item dropdown">
     <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <i class="fa fa-comment-o text-muted fw-bold"></i> <span class="badge badge-pill bg-dark">8</span> </a>
     <div class="dropdown-menu notifications">
      <div class="topnav-dropdown-header"> <span class="notification-title">Messages</span> <a href="javascript:void(0)" class="clear-noti"> Clear All </a> </div>
      <div class="noti-content">
       <ul class="notification-list">
        <li class="notification-message">
         <a href="chat.html">
          <div class="list-item">
           <div class="list-left"> <span class="avatar">
              <img alt="" src="{{ URL::to('assets/img/profiles/avatar-09.jpg') }}">
             </span> </div>
           <div class="list-body"> <span class="message-author">Richard Miles </span> <span class="message-time">12:28 AM</span>
            <div class="clearfix"></div> <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span> </div>
          </div>
         </a>
        </li>
        <li class="notification-message">
         <a href="chat.html">
          <div class="list-item">
           <div class="list-left"> <span class="avatar">
              <img alt="" src="{{ URL::to('assets/img/profiles/avatar-02.jpg') }}">
             </span> </div>
           <div class="list-body"> <span class="message-author">John Doe</span> <span class="message-time">6 Mar</span>
            <div class="clearfix"></div> <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span> </div>
          </div>
         </a>
        </li>
        <li class="notification-message">
         <a href="chat.html">
          <div class="list-item">
           <div class="list-left"> <span class="avatar">
              <img alt="" src="{{ URL::to('assets/img/profiles/avatar-03.jpg') }}">
             </span> </div>
           <div class="list-body"> <span class="message-author"> Tarah Shropshire </span> <span class="message-time">5 Mar</span>
            <div class="clearfix"></div> <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span> </div>
          </div>
         </a>
        </li>
        <li class="notification-message">
         <a href="chat.html">
          <div class="list-item">
           <div class="list-left"> <span class="avatar">
              <img alt="" src="{{ URL::to('assets/img/profiles/avatar-05.jpg') }}">
             </span> </div>
           <div class="list-body"> <span class="message-author">Mike Litorus</span> <span class="message-time">3 Mar</span>
            <div class="clearfix"></div> <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span> </div>
          </div>
         </a>
        </li>
        <li class="notification-message">
         <a href="chat.html">
          <div class="list-item">
           <div class="list-left">
            <span class="avatar">
             <img alt="" src="{{ URL::to('assets/img/profiles/avatar-08.jpg') }}">
            </span>
           </div>
           <div class="list-body"> <span class="message-author"> Catherine Manseau </span> <span class="message-time">27 Feb</span>
           <div class="clearfix"></div> <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span> </div>
          </div>
         </a>
        </li>
       </ul>
      </div>
      <div class="topnav-dropdown-footer"> <a href="chat.html">View all Messages</a> </div>
     </div>
    </li> -->
        <!-- /Message Notifications -->

        <!-- Profile -->
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img">
                    <img src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" class="rounded-circle" width="30px" alt="{{ Auth::user()->name }}">
                    <span class="status online"></span></span>
                <span class="text-dark fw-bold">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('profile_user') }}">My Profile</a>
                <a class="dropdown-item" href="{{ route('company/settings/page') }}">Settings</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->

</div>
