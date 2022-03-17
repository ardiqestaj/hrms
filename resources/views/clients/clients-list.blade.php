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
                        <h3 class="page-title">Clients</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Clients</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_client"><i class="fa fa-plus"></i> Add Client</a>
                        <div class="view-icons">
                            <a href="{{ route('clients/clients') }}" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
                            <a href="{{ route('clients/clients-list') }}" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
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
                        <label class="focus-label">Client ID</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Client Name</label>
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
                                    <th>Name</th>
                                    <th>Client ID</th>
                                    <th>Contact Person</th>
                                    <th>Client Address</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('clients/client-profile/' . $client->client_id) }}" class="avatar"><img src={{ URL::to('/assets/images/photo_defaults.jpg') }} alt=""></a>
                                                <a class="client_name" href={{ url('clients/client-profile/' . $client->client_id) }}>{{ $client->client_name }}</a>
                                            </h2>
                                        </td>
                                        <td hidden class="id">{{ $client->client_id }}</td>
                                        <td class="rec_client_id">{{ $client->rec_client_id }}</td>
                                        <td class="contact_person">{{ $client->contact_person }}</td>
                                        <td class="client_address">{{ $client->client_address }}</td>
                                        <td> <a href="mailto: {{ $client->client_email }}" class="client_email">{{ $client->client_email }} </a></td>
                                        <td class="client_mobile_phone">{{ $client->client_mobile_phone }}</td>
                                        <td hidden class="client_fax_phone">{{ $client->client_fax_phone }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item clientUpdate" href="#" data-toggle="modal" data-target="#edit_client"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item clientDelete" href="#" data-toggle="modal" data-target="#delete_client"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

        <div id="add_client" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Client</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('clients/new') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Client Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="client_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Contact Person</label>
                                        <input class="form-control" name="contact_person" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Client Address <span class="text-danger">*</span></label>
                                        <input class="form-control" name="client_address" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Client Email <span class="text-danger">*</span></label>
                                        <input class="form-control floating" name="client_email" type="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Mobile Phone</label>
                                        <input class="form-control" name="client_mobile_phone" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Fax Phone</label>
                                        <input class="form-control" name="client_fax_phone" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Client ID <span class="text-danger">*</span></label>
                                        <input class="form-control floating" placeholder="Auto Generatet" readonly type="text">
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
        <!-- /Add Client Modal -->

        <!-- Edit Client Modal -->
        <div id="edit_client" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Client</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('clients/edit') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" id="e_id" name="id">
                                    <div class="form-group">
                                        <label class="col-form-label">Client Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="e_client_name" name="client_name" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Contact Person</label>
                                        <input class="form-control" id="e_contact_person" name="contact_person" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Client Address <span class="text-danger">*</span></label>
                                        <input class="form-control" id="e_client_address" name="client_address" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Client Email <span class="text-danger">*</span></label>
                                        <input class="form-control floating" id="e_client_email" name="client_email" type="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Mobile Phone</label>
                                        <input class="form-control" id="e_client_mobile_phone" name="client_mobile_phone" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Fax Phone</label>
                                        <input class="form-control" id="e_client_fax_phone" name="client_fax_phone" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Client ID <span class="text-danger">*</span></label>
                                        <input class="form-control floating" id="e_rec_client_id" readonly type="text">
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
        <!-- /Edit Client Modal -->
        <!-- /Delete Client Modal -->
        <div class="modal custom-modal fade" id="delete_client" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Client</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('clients/delete') }}" method="POST">
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
        <!-- /Delete Client Modal -->

    </div>
    {{-- @section('script') --}}
    <!-- /Page Wrapper -->
    <script>
        $(document).on('click', '.clientDelete', function() {
            var _this = $(this).parents('tr');
            $('#d_id').val(_this.find('.id').text());
        });

        // Edit Modal
        $(document).on('click', '.clientUpdate', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_client_name').val(_this.find('.client_name').text());
            $('#e_contact_person').val(_this.find('.contact_person').text());
            $('#e_client_address').val(_this.find('.client_address').text());
            $('#e_client_email').val(_this.find('.client_email').text());
            $('#e_client_mobile_phone').val(_this.find('.client_mobile_phone').text());
            $('#e_client_fax_phone').val(_this.find('.client_fax_phone').text());
            $('#e_rec_client_id').val(_this.find('.rec_client_id').text());
        });
    </script>
    {{-- @endsection --}}
@endsection
