<?php 
  require_once('startsession.php');
  if(!isset($_SESSION['login_id']))
    header('location:login.php');
  include('db_connect.php');

  include('./header.php');
  include ('topbar.php'); 
  include ('navbar.php'); 
  include ('utils.php');
?>

<style>


	@media (min-width: 900px) {
	.container {
	    padding-top:65px;
		width: 100%;
	 
		}

	body {
		margin-top:85px;
		width: 100%;
		}
	}

	@media (max-width: 800px) {
	.container {
		padding-left:10px;
	 	padding-top:65px;
		}
      
    body {
     padding:0
     margin-top:85px;
    	}
  
  	/*.navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top {
      margin-left: 0;
      margin-right: 0;
  	  margin-bottom:0;
  		}*/
	}

</style>	

<div class="container" >

<main id="view-pane" class="container-fluid" >

		<div class="container-fluid p-0" >
			<div class="col-lg-12">
				
				<br />
				<br />
				<div class="card flex-fill">
					<div class="card-header">
						<h5 class="card-title mb-0">Physical Inventory Plans</h5>
						<button class="btn btn-primary btn-sm btn-block col-md-3 float-right" type="button" id="new_inv_btn"><span class="fa fa-plus"></span>  Create Inventory Plan</button>
					</div>
					<div class="card-body">
           <input type="hidden" name="id">
           <input for="module" id="module" name="module" type="text" value="Inventory Module" hidden >

						<table id="table" class="table table-hover">
							<thead>
								<tr>
									<th class="d-none d-xl-table-cell">Start Date</th>
									<th class="d-none d-xl-table-cell">Completion Date</th>
									<th class="d-none d-xl-table-cell">Cut-off Date</th>
									<th>Description</th>
									<th class="d-none d-xl-table-cell">Inv. Officer</th>
									<th class="d-none d-xl-table-cell">% Processed</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php

                                    $prev_inv = $conn->query("SELECT count(*) FROM assets where status <> 'UnServiceable' or status <> 'Unlocated'");
                                    $row =$prev_inv->fetch_array();
                                    $prev_cnt = $row[0];
                                  
								
									$inv = $conn->query("SELECT i.id as id, start_date, completion_date, cut_off_date, description, concat(e.firstname,' ',e.lastname) as officername, rpt_status, d.inv_cnt as inv_cnt FROM inventory i LEFT JOIN employee e ON i.employee_id=e.id 	LEFT JOIN (SELECT inv_id, count(*) as inv_cnt FROM inventorydetails GROUP BY inv_id) d ON i.id=d.inv_id	order by inv_date desc");
									if ($inv->num_rows > 0){
										while($row=$inv->fetch_array()){


									$pc_done = ($row['inv_cnt']/$prev_cnt) * 100;
								?>
								<tr>
									
									<td class="d-none d-xl-table-cell"><?php echo $row['start_date']?></td>
									<td class="d-none d-xl-table-cell"><?php echo $row['completion_date']?></td>
									<td class="d-none d-xl-table-cell"><?php echo $row['cut_off_date']?></td>
									<td><?php echo $row['description']?></td>
									<td class="d-none d-xl-table-cell"><?php echo $row['officername']?></td>
									<td class="d-none d-xl-table-cell"><?php echo round($pc_done,2) . ' %'  ?></td>
									<td>

										<?php if($row['rpt_status']=="Open")           { echo '<span class="badge bg-success">';} 	
											  else                                     { echo '<span class="badge bg-danger">';} ?>
										<?php echo $row['rpt_status']?></span></td>
									
									<td>
										<center>
											<?php if($row['rpt_status'] != 'Closed'){ ?>
										 <button class="btn btn-sm btn-outline-primary perf_inventory" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-warehouse" title="Perform Inventory"></i></button>

										    <?php } ?>
										 <button class="btn btn-sm btn-outline-primary view_inventory" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-eye" title="View Inventory"></i></button>
										    <?php if($row['rpt_status'] != 'Closed'){ ?>
										 <button class="btn btn-sm btn-outline-secondary close_inventory" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-door-closed" title="Close Inventory"></i></button>
										 <?php } ?>

										    <?php if($row['rpt_status'] == 'Closed'){ ?>
										<button class="btn btn-sm btn-outline-success print_inventory" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-print" title= "Print Inventory Report"></i></button>

										<!-- <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split btn-outline-success " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i>&nbsp;&nbsp;</button>
                      					<span class="sr-only">Toggle Dropdown</span>
                    
                      					<div class="dropdown-menu">
                        					                        					                    					
                        					<div class="dropdown-divider"></div>
                        					<a class="dropdown-item print_ics" href="javascript:void(0)" data-id = '<?php echo $row['mrnumber'] ?>'>Inventory Count Per Location </a>
                        					<a class="dropdown-item print_ics" href="javascript:void(0)" data-id = '<?php echo $row['mrnumber'] ?>'>List of Asset Per Category Per Location </a>
                   
                      					</div> -->

										<?php } ?>

										<button class="btn btn-sm btn-outline-success update_inventory" data-id="<?php echo $row['id']?>" type="button" hidden><i class="fa fa-cogs" title= "Update Inventory"></i></button>
										<button class="btn btn-sm btn-outline-danger remove_inventory" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash" title="Delete Inventory"></i></button>
										</center>
									</td>
								</tr>
								<?php

									} }
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
			
</main>

</div>		
		
	<script type="text/javascript">
		$(document).ready(function(){
			$('#table').DataTable();
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){

			

			
			$('.perf_inventory').click(function(){
				var $id=$(this).attr('data-id');
				uni_modal("Perform Inventory","perform_inventory.php?id="+$id,"mid-large")
				
			});
			$('.view_inventory').click(function(){
				var $id=$(this).attr('data-id');
				uni_modal("Inventory Details","view_inventory.php?id="+$id,"mid-large")
				
			});
			$('#new_inv_btn').click(function(){
				uni_modal("New Inventory Plan","manage_inventory.php")
			})
			$('.close_inventory').click(function(){
				_conf("Are you sure to close this inventory?\nWarning: You will not be able to change anymore after this is done.","close_inventory",[$(this).attr('data-id')])
			})
			$('.print_inventory').click(function(){
				
				window.location.href="reports/inventoryperemployee.php?id="+[$(this).attr('data-id')];
			})
			$('.remove_inventory').click(function(){
				_conf("Are you sure to delete this inventory?","remove_inventory",[$(this).attr('data-id')])
			})




		});
		function remove_inventory(id){
			start_load()
			$.ajax({
				url:'ajax.php?action=delete_inventory',
				method:"POST",
				data:{id:id},
				error:err=>console.log(err),
				success:function(resp){
						if(resp == 1){
							alert_toast("Inventory data successfully deleted","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
					}
			})
		}
		function close_inventory(id){
			start_load()
			$.ajax({
				url:'ajax.php?action=close_inventory',
				method:"POST",
				data:{id:id},
				error:err=>console.log(err),
				success:function(resp){
						if(resp == 1){
							alert_toast("Inventory successfully closed","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
					}
			})
		}
	</script>
