
<style>
button.nav-item {
    position: relative;
    display: block;
    padding: .75rem 1.25rem;
    margin-bottom: -1px;
    border: 1px solid rgba(0,0,0,.125);
    background-color: #000000c4;
    color: #989898;
    font-weight: 300;
    width: 250px;
    text-align: left;
  

}

button.nav-item:hover, .nav-item.active {
    background-color: #000000ad;
    color: #fffafa;
    }
.fa-caret-down {
  float: right;
  padding-right: 8px;
  color: white;
}
.dropdown-container {
  display: none;
  background-color: #262626;
  padding-left: 8px;
  height:50px;
}

.sidebar li .submenu{ 
  list-style: none; 
  margin: 0; 
  padding: 0; 
//width: 500px;

  /*padding-left: 1rem; 
  padding-right: 1rem;*/
}

.sidebar {
   overflow-y: scroll;
}

.dataTables_filter{
  display:none;
}


</style>

<?php

  require_once('systemsettings.php');
  require_once('system_permission.php');

?>
<nav class="sidebar card py-2 mb-4 mx-lt-5 bg-dark" id="sidebar">
  
<div class="sidebar-list">
<ul class="nav flex-column" id="nav_accordion">
  <li class="nav-item">
    <a class="nav-link nav-item" href="home.php"><span class='icon-field'><i class="fa fa-home"></i></span> Home </a>
  </li>

  <?php
    if (checkPermissions($_SESSION['login_id'],10)=='true'){
    
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="assetsmasterlist.php"><span class="icon-field"><i class="fa fa-keyboard"></i></span> Asset Masterlist </a>
            </li>';
    } ?>

  <?php
    if (checkPermissions($_SESSION['login_id'],11)=='true'){
    
      echo ' <li class="nav-item">
            <a class="nav-link nav-item" href="assetassignment.php"><span class="icon-field"><i class="fa fa-hand-lizard"></i></span> Asset Assignment </a>
            </li> ';
    } ?>

  <?php
    if (checkPermissions($_SESSION['login_id'],4)=='true'){
    
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="category.php"><span class="icon-field"><i class="fa fa-object-group"></i></span> Asset Categories </a>
            </li>';
    } ?>

  <?php
    if (checkPermissions($_SESSION['login_id'],12)=='true'){
    
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="inventory.php"><span class="icon-field"><i class="fa fa-barcode"></i></span> Asset Inventory</a>
            </li>';

    } ?>
  <?php
    if (checkPermissions($_SESSION['login_id'],18)=='true'){
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="assettransfers.php"><span class="icon-field"><i class="fa fa-luggage-cart"></i></span> Asset Transfer/Return </a>
            </li>';
    } ?> 
  <?php
    if (checkPermissions($_SESSION['login_id'],13)=='true'){
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="suppliesmasterlist.php"><span class="icon-field"><i class="fa fa-keyboard"></i></span> Supplies Masterlist </a>
            </li>';
    } ?> 
  <?php
    if (checkPermissions($_SESSION['login_id'],14)=='true'){
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="suppliesdelivery.php"><span class="icon-field"><i class="fa fa-keyboard"></i></span> Supplies Delivery </a>
            </li>';
    } ?> 
  <?php
    if (checkPermissions($_SESSION['login_id'],15)=='true'){
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="suppliesissuance.php"><span class="icon-field"><i class="fa fa-keyboard"></i></span> Supplies Issuance </a>
            </li>';
     } ?>         
  <?php
    if (checkPermissions($_SESSION['login_id'],5)=='true'){
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="employee.php"><span class="icon-field"><i class="fa fa-user-circle"></i></span> Employees</a>
            </li>';
    } ?>
  <?php
    if (checkPermissions($_SESSION['login_id'],6)=='true'){
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="department.php"><span class="icon-field"><i class="fa fa-building"></i></span> Departments</a>
            </li>';
    } ?>
  <?php
    if (checkPermissions($_SESSION['login_id'],7)=='true'){
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="office.php"><span class="icon-field"><i class="fa fa-building"></i></span> Offices</a>
            </li>';
    } ?>
  <?php
    if (checkPermissions($_SESSION['login_id'],8)=='true'){
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="location.php"><span class="icon-field"><i class="fa fa-map-marker"></i></span> Locations </a>
            </li>';
    } ?>
    <?php
    if (checkPermissions($_SESSION['login_id'],29)=='true'){
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="notifications.php"><span class="icon-field"><i class="fa fa-envelope-open-text"></i></span> Notification Maintenance </a>
            </li>';
   } ?>     
  <?php
    if (checkPermissions($_SESSION['login_id'],9)=='true'){
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="fundcluster.php"><span class="icon-field"><i class="fa fa-money-bill-wave"></i></span> Fund Clusters </a>
            </li>';
   } ?>        
     
  <!--li class="nav-item">
    <a class="nav-link nav-item" href="#"><span class='icon-field'><i class="fa fa-object-group"></i></span> Asset Types </a>
  </li>-->
  <?php
    if (checkPermissions($_SESSION['login_id'],16)=='true'){
      echo '
        <li class="nav-item has-submenu">
          <a class="nav-link nav-item" href="#"><span class="icon-field"><i class="fa fa-chart-bar"></i></span> Reports <i class="fa fa-caret-down"></i></a>
          <ul class="submenu collapse">
            <li><a class="nav-link nav-item" href="reports/assetperemployee.php"> Assets Per Employee</a></li>
            <li><a class="nav-link nav-item" href="reports/assetpercategory.php"> Assets Per Category</a></li>
            <li><a class="nav-link nav-item" href="reports/assetperdepartment.php"> Assets Per Dept. </a></li>';
  ?>
  <?php
    if (checkPermissions($_SESSION['login_id'],20)=='true'){
      echo '<li><a class="nav-link nav-item sepc" id="sepc" href="#">Employee Ledger Card</a></li>';
  }?>     
  <?php
    if (checkPermissions($_SESSION['login_id'],21)=='true'){
      echo '<li><a class="nav_link nav-item" id="rpcppe" href="#">Physical Count of PPE</a></li>';
  }?>   
  <?php
    if (checkPermissions($_SESSION['login_id'],22)=='true'){    
       echo '<li><a class="nav_link nav-item" id="iirup1" href="#">IIRUP</a></li>';
  }?>     
  <?php
    if (checkPermissions($_SESSION['login_id'],23)=='true'){    
       echo '<li><a class="nav_link nav-item" id="wmr" href="#">Waste Material Report</a></li> ';
  }?>     
       <!-- <li><a class="nav-link nav-item" href="unserviceableassets.php"> List of Unserviceable Property </a> </li> -->
       <!-- <li><a class="nav-link nav-item" href="unlocatedassets.php"> List of Unlocated Items </a> </li> -->
  <?php
    if (checkPermissions($_SESSION['login_id'],27)=='true'){    
       echo '<li><a class="nav-link nav-item" href="reports/activitylogs.php"> Activity Logs </a> </li>';
  }?>   
  <?php
    if (checkPermissions($_SESSION['login_id'],28)=='true'){    
       echo '<li><a class="nav-link nav-item" href="forms/barcodestickers.php"> Barcode Stickers </a> </li>';
  }?>     
   <?php    
    echo '</ul>
  </li>';
   ?>
   <?php 
   } ?>  
<?php
    if (checkPermissions($_SESSION['login_id'],2)=='true'){
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="roles.php"><span class="icon-field"><i class="fa fa-life-ring"></i></span> User Roles </a>
        </li>';
    } ?>                
 <!--  <li class="nav-item">
    <a class="nav-link nav-item" href="index.php?page=rolepermission"><span class='icon-field'><i class="fa fa-hard-hat"></i></span> Role Permissions </a>
  </li> -->
<?php
    if (checkPermissions($_SESSION['login_id'],2)=='true'){
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="permission.php"><span class="icon-field"><i class="fa fa-thumbs-up"></i></span> Permission Maintenance </a>
            </li>';
    } ?>        

<?php
    if (checkPermissions($_SESSION['login_id'],1)=='true'){
      echo '<li class="nav-item">
            <a class="nav-link nav-item" href="users.php"><span class="icon-field"><i class="fa fa-user"></i></span> User Maintenance </a>
            </li>';
  } ?>           


</ul>
</div>
</nav>
<!-- -------- Select Employee Modal ------- -->

<div class="modal fade modal-dialog modal-lg" style="position:fixed;top:0%;left:20%;width:1250px" id="selemployee_modal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
     
        <h5 class="modal-title">Select Employee</h5>

        
        <button type="button" class="close" data-dismiss="modal" aria-label="x">
          <span aria-hidden="true">×</span>
        </button>
   
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
        <div class="input-group ">
        <div>
        
          <select class="form-select"  id="format" name="format" >
            
            <option value="PDF" >PDF</option> 
            <option value="PDF" >Excel</option> 
         
          </select>
        </div>
        </div>  
        </div>
        <div class="col-md-6">
        <div class="input-group float-right" >
          <div class="form-outline">
            <input type="search" placeholder="Search Employee" id="search_text" class="form-control" />
   
          </div>
          <button type="button" id= "gosearch" class="btn btn-primary">
            <i class="fas fa-search"></i>
          </button>
          
        </div>
        </div>
      </div>
      <br>
      <input type="hidden" id="uri" />
        <table id="table" class="table1 table-hover">
              <thead>
                <tr>
                  <th>Employee No</th>
                  <th>Employee Name</th>
                </tr>
              </thead>
              <tbody id="empsrch">
                
              </tbody>


        </table>
 
    </div>

 
  </div> 
  </div>
</div>

<!--------   Select Category & Date Modal   -------------->


<div class="modal fade modal-dialog modal-lg" style="position:fixed;top:0%;left:20%" id="selcategory_modal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Report on Physical Count of PPE</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="x">
          <span aria-hidden="true">×</span>
      </button>
    </div>

    <div class="modal-body">

      <div class="row">

      <div class="form-group col-md-12">
        
        
        <label>Category</label>
        <select class="custom-select browser-default sel2" id="category" name="category">
          <option value=""></option>
          <?php
            $category = $conn->query("SELECT * from category order by name asc");
            while($row=$category->fetch_assoc()):
          ?>
          <option value="<?php echo $row['id'] ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? "selected" :"" ?>><?php echo $row['name'] ?></option> 
          <?php endwhile; ?>
        </select>
      </div>

      </div>
      <div class="row">
        <div class="form-group col-md-12">
        <label>Cut-off Date</label>
        <input type="text" id="cut_off_date" name="cut_off_date" required="required" class="form-control text-right" onfocus="(this.type='date')" step="any" value="<?php echo date("m/d/Y") ?>" />
        </div>
      </div>
      
 
    </div>
    <div class="modal-footer">
      <button class="btn btn-primary btn-sm save_selected" style="padding-left:30px" type="button" id="view_excel" ></span> Export XLS </button>
      <button class="btn btn-primary btn-sm save_selected" style="padding-left:30px" type="button" id="view_rpt" ></span> View PDF </button>
      <button class="btn btn-secondary btn-sm" style="padding-left:30px" type="button" id="cancel_assign" onclick="window.location='assetassignment.php'">Cancel </button>
    </div>  

 
  </div> 
  </div>
</div>



<!------------------------------------------------->

<script>
  $(document).ready(function(){
    $('#table').DataTable({
        "paging": false

    });


  });

</script>


<script>

  $('#gosearch').click(function(){
    $search_text = $('#search_text').val();
    $uri = $('#uri').val();

    var response = '';
    $.ajax({
            type: "GET",
            url: "search_employee.php?search_text="+$search_text+"&uri="+$uri,
            dataType: "html",
            success: function(response) {
                //alert(response);
            $('#empsrch').html(response);
                if (response != 'Not Found!') {
                  
                  //$('#asset_status').prop('disabled',false);
                  //$('.modal-save').prop('disabled',false);
                }
              }
          });


    //alert('test');4
  });

   
    $('#view_rpt').click(function(){
 
        $catid=$('#category option:selected').val();
        $cutoff=$('#cut_off_date').val();
        window.location="reports/rpcppe.php?catid="+$catid+'&cutoff='+$cutoff;
    })

    $('#view_excel').click(function(){

 
        $catid=$('#category option:selected').val();
        $cutoff=$('#cut_off_date').val();
        window.location="reports/rpcppe_excel.php?catid="+$catid+'&cutoff='+$cutoff;
        
       
       
    });

  $('#sepc').click(function(){
        $('#uri').val('employeeledgercardLS');
        $('#selemployee_modal').modal('show');
    })

  $('#rpcppe').click(function(){
        $('#selcategory_modal').modal('show');
    })
  $('#iirup1').click(function(){
        $('#uri').val('iirup');
        $('#selemployee_modal').modal('show');
    })
  $('#wmr').click(function(){
        window.location="reports/wmr.php";
    })


</script>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
	var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
<script>
  document.addEventListener("DOMContentLoaded", function(){
  document.querySelectorAll('.sidebar .nav-link').forEach(function(element){
    
    element.addEventListener('click', function (e) {

      let nextEl = element.nextElementSibling;
      let parentEl  = element.parentElement;  

        if(nextEl) {
            e.preventDefault(); 
            let mycollapse = new bootstrap.Collapse(nextEl);
            
            if(nextEl.classList.contains('show')){
              mycollapse.hide();
            } else {
                mycollapse.show();
                // find other submenus with class=show
                var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                // if it exists, then close all of them
                if(opened_submenu){
                  new bootstrap.Collapse(opened_submenu);
                }
            }
        }
    }); // addEventListener
  }) // forEach
}); 
// DOMContentLoad
</script>

