@extends('layouts.master')

@section('content')
<div class="container">

	<section class="content-header">
		<h1>Users</h1>
		<ol class="breadcrumb">
			<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Users</li>
		</ol>
	</section>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">
					<div class="box-header">
						<a href="{{ route('users.create') }}" class="btn btn-success btn-sm btn-flat pull-right" title="Add New User">
							<i class="fa fa-plus" aria-hidden="true"></i> Add New
						</a>
					</div>
					<div class="box-body">
						<table id="users-table" class="table table-bordered table-striped data-table">
							<thead>
								<tr>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Phone Number</th>
									<th>User Role</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			  
			</div>
		</div>
	</section>

</div>


@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('users.data') !!}',
        columns: [
            { data: 'first_name', name: 'first_name' },
			{ data: 'last_name', name: 'last_name' },
			{ data: 'email', name: 'email' },
			{ data: 'phone_number', name: 'phone_number', orderable: false, searchable: false },
			{ data: 'role.name', name: 'role_name', orderable: false, searchable: false },
			{ data: 'status', name: 'status', orderable: false, searchable: false,
				render: function (status) { 
					return (status==1)?'<span class="text-success">Enable</span>':'<span class="text-danger">Disable</span>' 
				} 
			},
			{ data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush
@endsection
