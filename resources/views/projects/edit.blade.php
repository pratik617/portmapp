@extends('layouts.master')

@section('content')
<div class="container">
    <section class="content-header">
		<h1>Edit Project #{{ $project->id }}</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('projects.index') }}">Projects</a></li>
        <li class="active">Edit Project</li>
      </ol>
    </section>

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<!-- left column -->
		<div class="col-md-12">
		  <!-- general form elements -->
		  <div class="box box-primary">

			<form method="POST" action="{{ route('projects.update', $project->id) }}" accept-charset="UTF-8" role="form">
				{{ method_field('PATCH') }}
				{{ csrf_field() }}

				@include ('projects.form', ['formMode' => 'edit'])
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
