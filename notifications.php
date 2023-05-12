<<?php 
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

		<div class="container-fluid " >
			<div class="col-lg-12">
				
				<br />
				<br />
				<div class="card flex-fill">
					<div class="card-header">
						<h5 class="card-title mb-0">Notitications</h5>
						<button class="btn btn-primary btn-sm btn-block col-md-3 float-right" type="button" id="new_notif_btn"><span class="fa fa-plus"></span> New Notification</button>
					</div>
					<div class="card-body">
						<table id="table" class="table table-hover">
							<thead>
								<tr>
									<th class="">Notification ID</th>
									<th>Notification Name/Subject</th>
									<th class="d-none d-xl-table-cell">Notitication Message</th>
									<th class="">Type</th>
									<th>For Role</th>
									
									
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$d_arr[0] = "Unset";
									$p_arr[0] = "Unset";
									// $dept = $conn->query("SELECT * from department order by name asc");
									// 	while($row=$dept->fetch_assoc()):
									// 		$d_arr[$row['id']] = $row['name'];
									// 	endwhile;
										$roles = $conn->query("SELECT * from roles order by role_name asc");
										while($row=$roles->fetch_assoc()):
											$p_arr[$row['role_id']] = $row['role_name'];
										endwhile;
									$notif_qry=$conn->query("SELECT * FROM notifications") or die($conn->error);
									while($row=$notif_qry->fetch_array()){
								?>
								<tr>
									<td class="d-none d-xl-table-cell"><?php echo $row['id']?></td>
									<td><?php echo $row['notif_name']?></td>
									<td class="d-none d-xl-table-cell"><?php echo $row['message']?></td>
									
									<td class="d-none d-xl-table-cell"><?php echo $row['type']?></td>
									<td><?php echo $p_arr[$row['role_id']]?></td>
									<td>
										<center>
										 
										 	<button class="btn btn-sm btn-outline-primary edit_notification" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit"></i></button>
											<button class="btn btn-sm btn-outline-danger remove_notification" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash"></i></button>
										</center>
									</td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
			
</main>		
		
	<script type="text/javascript">
		$(document).ready(function(){
			$('#table').DataTable();
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){

			

			
			$('.edit_notification').click(function(){
				var $id=$(this).attr('data-id');
				uni_modal("Edit Notification","manage_notification.php?id="+$id)
				
			});
			// $('.view_employee').click(function(){
			// 	var $id=$(this).attr('data-id');
			// 	uni_modal("Notification Details","view_employee.php?id="+$id,"mid-large")
				
			// });
			$('#new_notif_btn').click(function(){
				uni_modal("New Notification","manage_notification.php")
			})
			$('.remove_notification').click(function(){
				_conf("Are you sure to delete this notification?","remove_notification",[$(this).attr('data-id')])
			})
		});
		function remove_notification(id){
			start_load()
			$.ajax({
				url:'ajax.php?action=delete_notification',
				method:"POST",
				data:{id:id},
				error:err=>console.log(err),
				success:function(resp){
						if(resp == 1){
							alert_toast("Notification successfully deleted","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
					}
			})
		}
	</script>
