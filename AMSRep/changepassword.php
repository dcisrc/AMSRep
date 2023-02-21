
  		<div class="container-fluid">
  				
  					<form id="changepassword-form" >
  						<div class="form-group">
  							<label for="newpassword" class="control-label">New Password</label>
  							<input type="password" id="newpassword" name="newpassword" maxlength=64 class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="verifypassword" class="control-label">Verify</label>
  							<input type="password" id="verifypassword" name="verifypassword" maxlength=64 class="form-control">
  						</div>
  						
  					</form>
  				
  		
  		</div>

<script>
	$('#changepassword-form').submit(function(e){
		e.preventDefault()
	
		$.ajax({
			url:'ajax.php?action=changepassword',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)

			},
			success:function(resp){
				if(resp == 1){
					alert_toast("Password successfully changed!","success");
					location.href ='index.php?page=home';
				
				}else{
					
					$('#changepassword-form').prepend('<div class="alert alert-danger">Change Not Successful</div>');
					//$('#changepassword-form button[type="button"]').removeAttr('disabled').html('Login');
					
				}
			}
		})
	})
</script>	
