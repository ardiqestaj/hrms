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
                </div>
            </div>
            <!-- /Page Header -->
            {{-- message --}}
            {!! Toastr::message() !!}

            @php
                use Carbon\Carbon;
                $today_date = Carbon::today()->format('d-m-Y');
            @endphp

            <div class="mt-4">
                {{-- <div class="item"> --}}

                <div class="item">
                    <div class="card content-post">
                        <div class="card-body ">
                          <h5 class="card-title d-flex justify-content-between">Leaves Status<span style="font-size: 0.8rem" class="text-muted">
                            @php 
                            $time_created = $notifications->created_at;
                            echo Carbon::createFromFormat('Y-m-d H:i:s', $time_created)->diffForHumans(); 
                            @endphp</span> </h5>
                          <h4 class="card-text text-muted">Your leaves applies has been {{$notifications->data['rec_id']}}</h4>
                          {{-- <div class="truncate"> --}}
                          {{-- <p class="card-text">{!!$post->body!!}</p> --}}
                          {{-- </div> --}}
                          <div class="d-flex justify-content-end">
                          <a href="{{ url('deleteone/notification/' . $notifications->id) }}" class="btn btn-danger"> <i class="las la-trash-alt"></i></a>
                           <span style="font-size: 0.8rem" class="text-muted align-self-end">
                           {{-- Author: {{$post->name}} --}}
                            </span>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- </div> --}}
            {{-- <div class="mt-5">
                @if (count($posts) >= 1)
                    {{ $posts->links('vendor.pagination.bootstrap-4') }}
                @endif
            </div> --}}
        </div>


    </div>
    <!-- /Page Wrapper -->
@section('script')
    <script type="text/javascript">
function resizeGridItem(item){
    gridPost = document.getElementsByClassName("gridPost")[0];
    rowHeight = parseInt(window.getComputedStyle(gridPost).getPropertyValue('grid-auto-rows'));
    rowGap = parseInt(window.getComputedStyle(gridPost).getPropertyValue('grid-row-gap'));
    rowSpan = Math.ceil((item.querySelector('.content-post').getBoundingClientRect().height+rowGap)/(rowHeight+rowGap));
      item.style.gridRowEnd = "span "+rowSpan;
  }
  
  function resizeAllGridItems(){
    allItems = document.getElementsByClassName("item");
    for(x=0;x<allItems.length;x++){
      resizeGridItem(allItems[x]);
    }
  }
  
  function resizeInstance(instance){
      item = instance.elements[0];
    resizeGridItem(item);
  }
  
  window.onload = resizeAllGridItems();
  window.addEventListener("resize", resizeAllGridItems);
  
  allItems = document.getElementsByClassName("item");
  for(x=0;x<allItems.length;x++){
    imagesLoaded( allItems[x], resizeInstance);
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
