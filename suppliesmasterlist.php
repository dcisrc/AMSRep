
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
            <div class="col-md-10">
              <h5 class="card-title mb-0">Supplies List</h5>
            
            </div>
            <!-- <div class="col-md-2" >
            <button class="btn btn-primary btn-sm btn-block float-right" type="button" id="upload_supplies_btn"><span class="fa fa-upload"></span> Upload </button>
            </div>
 -->
                    
            <div class="col-md-2" >
            <button class="btn btn-primary btn-sm btn-block  float-right" type="button" id="new_supplies_btn"><span class="fa fa-plus"></span> Add Supplies</button>
            </div>
          </div>
          </div>
          <!--filtering-->
          <br>

 <!--         <div class="col-12">
            <div class="btn-group submitter-group float-right">
              <div class="input-group-prepend">
                <div class="input-group-text">Status</div>
              </div>
              <select class="form-control status-dropdown">
                <option value="">All</option>
                <option value="Assigned">Assigned</option>
                <option value="Unserviceable">UnAssigned</option>
              
              </select>
            </div>

          </div> -->
          <!--end filtering -->
          <div class="card-body">
            <table id="table1" class="table table-hover "> 
                <thead>
                  <tr>
                    <th class="d-none d-xl-table-cell">Item Code</th>
                    <th>Description </th>
                    <th class="d-none d-xl-table-cell">Item Type</th>
                    <th class="d-none d-xl-table-cell">Unit of Measure</th>
                    <th class="d-none d-xl-table-cell">No. of Pieces</th>
                    <th class="d-none d-xl-table-cell">Action</th>
                  </tr>
                </thead>
        <tbody >
         <?php 
                  $d_arr[0] = "Unset";
                  $c_arr[0] = "Unset";
                  $supp = $conn->query("SELECT * from supplies_master order by item_description asc");
                    while($row=$supp->fetch_assoc()):
                      $d_arr[$row['id']] = $row['item_description'];
                    endwhile;
                    $suppbb = $conn->query("SELECT * from supplies_begbal order by balance_date asc");
                    while($row=$suppbb->fetch_assoc()):
                      $c_arr[$row['id']] = $row['balance_date'];
                     endwhile;

          $supptrn_qry = $conn->query("SELECT * FROM supplies_master");
          while($row=$supptrn_qry->fetch_array()){
  
        ?>

          <tr>
            <td class="d-none d-xl-table-cell"><?php echo $row['item_code'] ?></td>
            <td class="d-none d-xl-table-cell"><?php echo $row['item_description'] ?></td>
            <td class="d-none d-xl-table-cell"><?php echo $row['item_type'] ?></td>
            <td class="d-none d-xl-table-cell"><?php echo $row['unit_of_measure'] ?></td>
            <td class="d-none d-xl-table-cell"><?php echo $row['pcs_unit'] ?></td>
            <td>
              <center>
                     <button class="btn btn-sm btn-outline-primary view_supplies" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-eye" title= "View Supplies"></i></button>
                     <button class="btn btn-sm btn-outline-primary edit_supplies" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit" title= "Edit Supplies"></i></button>
                     <button class="btn btn-sm btn-outline-danger remove_supplies" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash" title= "Delete Supplies"></i></button>
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
      
     dataTable.column(6).search(status).draw();
      })
    
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
  
      
      $('.edit_supplies').click(function(){
        var $id=$(this).attr('data-id');
        uni_modal("Edit supplies","manage_supplies.php?id="+$id,"large")
        
      });
      $('.view_supplies').click(function(){
        var $id=$(this).attr('data-id');
        uni_modal("Supplies Details","view_supplies.php?id="+$id,"large")
        
      });
      $('#new_supplies_btn').click(function(){
        uni_modal("New Supplies","manage_supplies.php","large")
      })

       $('#upload_supplies_btn').click(function(){
        $('#upload_modal').modal('show');
        //uni_modal("Upload suppliess","upload.php","med-large")
      })
      $('.remove_supplies').click(function(){
        _conf("Are you sure to delete this supplies?","remove_supplies",[$(this).attr('data-id')],"Remove supplies")
      })
    });
    function remove_supplies(id,mod){
      start_load()
      $.ajax({
        url:'ajax.php?action=delete_supplies',
        method:"POST",
        data:{id:id, module:mod},
        error:err=>console.log(err),
        success:function(resp){
            if(resp == 1){
              alert_toast("Supplies information successfully deleted","success");
                setTimeout(function(){
                location.reload();

              },1000)
            }
          }
      })
    }
  </script>