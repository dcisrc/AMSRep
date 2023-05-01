
<?php 
  session_start();
  if(!isset($_SESSION['login_id']))
    header('location:login.php');
  include('db_connect.php');

  include('header.php');
  include ('topbar.php'); 
  include ('navbar.php'); 
  include ('utils.php');


?>

<head>
     

<link rel="stylesheet" href="css/datatable-styles.css"/>      


</head> 
<main id="view-panel" >

<div class="container-fluid" >
    <div class="col-lg-12">
        
        <br />
        <br />
        <div class="card flex-fill">
          <div class="card-header">
            <div class="row">
            <div class="col-md-8">
              <h5 class="card-title mb-0">Asset List</h5>
            
            </div>
            <div class="col-md-2" >
              <button class="btn btn-primary btn-sm btn-block float-right" type="button" id="upload_asset_btn"><span class="fa fa-upload"></span> Upload </button>
            </div>
            
            <div class="col-md-2" >
            <button class="btn btn-primary btn-sm btn-block  float-right" type="button" id="new_asset_btn"><span class="fa fa-plus"></span> Add Asset</button>
            </div>
          </div>
          </div>
          <!--filtering-->
          <br>
          <div class="col-12">
            <div class="btn-group submitter-group float-right">
              <div class="input-group-prepend">
                <div class="input-group-text">Status</div>
              </div>
              <select class="form-control status-dropdown">
                <option value="">All</option>
                <option value="Assigned">Assigned</option>
                <option value="Unserviceable">Unserviceable</option>
                <option value="UnAssigned">UnAssigned</option>
              
              </select>
            </div>

          </div>
          <!--end filtering -->
          <div class="card-body">
            <input type="hidden" name="id">
            <input for="module" id="module" name="module" type="text" value="Asset Masterlist Module" hidden >
            <table id="table1" class="table table-hover "> 
                <thead>
                  <tr>
                    <th class="d-none d-xl-table-cell">Asset Code</th>
                    <th>Asset Name</th>
                    <th class="d-none d-xl-table-cell">Category</th>
                    <th class="d-none d-xl-table-cell">Location</th>
                    <th class="d-none d-xl-table-cell">Purchase Date</th>
                    <th class="d-none d-xl-table-cell">Purchase Amount</th>
                    <th>Assign. Status</th>
                    <th>Condition</th>
                    <th class="d-none d-xl-table-cell">Action</th>
                  </tr>
                </thead>
        <tbody >
         <?php 
                  $d_arr[0] = "Unset";
                  $c_arr[0] = "Unset";
                  $dept = $conn->query("SELECT * from department order by name asc");
                    while($row=$dept->fetch_assoc()):
                      $d_arr[$row['id']] = $row['name'];
                    endwhile;
                    $catg = $conn->query("SELECT * from category order by name asc");
                    while($row=$catg->fetch_assoc()):
                      $c_arr[$row['id']] = $row['name'];
                     endwhile;
  
          $asset_qry = $conn->query("SELECT a.id, asset_code, asset_name, c.name as category, 'HO' as location, purchase_date,
              purchase_amount, supplier, status, `condition` FROM assets a LEFT JOIN category c on a.category_id = c.id") or die($conn->error);
          while($row=$asset_qry->fetch_array()){
                   
        ?>

          <tr>
            <td class="d-none d-xl-table-cell"><?php echo $row['asset_code'] ?></td>
            <td><?php echo $row['asset_name'] ?></td>
            <td class="d-none d-xl-table-cell"><?php echo $row['category'] ?></td>
            <td class="d-none d-xl-table-cell"><?php echo $row['location'] ?></td>
            <td class="d-none d-xl-table-cell"><?php echo $row['purchase_date'] ?></td>
            <td class="d-none d-xl-table-cell"><?php echo $row['purchase_amount'] ?></td>
            <td>
               <?php if($row['status']=="Assigned")           { echo '<span class="badge bg-success">';} 
                     elseif ($row['status']=="Unassigned")  { echo '<span class="badge bg-secondary">';} ?>
               <?php echo $row['status'] ?></span> </td>
            <td>
               <?php if($row['condition']=="Serviceable")     {echo '<span class="badge bg-primary">';}
                     elseif ($row['condition']=="Unserviceable") {echo '<span class="badge bg-danger">';}
                      ?>
              <?php echo $row['condition'] ?></span></td>
                
            
            <td>
            
              <center>
                     <button class="btn btn-sm btn-outline-primary view_asset" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-eye"></i></button>
                     <button class="btn btn-sm btn-outline-primary edit_asset" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit"></i></button>
                     <button class="btn btn-sm btn-outline-danger remove_asset" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash"></i></button>
              </center> 
            </td>
          </tr>
          <?php } ?>
                    
        </tbody>
  </table>
 
</div>

</main>

 <!--             Upload Modal            -->




<div class="modal fade modal-dialog modal-lg" style="position:fixed;top:0%;left:20%" id="upload_modal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Upload</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="x">
          <span aria-hidden="true">×</span>
      </button>
    </div>

    <div class="modal-body">
      
      <div class="outer-container">
        <form action="upload.php" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Choose Excel
                    File</label> <input type="file" name="file"
                    id="file" accept=".csv">
                <button type="submit" id="Import" name="Import"
                    class="btn-submit">Import</button>
        
            </div>
        
        </form>
        
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    
 
    </div>
 
  </div> 
  </div>
</div>

<script>
  $(document).ready(function(){
    $('#table1').DataTable({
        "pageLength" : 15

    });


  });

</script>

    
  <script type="text/javascript">
   
    //filtering
    //$(document).ready(function() {
    //dataTable = $("#table1").DataTable({
    
    //  "columnDefs": [
    //        {
    //            "targets": [7],
    //            "visible": true
    //        }
    //    ]
      
    //});

    $('.status-dropdown').on('change', function(e){
      var status = $(this).val();
      $('.status-dropdown').val(status)
      console.log(status)
      
      DataTable.column(6).search(status).draw();
      })
    
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
  
      
      $('.edit_asset').click(function(){
        var $id=$(this).attr('data-id');
        uni_modal("Edit Asset","manage_asset.php?id="+$id,"large")
        
      });
      $('.view_asset').click(function(){
        var $id=$(this).attr('data-id');
        uni_modal("Asset Details","view_asset.php?id="+$id,"large")
        
      });
      $('#new_asset_btn').click(function(){
        uni_modal("New Asset","manage_asset.php","large")
      })

       $('#upload_asset_btn').click(function(){
        $('#upload_modal').modal('show');
        //uni_modal("Upload Assets","upload.php","med-large")
      })
      $('.remove_asset').click(function(){
        _conf("Are you sure to delete this asset?","remove_asset",[$(this).attr('data-id')],"Remove Asset")
      })
    });
    function remove_asset(id,mod){
      start_load()
      $.ajax({
        url:'ajax.php?action=delete_asset',
        method:"POST",
        data:{id:id, module:mod},
        error:err=>console.log(err),
        success:function(resp){
            if(resp == 1){
              alert_toast("Asset information successfully deleted","success");
                setTimeout(function(){
                location.reload();

              },1000)
            }
          }
      })
    }
  </script>