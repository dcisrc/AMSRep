

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

 
<main id="view-panel" >

<div class="container-fluid" >
    <div class="col-lg-12">
        
        <br />
        <br />
        <div class="card flex-fill">
          <div class="card-header">
            <div class="row">
            <div class="col-md-8">
              <h5 class="card-title mb-0"A>Transferred / Returned Assets</h5>

            
            </div>
            <div class="col-md-2" >
              <button class="btn btn-primary btn-sm btn-block  float-right" type="button" id="new_asset_return"><span class="fa fa-backward"></span> New Asset Return</button>
            </div>
            <div class="col-md-2" >
              <button class="btn btn-primary btn-sm btn-block float-right" type="button" id="new_property_transfer"><span class="fa fa-redo"></span> New Asset Transfer</button>
            </div>  
            
          </div>
          
               
          </div>
         
          <div class="card-body">
            <table id="table" class="table table-hover ">
                <thead>
                   <th>PTR No.</th>
                    <th class="d-none d-xl-table-cell">PTR Date</th>
                    <th>Assignee</th>
                    <th class="d-none d-xl-table-cell">Department</th>
                    <th>Prev. PAR No.</th>
                    <th>Prev. Assignee</th>
                    <th>Action</th>
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
  
           $asset_qry = $conn->query("SELECT distinct  assignnumber, assigndate, concat(e.lastname , ', ', e.firstname)  as assignee , d.name as department, assign_status, prevassignnumber FROM assetassignment aa LEFT JOIN assets a on aa.assetcode = a.asset_code LEFT JOIN employee e on aa.employee_id=e.id LEFT JOIN department d on e.department_id = d.id WHERE assign_mode='Transfer'") or die($conn->error);
          while($row=$asset_qry->fetch_array()){
                   
        ?>

          <tr>
             <td><?php echo $row['assignnumber'] ?></td>
            <td class="d-none d-xl-table-cell"><?php echo $row['assigndate'] ?></td>

            <td><span class="badge bg-success"><?php echo $row['assignee'] ?></span></td>
            <td class="d-none d-xl-table-cell"><?php echo $row['department'] ?></td>
            <td class="d-none d-xl-table-cell"><?php echo $row['prevassignnumber'] ?></td>
            <td class="d-none d-xl-table-cell"><?php //echo $row['prevassignee'] ?></td>
             
            
            <td>
              <center>
                   
              
                     <button class="btn btn-sm btn-outline-secondary edit_ptr" title="Edit PTR" data-id="<?php echo $row['assignnumber']?>" type="button"><i class="fa fa-edit"></i></button>
                     <button class="btn btn-sm btn-outline-success print_ptr" title="Print PTR" data-id="<?php echo $row['assignnumber']?>" type="button"><i class="fa fa-print"></i></button> 
                     
                     <button class="btn btn-sm btn-outline-info cancel_mr" title="Cancel PTR" data-id="<?php echo $row['assignnumber']?>" type="button"><i class="fa fa-redo"></i></button>
                     <button class="btn btn-sm btn-outline-danger remove_mr" title="Delete PTR" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash"></i></button>
              </center> 
            </td>
          </tr>
          <?php } ?>
                    
        </tbody>
  </table>
 
</div>

</main>  


  
  <script type="text/javascript">
  
      $('#new_property_transfer').click(function(){
         // $('#selectassignment_modal').modal('show');
         location.href = "transferasset.php";
      })



       $('.transferasset').click(function(){
          var $par=$(this).attr('data-id');
          location.href = "transferasset.php?par="+$par;
      })

      $('.print_ptr').click(function(){
        var $ptrnumber=$(this).attr('data-id');
        location.href="/ams/forms/ptr.php?ptrnumber="+$ptrnumber+"";
      });
 
  </script>