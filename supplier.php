
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
			<form action="" id="manage-supplier">
   	    <input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : "" ?>" />
   			<input for="module" id="module" name="module" value="supplier Module" hidden >

				<div class="card">
					<div class="card-header">
						 <h5 class="card-title mb-0">Add New Supplier </h5> 
				  	</div>
					<div class="card-body">
							<div class="form-group">
								<label class="control-label">Name</label>
								<input name="name" id="name" cols="30" rows="2"  class="form-control"></input>
							</div>
              <div class="form-group">
								<label class="control-label">Address</label>
								<input name="address" id="address" cols="30" rows="2" class="form-control"></input>
							</div>
							<div class="form-group">
								<label class="control-label">Contact Number</label>
								<input name="contact_number" id="contact_number" cols="30" rows="2" class="form-control"></input>
							</div>
							<div class="form-group">
								<label class="control-label">Contact Person</label>
								<input name="contact_name" id="contact_name" cols="30" rows="2" class="form-control"></input>
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
									<th class="text-center">supplier</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$supplier = $conn->query("SELECT * FROM supplier order by id asc");
								while($row=$supplier->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									
									<td class="">
										 <p> <b><?php echo $row['name'] ?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_supplier" type="button" 
										      data-id="<?php echo $row['id'] ?>" 
										      data-name="<?php echo $row['name'] ?>" 
										      data-address="<?php echo $row['address'] ?>" 
										      data-contact_number="<?php echo $row['contact_number'] ?>" 
                          data-contact_name="<?php echo $row['contact_name'] ?>" >Edit</button>
										<button class="btn btn-sm btn-danger delete_supplier" type="button" data-id="<?php echo $row['id']  ?>">Delete</button>
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
		$('#manage-supplier').get(0).reset();
	}

	$('#manage-supplier').submit(function(e){
		e.preventDefault()
		start_load()
 	  if (document.getElementById('id').value !== ""){
		$.ajax({
			url:'ajax.php?action=update_supplier',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
 			  success:function(resp){
				if(resp==1){
					alert_toast("Supplier data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1000)
				}
			}
		})
	}
		else{
		$.ajax({
			url:'ajax.php?action=save_supplier',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Supplier data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1000)
				}
			}
		})
  }
})

	$('.edit_supplier').click(function(){
		start_load()
		var cat = $('#manage-supplier')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='address']").val($(this).attr('data-address'))
		cat.find("[name='contact_number']").val($(this).attr('data-contact_number'))
		cat.find("[name='contact_name']").val($(this).attr('data-contact_name'))
		end_load()
	})

	$('.delete_supplier').click(function(){
		_conf("Are you sure to delete this supplier?","delete_supplier",[$(this).attr('data-id')])
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

	function delete_supplier($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_supplier',
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