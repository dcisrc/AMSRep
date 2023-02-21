<style>

  .space {
  width: 50px;
  height: auto;
  display: inline-block;
}
</style>  



<?php   
session_start();
include('./header.php'); 
$assignnumber = $_GET['assignnumber'];
$assignnumber_tr = substr($assignnumber,0,20);
?>
<?php include('db_connect.php') ?>
<?php include 'topbar.php' ?>
<?php include 'navbar.php' ?>

<main id="view-panel">
<div class="container-fluid" >
  <div class="row">
  

    <div class="col-lg-12">
        
        <br />
        <br />
        
        <div class="card">
          <div class="card-header">
    
            <span><b>Edit Assignment</b></span>
                       
          </div>  
          <div class="card-body">
          <br>
          <form>   
            <?php
                  
                  $assign_qry=$conn->query("SELECT DISTINCT assignnumber,assigndate,e.id as id, CONCAT(e.lastname, ', ',e.firstname) as assignee  FROM assetassignment aa LEFT JOIN employee e ON aa.employee_id=e.id WHERE assignnumber= '".$assignnumber_tr."'") or die($conn->error);
                  while($row=$assign_qry->fetch_array()){
                    $assigndate=$row['assigndate'];

            ?>
            <div class="row">
           
              <div class="form-group col-md-3" style="padding-left:30px">
                <label>PAR No</label>
                <input type="text" name="assignnumber" id="assignnumber" required="required" class="form-control text-left" disabled value=<?php echo $assignnumber ?> />
               
              </div>
              <div class="form-group col-md-3" style="padding-left:30px">
                <label>Assignee</label>
                <select class="custom-select browser-default " name="assignee_id" id="assignee_id" >
                  <option value=""></option>
                  <?php
                    $emp = $conn->query("SELECT * from employee order by lastname asc");
                      while($row=$emp->fetch_assoc()):
                        $emp_id=$row['id'];
                  ?>
                  <option value="<?php echo $row['id'] ?>" <?php echo isset($emp_id) && $emp_id == $row['id'] ? "selected" :"" ?>><?php echo $row['lastname'].', '.$row['firstname'].' ('.$row['id'].')' ?></option> 
                      <?php endwhile; ?>
                </select>
              </div>

              <div class="form-group col-md-2" style="padding-left:30px">
                <label>Date</label>
               
                <input type="text" name="assigndate" id="assigndate"  required="required" class="form-control text-right"  step="any" value=<?php echo $assigndate  ?> />
              </div>
              <?php
                }
              ?>  
              <div class="form-group col-md-3">
                <br>
                <button class="btn btn-secondary btn-sm btn-block col-md-6 float-right" type="button" id="add_asset_btn" ><span class="fa fa-plus"></span> Add Property </button>
              </div>
            </div>
          
          
            <table id="assigned_assets" class="table table-bordered table-striped" >
                <thead class="bg-primary">
                  <tr>
                    <th>Select</th>
                    <th>Asset Code</th>
                    <th>Asset Details</th>
                    <th>Purchase Date</th>
                  </tr>
                </thead>

                <tbody>
                <?php

                  $rctr=0;  
                  $assigned_qry=$conn->query("SELECT * FROM assetassignment aa LEFT JOIN assets a ON aa.assetcode=a.asset_code where assignnumber= '".$assignnumber_tr."'") or die($conn->error);
                  while($row=$assigned_qry->fetch_array()){
                  $rctr +=1; 
                ?>
                <tr>
                  <!--<td><input type="hidden" name="id" value="<?php echo isset($id) ? $id : "" ?>" /></td>-->
                  <td><input id="selectitem" name="selectitem"+$rctr type="checkbox"  /></td>
                  <td><?php echo $row['asset_code']?></td>
                  <td><?php echo $row['asset_name'].'; S/N:'.$row['serial_number']?></td>
                  <td><?php echo $row['purchase_date']?></td>
                  
                  
                </tr>
                <?php
                  } 
                ?>
              </tbody>
            </table>
            </form>
          </div>
          <div class="card-footer">
          <button class="btn btn-danger btn-sm btn-block col-md-3 float-left remove_selected" style="padding-left:30px" type="button" id="remove_selected" ><span class="fa fa-trash-restore"></span> Remove Selected </button>
        </div>
         
         
        </div>


    </div>

</div>  
</div>
  

</main>
    
  <script type="text/javascript">
    $(document).ready(function(){
      $('#table').DataTable();
    });

    $("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#remove_selected').click(function(){

          $('#assigned_assets').find('tr').each(function (i, el) {
            
            var $tds = $(this).find('td');
            var asset_code = parseInt($tds.eq(1).text());
            var sel = $tds.eq(0).checked;
            var mr_number = document.getElementById('mr_number').value;


            
              if (!(isNaN(asset_code)) ) 
              {

                alert(sel);
                // start_load()
                // $.ajax({
                //     type: "POST",
                //     url: "ajax.php?action=remove_asset_assignment",
                //     data: {
                       
                //         asset_code:asset_code,
                //         mr_number:mrnumber
                //     },
                //     success: function(resp) {
                      //if(resp == 1){
                        
                        // $.ajax({
                        //   type: "POST",
                        //   url: "ajax.php?action=update_unassigned_assets",
                        //   data: {
                        //      asset_code:asset_code
                             
                        //   },
                        //   success: function(resp) {
                        //   if(resp == 1){
                        
                        //       alert_toast("Asset successfully removed","success");
                        //       setTimeout(function(){
                        //       location.reload();

                        //       },1000)
                        //     }
                        
                        //   },
                        //   error: function(xhr, status, error) {
                        //   //console.error(xhr);
                        //   alert_toast(error);
                        //   }

                        // });

                       
                       
                      //}
                        
              //       },
              //       error: function(xhr, status, error) {
              //           //console.error(xhr);
              //           alert_toast(error);
              //       }
              //   });


               }
            
    
          });
      });


    }); 
  </script>   
  