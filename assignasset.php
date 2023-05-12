<style>

  .space {
  width: 50px;
  height: auto;
  display: inline-block;
}



/* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 80vh;
    overflow-y: auto;
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

                      $ctr = substr($row['assignnumber'],10,3);
                      $nxtcnt = (int)$ctr + 1;
                      //$lastnum = 'PAR'.$curryear.$currmo.str_pad(substr($row['assignnumber'],10,3)+1,3,'0',STR_PAD_LEFT);
                      $lastnum = 'PAR'.$curryear.$currmo.str_pad($nxtcnt,3,'0',STR_PAD_LEFT);
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
            <?php 

               $row_num = 1;

            ?>
      
            <table id="assets_for_assignment" class="table table-bordered table-striped" >

                <thead class="bg-primary">
                  <tr>
                    <!-- <th>Row #</th> -->
                    <th>Asset Code</th>
                    <th>Asset Details</th>
                    <th>Unit of Measure</th>
                    <th>Purchase Date</th>
                    <th>Invoice No.</th>
                    <th>Supplier</th>
                  </tr>
                </thead>

                <tbody>
             
                   
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

<!-- -------- Select Assets Modal ------- -->

<div class="modal fade modal-dialog modal-lg" style="position:fixed;top:0%;left:20%" id="selectassets_modal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Select Assets to Assign</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="x">
          <span aria-hidden="true">×</span>
      </button>
    </div>

    <div class="modal-body">
      
        <table id="a4atable" class="table table-hover">
              <thead>
                <tr>
                    <th>Property No.</th>
                    <th>Description</th>
                    <th>Serial No.</th>
                    <th>Invoice No.</th>
                    <th class="d-none d-xl-table-cell">Purchase Date</th>
                   
                </tr>
              </thead>
              <tbody>

                <?php 
                  $d_arr[0] = "Unset";
                  $c_arr[0] = "Unset";
               
          $asset_qry = $conn->query("SELECT asset_code, asset_name, serial_number, invoice_number, purchase_date FROM assets where status='Unassigned'") or die($conn->error);
          while($row=$asset_qry->fetch_array()){
                   
        ?>

          <tr>
            <td><?php  echo  '<a href="#" class="asssignasset" data-id="'.$row['asset_code'].'" onclick="add_asset('.$row['asset_code'].')"  >'.$row['asset_code'].'</a>' ?></td>
            <td class="d-none d-xl-table-cell"><?php  echo $row['asset_name'] ?></td>
            <td><?php echo $row['serial_number'] ?></td>

            <td><?php  echo $row['invoice_number'] ?></td>
           
            <!-- <td>
              <center>
                    
                     <button class="btn btn-sm btn-outline-primary view_mr" title="View MR" data-id="<?php //echo $row['id']?>" type="button"><i class="fa fa-eye"></i></button>
                     <button class="btn btn-sm btn-outline-secondary edit_mr" title="Edit MR" data-id="<?php //echo $row['mrnumber']?>" type="button"><i class="fa fa-edit"></i></button>
                
              </center> 
            </td>   -->
          </tr>
          <?php  } ?>
                
              </tbody>


        </table>
 
    </div>

 
  </div> 
  </div>
</div>

<!----------------- end select assets modal   -----------------  -->



    
  <script type="text/javascript">
    $(document).ready(function(){
      $('#a4atable').dataTable({
        
      });
    });
  </script>
  <script type="text/javascript">
   
         
          
    function add_asset(asset_code){
      $('#selectassets_modal').modal('hide');
          
      
      $.ajax({
        url:"getassetinfo.php?asset_code="+asset_code ,
        type: 'get',
        dataType: 'html',
        success:function(response){
           $('#assets_for_assignment').append(response);
           
         
          }
       
       
      });
     
    }

    $(document).ready(function(){

      $('#add_asset_btn').click(function(){
         
          $('#selectassets_modal').modal('show');
      });
     
           

      $('#cancel_assign').click(function(){

        var btn = document.getElementById('myBtn');
        btn.addEventListener('click', function() {
         document.location.href = 'some/page';
          });
      });


      $('#save_assign').click(function(){
 
        var assign_number = document.getElementById('assign_number').value;
        var assign_date = document.getElementById('assign_date').value;
        var assignee_id = document.getElementById('assignee_id').value;
        if (assignee_id == ''){
          alert_toast('Select Assignee.');
          return;
        }
        if (assign_date == ''){
          alert_toast('Select Assignment Date.');

          return;
        }
        
     
        $('#assets_for_assignment').find('tr').each(function (i, el) {
            var $tds = $(this).find('td');
            var asset_code = parseInt($tds.eq(0).text());
                 
              if (!(isNaN(asset_code)))
              {
                //alert(asset_code);
                
                //start_load()
                $.ajax({
                    type: "POST",
                    url: "ajax.php?action=add_asset_assignment",
                    data: {
                        assign_number:assign_number,
                        assign_date:assign_date, 
                        assignee_id:assignee_id,
                        asset_code:asset_code
                    },
                    success: function(resp) {
                      //if(resp == 1){
                        
                          $.ajax({
                            type: "POST",
                            url: "ajax.php?action=update_unassigned_assets",
                            data: {
                                assign_number:assign_number,
                                assign_date:assign_date, 
                                assignee_id:assignee_id,
                                asset_code:asset_code
                            
                            },
                            success: function(resp) {
                            if(resp == 1){
                               
                               alert_toast("Asset(s) successfully assigned","success");
                               setTimeout(function(){
                               //location.reload();
                               location.href="assetassignment.php";

                               },1000)
                            }
                        
                            },
                            error: function(xhr, status, error) {
                            console.error(xhr);
                            alert_toast(error);
                            }

                          });

                       
                       
                      //}
                        
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                        //alert_toast(error);
                        setTimeout(function(){
                              location.reload();

                               },1000)
                    }
                });


              }
            
    
        });
      });
    });
    



    

    
  </script>