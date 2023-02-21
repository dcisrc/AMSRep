<?php 

//session_start();
require_once('startsession.php');
include('db_connect.php') 

?>
		<div class="container-fluid " >
			<div class="col-lg-12">

				<form id="add_assignment_frm">

				
				<div class="card">
					<div class="card-header">
						<span><b>Unassigned Assets</b></span>
				        <input value=<?php echo $_SESSION['lastnum'] ?> >
				        <input id="mr_date">
				        <input id="assignee_id"> 	
					</div>
					<div class="card-body">
						<table id="uatable" class="table table-bordered table-striped uatable">
							<thead>
								<tr>
									<th>Asset Code</th>
									<th>Asset Details</th>
									<th>Purchase Date</th>
									
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									
									$unassigned_qry=$conn->query("SELECT * FROM assets WHERE status = ''" ) or die($conn->error);
									if ($unassigned_qry->num_rows > 0){
									while($row=$unassigned_qry->fetch_array()){
										
								?>
								<tr>
									<td><?php echo $row['asset_code']?></td>
									<td><?php echo $row['asset_name'].'; S/N:'.$row['serial_number']?></td>
									<td><?php echo $row['purchase_date']?></td>
									
									<td>
										<center>
										<!--  <button class="btn btn-sm btn-outline-primary select_asset" data-id="<?php// echo $row['id']?>" type="button"><i class="fa fa-select"></i></button> -->
											<div class="radio">
												<label><input type="radio" name="asset_select"></label>
											</div>	
										 
										</center>
									</td>
								</tr>
								<?php } ?>
								<tr>
									<td colspan="3"><?php }  else { echo 'No Unassigned Assets';} ?></td>
								</tr>	
							</tbody>

						
						</table>
					</div>
					
						
								

					

				</div>
				</form>
			</div>
		</div>
			
		
		
	<script type="text/javascript">
		$(document).ready(function(){
			$('#table').DataTable();
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
		
			$('.select_asset').click(function(){
				var $id=$(this).attr('data-id');
			
			});




			$('#add_assignment_frm').submit(function(e){
				e.preventDefault()
				start_load();
			$.ajax({
				url:'ajax.php?action=add_asset_assignment',
				method:"POST",
				data:$(this).serialize(),
				error:err=>console.log(),
				success:function(resp){
						if(resp == 1){
							alert_toast("Item Added","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
				}
			})
		})
			
		});
		function remove_employee(id){
			start_load()
			$.ajax({
				url:'ajax.php?action=delete_employee',
				method:"POST",
				data:{id:id},
				error:err=>console.log(err),
				success:function(resp){
						if(resp == 1){
							alert_toast("Employee's data successfully deleted","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
					}
			})
		}
	</script>
