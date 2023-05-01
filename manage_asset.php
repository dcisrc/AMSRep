<?php 
include 'db_connect.php'; 
 if(isset($_GET['id'])){
 	$qry = $conn->query("SELECT * FROM assets where id = ".$_GET['id'])->fetch_array();
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
	
	<form id='asset_frm'>
		<input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : "" ?>" />
		<input for="module" id="module" name="module" value="Manage Assets" hidden>
		<div class="clearfix"></div>
		<div class = "row">
			
			<div class="form-group col-md-4">
				<label>Asset Code</label>
				<?php
                    //get last asset code number used
					$qry = $conn->query("SELECT asset_code FROM assets ORDER BY asset_code desc LIMIT 1");
					if ($qry->num_rows > 0){
						while($row=$qry->fetch_array()){
						//format new asset code	
						$lastnum=str_pad(substr($row['asset_code'],2,5)+1,5,'0',STR_PAD_LEFT);

						}
					}
					else
						{$lastnum=str_pad(1,5,'0',STR_PAD_LEFT);}
                    //handle asset code vis-a-vis new entry and edit
					if (isset($asset_code))
    					{$newac=$asset_code;}
    				else
    					{
						$newac=substr(date('Y'),-2).$lastnum;
						}
	       

					echo '<input type="text" id="asset_code" name="asset_code" required="required" class="form-control" required pattern="(0-9) {6,}" value="'.$newac . '"  />'
				?>		


		    <!--<input type="text" id="asset_code" name="asset_code" required="required" class="form-control" value="<?php //echo isset($asset_code) ? $asset_code : "" ?>" required pattern="(0-9) {6,}" />';-->
			</div>
			<div class="form-group col-md-8">
				<label>Asset Name</label>
				<input type="text" name="asset_name" required="required" class="form-control" value="<?php echo isset($asset_name) ? $asset_name : "" ?>" />
			</div>

			<!-- <div class="form-group col-md-4">
  				
  				<label class="form-check-label">Main Unit</label>
  				<select class="custom-select browser-default " name="category_id">
					<option value="Yes">Yes</option>
					<option value="No">No</option> 
					
				</select>
			</div> -->
		
		</div>
        <hr>
		<div class="clearfix"></div>
		
		<div class="row">

			<div class="form-group col-md-4">
				
				
				<label>Category</label>
				<select class="custom-select browser-default sel2" name="category_id">
					<option value=""></option>
					<?php
						$category = $conn->query("SELECT * from category order by name asc");
						while($row=$category->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? "selected" :"" ?>><?php echo $row['name'] ?></option> 
					<?php endwhile; ?>
				</select>
			</div>

			<div class="form-group col-md-4">
				<label>Department</label>
				<select class="custom-select browser-default " name="department_id">
					<option value=""></option>
					<?php
						$dept = $conn->query("SELECT * from department order by name asc");
						while($row=$dept->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($department_id) && $department_id == $row['id'] ? "selected" :"" ?>><?php echo $row['name'] ?></option> 
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label>Location</label>
				<select class="custom-select browser-default " name="location_id">
					<option value=""></option>
					<?php
						$dept = $conn->query("SELECT * from location order by name asc");
						while($row=$dept->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($location_id) && $location_id == $row['id'] ? "selected" :"" ?>><?php echo $row['name'] ?></option> 
					<?php endwhile; ?>
				</select>
			</div>

		</div>

		<div class="clearfix"></div>

		<div class="row">

			<div class="form-group col-md-4">
				<label>Fund Cluster</label>
				<select class="custom-select browser-default " name="fund_cluster_id">
					<option value=""></option>
					<?php
						$fc = $conn->query("SELECT * from fund_cluster order by name asc");
						while($row=$fc->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($fund_cluster_id) && $fund_cluster_id == $row['id'] ? "selected" :"" ?>><?php echo $row['name'] ?></option> 
					<?php endwhile; ?>
				</select>
			</div>

			<div class="form-group col-md-4">
				<label>Invoice Number</label>
			
				<input type="text" name="invoice_number" required="required" class="form-control text-right" value="<?php echo isset($invoice_number) ? $invoice_number : "" ?>" />
			
			</div>
			
			<div class="form-group col-md-4">
				<label>Unit of measure</label>
				<select class="custom-select browser-default " name="unit_of_measure">
					<option value="">pc</option>
					<option value="pc">pc</option>
					<option value="set">set</option>
					
				</select>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="form-group col-md-4">
				<label>Purchase Amount</label>
			
				<input type="number" name="purchase_amount" required="required" class="form-control text-right" value="<?php echo isset($purchase_amount) ? $purchase_amount : "" ?>" />
			
			</div>
			<div class="form-group col-md-4">
				<label>Purchase Date</label>
				<input type="text" name="purchase_date" required="required" class="form-control text-right" onfocus="(this.type='date')" step="any" value="<?php echo isset($purchase_date) ? $purchase_date : "" ?>" />
			</div>
			<div class="form-group col-md-4">
				<label>Supplier</label>
				<input type="text" name="supplier" required="required" class="form-control" value="<?php echo isset($supplier) ? $supplier : "" ?>" />
			</div>
		</div>
		<hr>
		<div class="clearfix"></div>
		<div class="row">
			<div class="form-group col-md-4">
				<label>Depreciation Start Date</label>
				<input type="text" name="depstartdate"  class="form-control text-right" onfocus="(this.type='date')" step="any" value="<?php echo isset($depstartdate) ? $depstartdate : "" ?>" />
			</div>
			<div class="form-group col-md-4">
				<label>Use Life</label>
			
				<input type="number" name="userlife"  class="form-control text-right" placeholder="yrs." value="<?php echo isset($userlife) ? $userlife : "" ?>" />
			
			</div>
			<div class="form-group col-md-4">
				<label>Depreciation Rate</label>
			
				<input type="number" name="depreciation_rate" class="form-control text-right" value="<?php echo isset($depreciation_rate) ? $depreciation_rate : "" ?>" />
			
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="form-group col-md-12">
				<label>Specifications</label>
				              <input type="text" name="specifications"  class="form-control" value="<?php echo isset($specifications) ? $specifications : "" ?>" />
			</div>
		</div>	
		<div class="row">
			<div class="form-group col-md-4">
				<label>Manufacturer</label>
				<input type="text" name="manufacturer" required="required" class="form-control" value="<?php echo isset($manufacturer) ? $manufacturer : "" ?>" />
			</div>
			<div class="form-group col-md-4">
				<label>Model</label>
				<input type="text" name="model" required="required" class="form-control" value="<?php echo isset($model) ? $model : "" ?>" />
			</div>
			<div class="form-group col-md-4">
				<label>Serial Number</label>
				<input type="text" name="serial_number" required="required" class="form-control" value="<?php echo isset($serial_number) ? $serial_number : "" ?>" />
			</div>
			
		</div>	
		<div id="hiddenrows" class="row" hidden>
			<div class="form-group col-md-3">
				<label>Total Depreciation</label>
				<input type="text" name="totaldepreciation" required="required" class="form-control" value="<?php echo isset($totaldepreciation) ? $totaldepreciation : "" ?>" />
			</div>
			<div class="form-group col-md-3">
				<label>Net Book Value</label>
				<input type="text" name="netbookvalue" required="required" class="form-control" value="<?php echo isset($netbookvalue) ? $netbookvalue : "" ?>" />
			</div>
			<div class="form-group col-md-3">
				<label>Status</label>
				<select class="custom-select browser-default " name="status">
					<option value="" selected></option>
					<?php
						$st = $conn->query("SELECT * from status order by name asc");
						while($row=$st->fetch_assoc()):
					?>
					
					<option value="<?php echo $row['name'] ?>" <?php echo isset($status) && $status == $row['name'] ? "selected" :"" ?>><?php echo $row['name'] ?></option> 
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label>Condition</label>
				<select class="custom-select browser-default " name="condition">
					<option value="" selected></option>
					<?php
						$condi = $conn->query("SELECT * from `condition` order by name asc");
						while($row=$condi->fetch_assoc()):
					?>
					<option value="<?php echo $row['name'] ?>" <?php echo isset($condition) && $condition == $row['name'] ? "selected" :"" ?>><?php echo $row['name'] ?></option> 
					<?php endwhile; ?>
				</select>
			</div>
			
		</div>	
	</form>
   </div>
</div>

<script>


	//display hidden fields on edit
	if (document.getElementById('id').value !== ""){
		document.getElementById('hiddenrows').hidden = false;
	};
    //
    
	$(document).ready(function(){
	 	
		$('#asset_frm').submit(function(e){
				e.preventDefault()
				start_load();
				if (document.getElementById('id').value !== ""){
					$.ajax({
						url:'ajax.php?action=update_asset',
						method:"POST",
						data:$(this).serialize(),
						error:err=>console.log(),
						success:function(resp){
							if(resp == 1){
								alert_toast("Asset data successfully updated","success");
								setTimeout(function(){
									location.reload();
								},1000)
							}
						}
					})
				}
				else{
					$.ajax({
						url:'ajax.php?action=save_asset',
						method:"POST",
						data:$(this).serialize(),
						error:err=>console.log(),
						success:function(resp){
							if(resp == 1){
								alert_toast("Asset data successfully saved","success");
								setTimeout(function(){
									location.reload();
								},1000)
							}
						}
					})
				}	
		})
	})


</script>
