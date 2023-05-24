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
						<h5 class="card-title mb-0">Asset Classification</h5>
						<button class="btn btn-primary btn-sm btn-block col-md-3 float-right" type="button" id="new_classification_btn"><span class="fa fa-plus"></span> Add Asset Classification</button>
					</div>
					<div class="card-body">
           <input type="hidden" name="id">
           <input for="module" id="module" name="module" type="text" value="Employee Module" hidden >

						<table id="table" class="table table-hover">
							<thead>
								<tr>
									<th class="d-none d-xl-table-cell">#</th>
									<th>Short Description</th>
									<th class="d-none d-xl-table-cell">Prefix Code</th>
									<th>Major Account Group</th>
									<th class="d-none d-xl-table-cell">Sub Major Account Group</th>
									
									<th>Action</th>
								</tr>
							</thead>
							<tbody>

								<?php

								



									$d_arr[0] = "Unset";
									$p_arr[0] = "Unset";
									$dept = $conn->query("SELECT * from department order by name asc");
										while($row=$dept->fetch_assoc()):
											$d_arr[$row['id']] = $row['name'];
										endwhile;
										//$pos = $conn->query("SELECT * from position order by name asc");
										//while($row=$pos->fetch_assoc()):
										//	$p_arr[$row['id']] = $row['name'];
										// endwhile;
									$i = 1;
									$class = $conn->query("SELECT *, ac.id as id, ac.majoracctgrp as majoracctgrp, ac.sbmajoracctgrp as sbmajoracctgrp, mg.name as mgname, sg.name as sgname FROM classification ac left join majoracctgrp mg on ac.majoracctgrp=mg.id left join sbmajoracctgrp sg on ac.sbmajoracctgrp=sg.id ");

									//$class = $conn->query("SELECT * FROM classification");


									while($row=$class->fetch_assoc()):
								?>
								<tr>
									<td class="d-none d-xl-table-cell"><?php echo $row['id'] ?></td>
									<td><?php echo $row['shortdescription'] ?></td>
									<td class="d-none d-xl-table-cell"><?php echo $row['prefixcode'] ?></td>
									
									<td class="d-none d-xl-table-cell"><?php echo $row['mgname'] ?></td>
									<td><?php echo $row['sgname'] ?></td>
									<td>
										<center>
										 
											<button class="btn btn-sm btn-outline-primary edit_classification" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit"></i></button>
                     	<button class="btn btn-sm btn-outline-danger delete_classification" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash"></i></button>
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
		
	<script type="text/javascript">
		$(document).ready(function(){
			$('#table').DataTable();
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){

			
			$('.edit_classification').click(function(){
				var $id=$(this).attr('data-id');
				// var $majoracctgrp_id=$(this).attr('data-majoracctgrp');
				// var $sbmajoracctgrp_id=$(this).attr('data-sbmajoracctgrp');
				
				uni_modal("Edit Asset Classification","manage_asset_classification.php?id="+$id)
				
			});
			
			$('#new_classification_btn').click(function(){
				uni_modal("New Asset Classification","manage_asset_classification.php")
			})
			$('.delete_classification').click(function(){
				_conf("Are you sure to delete this asset_classification?","remove_asset_classification",[$(this).attr('data-id')])
			})
		});
		function remove_employee(id){
			start_load()
			$.ajax({
				url:'ajax.php?action=delete_classification',
				method:"POST",
				data:{id:id},
				error:err=>console.log(err),
				success:function(resp){
						if(resp == 1){
							alert_toast("Asset Classification successfully deleted","success");
								setTimeout(function(){
								location.reload();
							},1000)
						}
					}
			})
		}
	</script>
