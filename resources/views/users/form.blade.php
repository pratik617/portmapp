<div class="box-body">
	<div class="form-group {{ $errors->has('role_id') ? 'has-error' : ''}}">
		<label for="role_id">{{ 'User Role' }}</label>
		<select class="form-control" name="role_id" id="role_id" value="{{ $user->role_id or '' }}" >
			<option value="">Select Role</option>
			@foreach($roles as $role)
				<option value="{{ $role->id }}"{{ ((isset($user) && $user->role_id == $role->id) || old('role_id') == $role->id) ? ' selected' : '' }}>{{ $role->name }}</option>
			@endforeach
		</select>
		{!! $errors->first('role_id', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
		<label for="first_name">{{ 'First Name' }}</label>
		<input class="form-control" name="first_name" type="text" id="first_name" value="{{ $user->first_name or old('first_name') }}" placeholder="Enter first name" >
		{!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
		<label for="last_name">{{ 'Last Name' }}</label>
		<input class="form-control" name="last_name" type="text" id="last_name" value="{{ $user->last_name or ''}}" placeholder="Enter last name" >
		{!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
		<label for="email">{{ 'Email' }}</label>
		<input class="form-control" name="email" type="email" id="email" value="{{ $user->email or ''}}" placeholder="Enter email address" >
		{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
	</div>

	@if($formMode === 'create')
	<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
		<label for="password">{{ 'Password' }}</label>
		<input class="form-control" name="password" type="password" id="password" placeholder="Enter password" >
		{!! $errors->first('password', '<p class="help-block">:message</p>') !!}
	</div>
	@elseif($formMode === 'edit')
	<div class="form-group">
		<div class="checkbox">
			<label for="change_password">
				<input type="checkbox" id="change_password" name="change_password">{{ 'Change Password' }}
			</label>
		</div>
	</div>
	<div id="password_field" class="form-group {{ $errors->has('password') ? 'has-error' : ''}}" style="display:none;">
		<label for="password">{{ 'Password' }}</label>
		<input class="form-control" name="password" type="password" id="password" placeholder="Enter password" >
		{!! $errors->first('password', '<p class="help-block">:message</p>') !!}
	</div>
	@endif

	<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
		<label for="phone_number">{{ 'Phone Number' }}</label>
		<input class="form-control" name="phone_number" type="text" id="phone_number" value="{{ $user->phone_number or ''}}" placeholder="Enter phone number">
		{!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
	</div>

	<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
		<label for="address">{{ 'Address' }}</label>
		<textarea class="form-control" rows="2" name="address" type="textarea" id="address" placeholder="Enter address">{{ $user->address or ''}}</textarea>
		{!! $errors->first('address', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group">
		<label for="status">{{ 'Status' }}</label>
		  <div class="radio">
			<label>
			  <input type="radio" class="minimal" name="status" id="enable" value="1"{{ ($formMode === 'create') ? 'checked' : (isset($user) && $user->status == 1)?'checked':'' }}>
			  Enable
			</label>
			<label style="margin-left:15px;">
			  <input type="radio" class="minimal" name="status" id="disable" value="0"{{ (isset($user) && $user->status == 0)?'checked':'' }}>
			  Disable
			</label>
		  </div>
	</div>
</div>

<div class="box-footer">
    <input class="btn btn-success btn-flat" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
	<a href="{{ route('users.index') }}" class="btn btn-warning btn-flat pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i>
		Back
	</a>
</div>