<?php 
include 'db_connect.php'; 
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM inventory where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>

<div class="container-fluid">
	<form id='inventory_frm'>
		<input for="module" id="module" name="module" type="text" value="Inventory Module" hidden >
		<div class="form-group">
			<label>Inventory Start Date</label>
			<input type="hidden" name="id" value="<?php echo isset($id) ? $id : "" ?>" />
			<input type="date" name="start_date" required="required" class="form-control" value="<?php echo isset($inv_date) ? $inv_date : "" ?>" />
		</div>

		<div class="form-group">
			<label>Inventory End Date</label>
			
			<input type="date" name="completion_date" required="required" class="form-control" value="<?php echo isset($inv_date) ? $inv_date : "" ?>" />
		</div>

		<div class="form-group">
			<label>Inventory Cut-off Date</label>
			
			<input type="date" name="cut-off_date" required="required" class="form-control" value="<?php echo isset($inv_date) ? $inv_date : "" ?>" />
		</div>
		<div class="form-group">
			<label>Description</label>
			<input type="text" name ="description"  class="form-control" value="<?php echo isset($description) ? $description : "" ?>" />
		</div>
		

	</form>
</div>
<script>
	
	$(document).ready(function(){
	
		$('#inventory_frm').submit(function(e){
			e.preventDefault()
			start_load();
			$.ajax({
				url:'ajax.php?action=save_inventory',
				method:"POST",
				data:$(this).serialize(),
				error:err=>console.log(),
				success:function(resp){
						if(resp == 1){
							alert_toast("Inventory successfully saved","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
				}
			})
		})
	})
</script>