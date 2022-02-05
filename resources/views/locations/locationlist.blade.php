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
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_location"><i
                                class="fa fa-plus"></i> Add Location</a>
                        <div class="view-icons">
                            <a href="{{ route('location/locations') }}" class="grid-view btn btn-link active"><i
                                    class="fa fa-th"></i></a>
                            <a href="{{ route('location/locations/list') }}" class="list-view btn btn-link"><i
                                    class="fa fa-bars"></i></a>
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

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Location Name</th>
                                    <th>Client Name</th>
                                    <th>Location Address</th>
                                    <th>Location Email</th>
                                    <th>Location Phone Number</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $location)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('location/locations/profile/' . $location->id) }}"
                                                    class="avatar"><img
                                                        src={{ URL::to('/assets/images/photo_defaults.jpg') }} alt=""></a>
                                                <a class="client_name"
                                                    href={{ url('location/locations/profile/' . $location->id) }}>{{ $location->location_name }}</a>
                                            </h2>
                                        </td>
                                        <td hidden class="id">{{ $location->id }}</td>
                                        <td hidden class="location_name">{{ $location->location_name }}</td>
                                        <td class="rec_client_id">{{ $location->client_name }}</td>
                                        {{-- <td class="contact_person">{{$location->contact_person}}</td> --}}
                                        <td class="location_address">{{ $location->location_address }}</td>
                                        <td> <a href="mailto: {{ $location->location_email }}"
                                                class="location_email">{{ $location->location_email }} </a></td>
                                        <td class="location_phone_number">{{ $location->location_phone_number }}</td>
                                        <td hidden class="address_identifier">{{ $location->address_identifier }}</td>
                                        <td hidden class="firstname">{{ $location->firstname }}</td>
                                        <td hidden class="lastname">{{ $location->lastname }}</td>
                                        <td hidden class="street_address">{{ $location->street_address }}</td>
                                        <td hidden class="city">{{ $location->city }}</td>
                                        <td hidden class="state">{{ $location->state }}</td>
                                        <td hidden class="country">{{ $location->country }}</td>
                                        <td hidden class="zip_code">{{ $location->zip_code }}</td>
                                        <td hidden class="phone_number">{{ $location->phone_number }}</td>
                                        <td hidden class="email">{{ $location->email }}</td>


                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item locationUpdate" href="#" data-toggle="modal"
                                                        data-target="#edit_location"><i class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item locationDelete" href="#" data-toggle="modal"
                                                        data-target="#delete_location"><i class="fa fa-trash-o m-r-5"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
                                        <label class="col-form-label">Location Name <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="location_name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Location Address <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" name="location_address" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Location Email <span
                                                class="text-danger">*</span></label>
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
                                        <label class="col-form-label">Firstname <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" name="firstname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Lastname <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" name="lastname">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Street Address <span
                                                class="text-danger">*</span></label>
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
                                        <label class="col-form-label">State/Province <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" name="state">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Country/Region <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" name="country">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Zip/Postal Code <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" name="zip_code">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone Number <span
                                                class="text-danger">*</span></label>
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
                                        <label class="col-form-label">Location Name <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="e_location_name" name="location_name"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Location Address <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" id="e_location_address" name="location_address"
                                            type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Location Email <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control floating" id="e_location_email" name="location_email"
                                            type="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone Number</label>
                                        <input class="form-control" id="e_location_phone_number"
                                            name="location_phone_number" type="text">
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
                                        <input class="form-control" id="e_address_identifier" name="address_identifier"
                                            type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Firstname <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" id="e_firstname" name="firstname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Lastname <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" id="e_lastname" name="lastname">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Street Address <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" id="e_street_address"
                                            name="street_address">
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
                                        <label class="col-form-label">State/Province <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control floating" id="e_state" type="text" id="e_state"
                                            name="state">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Country/Region <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" id="e_country" name="country">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Zip/Postal Code <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" id="e_zip_code" name="zip_code">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone Number <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control floating" type="text" id="e_phone_number"
                                            name="phone_number">
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
                                        <button type="submit"
                                            class="btn btn-primary continue-btn submit-btn">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal"
                                            class="btn btn-primary cancel-btn">Cancel</a>
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
            var _this = $(this).parents('tr');
            $('#d_id').val(_this.find('.id').text());
        });
    </script>
    {{-- Edit Modal --}}
    <script>
        $(document).on('click', '.locationUpdate', function() {
            var _this = $(this).parents('tr');
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
