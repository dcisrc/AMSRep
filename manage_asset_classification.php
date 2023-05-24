<?php 
include 'db_connect.php'; 
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * from classification  where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>

<div class="container-fluid">
	<form id='asset_classification_frm'>
		<input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : "" ?>" />
		<input for="module" id="module" name="module" type="text" value="Manage Asset Classification Module" hidden >
		<div class="form-group">
			<label>Short Description</label>
			<input  name="id" id="id" value="<?php echo isset($id) ? $id : "" ?>" />
			<input type="text" name="shortdescription" id="shortdescription"  class="form-control" value="<?php echo isset($shortdescription) ? $shortdescription : "" ?>" />
		</div>
		<div class="form-group">
			<label>Prefix Code</label>
			<input type="text" name="prefixcode" id="prefixcode" required="required" class="form-control" value="<?php echo isset($prefixcode) ? $prefixcode : "" ?>" />
		</div>
				<div class="form-group">
			<label>Major Account Group</label>
			<select class="custom-select browser-default select2" name="majoracctgrp">
				<!-- <option value=""></option> -->
					<?php
						$majoracctqry = $conn->query("SELECT * from majoracctgrp order by name asc");
						while($row=$majoracctqry->fetch_assoc()):
						
					?>
				<option value="<?php echo $row['id'] ?>" <?php echo isset($majoracctgrp) && $majoracctgrp == $row['id'] ? "selected" :"" ?>><?php echo $row['name'] ?></option>  
				
				<?php endwhile; ?>
			</select>
			
		</div>
		<div class="form-group">
			<label>Sub-Major Account Group</label>
			<select class="custom-select browser-default select2" name="sbmajoracctgrp">
			classification	<!-- <option value=""></option> -->
					<?php 
						$sbmajoracctqry = $conn->query("SELECT * from sbmajoracctgrp order by name asc");
						while($row=$sbmajoracctqry->fetch_assoc()):
					?>
				<option value="<?php echo $row['id'] ?>" <?php echo isset($sbmajoracctgrp) && $sbmajoracctgrp == $row['id'] ? "selected" :"" ?>><?php echo $row['name'] ?></option>
				
				<?php endwhile; ?>
			</select> 
		</div>
		

	</form>
</div>
<script>
	// $('[name="department_id"]').change(function(){
	// 	var did = $(this).val()
	// 	$('[name="position_id"] .opt').each(function(){
	// 		if($(this).attr('data-did') == did){
	// 			$(this).attr('disabled',false)
	// 		}else{
	// 			$(this).attr('disabled',true)
	// 		}
	// 	})
	// })
	$(document).ready(function(){
		// $('.select2').select2({
		// 	placeholder:"Please Select Here",
		// 	width:"100%"
		// })
		$('#asset_classification_frm').submit(function(e){
				e.preventDefault()
				start_load();
				if (document.getElementById('id').value !== ""){
					$.ajax({
					url:'ajax.php?action=update_classification',
					method:"POST",
					data:$(this).serialize(),
					error:err=>console.log(),
					success:function(resp){
						if(resp == 1){
							alert_toast("Asset Classification successfully updated","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
					}
					})
				}
				else {
					$.ajax({
					url:'ajax.php?action=save_classification',
					method:"POST",
					data:$(this).serialize(),
					error:err=>console.log(),
					success:function(resp){
						if(resp == 1){
							alert_toast("Asset Classification successfully saved","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
						else
						{
							err=>console.log();
						}
					}
					})

				}
		})
	})
</script>