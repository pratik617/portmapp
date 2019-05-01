//Initialize form validator
$.validate({});

//Initialize Select2 Elements
$('.select2').select2()

//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
})

//Date picker
$('.datepicker').datepicker({
  autoclose: true,
  format: 'dd/mm/yyyy'
})


$(document).ready(function() {
	$('#change_password').click(function() {
        $('#password_field').toggle();
	});
	
	$('#users-table, #programs-table, #projects-table').on('click', '.btn-delete[data-remote]', function (e) { 
		e.preventDefault();
		 $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var url = $(this).data('remote');
		var table_id = $(this).data('table');
		
		// confirm then
		if (confirm('Are you sure you want to delete this?')) {
			$.ajax({
				url: url,
				type: 'DELETE',
				dataType: 'json',
				data: {method: '_DELETE', submit: true}
			}).always(function (data) {
				$('#'+table_id).DataTable().draw(false);
			});
		}else
			alert("You have cancelled!");
	});

});