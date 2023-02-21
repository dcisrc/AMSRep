
<?php 
  session_start();
  //require_once('startsession.php');
  if(!isset($_SESSION['login_id']))
    header('location:login.php');
  include('db_connect.php');

  include('header.php');
  include ('topbar.php'); 
  include ('navbar.php'); 
  include ('utils.php');
?>

    

<html lang="en">
    <head>        
        <style type="text/css">
             
              h1{
                font-size: 43px;
              }

               /*for scrollbar*/
               .fixed-panel {
                  min-height: 10px;
                  max-height: 300px;
                  overflow-y: scroll;
                    }
                    /* width */
                    ::-webkit-scrollbar {
                        width: 8px;
                    }

                    /* Track */
                    ::-webkit-scrollbar-track {
                        box-shadow: inset 0 0 5px grey; 
                        border-radius: 10px;
                    }

                    /* Handle */
                    ::-webkit-scrollbar-thumb {
                        background: #d6d6c2; 
                        border-radius: 10px;
                    }
                     /*end for scrollbar*/
        </style> 
  	
<style>


  @media (min-width: 900px) {
  .container {
     padding-top:10px;
     width: 100%;
     margin-left: 30px;
     padding-left: 200px;
   
    }

  body {
    margin-top:68px;
    width: 100%;
   
     
    }



  }

  @media (max-width: 800px) {
  .container {
    padding-left:10px;
    padding-top:10px;
    margin-left: 0px;
    }
      
    body {
     padding:0px;
     margin-top:68px;
     margin-left: 0px;
      }
  
    /*.navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top {
      margin-left: 0;
      margin-right: 0;
      margin-bottom:0;
      }*/
   
  }

</style>  

          <link rel="preconnect" href="https://fonts.gstatic.com">
          <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
	 <!--        <link rel="canonical" href="https://demo-basic.adminkit.io/" /> -->
    <!--       <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet"> -->
 <!--  <link href="css/app.css" rel="stylesheet"> -->
 
</head>    
             
 
		<?php

        $sql = "SELECT  Sum(purchase_amount) as total_assets FROM assets WHERE `condition`='Serviceable' ";
        $query = $conn->query($sql);
        while ($row=$query->fetch_assoc()){
            $total = $row['total_assets']/1000000;}
       

        $sql = "SELECT count(*) as tot_count FROM assets where `condition`='Serviceable' ";
        $query = $conn->query($sql);
        while ($row=$query->fetch_assoc()){
            $active = $row['tot_count'];
        }

        $sql = "SELECT count(*) as tot_count FROM assets where `condition`<>'Serviceable' or `condition`<>'Not used since purchase' or `condition`<>'For Repair' ";
        $query = $conn->query($sql);
        while ($row=$query->fetch_assoc()){
            $inactive = $row['tot_count'];
        }

        $sql = "SELECT l.name as location, count(*) as countperloc FROM assets a LEFT JOIN location l ON a.location_id=l.id where (`condition`<>'Serviceable' or `condition`<>'Not used since purchase' or `condition`<>'For Repair') and status='Assigned' GROUP BY location";
        $query = $conn->query($sql);
        while ($row=$query->fetch_array()){
            
            $count[] = $row['countperloc'];
            $location[] = $row['location'];
            //$words = preg_split("/\s+/",$row['location'] );
            //$acronym = "";
            //foreach ($words as $w){
            //  $acronym .= mb_substr($w, 0, 1);

            //} 
        }   //$acron[] = $acronym;

    ?>
<main id="view-pane" class="content" >
    <!-- <main class="content"> -->
        <div class="container"> <!--"container-fluid col-lg-12">   style="padding-left:30px;padding-top:30px;padding-bottom: 30px"> -->

          <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

          <div class="row">
            <div class="col-xl-6 col-xxl-6 d-flex">
              <div class="w-100">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col mt-0">
                            <h5 class="card-title">Active Assets</h5>
                          </div>

                          <div class="col-auto">
                            <div class="stat text-primary">
                              <i class="align-middle fa fa-truck" data-feather="truck"></i>
                            </div>
                          </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?php echo $active ?></h1>
                        <div class="mb-0">
                          <span class="text-primary"> <i class="mdi mdi-arrow-bottom-right"></i> +3.65% </span>
                          <span class="text-muted">Since last week</span>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col mt-0">
                            <h5 class="card-title">Disposal Value</h5>
                          </div>

                          <div class="col-auto">
                            <div class="stat text-primary">
                              <i class="align-middle fa fa-truck-loading" data-feather="users"></i>
                            </div>
                          </div>
                        </div>
                        <h1 class="mt-1 mb-3">14.212</h1>
                        <div class="mb-0">
                          <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
                          <span class="text-muted">Since last week</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col mt-0">
                            <h5 class="card-title">Total Asset Value</h5>
                          </div>

                          <div class="col-auto">
                            <div class="stat text-primary">
                              <i class="align-middle fa fa-money-bill" data-feather="dollar-sign"></i>
                            </div>
                          </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?php echo $total.'M' ?></h1>
                        <div class="mb-0">
                          <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
                          <span class="text-muted">Since last week</span>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col mt-0">
                            <h5 class="card-title">Unserviceable</h5>
                          </div>

                          <div class="col-auto">
                            <div class="stat text-primary">
                              <i class="align-middle fa fa-heart-broken" data-feather="shopping-cart"></i>
                            </div>
                          </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?php echo $inactive ?></h1>
                        <div class="mb-0">
                          <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
                          <span class="text-muted">Since last week</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 col-lg-5 col-xxl-6 d-flex">
              <div class="card flex-fill w-100">
                <div class="card-header">

                  <h5 class="card-title mb-0">Assets per Location</h5>
                </div>
                <div class="card-body d-flex w-100">
                  <div class="align-self-center chart chart-lg">
                    <canvas id="chartjs-dashboard-bar"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>

                
          

        </div>
      </main>
      <script src="js/app.js"></script>
      <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Bar chart
      new Chart(document.getElementById("chartjs-dashboard-bar"), {
        type: "bar",
        data: {
          labels: <?php echo json_encode($location) ?>,
          datasets: [{
            label: "This year",
            backgroundColor: window.theme.primary,
            borderColor: window.theme.primary,
            hoverBackgroundColor: window.theme.primary,
            hoverBorderColor: window.theme.primary,
            data: <?php echo json_encode($count) ?>,
            barPercentage: .75,
            categoryPercentage: .5
          }]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              gridLines: {
                display: false
              },
              stacked: false,
              ticks: {
                stepSize: 20
              }
            }],
            xAxes: [{
              stacked: false,
              gridLines: {
                color: "transparent"
              }
            }]
          }
        }
      });
    });
  </script>

</html>    
