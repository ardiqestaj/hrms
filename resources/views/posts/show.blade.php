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
                            <li class="breadcrumb-item active"><a href="{{ route('posts') }}">Post</a></li>
                            <li class="breadcrumb-item active"><a href="#">{{$posts->title}}</a></li>
                        </ul>
                    </div>
                    @if (Auth::user()->role_name == 'Admin')
                        <div class="col-auto float-right ml-auto">
                            <a href="" class="btn add-btn ml-2" data-toggle="modal" data-target="#edit_post"><i class="fa fa-plus"></i> Edit Post</a>
                            <a href="" class="btn add-btn" data-toggle="modal" data-target="#delete_post"><i class="fa fa-trash"></i> Delete Post</a>

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
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if ($posts->image == "NULL")
                         @else
                         <div class="text-center mt-3">
                        <img class="card-img-top img-fluid" style="width: 40%" style="" src="{{ URL::to('/assets/images/posts/' . $posts->image) }}">
                    </div>
                        @endif
                        <div class="card-body">
                          <h3 class="card-title d-flex justify-content-between">{{$posts->title}} <span style="font-size: 0.8rem" class="text-muted">
                            @php 
                            $time_created = $posts->created_at;
                            echo Carbon::createFromFormat('Y-m-d H:i:s', $time_created)->diffForHumans(); 
                            @endphp</span> </h3>
                          <h4 class="card-text">{{$posts->description}}</h4>
                          <p class="card-text">{!!$posts->body!!}</p>

                          {{-- <a href="{{ url('posts/show/' . $posts->id) }}" class="btn btn-primary">Visit</a> --}}
                        </div>
                      </div>
                </div>
                <!-- Edit Post Modal -->
                <div class="modal custom-modal fade" id="edit_post" role="dialog">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <form method="POST" enctype="multipart/form-data" id="save-content-form" action="{{ route('posts/edit') }}">
                                    @csrf
                                    <div class="mb-3 text-left">
                                        <input type="hidden" name="id" value="{{$posts->id}}">
                                        <label for="title" class="form-label">Title</label>
                                        <input value="{{$posts->title}}" 
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
                                        <input value="{{ $posts->description }}" 
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
                                        <input value="{{ $posts->image }}" 
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
                                            id="tinymce" name="body">{{ $posts->body }} </textarea>
                    
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
        <!-- /Edit Post Modal -->
                
         <!-- Delete Post Modal -->
         <div class="modal custom-modal fade" id="delete_post" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Post</h3>
                            <p>Are you sure want to delete this Post?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('posts/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$posts->id}}">
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
        <!-- /Delete Post Modal -->

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
