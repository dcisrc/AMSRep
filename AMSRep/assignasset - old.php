<style>

  .space {
  width: 50px;
  height: auto;
  display: inline-block;
}
</style>  

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

<div class="container-fluid" >
    <div class="col-lg-12">
        
        <br />
        <br />
        
        <div class="card">
          <div class="card-header">
            
           
            <div>
            <!--<button class="btn btn-primary btn-sm btn-block col-md-1 float-right" type="button"  id="new_assgn_btn"><span class="fa fa-plus"></span> New MR </button>
            </div>-->
            <!-- <div>
              <button class="btn btn-primary btn-sm btn-block col-md-3 float-right" style="margin-right:10px;" type="button" id="list_btn"><span class="fa fa-list-alt"></span> List Memorandum Receipts </button>
            </div> -->
            <span><b>Assign Asset </b></span>
                       
          </div>  
          <div class="card-body">
          <br>
          <form>   
          <div class="row">
           
              <div class="form-group col-md-3" style="padding-left:30px">
                <label>PAR No</label>

                <?php
                  $lastnum = '';
                  //get last mr number number used for the current year and month
                  $curryear = date('Y');
                  $currmo = date ('m');
                 
                  $qry = $conn->query("SELECT DISTINCT assignnumber FROM assetassignment WHERE assignnumber like 'PAR".$curryear.$currmo. "%' ORDER BY assignnumber  desc LIMIT 1");
                  if (mysqli_num_rows($qry) > 0)
                  {$row=$qry->fetch_assoc();
                     
                      $lastnum = $curryear.$currmo.str_pad(substr($row['assignnumber'],8,2)+1,2,'0',STR_PAD_LEFT);
                    }
                  
                  else
                  {
                  $lastnum = 'PAR'.$curryear.$currmo.'001';  
                  } 
                  $_SESSION['lastnum']=$lastnum;
         
                  echo '<input type="text" name="assign_number" id="assign_number" required="required" class="form-control text-left" disabled value="'.$lastnum.' " />'
                ?>    
               
      
              </div>
              <div class="form-group col-md-3" style="padding-left:30px">
                <label>Assignee</label>
                <select class="custom-select browser-default " name="assignee_id" id="assignee_id" >
                  <option value=""></option>
                  <?php
                    $emp = $conn->query("SELECT * from employee order by lastname asc");
                      while($row=$emp->fetch_assoc()):
                  ?>
                  <option value="<?php echo $row['id'] ?>" <?php echo isset($emp_id) && $emp_id == $row['id'] ? "selected" :"" ?>><?php echo $row['lastname'].', '.$row['firstname'].' ('.$row['id'].')' ?></option> 
                      <?php endwhile; ?>
                </select>
              </div>

              <div class="form-group col-md-2" style="padding-left:30px">
                <label>Date</label>
                <input type="text" name="assign_date" id="assign_date"  required="required" class="form-control text-right" onfocus="(this.type='date')" step="any"  />
              </div>
              <div class="form-group col-md-3">
                <br>
                <button class="btn btn-secondary btn-sm btn-block col-md-6 float-right" type="button" id="add_asset_btn" ><span class="fa fa-plus"></span> Add Property </button>
              </div>
          </div>
          </form>
          <br>
          <tr>
                  <td colspan="4"><h5 style="font-weight: bold">Select from the following the items to assign:</h5></td>

                </tr>
          
            <table id="unassigned_assets" class="table table-bordered table-striped" >

                <thead class="bg-primary">
                  <tr>
                    <th>Select</th>
                    <th>Asset Code</th>
                    <th>Asset Details</th>
                    <th>Unit of Measure</th>
                    <th>Purchase Date</th>
                    <th>Invoice No.</th>
                    <th>Supplier</th>
                  </tr>
                </thead>

                <tbody>
                <?php
                  
                  $unassigned_qry=$conn->query("SELECT * FROM assets WHERE status = 'Unassigned' ") or die($conn->error);
                  if($unassigned_qry->num_rows > 0){
                    while($row=$unassigned_qry->fetch_array()){

                ?>
                    <tr>
                      <!--<td><input type="hidden" name="id" value="<?php //echo isset($id) ? $id : "" ?>" /></td>-->
                      <!-- <td><input class="sel" id="selectitem" type="checkbox" /></td>
       -->
                      <td><?php echo '<input  id="sel"'.' type="checkbox" />' ?></td>
                      <td><?php echo $row['asset_code']?></td>
                      <td><?php echo $row['asset_name'].'; S/N:'.$row['serial_number']?></td>
                      <td><?php echo $row['unit_of_measure']?></td>
                      <td><?php echo $row['purchase_date']?></td>
                      <td><?php echo $row['invoice_number']?></td>
                      <td><?php echo $row['supplier']?></td>
                                
                    </tr>
                <?php
                  } }
                  else { ?>
                    <tr>
                  <td colspan="4"><h5 style="font-weight: bold">Found No items to assign:</h5></td>

                </tr>

                  <?php } 
                ?>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary btn-sm save_selected" style="padding-left:30px" type="button" id="save_assign" ></span> Save </button>
            <button class="btn btn-secondary btn-sm" style="padding-left:30px" type="button" id="cancel_assign" onclick="window.location='assetassignment.php'">Cancel </button>
          </div>
            
        </div>

    </div>
</div>        

</main>

    
  <script type="text/javascript">
    $(document).ready(function(){
      $('#table').DataTable();
    });
  </script>
  <script type="text/javascript">

  
    $(document).ready(function(){
     
      
      $('#new_assgn_btn').click(function(){
        document.getElementById('assign_number').disabled = false;
        document.getElementById('assignee_id').disabled = false;
        document.getElementById('assign_date').disabled = false;
        document.getElementById('add_asset_btn').disabled = false;
        const zeroPad = (num, places) => String(num).padStart(places, '0')
        const nw = new Date();
        var $yr = nw.getFullYear();
        if (nw.getMonth().length = 1) {var $mo = '0' + nw.getMonth();} else {var $mo = nw.getMonth();}
        if (nw.getDay().length = 1) {var $dy = '0'+ nw.getDay();} else { var $dy = nw.getDay();}
        
        document.getElementById('assign_number').value='PAR'+$yr+$mo+$dy
        //uni_modal("New Asset","manage_asset.php","large")
      })

      $('#list_btn').click(function(){
      
          location.href= "index.php?page=assetassignments";
      })

      $('#add_asset_btn').click(function(){
          //location.href="unassigned_assets.php";
        
          document.getElementById('assigning_assets').hidden = false;
          document.getElementById('save_mr').disabled = false;
         
         

          //document.getElementById('mrnum').val()='123';
          uni_modal("Add Asset","unassignedassets.php","mid-large");
          //$('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
          $('.uatable').dataTable({bPaging: false});
          
      })

      $('#cancel_assign').click(function(){

        var btn = document.getElementById('myBtn');
        btn.addEventListener('click', function() {
         document.location.href = 'some/page';
          });
      })

      // for dev below

      $('#save_assign').click(function(){

        var mr_number = document.getElementById('assign_number').value;
        var mr_date = document.getElementById('assign_date').value;
        var assignee_id = document.getElementById('assignee_id').value;
        $('#unassigned_assets').find('tr').each(function () {
            
            var row = $(this);
            if (row.find('input[type="checkbox"]').is(':checked')) {
              //var $tds = $(this).find('td');
              //var asset_code = parseInt($tds.eq(1).text());
              var asset_code = '1';

              //alert(asset_code);
              
              //if (!isNaN(asset_code) ){
              
                start_load()
                $.ajax({
                    type: "POST",
                    url: "ajax.php?action=add_asset_assignment",
                    data: {
                        mr_number:mr_number, 
                        mr_date:mr_date, 
                        assignee_id:assignee_id, 
                        asset_code:asset_code
                    },
                    success: function(resp) {
                      //if(resp == 1){
                        
                        // $.ajax({
                        //   type: "POST",
                        //   url: "ajax.php?action=update_unassigned_assets",
                        //   data: {
                        //       mr_number:mr_number, 
                        //       mr_date:mr_date, 
                        //       asset_code:asset_code,
                        //       assignee_id:assignee_id 
                        //   },
                        //   success: function(resp) {
                           if(resp == 1){
                        
                               alert_toast("Asset successfully assigned","success");
                               setTimeout(function(){
                               location.reload();

                               },1000)
                             }
                        
                           },
                           error: function(xhr, status, error) {
                           console.error(xhr);
                        //   alert_toast(error);
                          }

                        // });

                       
                       
                      //}
                        
                    },
                    error: function(xhr, status, error) {
                        //console.error(xhr);
                        alert_toast(error);
                    }
                });


              }
              
            
    
        });
      });


      // save assigment - loop through datatable

      $('#save_assign1').click(function(){

        var mr_number = document.getElementById('assign_number').value;
        var mr_date = document.getElementById('assign_date').value;
        var assignee_id = document.getElementById('assignee_id').value;
        $('#unassigned_assets').find('tr').each(function (i, el) {
            var $tds = $(this).find('td');
            var asset_code = parseInt($tds.eq(1).text());
                
              
              if (!isNaN(asset_code) ){
              
                start_load()
                $.ajax({
                    type: "POST",
                    url: "ajax.php?action=add_asset_assignment",
                    data: {
                        mr_number:mr_number, 
                        mr_date:mr_date, 
                        assignee_id:assignee_id, 
                        asset_code:asset_code
                    },
                    success: function(resp) {
                      //if(resp == 1){
                        
                        $.ajax({
                          type: "POST",
                          url: "ajax.php?action=update_unassigned_assets",
                          data: {
                              mr_number:mr_number, 
                              mr_date:mr_date, 
                              asset_code:asset_code,
                              assignee_id:assignee_id 
                          },
                          success: function(resp) {
                          if(resp == 1){
                        
                              alert_toast("Asset successfully assigned","success");
                              setTimeout(function(){
                              location.reload();

                              },1000)
                            }
                        
                          },
                          error: function(xhr, status, error) {
                          //console.error(xhr);
                          alert_toast(error);
                          }

                        });

                       
                       
                      //}
                        
                    },
                    error: function(xhr, status, error) {
                        //console.error(xhr);
                        alert_toast(error);
                    }
                });


              }
              
            
    
        });
      });


    // end save assign

    });

    

    function remove_asset(id){
      start_load()
      $.ajax({
        url:'ajax.php?action=delete_asset',
        method:"POST",
        data:{id:id},
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