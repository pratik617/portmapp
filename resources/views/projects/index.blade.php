@extends('layouts.master')

@section('content')
<div class="container">

	<section class="content-header">
		<h1>Projects</h1>
		<ol class="breadcrumb">
			<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Projects</li>
		</ol>
	</section>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">
					<div class="box-header">
						<a href="{{ route('projects.create') }}" class="btn btn-success btn-sm btn-flat pull-right" title="Add New Project">
							<i class="fa fa-plus" aria-hidden="true"></i> Add New
						</a>
					</div>
					<div class="box-body">
						<table id="projects-table" class="table table-bordered table-striped data-table">
							<thead>
								<tr>
									<th>Title</th>
									<th>Program</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Status</th>
									<th>Action</th>
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
	
@endsection

@push('scripts')
<script>
$(function() {
    $('#projects-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('projects.data') !!}',
        columns: [
            { data: 'title', name: 'title' },
			{ data: 'program.title', name: 'program' },
			{ data: 'start_at', name: 'start_at', orderable: false, searchable: false },
			{ data: 'end_at', name: 'end_at', orderable: false, searchable: false },
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
