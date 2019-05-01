  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{ route('dashboard') }}" class="navbar-brand"><b>Port</b>MAPP</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
          <ul class="nav navbar-nav">
			<li class="{{ Request::is('projects*') ? 'active' : '' }}">
				<a href="{{ route('projects.index') }}">Projects</a>
			</li>
			<li class="{{ Request::is('programs*') ? 'active' : '' }}">
				<a href="{{ route('programs.index') }}">Programs</a>
			</li>
			<li class="{{ Request::is('users*') ? 'active' : '' }}">
				<a href="{{ route('users.index') }}">Users</a>
			</li>
          </ul>
		  <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				{{ Auth::user()->full_name }} <span class="caret"></span>
			  </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#" data-toggle="modal" data-target="#modal-default">Change Password</a></li>
                <li>
					<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</li>
              </ul>
            </li>		  
		  </ul>
        </div>
        <!-- /.navbar-collapse -->
		
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Change Password</h4>
			</div>
			
			<div class="modal-body">
				<div class="box box-primary">
					<form id="frm_change_password" method="POST" accept-charset="UTF-8" role="form">
						{{ csrf_field() }}

						<div class="box-body">
							<div class="form-group ">
								<label for="title">Existing Password</label>
								<input class="form-control" type="password" name="existing_password" id="existing_password" placeholder="Enter existing password">
							</div>
							
							<div class="form-group ">
								<label for="title">New Password</label>
								<input class="form-control" type="password" name="password" id="password" placeholder="Enter new password">
							</div>

							<div class="form-group ">
								<label for="title">Confirm Password</label>
								<input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Enter password again">
							</div>
						</div>

						<div class="box-footer">
							<input class="btn btn-success btn-flat" type="submit" value="Update Password">
						</div>
					</form>
				</div>
			</div>
		</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
$(document).ready(function() {
	$('#frm_change_password').submit(function(e) {
		e.preventDefault();

		var request_url = "{{ route('change-password') }}";

		//var token = $("#frm_change_password input[name='_token']").val();
		var existing_password = $("#existing_password").val();
		var password = $("#password").val();
		var confirm_password = $("#confirm_password").val();
		
		$.ajax({
			url: request_url,
			data: { 'existing_password': existing_password, 'password': 'password' },
			processData: false,
			contentType: false,
			type: 'POST',
			dataType: 'json',
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		  success: function(html){
			//$("#results").append(html);
		  }
		});
	});
});
</script>
