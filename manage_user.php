<?php 
include('db_connect.php');
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-user">
   	    <input type="hidden" name="id" id="id" value="<?php echo isset($meta['id']) ? $meta['id'] : "" ?>" />
		<input for="module" id="module" name="module" value="Manage User" hidden>
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control" value="<?php echo isset($meta['password']) ? $meta['password']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="type">User Type</label>
			<select name="type" id="type" class="custom-select">
				<option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Admin</option>
				<option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>Staff</option>
			</select>
		</div>
	</form>
</div>

<script>

	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		if (document.getElementById('id').value !== ""){
	  		$.ajax({
			url:'ajax.php?action=update_user',
			method:"POST",
			data:$(this).serialize(),
			error:err=>console.log(),
			success:function(resp){
			if(resp == 1){
					alert_toast("User data successfully updated","success");
					setTimeout(function(){
					location.reload();
						},1000)
					}
				}
			})
		}
		else{
			$.ajax({
				url:'ajax.php?action=save_user',
				method:'POST',
				data:$(this).serialize(),
				error:err=>console.log(),
				success:function(resp){
				if(resp ==1){
					alert_toast("User data successfully saved",'success')
					setTimeout(function(){
					location.reload()
					},1500)
				}
			}
		})
 	 }
})

</script>


