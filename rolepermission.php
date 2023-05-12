<?php 
	session_start();
  		if(!isset($_SESSION['login_id']))
    		header('location:login.php');
	include('db_connect.php');

	include('header.php');
	include ('topbar.php'); 
	include ('navbar.php'); 
	include ('utils.php');


?>


<main id="view-panel" >

<div class="container-fluid role-info">
	
	<div class="col-lg-12">
		<div class="row">
			<div class="col-md-8">
			
				<div class="card">
					<div class="card-header"><h5><strong>
						  Role Permission Maintenance</strong></h5>
				  	</div>
					<div class="card-body ">
	
							<div class="row">
							<?php
							if(isset($_GET['role_id'])){
							$qry = $conn->query("SELECT role_name FROM roles where role_id = ".$_GET['role_id']);
	 							if (mysqli_num_rows($qry) > 0){
									while($row=$qry->fetch_assoc()):
										$role_name = $row['role_name']; ?>
								
						    <h5><strong>Role</strong></h5> <label type="text" id="selected_role"><?php echo $role_name ?> </label>
							
							<?php endwhile;}} ?>
							
							</div>

					</div>
					<input type="hidden" name="id" id="id" value='<?php echo $_GET['role_id']; ?>'>		
					<input for="module" id="module" name="module" type="text" value="Role Permission Module" hidden >
					
				</div>
	
			</div>
			<!-- FORM Panel -->
		</div>	
		<div class="row">	
			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover permissions" name="permissions" >
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Permissions Granted</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody id="permiss">
							<?php	
							    $i=1;	
								if(isset($_GET['role_id'])){
									$qry = $conn->query("SELECT rp.id, permission_id, p.name as perm FROM rolepermissions rp left join permission p on rp.permission_id=p.id where role_id = ".$_GET['role_id']);
	 									if (mysqli_num_rows($qry) > 0){
										while($row=$qry->fetch_assoc()):
											
											$permission = $row['perm'];

							?>	
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									
									<td class="">
										 <p> <b><?php echo $permission ?></b></p>
									</td>
									<td class="text-center">
										
										<button class="btn btn-sm btn-danger remove_permission" type="button" data-id="<?php echo $row['id'] ?>">Remove</button>
									</td>
								</tr>	
								<?php endwhile; }} ?> 	
							
							</tbody>
						</table>
					</div>
					<div class="card-footer">
						<button class="btn btn-sm btn-primary col-sm-3 offset-md-3 float-right" data-toggle="modal" id="add_permission_btn"> Grant Permission</button>

					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>

</main>
<div class="modal fade modal-dialog modal-md" style="position:fixed;top:0%;left:20%" id="permission_modal" role="dialog">
	<div class="modal-dialog modal-md" role="document">
	<div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Select Permission to Grant</h5>
    </div>
    <div class="modal-body">

	<form action="" id='manage-rolepermission'>
		<input type="hidden" for="mrole_id" name="mrole_id"  id="mrole_id">


				
		
		<div class="form-group">Permissions</label>


			<select class="custom-select browser-default sel2" name="perm" id="perm" class="custom-select">
					<option value=""></option>
					<?php
						$permission = $conn->query("SELECT * from permission order by name asc");
						while($row=$permission->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($perm) && $perm == $row['id'] ? "selected" :"" ?>><?php echo $row['name'] ?></option> 
					<?php endwhile; ?>
			</select>
			
		</div>
	</form>
	</div>
	 <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#permission_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>  
<div>	
	
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
	
	$('#manage-rolepermission').submit(function(e){

	 	e.preventDefault()
	  	start_load();
	 	$.ajax({
	 		url:'ajax.php?action=save_rolepermission',
	 	    method: 'POST',
	 	    data:$(this).serialize(),
	 	   	success:function(resp){
	 			if(resp==1){
	 				alert_toast("Data successfully added",'success')
	 				setTimeout(function(){
	 					location.reload();
	 				},1000)

	 			}
	 			
	 		}
	 	})
	})

	$('#add_permission_btn').click(function(){
		
		//$('.rolename-modal #mrole_name').val($('#role_select option:selected').text());
        $('.modal-md #mrole_id').val($('.role-info #id').val());
        $('#permission_modal').modal('show');
    })

    $('.remove_permission').click(function(){
	 	_conf("Are you sure to delete this permission?","remove_permission",[$(this).attr('data-id')])
	})


	
</script>

<script>
	//$(document).ready(function(){
	function _reset(){
		$('[name="id"]').val('');
		$('#manage-role').get(0).reset();
	}

	

	//})

	function remove_permission($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=remove_rolepermission',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	
</script>
