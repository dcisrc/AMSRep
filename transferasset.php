<style>

  .space {
  width: 50px;
  height: auto;
  display: inline-block;
}
</style>  

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


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
          
          <div class="card-body">
          <br>
          <form>   
          <div class="row">

          
            <div class="form-group col-md-3">
              <label>PAR No</label>
              <input type="text" name="par_number" id="par_number"  class="form-control text-left" disabled />
            </div> 
            <div class="form-group col-md-3">
              <label>Prev. Assignee</label>
              <input type="text" name="prvassignee_name" id="prvassignee_name"  class="form-control text-left" disabled />
              <input type="text" name="prevassignee_id" id="prevassignee_id" hidden />

               
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
                <button class="btn btn-secondary btn-sm btn-block col-md-6 float-right" type="button" id="add_transfer_btn" ><span class="fa fa-plus"></span> Select Property to Transfer </button>
              </div>
          </div>
          </form>
          <br>
          
          
            <table id="assets_for_transfer" class="table table-bordered table-striped" >

                <thead class="bg-primary">
                  <tr>
                   
                    <th>Asset Code</th>
                    <th>Asset Description</th>
                    <th>Unit of Measure</th>
                    <th>Purchase Date</th>
                    <th>Invoice No</th>
                    <th>Supplier</th>
                  </tr>
                </thead>

                <tbody>
             
                    <tr>
                                  
                  
                    </tr>
                
              </tbody>
            </table>
          </div>
           <div class="modal-footer" >
            <button class="btn btn-primary btn-sm save_selected" style="padding-left:30px" type="button" id="save_transfer" ></span> Save </button>
            <button class="btn btn-secondary btn-sm" style="padding-left:30px" type="button" id="cancel_transfer" onclick="window.location='assettransfers.php'">Cancel </button>
          </div>
          
        </div>

    </div>
</div>        

</main>

<!-- -------- Select Assignment Modal ------- -->

<div class="modal fade modal-dialog modal-lg" style="position:fixed;top:0%;left:20%" id="selectassignment_modal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Select Assignment</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="x">
          <span aria-hidden="true">×</span>
      </button>
    </div>

    <div class="modal-body">
      
        <table id="assignment_list_table" class="table table-hover">
              <thead>
                <tr>
                    <th>PAR/PTR No.</th>
                    <th class="d-none d-xl-table-cell">PAR/PTR Date</th>
                    <th>Assignee</th>
             
                </tr>
              </thead>
              <tbody>

                <?php 
                  $d_arr[0] = "Unset";
                  $c_arr[0] = "Unset";
               
                  $asset_qry = $conn->query("SELECT distinct  assignnumber, assigndate, concat(e.lastname , ', ', e.firstname)  as assignee , d.name as department, assign_status FROM assetassignment aa LEFT JOIN assets a on aa.assetcode = a.asset_code LEFT JOIN employee e on aa.employee_id=e.id LEFT JOIN department d on e.department_id = d.id WHERE assign_status='Active'") or die($conn->error);
                  while($row=$asset_qry->fetch_array()){
                     $assignnumber = $row['assignnumber'];
                   
                ?>
                <tr>
      
                  <td><?php  echo  '<a href="#" class="transferasset" data-id="'.$row['assignnumber'].'"  >'.$row['assignnumber'].'</a>' ?></td>
                  <td class="d-none d-xl-table-cell"><?php  echo $row['assigndate'] ?></td>
                  <td><?php  echo $row['assignee'] ?></td>
           
       
                </tr>
                <?php  } ?>
              </tbody>
        </table>

        <table id="assets_for_selection" class="table table-bordered table-striped" >

                <thead class="bg-primary">
                  <tr>
                   
                    <th>Asset Code</th>
                    <th>Asset Description</th>
                    <th>Purchase Amount</th>
                    <th>Date Acquired</th>
                    <th>Condition</th>
                  </tr>
                </thead>

                <tbody>
             
                    <tr>
                                  
                  
                    </tr>
                
              </tbody>
               Note: Unselected assets/property will be automatically lodged as unassigned.
        </table>

 
    </div>
 
  </div> 
  </div>
</div>

<!----------------- end select assignment modal   -----------------  -->

    
  <script type="text/javascript">
    $(document).ready(function(){
      $('#table').DataTable();
    });
  </script>


  <script type="text/javascript">

   function select_asset(asset_code)
    {
       $('#selectassignment_modal').modal('hide');
       $.ajax({
         url:"getassetinfo.php?asset_code="+asset_code ,
         type: 'get',
         dataType: 'html',
         success:function(response){
            $('#assets_for_transfer').append(response);
         
           }
       });
    }

  </script>  

  <script type="text/javascript">

    $('.transferasset').click(function(){
      
      var $assignnumber=$(this).attr('data-id');
      $('#assignment_list_table').hide();
      $("#assets_for_selection tbody tr").remove();

      $.ajax({
        url:"getassignedassets.php?assignnumber="+$assignnumber ,
        type: 'get',
        dataType: 'json',
        success:function(response){
       
          var data = response;
          var html = '';
          $('#par_number').val(data[0].assignnumber);
          $('#prvassignee_name').val(data[0].assignee);
          $('#prevassignee_id').val(data[0].employee_id)
          for(var i=0;i<data.length;i++)
          {
            html += '<tr>';
            html += '<td><a href="#" class="select_asset" id="select_asset" onclick="select_asset('+ data[i].assetcode +')" data-id="'+ data[i].assetcode + '">' + data[i].assetcode + '</a>' +'</td><td>'+data[i].asset_name+'</td><td>'+data[i].purchase_amount+'</td><td>'+data[i].purchase_date+'</td><td>'+data[i].condition+'</td>';
            html += '</tr>'
          }  
          $('#assets_for_selection').append(html);
 
        }
    });

 
  });




    $(document).ready(function(){

      $('#add_transfer_btn').click(function(){
       
          $('#selectassignment_modal').modal('show');
      });
          
      $('#save_transfer').click(function(){
    
        var par_number = document.getElementById('par_number').value;
        var ptrdate = document.getElementById('ptrdate').value;
        var assignee_id = document.getElementById('assignee_id').value;
        var prevassignee_id = document.getElementById('prevassignee_id').value;
        var ptr_number  = document.getElementById('ptr_number').value;

        
        if (assignee_id == ''){
          alert_toast('Select New Assignee.');
          return;
        }
        if (ptrdate == ''){
          alert_toast('Select Transfer Date.');

          return;
        }

        $('#assets_for_transfer').find('tr').each(function (i, el) {
            var $tds = $(this).find('td');
            var asset_code = parseInt($tds.eq(0).text());
             
            if (!(isNaN(asset_code)))
            {
             
                //start_load()
                $.ajax({
                    type: "POST",
                    url: "ajax.php?action=add_asset_transfer",
                    data: {
                        par_number:par_number,
                        ptr_number:ptr_number, 
                        ptrdate:ptrdate, 
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
                                par_number:par_number,
                                asset_code:asset_code
                            
                           },
                           success: function(resp) {
                           if(resp == 1){
                               
                               alert_toast("Asset(s) successfully transferred","success");
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