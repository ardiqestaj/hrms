@extends('layouts.master')
@section('content')
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Theme Settings</h3>
									</div>
								</div>
							</div>
							<!-- /Page Header -->
							    {{-- message --}}
								{!! Toastr::message() !!}

							@if(!empty($ThemeSettings))
							<form action="{{ route('website/settings') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Website Name</label>
									<div class="col-lg-9">
										<input type="hidden" name="id">
										<input name="website_name" class="form-control" value="{{$ThemeSettings->website_name}}" type="text">
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Light Logo</label>
									<div class="col-lg-7">
										<input type="file" class="form-control" name="website_logo">
										<span class="form-text text-muted">Recommended image size is 40px x 40px</span>
									</div>
									<div class="col-lg-2">
										<div class="img-thumbnail float-right"><img src="{{ URL::to('/assets/images/'. $ThemeSettings->website_logo) }}" alt="" width="40" height="40"></div>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Favicon</label>
									<div class="col-lg-7">
										<input type="file" class="form-control" name="website_favicon">
										<span class="form-text text-muted">Recommended image size is 16px x 16px</span>
									</div>
									<div class="col-lg-2">
										<div class="settings-image img-thumbnail float-right"><img src="{{ URL::to('/assets/images/'. $ThemeSettings->website_favicon) }}" class="img-fluid" width="16" height="16" alt=""></div>
									</div>
								</div>

								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Save</button>
								</div>
							</form>

							@else 
							<form action="{{ route('website/settings') }}" method="POST"  enctype="multipart/form-data">
								@csrf
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Website Name</label>
									<div class="col-lg-9">
										<input name="website_name" class="form-control" type="text">
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Light Logo</label>
									<div class="col-lg-7">
										<input type="file" class="form-control" name="website_logo">
										<span class="form-text text-muted">Recommended image size is 40px x 40px</span>
									</div>
									<div class="col-lg-2">
										<div class="img-thumbnail float-right"><img src="" alt="" width="40" height="40"></div>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Favicon</label>
									<div class="col-lg-7">
										<input type="file" class="form-control" name="website_favicon">
										<span class="form-text text-muted">Recommended image size is 16px x 16px</span>
									</div>
									<div class="col-lg-2">
										<div class="settings-image img-thumbnail float-right"><img src="" class="img-fluid" width="16" height="16" alt=""></div>
									</div>
								</div>

								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Save</button>
								</div>
							</form>
							@endif

						</div>
					</div>
                </div>
				<!-- /Page Content -->
            </div>
			<!-- /Page Wrapper -->
@endsection
