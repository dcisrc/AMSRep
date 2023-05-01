<?php 
  require_once('startsession.php');
  if(!isset($_SESSION['login_id']))
    header('location:login.php');
  include('db_connect.php');

  include('header.php');
  include ('topbar.php'); 
  include ('navbar.php'); 
  include ('utils.php');
?>

<main id="view-panel" >

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-role">
				<div class="card">
					<div class="card-header">
						  Add New Role 
				  	</div>
   					<div class="card-body">
							<input type="hidden" name="role_id" id="role_id" value="<?php echo isset($role_id) ? $role_id : "" ?>" />
							<input for="module" id="module" name="module" type="text" value="Role Module" hidden >
							<div class="form-group">
								<label class="control-label">Role Name</label>
								<textarea name="role_name" id="" cols="30" rows="2" class="form-control"></textarea>
							</div>
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Role Name</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$role = $conn->query("SELECT * FROM roles order by role_id asc");
								 if (mysqli_num_rows($role) > 0){
								while($row=$role->fetch_assoc()):
								?>
								<tr>
    							<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p> <b><?php echo $row['role_name'] ?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-success manage_permissions" type="button" data-id="<?php echo $row['role_id'] ?>">Permissions</button>
										<button class="btn btn-sm btn-primary edit_role" type="button" data-id="<?php echo $row['role_id'] ?>" data-name="<?php echo $row['role_name'] ?>"  >Edit</button>
										<button class="btn btn-sm btn-danger delete_role" type="button" data-id="<?php echo $row['role_id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile;} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>

</main>

<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>

	function _reset(){
		$('[name="id"]').val('');
		$('#manage-role').get(0).reset();
	}

	$('#manage-role').submit(function(e){
		e.preventDefault()
		start_load()
 	  if (document.getElementById('role_id').value !== ""){
		$.ajax({
			url:'ajax.php?action=update_role',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
 			  success:function(resp){
				if(resp==1){
					alert_toast("Role data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1000)
				}
			}
		})
	}
		else{
		$.ajax({
			url:'ajax.php?action=save_role',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Role data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1000)
				}
			}
		})
  }
})

	$('.edit_role').click(function(){
		start_load()
		var role = $('#manage-role')
		role.get(0).reset()
		role.find("[name='role_id']").val($(this).attr('data-id'))
		role.find("[name='role_name']").val($(this).attr('data-name'))
		end_load()
	})

	$('.delete_role').click(function(){
		_conf("Are you sure to delete this role?","delete_role",[$(this).attr('data-id')])
	})

	$('.manage_permissions').click(function(){
		//alert('test');
		window.location.href ="rolepermission.php?role_id="+$(this).attr('data-id');
	})

	function displayImg(input,_this) {
    	if (input.files && input.files[0]) {
        	var reader = new FileReader();
        	reader.onload = function (e) {
        		$('#cimg').attr('src', e.target.result);
        	}
        	reader.readAsDataURL(input.files[0]);
    	}
	}

	function delete_role($role_id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_role',
			method:'POST',
			data:{role_id:$role_id},
			success:function(resp){
				if(resp==1){
					alert_toast("Role data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	}
</script>