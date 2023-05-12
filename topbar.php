<?php 

include ('systemsettings.php');

?>

<head>
 <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

  <link rel="canonical" href="https://demo-basic.adminkit.io/" />


  <link href="css/app.css" rel="stylesheet">
 
<style>
    @media (max-width: 1026px) {
        .hidden-md {
            display: none;
        }
    }

  @media (min-width: 1025px) {
        .hidden-lg{
            display: none;
        }
    }
  
</style>
  
  <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet"> -->
</head>
<nav class="navbar navbar-expand fixed-top bg-primary navbar-bg">
      <a class="sidebar-brand" style="height:40px;width:250px;padding-top: 0px;margin-top:0px" href="index.php">
        <h1 style='color:blue;font-weight: bold'><span class="align-middle"><?php echo $_SESSION['system_info']['company_short_name']?></span></h1>
      </a>
      <a class="sidebar-toggle js-sidebar-toggle hidden-lg">
        <i class="hamburger align-self-center"></i>
      </a>
      <div class="col-md-4 float-left hidden-md" style="color:white!important">
        <large><b><h2 style="color:white;white-space:nowrap;"><?php echo $_SESSION['system_info']['system_name'] ?></h2></b></large>
      </div>
       

        <div class="navbar-collapse collapse">
          <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
              <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                <div class="position-relative">
                  <i class="align-middle  fa fa-bell text-white" ></i>
                  <span class="indicator secondary">4</span>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown" id="alertsList">
                <div class="dropdown-menu-header">
                  4 New Notifications
                </div>
                <div class="list-group1">
                  <a href="#" class="list-group-item">
                    <div class="row g-0 align-items-center">
                      <div class="col-2">
                        <i class="text-danger" data-feather="alert-circle"></i>
                      </div>
                      <div class="col-10">
                        <div class="text-dark">Update completed</div>
                        <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                        <div class="text-muted small mt-1">30m ago</div>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="list-group-item">
                    <div class="row g-0 align-items-center">
                      <div class="col-2">
                        <i class="text-warning" data-feather="bell"></i>
                      </div>
                      <div class="col-10">
                        <div class="text-dark">Lorem ipsum</div>
                        <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
                        <div class="text-muted small mt-1">2h ago</div>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="list-group-item">
                    <div class="row g-0 align-items-center">
                      <div class="col-2">
                        <i class="text-primary" data-feather="home"></i>
                      </div>
                      <div class="col-10">
                        <div class="text-dark">Login from 192.186.1.8</div>
                        <div class="text-muted small mt-1">5h ago</div>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="list-group-item">
                    <div class="row g-0 align-items-center">
                      <div class="col-2">
                        <i class="text-success" data-feather="user-plus"></i>
                      </div>
                      <div class="col-10">
                        <div class="text-dark">New connection</div>
                        <div class="text-muted small mt-1">Christina accepted your request.</div>
                        <div class="text-muted small mt-1">14h ago</div>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="dropdown-menu-footer">
                  <a href="#" class="text-muted">Show all notifications</a>
                </div>
              </div>
            </li>
            <!-- <li class="nav-item dropdown">
              <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                <div class="position-relative">
                  <i class="align-middle fa fa-comments text-white" ></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown" id="messagesList">
                <div class="dropdown-menu-header">
                  <div class="position-relative">
                    4 New Messages
                  </div>
                </div>
                <div class="list-group">
                  <a href="#" class="list-group-item">
                    <div class="row g-0 align-items-center">
                      <div class="col-2">
                        <img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                      </div>
                      <div class="col-10 ps-2">
                        <div class="text-dark">Vanessa Tucker</div>
                        <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
                        <div class="text-muted small mt-1">15m ago</div>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="list-group-item">
                    <div class="row g-0 align-items-center">
                      <div class="col-2">
                        <img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="William Harris">
                      </div>
                      <div class="col-10 ps-2">
                        <div class="text-dark">William Harris</div>
                        <div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
                        <div class="text-muted small mt-1">2h ago</div>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="list-group-item">
                    <div class="row g-0 align-items-center">
                      <div class="col-2">
                        <img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Christina Mason">
                      </div>
                      <div class="col-10 ps-2">
                        <div class="text-dark">Christina Mason</div>
                        <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
                        <div class="text-muted small mt-1">4h ago</div>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="list-group-item">
                    <div class="row g-0 align-items-center">
                      <div class="col-2">
                        <img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
                      </div>
                      <div class="col-10 ps-2">
                        <div class="text-dark">Sharon Lessman</div>
                        <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
                        <div class="text-muted small mt-1">5h ago</div>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="dropdown-menu-footer">
                  <a href="#" class="text-muted">Show all messages</a>
                </div>
              </div>
            </li> -->
            <li class="nav-item dropdown" id="userdrop">
              <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

              <a class="nav-link dropdown-toggle d-none d-sm-inline-block logged-user" href="#" data-bs-toggle="dropdown">
                <img src="img/icons/person.jpg" class="avatar img-fluid rounded me-1" /><!-- <span class="text-white"><?php //echo $_SESSION['login_name'] ?></span> -->
                 <span class="text-white"><?php echo $_SESSION['login_name'] ?></span>&nbsp;&nbsp;<span class="ml-6 font-italic hidden-md hidden-xs"><?php echo $_SESSION['login_role_name'] ?></span>
                
              </a>

              <div class="dropdown-menu dropdown-menu-end user" id="user">
   
                <a class="dropdown-item" href="#" id="changepwdbutton"></i> Change Password</a>
                <!-- <i class="align-middle me-1" data-feather="settings"> -->
               
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="ajax.php?action=logout">Log out</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
<!-- <script src="js/app.js"></script> -->
<script type="text/javascript">
$(document).ready(function(){

      
      $('.logged-user').click(function(){
        document.getElementById("user").classList.toggle("show");
        //alert('test');
        
      });


      $('.dropdown-toggle').mouseleave(function(){
        document.getElementById("user").classList.toggle("hide");
        //alert('test');
        
      });
      $('#alertsDropdown').click(function(){
        document.getElementById("alertsList").classList.toggle("show");
        //alert('test');
        
      });
      $('#messagesDropdown').click(function(){
        document.getElementById("messagesList").classList.toggle("show");
        //alert('test');
        
      });
       $('#changepwdbutton').click(function(){
     
        uni_modal("Change Password","changepassword.php");
      })

    });
</script>
