@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Locations</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Locations</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        {{-- <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_location"><i class="fa fa-plus"></i> Add Location</a> --}}
                        <div class="view-icons">
                            <a href="{{ route('location/locations') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="{{ route('location/locations/list') }}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Location ID</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Location Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option>Select Company</option>
                            <option>Global Technologies</option>
                            <option>Delta Infotech</option>
                        </select>
                        <label class="focus-label">Company</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="#" class="btn btn-success btn-block"> Search </a>
                </div>
            </div>
            <!-- Search Filter -->

            <div class="row staff-grid-row">
                <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3 employeeclass">
                    <div class="card" style="height: 86%;">
                        <div class="card-body d-flex align-items-center justify-content-center">

                            <a href="#" class="btn text-muted stretched-link" data-toggle="modal" data-target="#add_location" style="border: none;"><i class="fa fa-3x fa-plus"></i> <br> Add Location </a>

                        </div>
                    </div>
                </div>
                @foreach ($locations as $location)
                    <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3 more">
                        <div class="profile-widget more">
                            <div hidden class="id">{{ $location->id }}</div>

                            <div hidden class="location_name">{{ $location->location_name }}</div>
                            <div hidden class="location_address">{{ $location->location_address }}</div>
                            <div hidden class="location_email">{{ $location->location_email }}</div>
                            <div hidden class="location_phone_number">{{ $location->location_phone_number }}</div>
                            <div hidden class="address_identifier">{{ $location->address_identifier }}</div>
                            <div hidden class="firstname">{{ $location->firstname }}</div>
                            <div hidden class="lastname">{{ $location->lastname }}</div>
                            <div hidden class="street_address">{{ $location->street_address }}</div>
                            <div hidden class="city">{{ $location->city }}</div>
                            <div hidden class="state">{{ $location->state }}</div>
                            <div hidden class="country">{{ $location->country }}</div>
                            <div hidden class="zip_code">{{ $location->zip_code }}</div>
                            <div hidden class="phone_number">{{ $location->phone_number }}</div>
                            <div hidden class="email">{{ $location->email }}</div>
                            {{-- <div hidden class="rec_client_id">{{ $location->rec_client_id }}</div> --}}

                            <div class="profile-img">
                                <a href="{{ url('location/locations/profile/' . $location->id) }}" class="avatar"><img alt="" src="{{ URL::to('/assets/images/photo_defaults.jpg') }}"></a>
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item locationUpdate" href="#" data-toggle="modal" data-target="#edit_location"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item locationDelete" href="#" data-toggle="modal" data-target="#delete_location"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="user-name m-t-10 mb-0 text-ellipsis client_name"><a href="client-profile.html">{{ $location->location_name }}</a></h4>
                            {{-- <h5 class="user-name m-t-10 mb-0 text-ellipsis contact_person"><a
                                    href="client-profile.html">{{ $location->contact_person }}</a></h5> --}}
                            <div class="small text-muted"></div>
                            <a href="chat.html" class="btn btn-white btn-sm m-t-10 client-msg">Message</a>
                            <a href="{{ url('location/locations/profile/' . $location->id) }}" class="btn btn-white btn-sm m-t-10">View Location</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mx-auto mt-5">
                @if (count($locations) >= 1)
                    {{ $locations->links() }}
                @endif
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Add Location Modal -->
        <div id="add_location" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('location/new') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Client <span class="text-danger">*</span></label>
                                        <select class="select" name="rec_client_id" id="rec_cli_id">
                                            <option selected disabled>-- Select Client --</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->rec_client_id }}">
                                                    {{ $client->client_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Location Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="location_name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Location Address <span class="text-danger">*</span></label>
                                        <input class="form-control" name="location_address" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Location Email <span class="text-danger">*</span></label>
                                        <input class="form-control floating" name="location_email" type="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Location Phone Number</label>
                                        <input class="form-control" name="location_phone_number" type="text">
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="modal-header">
                                <h5 class="modal-title">Add Billing Address</h5>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Address identifier</label>
                                        <input class="form-control" name="address_identifier" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Firstname <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" name="firstname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Lastname <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" name="lastname">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Street Address <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" name="street_address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">City <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" name="city">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">State/Province <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" name="state">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Country/Region <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" name="country">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Zip/Postal Code <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" name="zip_code">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" name="phone_number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" name="email">
                                    </div>
                                </div>
                            </div>

                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Location Modal -->

        <!-- Edit Location Modal -->
        <div id="edit_location" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('location/edit') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" id="e_id" name="id">

                                    <div class="form-group">
                                        <label class="col-form-label">Location Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="e_location_name" name="location_name" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Location Address <span class="text-danger">*</span></label>
                                        <input class="form-control" id="e_location_address" name="location_address" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Location Email <span class="text-danger">*</span></label>
                                        <input class="form-control floating" id="e_location_email" name="location_email" type="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone Number</label>
                                        <input class="form-control" id="e_location_phone_number" name="location_phone_number" type="text">
                                    </div>
                                </div>
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Billing Address</h5>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Address identifier</label>
                                        <input class="form-control" id="e_address_identifier" name="address_identifier" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Firstname <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" id="e_firstname" name="firstname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Lastname <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" id="e_lastname" name="lastname">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Street Address <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" id="e_street_address" name="street_address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">City <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" id="e_city" name="city">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">State/Province <span class="text-danger">*</span></label>
                                        <input class="form-control floating" id="e_state" type="text" id="e_state" name="state">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Country/Region <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" id="e_country" name="country">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Zip/Postal Code <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" id="e_zip_code" name="zip_code">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" id="e_phone_number" name="phone_number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" id="e_email" name="email">
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="table-responsive m-t-15">
							<table class="table table-striped custom-table">
								<thead>
									<tr>
										<th>Module Permission</th>
										<th class="text-center">Read</th>
										<th class="text-center">Write</th>
										<th class="text-center">Create</th>
										<th class="text-center">Delete</th>
										<th class="text-center">Import</th>
										<th class="text-center">Export</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Projects</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
									</tr>
									<tr>
										<td>Tasks</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
									</tr>
									<tr>
										<td>Chat</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
									</tr>
									<tr>
										<td>Estimates</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
									</tr>
									<tr>
										<td>Invoices</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
									</tr>
									<tr>
										<td>Timing Sheets</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
										<td class="text-center">
											<input checked="" type="checkbox">
										</td>
									</tr>
								</tbody>
							</table>
						</div> --}}
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Location Modal -->

        <!-- /Delete Location Modal -->
        <div class="modal custom-modal fade" id="delete_location" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Location</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('location/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="d_id" value="">
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
        <!-- /Delete Location Modal -->
    </div>
    <!-- /Page Wrapper -->
    {{-- Delete Modal --}}
    <script>
        $(document).on('click', '.locationDelete', function() {
            var _this = $(this).parents('.more');
            $('#d_id').val(_this.find('.id').text());
        });
    </script>
    {{-- Edit Modal --}}
    <script>
        $(document).on('click', '.locationUpdate', function() {
            var _this = $(this).parents('.more');
            $('#e_id').val(_this.find('.id').text());
            $('#e_location_name').val(_this.find('.location_name').text());
            $('#e_location_address').val(_this.find('.location_address').text());
            $('#e_location_email').val(_this.find('.location_email').text());
            $('#e_location_phone_number').val(_this.find('.location_phone_number').text());
            $('#e_address_identifier').val(_this.find('.address_identifier').text());
            $('#e_firstname').val(_this.find('.firstname').text());
            $('#e_lastname').val(_this.find('.lastname').text());
            $('#e_street_address').val(_this.find('.street_address').text());
            $('#e_city').val(_this.find('.city').text());
            $('#e_state').val(_this.find('.state').text());
            $('#e_country').val(_this.find('.country').text());
            $('#e_zip_code').val(_this.find('.zip_code').text());
            $('#e_phone_number').val(_this.find('.phone_number').text());
            $('#e_email').val(_this.find('.email').text());

            // $('#e_client_fax_phone').val(_this.find('.client_fax_phone').text());
            // $('#e_rec_client_id').val(_this.find('.rec_client_id').text());
        });
    </script>
@endsection
