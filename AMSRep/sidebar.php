<!DOCTYPE html>
<html lang="en">


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
</style>



		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          		<span class="align-middle">AMS</span>
        	</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="index.html">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-profile.html">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-in.html">
              <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-up.html">
              <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign Up</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-blank.html">
              <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
            </a>
					</li>

					<li class="sidebar-header">
						Tools & Components
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-buttons.html">
              <i class="align-middle" data-feather="square"></i> <span class="align-middle">Buttons</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-forms.html">
              <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-cards.html">
              <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-typography.html">
              <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="icons-feather.html">
              <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
            </a>
					</li>

					<li class="sidebar-header">
						Plugins & Addons
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="charts-chartjs.html">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
            </a>
					</li>

					<li class="nav-item has-submenu">
						<a class="nav-link nav-item" href="#">
              				<i class="align-middle" data-feather="printer"></i> <span class="align-middle">Reports</span>
            			</a>
					</li>
					<ul class="submenu collapse">
      <li><a class="nav-link nav-item " href="assetperemployee.php"> List of Assets Per Employee</a></li>
      <li><a class="nav-link nav-item " href="assetpercategory.php"> List of Assets Per Category</a></li>
      <li><a class="nav-link nav-item" href="assetperdepartment.php"> List of Assets Per Department </a></li>
      <li><a class="nav-link nav-item" href="unserviceableassets.php"> List of Unserviceable Property </a> </li>
      <li><a class="nav-link nav-item" href="unlocatedassets.php"> List of Unlocated Items </a> </li>
      <li><a class="nav-link nav-item" href="activitylogs.php"> Activity Logs </a> </li>
      <li><a class="nav-link nav-item" href="barcodestickers.php"> Barcode Stickers </a> </li>
    </ul>
				</ul>

				
			</div>
		</nav>



	<script src="js/app.js"></script>
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

	

