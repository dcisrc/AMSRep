
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
    width: 260px;
    text-align: left;
  

}

button.nav-item:hover, .nav-item.active {
    background-color: #000000ad;
    color: #fffafa;
    }
.fa-caret-down {
  float: right;
  padding-right: 1px;
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

?>
<nav class="sidebar card py-2 mb-4 mx-lt-5 bg-dark" id="sidebar">
<div class="sidebar-list">
  <li class="nav-item">
    <a class="nav-link nav-item" href="home.php"><span class='icon-field'><i class="fa fa-home"></i></span> Home </a>
  </li>
 <li class="nav-item has-submenu">
    <a class="nav-link nav-item" href="#"><span class='icon-field'><i class="fa fa-chart-bar"></i></span> Assets <i class="fa fa-caret-down"></i></a>
 <ul class="submenu collapse">
  <li class="nav-item">
    <a class="nav-link nav-item" href="assetsmasterlist.php"><span class='icon-field'><i class="fa fa-keyboard"></i></span> Asset Masterlist </a>
  </li>
  <li class="nav-item">
    <a class="nav-link nav-item" href="assetassignment.php"><span class='icon-field'><i class="fa fa-hand-lizard"></i></span> Asset Assignment </a>
  </li>
  <li class="nav-item">
    <a class="nav-link nav-item" href="category.php"><span class='icon-field'><i class="fa fa-object-group"></i></span> Asset Categories </a>
  </li>
  <li class="nav-item">
    <a class="nav-link nav-item" href="inventory.php"><span class='icon-field'><i class="fa fa-barcode"></i></span> Asset Inventory</a>
  </li>
  <li class="nav-item">
    <a class="nav-link nav-item" href="assettransfers.php"><span class='icon-field'><i class="fa fa-luggage-cart"></i></span> Asset Transfer/Return </a>
  </li>
 </ul>
  <li class="nav-item">
    <a class="nav-link nav-item" href="suppliesmasterlist.php"><span class='icon-field'><i class="fa fa-store"></i></span> Supplies Masterlist </a>
  </li>
  <li class="nav-item">
    <a class="nav-link nav-item" href="employee.php"><span class='icon-field'><i class="fa fa-user-circle"></i></span> Employees</a>
  </li>
  <li class="nav-item">
    <a class="nav-link nav-item" href="department.php"><span class='icon-field'><i class="fa fa-building"></i></span> Departments</a>
  </li>
  <li class="nav-item">
    <a class="nav-link nav-item" href="office.php"><span class='icon-field'><i class="fa fa-building"></i></span> Offices</a>
  </li>
  <li class="nav-item">
    <a class="nav-link nav-item" href="location.php"><span class='icon-field'><i class="fa fa-map-marker"></i></span> Locations </a>
  </li>
  <li class="nav-item">
    <a class="nav-link nav-item" href="fundcluster.php"><span class='icon-field'><i class="fa fa-money-bill-wave"></i></span> Fund Clusters </a>
  </li>
  <!--li class="nav-item">
    <a class="nav-link nav-item" href="#"><span class='icon-field'><i class="fa fa-object-group"></i></span> Asset Types </a>
  </li>-->

  <li class="nav-item has-submenu">
    <a class="nav-link nav-item" href="#"><span class='icon-field'><i class="fa fa-chart-bar"></i></span> Reports <i class="fa fa-caret-down"></i></a>
    <ul class="submenu collapse">
      <li><a class="nav-link nav-item sepc" id="sepc" href="#">Employee Ledger Card</a></li>
      <li><a class="nav_link nav-item" id="rpcppe" href="#">Physical Count of PPE</a></li>
      <li><a class="nav_link nav-item" id="iirup1" href="#">IIRUP</a></li>
      <li><a class="nav_link nav-item" id="wmr" href="#">Waste Material Report</a></li>
      <li><a class="nav-link nav-item" href="reports/assetperemployee.php"> Assets Per Employee</a></li>
      <li><a class="nav-link nav-item" href="reports/assetpercategory.php"> Assets Per Category</a></li>
      <li><a class="nav-link nav-item" href="reports/assetperdepartment.php"> Assets Per Dept. </a></li>
      <!-- <li><a class="nav-link nav-item" href="unserviceableassets.php"> List of Unserviceable Property </a> </li> -->
      <!-- <li><a class="nav-link nav-item" href="unlocatedassets.php"> List of Unlocated Items </a> </li> -->
      <li><a class="nav-link nav-item" href="reports/activitylogs.php"> Activity Logs </a> </li>
      <li><a class="nav-link nav-item" href="forms/barcodestickers.php"> Barcode Stickers </a> </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link nav-item" href="roles.php"><span class='icon-field'><i class="fa fa-life-ring"></i></span> User Roles </a>
  </li>
 <!--  <li class="nav-item">
    <a class="nav-link nav-item" href="index.php?page=rolepermission"><span class='icon-field'><i class="fa fa-hard-hat"></i></span> Role Permissions </a>
  </li> -->

  <li class="nav-item">
    <a class="nav-link nav-item" href="users.php"><span class='icon-field'><i class="fa fa-user"></i></span> User Maintenance </a>
  </li>
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
      <div class="row" style="float:right;">
      <div class="input-group" >
          <div class="form-outline">
            <input type="search" placeholder="Search Employee" id="search_text" class="form-control" />
   
          </div>
          <button type="button" id= "gosearch" class="btn btn-primary">
            <i class="fas fa-search"></i>
          </button>
          
      </div>
      </div>
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
      <!-- <div class="row">
        <table id="table" class="table table-hover">
          
        </select>
              <thead>
                <tr>
                  <th>Select Category</th>
                  
                </tr>
              </thead>
              <tbody >

                <?php 

                  //$i = 1;
                  //$category = $conn->query("SELECT * FROM category order by id asc");
                  //while($row=$category->fetch_assoc()):
                  //  $catid=$row['id'];
                  //  $catname=$row['name'];


                  //  echo '<tr>';
                  //  echo  '<td><a href="reports/rpcppe.php?catid='.$catid.'">'. $catname .'</a></td>';
                  
                  //  echo '</tr>';


                ?>
                
                <?php //endwhile; ?>
                
              </tbody>


        </table> 
 
      </div>    --> 
   

      
 
    </div>
    <div class="modal-footer">
      <button class="btn btn-primary btn-sm save_selected" style="padding-left:30px" type="button" id="view_rpt" ></span> View </button>
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

  $('#sepc').click(function(){
        $('#uri').val('employeeledgercard');
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

