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
	<div class="col-lg-12 col-sm-100" style="margin:auto;width:100%">

	<br>

	<div class="card flex-fill" style="overflow-x:auto">

		<div class="card-header">
			<h5 class="card-title mb-0">Users List</h5>
			<button class="btn btn-primary btn-sm btn-block col-md-3 float-right" type="button" id="new_user"><span class="fa fa-plus"></span> Add User</button>
		</div>


		<div class="card-body">
		<table class="table table-hover" >
			<thead>
				<tr>
					<th class="d-none d-xl-table-cell">#</th>
					<th>Name</th>
					<th class="d-none d-xl-table-cell">Username</th>
					<th>Role</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
 					$users = $conn->query("SELECT *, r.role_name as rolename FROM users u left join roles r on u.type = r.role_id WHERE status != 'DELETED' order by name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
				 <tr>
				 	<td class="d-none d-xl-table-cell">
				 		<?php echo $i++ ?>
				 	</td>
				 	<td>
				 		<?php echo $row['name'] ?>
				 	</td>
				 	<td class="d-none d-xl-table-cell">
				 		<?php echo $row['username'] ?>
				 	</td>
				 	<td>
				 		<?php echo $row['rolename'] ?>
				 	</td>	
				 	<td><?php if($row['status']=="ACTIVE")           { echo '<span class="badge bg-success">';} 
				 			  else                                   { echo '<span class="badge bg-danger">';} ?>
				 		<?php echo $row['status'] ?>
				 	</td>
				 	<td>
				 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary">Action</button>
								  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item edit_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
								    <?php
								    if ($row['status'] == 'LOCKED')
								    {
								    ?>	
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item unlock_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Unlock</a>
								    <?php } ?>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item reset_pwd" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Reset Password</a>
								  </div>
								</div>
								</center>
				 	</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
		</div>
	</div>
	</div>
</div>

</main>

<script>
	
$('#new_user').click(function(){
	uni_modal('New User','manage_user.php')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
})
$('.delete_user').click(function(){
		_conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
	})
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
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