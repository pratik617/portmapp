<div class="box-body">
	<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
		<label for="title">{{ 'Title' }}</label>
		<input class="form-control" name="title" type="text" id="title" value="{{ $program->title or old('title') }}" placeholder="Enter program title">
		{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="form-group">
		<label for="status">{{ 'Status' }}</label>
		  <div class="radio">
			<label>
			  <input type="radio" class="minimal" name="status" id="enable" value="1"{{ ($formMode === 'create') ? 'checked' : (isset($program) && $program->status == 1)?'checked':'' }}>
			  Enable
			</label>
			<label style="margin-left:15px;">
			  <input type="radio" class="minimal" name="status" id="disable" value="0"{{ (isset($program) && $program->status == 0)?'checked':'' }}>
			  Disable
			</label>
		  </div>
	</div>
</div>

<div class="box-footer">
    <input class="btn btn-success btn-flat" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
	<a href="{{ route('programs.index') }}" class="btn btn-warning btn-flat pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> 	Back
	</a>
</div>