<?php 
include 'db_connect.php'; 

$emp = $conn->query("SELECT item_code, item_description, item_type, pcs_unit, unit_of_measure,b.bal as balance FROM supplies_master m left join (select item_id, sum(if(isnull(dep),0,dep)-if(isnull(wdw),0,wdw)) as bal from supplies_txn group by item_id )b ON m.item_code = b.item_id  where id =".$_GET['id'])->fetch_array();
	foreach($emp as $k=>$v){
		$$k=$v;
	}
?>

<div class="container-fluid">
	
	<form id='supply_frm'>
   	    <input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : "" ?>" />
		<input for="module" id="module" name="module" value="View Supplies" hidden>
		<div class="clearfix"></div>
		<div class = "row">
			<div class="form-group col-md-4">
				<label>Item Code</label>
				<input type="text" name="item_code" required="required" class="form-control" value="<?php echo  isset($item_code) ? $item_code : "" ?>" disabled />
			</div>
			<div class="form-group col-md-8">
				<label>Description</label>
				<input type="text" name="item_description" required="required" class="form-control" value="<?php echo isset($item_description) ? $item_description : "" ?>" disabled />
			</div>

		</div>
        <hr>
		<div class="clearfix"></div>
		<div class="row">
			<div class="form-group col-md-2">
				<label>Item Type</label>
				<input type="number" name="item_type" required="required" class="form-control text-right" 
				   value="<?php echo isset($item_type) ? $item_type : "" ?>" disabled/> 
			</div>

			<div class="form-group col-md-4">
				<label>Unit of Measure</label>
				<select class="custom-select browser-default " name="unit_of_measure">
					<option value="">pc</option>
					<option value="pc">pc</option>
					<option value="set">set</option>
					<option value="box">box</option>
					<option value="pair">pair</option>
				</select>
			</div>

            <div class="form-group col-md-2">
				<label>No. of Pieces</label>
				<input type="number" name="pcs_unit" required="required" class="form-control text-right" value="<?php echo isset($pcs_unit) ? $pcs_unit : "" ?>" disabled />
			</div>
			<div class="form-group col-md-2">
				<label>Stock Balance</label>
				<input type="number" name="balance" required="required" class="form-control text-right" value="<?php echo isset($balance) ? $balance : "" ?>" disabled />
			</div>
  		</div>
		<div class="clearfix"></div>
		<div class="row">

	</form>
   </div>
</div>


