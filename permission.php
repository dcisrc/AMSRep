
<?php 
  require_once('startsession.php');
  if(!isset($_SESSION['login_id']))
    header('location:login.php');
  include('db_connect.php');

  include('header.php');
  include ('topbar.php'); 
  include ('navbar.php'); 
  include ('utils.php');
?>

<<main id="view-panel" >

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-permission">
				<div class="card">
					<div class="card-header">
						 <h5 class="card-title mb-0">Add New Permission </h5> 
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<input for="module" id="module" name="module" type="text" value="Manage Permission Module" hidden >
							<div class="form-group">
								<label class="control-label">Name</label>
								<textarea name="name" id="" cols="30" rows="2" class="form-control"></textarea>
							</div>
							
							
							
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card flex-fill">
					<div class="card-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Permission</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$office = $conn->query("SELECT * FROM permission order by id asc");
								while($row=$office->fetch_assoc()):
								?>
								<tr>
									<!-- <td class="text-center"><?php echo $i++ ?></td> -->
									<td class="text-center"><?php echo $row['id'] ?></td>
									
									<td class="">
										 <p> <b><?php echo $row['name'] ?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_permission" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>"  >Edit</button>
										<button class="btn btn-sm btn-danger delete_permission" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>

</main>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	function _reset(){
		$('[name="id"]').val('');
		$('#manage-permission').get(0).reset();
	}
	
	$('#manage-permission').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_permission',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.edit_permission').click(function(){
		start_load()
		var perm = $('#manage-permission')
		perm.get(0).reset()
		perm.find("[name='id']").val($(this).attr('data-id'))
		perm.find("[name='name']").val($(this).attr('data-name'))
		end_load()
	})
	$('.delete_permission').click(function(){
		_conf("Are you sure to delete this permission?","delete_permission",[$(this).attr('data-id')])
	})
	function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        	$('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
	function delete_permission($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_permission',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>