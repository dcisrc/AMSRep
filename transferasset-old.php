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

  $par = $_GET['par'];
?>


<main id="view-panel" >

<div class="container-fluid" >
    <div class="col-lg-12">

       <br />
        <br />
         
        <div class="card">
          
          <div class="card-body">
          <br>
          <form>   
          <div class="row">

            <?php
                  $qry = $conn->query("SELECT distinct e.id as empid, concat(e.lastname, ', ',e.firstname) as prevassignee FROM assetassignment aa LEFT JOIN employee e ON aa.employee_id = e.id WHERE assignnumber='".$par."' ORDER BY assignnumber");
                  if (mysqli_num_rows($qry) > 0)
                  {$row=$qry->fetch_array();
                      $empid = $row['empid'];
                      $prev_assignee = $row['prevassignee'];
                  }
                  



             ?>
            <div class="form-group col-md-3">
              <label>PAR No</label>
              <input type="text" name="mr_number" id="mr_number" value="<?php echo $par ?>" class="form-control text-left" disabled />
            </div> 
            <div class="form-group col-md-3">
              <label>Prev. Assignee</label>
              <input type="text" name="prvassignee_name" id="prvassignee_name" value="<?php echo $prev_assignee ?>" class="form-control text-left" disabled />
              <input type="text" name="prevassignee_id" id="prevassignee_id" value="<?php echo $empid ?>" />

               
            </div>  



          </div>  
          <div class="row">
           
              <div class="form-group col-md-3">
                <label>PTR No</label>

                <?php
                  $lastnum = '';
                  //get last mr number number used for the current year and month
                  $curryear = date('Y');
                  $currmo = date ('m');
                 
                  $qry = $conn->query("SELECT * FROM assetassignment WHERE assignnumber like 'PTR".$curryear.$currmo. "%' ORDER BY assignnumber  desc LIMIT 1");
                  if (mysqli_num_rows($qry) > 0)
                  {$row=$qry->fetch_assoc();
                     
                      $lastnum = 'PTR'.$curryear.$currmo.str_pad(substr($row['assignnumber'],8,2)+1,4,'0',STR_PAD_LEFT);
                    }
                  
                  else
                  {
                  $lastnum = 'PTR'.$curryear.$currmo.'0001';  
                  } 
                  $_SESSION['lastnum']=$lastnum;
         
                  echo '<input type="text" name="ptr_number" id="ptr_number" required="required" class="form-control text-left" disabled value="'.$lastnum.' " />'
                ?>    
               
      
              </div>
              <div class="form-group col-md-3">
                <label>New Assignee</label>
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

              <div class="form-group col-md-2">
                <label>Date</label>
                <input type="text" name="ptrdate" id="ptrdate"  required="required" class="form-control text-right" onfocus="(this.type='date')" step="any"  />
              </div>
             

              <div class="form-group col-md-3">
                <br>
                <button class="btn btn-secondary btn-sm btn-block col-md-6 float-right" type="button" id="add_asset_btn" ><span class="fa fa-plus"></span> Select Property to Transfer </button>
              </div>
          </div>
          </form>
          <br>
          
          
            <table id="assets_for_transfer" class="table table-bordered table-striped" >

                <thead class="bg-primary">
                  <tr>
                    <th>Select</th>
                    <th>Asset Code</th>
                    <th>Asset Description</th>
                    <th>Purchase Amount</th>
                    <th>Date Acquired</th>
                    <th>Condition</th>
                  </tr>
                </thead>

                <tbody>
               <!--  <?php
                  
                  $transfer_qry=$conn->query("SELECT assetcode, asset_name, concat(e.lastname, ', ',e.firstname) as prevassignee, serial_number, purchase_amount, purchase_date, status, mrdate, mr_status FROM assetassignment aa LEFT JOIN assets a ON aa.assetcode=a.asset_code LEFT JOIN employee e ON aa.employee_id = e.id WHERE mrnumber='".$par."' ORDER BY mrnumber") or die($conn->error);
                  if($transfer_qry->num_rows > 0){
                    while($row=$transfer_qry->fetch_array()){

                ?> -->
                    <tr>
                      <!--<td><input type="hidden" name="id" value="<?php echo isset($id) ? $id : "" ?>" /></td>-->
                     <!--  <td><input id="selectitem" type="checkbox" /></td>
                      <td><?php echo $row['assetcode']?></td>
                      <td><?php echo $row['asset_name'].'; S/N:'.$row['serial_number']?></td>
                      <td><?php echo $row['purchase_amount']?></td>
                      <td><?php echo $row['purchase_date']?></td>
                      <td><?php echo $row['status']?></td>  -->
                  
                  
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
            <button class="btn btn-primary btn-sm save_selected" style="padding-left:30px" type="button" id="save_transfer" ></span> Save </button>
            <button class="btn btn-secondary btn-sm" style="padding-left:30px" type="button" id="cancel_transfer" onclick="window.location='assettransfers.php'">Cancel </button>
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

        

      $('#cancel_assign').click(function(){

        var btn = document.getElementById('myBtn');
        btn.addEventListener('click', function() {
        document.location.href = 'some/page';
        });
      })


      $('#save_transfer').click(function(){
       

      
        var mr_number = document.getElementById('mr_number').value;
        var ptr_date = document.getElementById('ptrdate').value;
        var assignee_id = document.getElementById('assignee_id').value;
        var prevassignee_id = document.getElementById('prevassignee_id').value;
        var ptr_number  = document.getElementById('ptr_number').value;



        $('#assets_for_transfer').find('tr').each(function (i, el) {
            var $tds = $(this).find('td');
            var asset_code = parseInt($tds.eq(1).text());
                 
              if (!(isNaN(asset_code) && document.getElementById('selectitem').checked == true))
              {
                //alert(asset_code);
                
                //start_load()
                $.ajax({
                    type: "POST",
                    url: "ajax.php?action=add_asset_transfer",
                    data: {
                        mr_number:mr_number,
                        ptr_number:ptr_number, 
                        ptr_date:ptr_date, 
                        assignee_id:assignee_id,
                        prevassignee_id:prevassignee_id, 
                        asset_code:asset_code
                    },
                    success: function(resp) {
                      //if(resp == 1){
                        
                         $.ajax({
                           type: "POST",
                           url: "ajax.php?action=update_prevassigned_assets",
                           data: {
                               mr_number:mr_number, 
                               asset_code:asset_code
                            
                           },
                           success: function(resp) {
                           if(resp == 1){
                               
                               alert_toast("Asset successfully transferred","success");
                               setTimeout(function(){
                               //location.reload();
                               location.href="assettransfers.php";

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
                        alert_toast(error);
                        setTimeout(function(){
                              location.reload();

                               },1000)
                    }
                });


              }
            
    
        });
      });
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