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

<main id="view-panel" >

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-fundcluster">
					<input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : "" ?>" />
       		<input for="module" id="module" name="module" value="Fund Cluster" hidden>						
				<div class="card flex-fill">
					<div class="card-header">
						  <h5 class="card-title mb-0">Add Fund Custer</h5>
				  	</div>
					<div class="card-body">
						<input type="hidden" name="id">
            
        	<div class="form-group">
								<label class="control-label">Func Cluster</label>
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
				<div class="card">
					<div class="card-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Fund Cluster</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$fc = $conn->query("SELECT * FROM fund_cluster order by id asc");
								
								while($row=$fc->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									
									<td class="">
										 <p> <b><?php echo $row['name'] ?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_fundcluster" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>"  >Edit</button>
										<button class="btn btn-sm btn-danger delete_fundcluster" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile;  ?>
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
		$('#manage-fundcluster').get(0).reset();
	}
	
	$('#manage-fundcluster').submit(function(e){
		e.preventDefault()
		start_load()
 	  if (document.getElementById('id').value !== ""){
		$.ajax({
			url:'ajax.php?action=update_fundcluster',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
 			  success:function(resp){
				if(resp==1){
					alert_toast("Fund cluster data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1000)
				}
			}
		})
	}
		else{
		$.ajax({
			url:'ajax.php?action=save_fundcluster',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Fund cluster data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1000)
				}
			}
		})
  }
})


	$('.edit_fundcluster').click(function(){
		start_load()
		var fc = $('#manage-fundcluster')
		fc.get(0).reset()
		fc.find("[name='id']").val($(this).attr('data-id'))
		fc.find("[name='name']").val($(this).attr('data-name'))
		end_load()
	})

	$('.delete_fundcluster').click(function(){
		_conf("Are you sure to delete this fund cluster?","delete_fundcluster",[$(this).attr('data-id')])
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

	function delete_fundcluster($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_fundcluster',
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