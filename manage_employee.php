<?php 
include 'db_connect.php'; 
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM employee where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>

<div class="container-fluid">
	<form id='employee_frm'>
		<input for="module" id="module" name="module" id="id" type="text" value="Manage Employee Module" hidden >
		<div class="form-group">
			<label>Firstname</label>
			<input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : "" ?>" />
			<input type="text" name="firstname" required="required" class="form-control" value="<?php echo isset($firstname) ? $firstname : "" ?>" />
		</div>
		<div class="form-group">
			<label>Middlename</label>
			<input type="text" name ="middlename" placeholder="(optional)" class="form-control" value="<?php echo isset($middlename) ? $middlename : "" ?>" />
		</div>
		<div class="form-group">
			<label>Lastname:</label>
			<input type="text" name="lastname" required="required" class="form-control" value="<?php echo isset($lastname) ? $lastname : "" ?>" />
		</div>
		<div class="form-group">
			<label>Department</label>
			<select class="custom-select browser-default select2" name="department_id">
				<option value=""></option>
			<?php
			$dept = $conn->query("SELECT * from department order by name asc");
			while($row=$dept->fetch_assoc()):
			?>
				<option value="<?php echo $row['id'] ?>" <?php echo isset($department_id) && $department_id == $row['id'] ? "selected" :"" ?>><?php echo $row['name'] ?></option>
			<?php endwhile; ?>
			</select>
		</div>

	</form>
</div>
<script>
	$('[name="department_id"]').change(function(){
		var did = $(this).val()
		$('[name="position_id"] .opt').each(function(){
			if($(this).attr('data-did') == did){
				$(this).attr('disabled',false)
			}else{
				$(this).attr('disabled',true)
			}
		})
	})
	$(document).ready(function(){
		$('.select2').select2({
			placeholder:"Please Select Here",
			width:"100%"
		})
		$('#employee_frm').submit(function(e){
				e.preventDefault()
				start_load();
				if (document.getElementById('id').value !== ""){
					$.ajax({
					url:'ajax.php?action=update_employee',
					method:"POST",
					data:$(this).serialize(),
					error:err=>console.log(),
					success:function(resp){
						if(resp == 1){
							alert_toast("Employee's data successfully updated","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
					}
					})
				}
				else {
					$.ajax({
					url:'ajax.php?action=save_employee',
					method:"POST",
					data:$(this).serialize(),
					error:err=>console.log(),
					success:function(resp){
						if(resp == 1){
							alert_toast("Employee's data successfully saved","success");
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