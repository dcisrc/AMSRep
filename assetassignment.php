
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
            <h5 class="card-title mb-0">Assigned Assets</h5>
            <button class="btn btn-primary btn-sm btn-block col-md-3 float-right" type="button" id="new_asset_assign"><span class="fa fa-plus"></span> New Asset Assignment</button>
          </div>
          <div class="card-body">
            <table id="table" class="table table-hover">
                <thead>
                  <tr>
                    <th>PAR No.</th>
                    <th class="d-none d-xl-table-cell">PAR Date</th>
                    <th>Assignee</th>
                    <th class="d-none d-xl-table-cell">Department</th>
                    <th>Status</th>
                    <th>Action</th>
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
  
          $asset_qry = $conn->query("SELECT distinct  assignnumber, assigndate, concat(e.lastname , ', ', e.firstname)  as assignee , d.name as department, assign_status FROM assetassignment aa LEFT JOIN assets a on aa.assetcode = a.asset_code LEFT JOIN employee e on aa.employee_id=e.id LEFT JOIN department d on e.department_id = d.id WHERE assign_mode='Purchase'") or die($conn->error);
          while($row=$asset_qry->fetch_array()){
                   
        ?>

          <tr>
            <td><?php echo $row['assignnumber'] ?></td>
            <td class="d-none d-xl-table-cell"><?php echo $row['assigndate'] ?></td>

            <td><?php echo $row['assignee'] ?></td>
            <td class="d-none d-xl-table-cell"><?php echo $row['department'] ?></td>
            <td>
                <?php if($row['assign_status']=="Active")           { echo '<span class="badge bg-success">';} 
                      else                                        { echo '<span class="badge bg-danger">';} ?>  


              <?php echo $row['assign_status'] ?></td>
            
            
            <td>
              <center>
                    
                     <button class="btn btn-sm btn-outline-primary view_assign" title="View" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-eye"></i></button>
                     <button class="btn btn-sm btn-outline-secondary edit_assign" title="Edit" data-id="<?php echo $row['assignnumber']?>" type="button"><i class="fa fa-edit"></i></button>
                     <button class="btn btn-sm btn-outline-success print_mr" title="Print MR" data-id="<?php echo $row['assignnumber']?>" type="button"><i class="fa fa-print"></i></button>
                     <!-- <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split btn-outline-success " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i>&nbsp;&nbsp;</button>
                      <span class="sr-only">Toggle Dropdown</span>
                    
                      <div class="dropdown-menu">
                        <a class="dropdown-item print_mr" href="javascript:void(0)" data-id = '<?php echo $row['assignnumber'] ?>'>MR</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item print_ics" href="javascript:void(0)" data-id = '<?php echo $row['assignnumber'] ?>'>ICS</a>
                   
                      </div> -->
                     <button class="btn btn-sm btn-outline-info cancel_assign" title="Cancel" data-id="<?php echo $row['assignnumber']?>" type="button"><i class="fa fa-redo"></i></button>
                     <button class="btn btn-sm btn-outline-danger remove_assign" title="Delete" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash"></i></button>
              </center> 
          </tr>
          <?php } ?>
                    
        </tbody>
  </table>
 
</div>

</main>




    
    
  <script type="text/javascript">
    $(document).ready(function(){
      $('#table').DataTable();
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){

    
 
      
      $('#new_asset_assign').click(function(){
        location.href="assignasset.php"
      });
      
      $('.print_mr').click(function(){
        var $parnumber=$(this).attr('data-id');
        location.href="/ams/forms/par.php?parnumber="+$parnumber+"";
      });
      $('.print_ics').click(function(){
        var $mrnumber=$(this).attr('data-id');
        location.href="ics.php?mrnumber="+$mrnumber+"";
      });

       $('.edit_assign').click(function(){
        var $assignnumber=$(this).attr('data-id');
        location.href="editassignment.php?assignnumber="+$assignnumber;
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
      });
    };
  </script>