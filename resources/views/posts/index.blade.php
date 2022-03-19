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
                        <h3 class="page-title">Posts <span id="year"></span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Posts</li>
                        </ul>
                    </div>
                    @if (Auth::user()->role_name == 'Admin')
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_post"><i class="fa fa-plus"></i> Create Post</a>
                        </div>
                    @endif
                </div>
            </div>
            <!-- /Page Header -->
            {{-- message --}}
            {!! Toastr::message() !!}

            @php
                use Carbon\Carbon;
                $today_date = Carbon::today()->format('d-m-Y');
            @endphp
            
            {{-- <div class="row"> --}}
            <div class="grid-post">
                {{-- <div class="item"> --}}

                @if (Auth::user()->role_name == 'Admin')
                <div class="employeeclass item">
                    <div class="card content" >
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <a href="#" class="btn text-muted stretched-link" data-toggle="modal" data-target="#add_post" style="border: none;"><i class="fa fa-3x fa-plus"></i> <br> Add a new Post </a>
                        </div>
                    </div>
                </div>
                @endif

                @forelse ($posts as $post)
                <div class="item">
                    <div class="card content">
                        @if ($post->image == "NULL")
                         @else
                        <img class="card-img-top img-fluid" src="{{ URL::to('/assets/images/posts/' . $post->image) }}">

                        @endif
                        <div class="card-body ">
                          <h5 class="card-title d-flex justify-content-between">{{$post->title}} <span style="font-size: 0.8rem" class="text-muted">
                            @php 
                            $time_created = $post->created_at;
                            echo Carbon::createFromFormat('Y-m-d H:i:s', $time_created)->diffForHumans(); 
                            @endphp</span> </h5>
                          <h4 class="card-text">{{$post->description}}</h4>
                          <div class="truncate">
                          <p class="card-text">{!!$post->body!!}</p>
                          </div>
                          <div class="d-flex justify-content-between">
                          <a href="{{ url('posts/show/' . $post->id) }}" class="btn btn-outline-success">Read more</a>
                           <span style="font-size: 0.8rem" class="text-muted align-self-end">
                           Author: {{$post->name}}
                            </span>
                          </div>
                        </div>
                    </div>
                </div>
                @empty
                    No Post to show, Create one.
                @endforelse
            </div>
            {{-- </div> --}}
            <div class="mt-5">
                @if (count($posts) >= 1)
                    {{ $posts->links('vendor.pagination.bootstrap-4') }}
                @endif
            </div>
        </div>
     
        <!-- /Page Content -->
        <!-- Add Post Modal Modal -->
        @if (Auth::user()->role_name == 'Admin')
            <div  class="modal custom-modal fade" id="add_post" role="dialog">
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
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <label for="title" class="form-label">Title</label>
                                    <input value="{{ old('title') }}" 
                                        type="text" 
                                        class="form-control" 
                                        name="title" 
                                        placeholder="Title" required>
                
                                    @if ($errors->has('title'))
                                        <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                
                                <div class="mb-3 text-left">
                                    <label for="description" class="form-label">Description</label>
                                    <input value="{{ old('description') }}" 
                                        type="text" 
                                        class="form-control" 
                                        name="description" 
                                        placeholder="Description" required>
                
                                    @if ($errors->has('description'))
                                        <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 text-left">
                                    <label for="description" class="form-label">Add Image</label>
                                    <input value="" 
                                        type="file" 
                                        class="form-control" 
                                        id="image"
                                        name="image" 
                                        placeholder="image">
                
                                    {{-- @if ($errors->has('description'))
                                        <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                                    @endif --}}
                                </div>
                
                                <div class="mb-3 text-left">
                                    <label for="body" class="form-label">Body</label>
                                    <textarea class="form-control"
                                        id="tinymce" name="body">{{ old('body') }} </textarea>
                
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
        <!-- /Add Holiday Modal -->

        

        <!-- Delete Holiday Modal -->
        <div class="modal custom-modal fade" id="delete_holiday" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Holiday</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/holidays/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn submit-btn">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Holiday Modal -->

    </div>
    <!-- /Page Wrapper -->
@section('script')
    <script type="text/javascript">
        // tinymce.init({
	    //     selector: 'textarea#tinymce',
	    //     plugins: [
        //         "advlist autolink lists link image charmap print preview anchor",
        //         "searchreplace visualblocks code fullscreen",
        //         "insertdatetime media table paste codesample"
        //     ],
        //     toolbar:
        //         "undo redo | fontselect styleselect fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | codesample action section button",
	    //     font_formats:"Segoe UI=Segoe UI;",
	    //     fontsize_formats: "8px 9px 10px 11px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px 38px 40px 42px 44px 46px 48px 50px 52px 54px 56px 58px 60px 62px 64px 66px 68px 70px 72px 74px 76px 78px 80px 82px 84px 86px 88px 90px 92px 94px 94px 96px",
	    //     height: 600
	    // });

        
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
