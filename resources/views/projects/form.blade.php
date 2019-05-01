<div class="box-body">
	<div class="form-group {{ $errors->has('program_id') ? 'has-error' : ''}}">
		<label for="program_id">{{ 'Program' }}</label>
		<select class="form-control select2" name="program_id" id="program_id" value="{{ $program->program_id or '' }}" style="width: 100%;">
			<option value="">Select Program</option>
			@foreach($programs as $program)
				<option value="{{ $program->id }}"{{ ((isset($project) && $project->program_id == $program->id) || old('program_id') == $program->id) ? ' selected' : '' }}>{{ ucwords($program->title) }}</option>
			@endforeach
		</select>
		{!! $errors->first('program_id', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
		<label for="title">{{ 'Title' }}</label>
		<input class="form-control" name="title" type="text" id="title" value="{{ $project->title or old('title') }}" placeholder="Enter project title">
		{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="form-group {{ $errors->has('start_at') ? 'has-error' : ''}}">
		<label for="start_at">{{ 'Start Date' }}</label>
		<div class="input-group date">
		  <div class="input-group-addon">
			<i class="fa fa-calendar"></i>
		  </div>
		  <input class="form-control pull-right datepicker" name="start_at" type="text" id="start_at" value="{{ $project->start_at or old('start_at') }}">
		</div>
		{!! $errors->first('start_at', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="form-group {{ $errors->has('end_at') ? 'has-error' : ''}}">
		<label for="end_at">{{ 'End Date' }}</label>
		<div class="input-group date">
		  <div class="input-group-addon">
			<i class="fa fa-calendar"></i>
		  </div>
		  <input class="form-control pull-right datepicker" name="end_at" type="text" id="end_at" value="{{ $project->end_at or old('end_at') }}">
		</div>
		{!! $errors->first('end_at', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="form-group">
		<label for="status">{{ 'Status' }}</label>
		  <div class="radio">
			<label>
			  <input type="radio" class="minimal" name="status" id="enable" value="1"{{ ($formMode === 'create') ? 'checked' : (isset($project) && $project->status == 1)?'checked':'' }}>
			  Enable
			</label>
			<label style="margin-left:15px;">
			  <input type="radio" class="minimal" name="status" id="disable" value="0"{{ (isset($project) && $project->status == 0)?'checked':'' }}>
			  Disable
			</label>
		  </div>
	</div>
</div>

<div class="box-footer">
    <input class="btn btn-success btn-flat" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
	<a href="{{ route('projects.index') }}" class="btn btn-warning btn-flat pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i>
		Back
	</a>
</div>