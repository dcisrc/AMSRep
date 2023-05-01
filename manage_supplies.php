<?php 
include 'db_connect.php'; 
if(isset($_GET['id'])){
 	$qry = $conn->query("SELECT * FROM supplies_master where id = ".$_GET['id'])->fetch_array();
 	foreach($qry as $k => $v){
 		$$k = $v;
 	}
}

?>
<style>
	.entry{
		width: 320px;
	}
	.cust-label{
       font-size: 14px;     
	}
</style>
<div class="container-fluid">
	
	<form id='supply_frm'>
   	    <input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : "" ?>" />
		<input for="module" id="module" name="module" value="Manage Supplies" hidden>
		<div class="clearfix"></div>
		<div class = "row">
			<div class="form-group col-md-4">
				<label>Item Code</label>
				<input type="text" name="item_code" required="required" class="form-control" value="<?php echo  isset($item_code) ? $item_code : "" ?>" />
			</div>
			<div class="form-group col-md-8">
				<label>Description</label>
				<input type="text" name="item_description" required="required" class="form-control" value="<?php echo isset($item_description) ? $item_description : "" ?>" />
			</div>

		</div>
        <hr>
		<div class="clearfix"></div>
		<div class="row">
			<div class="form-group col-md-2">
				<label>Item Type</label>
				<input type="number" name="item_type" required="required" class="form-control text-right" 
				   value="<?php echo isset($item_type) ? $item_type : "" ?>" /> 
			</div>

			<div class="form-group col-md-4">
				<label>Unit of Measure</label>
				<select class="custom-select browser-default " name="unit_of_measure">
					<option value=""></option>
					<option value="pc">pc</option>
					<option value="set">set</option>
					<option value="box">box</option>
					<option value="pair">pair</option>
					<option value="ream">ream</option>

				</select>
			</div>

            <div class="form-group col-md-2">
				<label>No. of Pieces</label>
				<input type="number" name="pcs_unit" required="required" class="form-control text-right" value="<?php echo isset($pcs_unit) ? $pcs_unit : "" ?>" />
			</div>
  		</div>
		<div class="clearfix"></div>
		<div class="row">

	</form>
   </div>
</div>

<script>

	//display hidden fields on edit
//	if (document.getElementById('id').value !== ""){
//		document.getElementById('hiddenrows').hidden = false;
//	};
    //
    
	$(document).ready(function(){
		$('#supply_frm').submit(function(e){
		e.preventDefault()
		start_load();
		if (document.getElementById('id').value !== ""){
			$.ajax({
				url:'ajax.php?action=update_supplies',
				method:"POST",
				data:$(this).serialize(),
				error:err=>console.log(),
				success:function(resp){
				if(resp == 1){
					alert_toast("Supplies data successfully updated","success");
					setTimeout(function(){
					location.reload();
						},1000)
					}
				}
			})
		}
		else{
			$.ajax({
				url:'ajax.php?action=save_supplies',
				method:"POST",
				data:$(this).serialize(),
				error:err=>console.log(),
				success:function(resp){
				if(resp == 1){
					alert_toast("Supplies data successfully saved","success");
					setTimeout(function(){
					location.reload();
						},1000)
					}
				}
			})
		}	
	})
})


/*	$(document).ready(function(){
		$('#supply_frm').submit(function(e){
				e.preventDefault()
				start_load();
			$.ajax({
				url:'ajax.php?action=save_supplies',
				method:"POST",
				data:$(this).serialize(),
				error:err=>console.log(),
				success:function(resp){
						if(resp == 1){
							alert_toast("Supplies data successfully saved","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
				}
			})
		})
	})
*/

</script>
