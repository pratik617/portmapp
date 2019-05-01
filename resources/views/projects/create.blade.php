@extends('layouts.master')

@section('content')
<div class="container">
	
	<section class="content-header">
		<h1>Create New Project</h1>
	  <ol class="breadcrumb">
		<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{ route('projects.index') }}">Projects</a></li>
		<li class="active">New Project</li>
	  </ol>
	</section>
	
	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<!-- left column -->
		<div class="col-md-12">
		  <!-- general form elements -->
		  <div class="box box-primary">

			<form method="POST" action="{{ route('projects.store') }}" accept-charset="UTF-8" role="form">
				{{ csrf_field() }}

				@include ('projects.form', ['formMode' => 'create'])

			</form>

		  </div>
		  <!-- /.box -->
		</div>
		<!--/.col (left) -->
	  </div>
	  <!-- /.row -->
	</section>
	<!-- /.content -->

</div>
@endsection
