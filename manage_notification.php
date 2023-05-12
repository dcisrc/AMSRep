<head>
	

</head>	

<?php 
include 'db_connect.php'; 
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM notifications where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>

<div class="container-fluid">
	<form id='notification_frm'>
		<input for="module" id="module" name="module" type="text" value="Manage Notifications Module" hidden >
		<div class="form-group">
			<label>Notification Name</label>
			<input type="hidden" name="id" value="<?php echo isset($id) ? $id : "" ?>" />
			<input type="text" name="notif_name" required="required" class="form-control" value="<?php echo isset($notif_name) ? $notif_name : "" ?>" />
		</div>
		<div class="form-group">
			<label>Message</label>
			<input id="message" type="text" name ="message" class="form-control"  value="<?php echo isset($message) ? $message : "" ?>"> </input>
		</div>
		<div class="form-group">
			<label>Type:</label>
			<select class="custom-select browser-default select2" name="type">
				<option value="Message">Message</option>
				<option value="Link">Link</option>
				<option value="Link">Link with parameter</option>
			</select>	
		</div>
		<div class="form-group">
			<label>For Roles:</label>
			<select class="custom-select browser-default select2" name="role_id">
				<option value=""></option>
			<?php
			$roles = $conn->query("SELECT * from roles order by role_name asc");
			while($row=$roles->fetch_assoc()):
			?>
				<option value="<?php echo $row['role_id'] ?>" <?php echo isset($role_id) && $role_id == $row['role_id'] ? "selected" :"" ?>><?php echo $row['role_name'] ?></option>
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
		$('.select2').select2({
			placeholder:"Please Select Here",
			width:"100%"
		})
		$('#notification_frm').submit(function(e){
				e.preventDefault()
				start_load();
			$.ajax({
				url:'ajax.php?action=save_notification',
				method:"POST",
				data:$(this).serialize(),
				error:err=>console.log(),
				success:function(resp){
						if(resp == 1){
							alert_toast("Notification successfully saved","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
				}
			})
		})
	})
</script>

