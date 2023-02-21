<?php 
include 'db_connect.php'; 
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM inventory where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}

// $asset_qry = $conn->query("SELECT * FROM assets WHERE status <> 'Unserviceable' and status <> 'Unlocated' and status <> 'Disposed'");
// while( $row = $asset_qry-> fetch_assoc()){
//     $new_array[$row['id']] = $row; // Inside while loop

//      $new_array[$row['id']]['id'] = $row['id'];
//     $new_array[$row['id']]['asset_code'] = $row['asset_code'];
    
// }



// foreach($new_array as $array)
// {      

//    echo $array['id'].'<br />';
//    echo $array['asset_code'].'<br />';
// }

?>

<div class="container-fluid">
    <div class="row">
    	
    	<div class="col-md-4">
    		<strong><label>Inventory Date:</label>
    		<input type="text" value="<?php echo isset($inv_date) ? $inv_date : "" ?>" disabled /></strong>
    	</div>
    	<div class="col-md-8">
    		<strong><label>Description:</label>
    		<input type="text" style="width:80%" value="<?php echo isset($description) ? $description : "" ?>" disabled /></strong>
    	</div>	
    </div>
    <hr>
	<form id='perf_inventory'>
		<input type="hidden" id="id" name="id" value="<?php echo isset($id) ? $id : "" ?>" />
		<br>

		
		<input for="module" id="module" name="module" type="text" value="Inventory Module" hidden >
		

		<div class="input-group mb-3 col-md-6">
  				<input type="text" id="asset_number" name="asset_number" class="form-control asset_number" placeholder="Asset Number" aria-label="Asset Number" aria-describedby="basic-addon2">
  				<div class="input-group-append">
    			<button class="btn btn-outline-secondary" id="search_asset_btn" type="button">Search</button>
  				</div>
		</div>
		
		<br>

		<div class="col-md-12">
			<div class="form-group">
				<label>Asset Details</label>
				<div id="asset_details" style = "height:100px" rows="40" cols="200" name =""   class="form-control">
				<div>	
			</div>
		</div>
		<br>
		<div class="row">
		<div class="col-md-4" style="padding-left:2px ">
			<div class="form-group">
			        <label>Asset Status</label>
					<select name="asset_status" id="asset_status" class="custom-select" required disabled>
					<option value="Serviceable" <?php echo isset($asset_status)  ? "selected" :"" ?>>Serviceable</option>
					<option value="Unserviceable" <?php echo isset($asset_status)  ? "selected" :"" ?>>Unserviceable</option>
					<option value="For Repair" <?php echo isset($asset_status)  ? "selected" :"" ?>>For Repair</option>
					<option value="Obsolete" <?php echo isset($asset_status)  ? "selected" :"" ?>>Obsolete</option>
					<option value="No Longer Needed" <?php echo isset($asset_status)  ? "selected" :"" ?>>No Longer Needed</option>
					<option value="Not Used Since Purchase" <?php echo isset($asset_status)  ? "selected" :"" ?>>Not Used Since Purchase</option>
					<option value="Missing" <?php echo isset($asset_status)  ? "selected" :"" ?>>Missing</option>

					
				
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Remarks</label>
				<input type="text" id="remarks" name="remarks" class="form-control remarks">
			</div>
		</div>
		</div>

	</form>
</div>
<script>
	$('.modal-save').prop('disabled',true);

	$('#uni_modal').on('shown.bs.modal', function () {
    	$('#asset_number').focus();
	})  
	
	$(document).ready(function(){
		$('#perf_inventory').submit(function(e){
			e.preventDefault()
			start_load();
            $.ajax({
				url:'ajax.php?action=save_inventory_details',
				method:"POST",
				data:$(this).serialize(),
				error:err=>console.log(),
				success:function(resp){
					if(resp == 1){
						alert_toast("Inventory Details successfully saved","success");
						setTimeout(function(){
						location.reload();

						},1000)
					}
					else 
            		{
            			alert_toast("Item already counted in this invetory activity.","info");
            			setTimeout(function(){
						location.reload();

						},1000)
            		}
            		
            	}

            })	

		})
	
          			
   		$('#search_asset_btn').click(function(){
            $asset_code = $('#asset_number').val();
			var response = '';
        	$.ajax({
            type: "GET",
            url: "search_asset.php?asset_code="+$asset_code,
            dataType: "html",
            success: function(response) {
                //alert(response);
				$('#asset_details').html(response);
                if (response != 'Asset Not Found!') {
                	
                	$('#asset_status').prop('disabled',false);
                	$('.modal-save').prop('disabled',false);
            		}
            	}
        	});

        	//alert(response);

		})	


	})
</script>