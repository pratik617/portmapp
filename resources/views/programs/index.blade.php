@extends('layouts.master')

@section('content')
<div class="container">

	<section class="content-header">
		<h1>Programs</h1>
		<ol class="breadcrumb">
			<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Programs</li>
		</ol>
	</section>
	
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">
					<div class="box-header">
						<a href="{{ route('programs.create') }}" class="btn btn-success btn-sm btn-flat pull-right" title="Add New Program">
							<i class="fa fa-plus" aria-hidden="true"></i> Add New
						</a>
					</div>
					<div class="box-body">
						<table id="programs-table" class="table table-bordered table-striped data-table">
							<thead>
								<tr>
									<th>Title</th>
									<th>No. of projects</th>
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
@endsection

@push('scripts')
<script>
$(function() {
    $('#programs-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('programs.data') !!}',
        columns: [
            { data: 'title', name: 'title' },
			{ data: 'projects_count', name: 'projects_count' },
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
