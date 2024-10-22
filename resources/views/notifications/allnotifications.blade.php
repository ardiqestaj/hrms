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
                        <h3 class="page-title">Notification <span id="year"></span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Notification</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            {{-- message --}}
            {!! Toastr::message() !!}

            @php
                use Carbon\Carbon;
                $today_date = Carbon::today()->format('d-m-Y');
            @endphp
            <!-- Search Filter -->
            {{-- <form action="{{ route('posts/search') }}" method="get">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="author" value="{{$author}}">
                            <label class="focus-label">Author</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="focused form-group form-focus focus focused">
                            <div class="cal-icon">
                                <input type="text" class="form-control floating datetimepicker" name="date" value="{{$date}}">
                            </div>
                            <label class="focus-label">Date</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" value="{{$general}}" name="general">
                            <label class="focus-label">General Search</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="sumit" class="btn btn-success btn-block"> Search </button>
                    </div>
                </div>
            </form> --}}
            <!-- Search Filter -->

            {{-- <div class="row"> --}}
            <div class="mt-4">
                {{-- <div class="item"> --}}

                @forelse ($notifications as $notification)
                    @if ($notification->type == 'App\Notifications\ApproveEmployeeLeaveNotify')
                        <div class="item">
                            <div class="card content-post">
                                <div class="card-body ">
                                    <h5 class="card-title d-flex justify-content-between">Leaves Status<span style="font-size: 0.8rem" class="text-muted">
                                            @php
                                                $time_created = $notification->created_at;
                                                echo Carbon::createFromFormat('Y-m-d H:i:s', $time_created)->diffForHumans();
                                            @endphp</span> </h5>
                                    @foreach ($leavetypes as $leavetype)
                                        @if ($leavetype->leave_id == $notification->data['leave_type_id'])
                                            <h4 class="card-text text-muted">Your <strong>{{ $leavetype->leave_names }}</strong> applie has been <strong>{{ $notification->data['status'] }}</strong>.</h4>
                                        @endif
                                    @endforeach
                                    {{-- <div class="truncate"> --}}
                                    <p class="card-text">Your leaves applies applies was from <strong>{{ $notification->data['from_date'] }} </strong> to <strong>{{ $notification->data['to_date'] }}</strong>.</p>
                                    {{-- </div> --}}
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ url('deleteone/notification/' . $notification->id) }}" class="btn btn-danger"> <i class="las la-trash-alt"></i></a>
                                        <span style="font-size: 0.8rem" class="text-muted align-self-end">
                                            {{-- Author: {{$post->name}} --}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($notification->type == 'App\Notifications\EditedAttendanceNotification')
                        <div class="item">
                            <div class="card content-post">
                                <div class="card-body ">
                                    <h5 class="card-title d-flex justify-content-between">Attendance Updated<span style="font-size: 0.8rem" class="text-muted">
                                            @php
                                                $time_created = $notification->created_at;
                                                echo Carbon::createFromFormat('Y-m-d H:i:s', $time_created)->diffForHumans();
                                            @endphp</span> </h5>
                                    <h4 class="card-text text-muted">Your attendance on this date <strong>{{ $notification->data['date'] }}</strong> has been <strong>Updated</strong>.</h4>
                                    {{-- <div class="truncate"> --}}
                                    <p class="card-text">Time in <strong>{{ $notification->data['time_in'] }} </strong> and Time out <strong>{{ $notification->data['time_out'] }}</strong>.</p>
                                    {{-- </div> --}}
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ url('deleteone/notification/' . $notification->id) }}" class="btn btn-danger"> <i class="las la-trash-alt"></i></a>
                                        <span style="font-size: 0.8rem" class="text-muted align-self-end">
                                            {{-- Author: {{$post->name}} --}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                @empty
                    No Notification to show.
                @endforelse
            </div>
            {{-- </div> --}}
            <div class="mt-5">
                @if (count($notifications) >= 1)
                    {{ $notifications->links('vendor.pagination.bootstrap-4') }}
                @endif
            </div>
        </div>

        <!-- /Page Content -->
        <!-- Add Post Modal Modal -->
        @if (Auth::user()->role_name == 'Admin')
            <div class="modal custom-modal fade" id="add_post" role="dialog">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <form method="POST" enctype="multipart/form-data" id="save-content-form" action="{{ route('posts/create') }}">
                                @csrf
                                <div class="mb-3 text-left">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <label for="title" class="form-label">Title</label>
                                    <input value="{{ old('title') }}" type="text" class="form-control" name="title" placeholder="Title" required>

                                    @if ($errors->has('title'))
                                        <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>

                                <div class="mb-3 text-left">
                                    <label for="description" class="form-label">Description</label>
                                    <input value="{{ old('description') }}" type="text" class="form-control" name="description" placeholder="Description" required>

                                    @if ($errors->has('description'))
                                        <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 text-left">
                                    <label for="description" class="form-label">Add Image</label>
                                    <input value="" type="file" class="form-control" id="image" name="image" placeholder="image">

                                    {{-- @if ($errors->has('description'))
                                        <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                                    @endif --}}
                                </div>

                                <div class="mb-3 text-left">
                                    <label for="body" class="form-label">Body</label>
                                    <textarea class="form-control" id="tinymce" name="body">{{ old('body') }} </textarea>

                                    @if ($errors->has('body'))
                                        <span class="text-danger text-left">{{ $errors->first('body') }}</span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary mx-auto">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- /Add Post Modal -->

    </div>
    <!-- /Page Wrapper -->
    @section('script')
        <script type="text/javascript">
            function resizeGridItem(item) {
                gridPost = document.getElementsByClassName("gridPost")[0];
                rowHeight = parseInt(window.getComputedStyle(gridPost).getPropertyValue('grid-auto-rows'));
                rowGap = parseInt(window.getComputedStyle(gridPost).getPropertyValue('grid-row-gap'));
                rowSpan = Math.ceil((item.querySelector('.content-post').getBoundingClientRect().height + rowGap) / (rowHeight + rowGap));
                item.style.gridRowEnd = "span " + rowSpan;
            }

            function resizeAllGridItems() {
                allItems = document.getElementsByClassName("item");
                for (x = 0; x < allItems.length; x++) {
                    resizeGridItem(allItems[x]);
                }
            }

            function resizeInstance(instance) {
                item = instance.elements[0];
                resizeGridItem(item);
            }

            window.onload = resizeAllGridItems();
            window.addEventListener("resize", resizeAllGridItems);

            allItems = document.getElementsByClassName("item");
            for (x = 0; x < allItems.length; x++) {
                imagesLoaded(allItems[x], resizeInstance);
            }
        </script>
        <script>
            document.getElementById("year").innerHTML = new Date().getFullYear();
        </script>
        {{-- update js --}}
        <script>
            $(document).on('click', '.userUpdate', function() {
                var _this = $(this).parents('tr');
                $('#e_id').val(_this.find('.id').text());
                $('#holidayName_edit').val(_this.find('.holidayName').text());
                $('#holidayDate_edit').val(_this.find('.holidayDate').text());
            });
        </script>
        {{-- delete model --}}
        <script>
            $(document).on('click', '.holidayDelete', function() {
                var _this = $(this).parents('tr');
                $('.e_id').val(_this.find('.id').text());
            });
        </script>
    @endsection

@endsection
