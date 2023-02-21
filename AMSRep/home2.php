
<!DOCTYPE html>
<?php include 'db_connect.php' ?>

<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title></title> 
         <meta charset="UTF-8">           
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="images/curo-teknika-services.png" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <link rel="stylesheet" href="css1/style2.css">

        <style type="text/css">
             #total{
                border:1px solid green;
                padding-left: 10px;
                border-radius: 8px;
                background-color: #bf40bf;
                color: white;
              }
                #totaly{
                border:1px solid green;
                padding-left: 10px;
                border-radius: 8px;
                background-color: orange;
                color: white;
              }
               #totaly2{
                border:1px solid green;
                padding-left: 10px;
                border-radius: 8px;
                background-color: green;
                color: white;
              }
                #totalv{
                border:1px solid green;
                padding-left: 10px;
                border-radius: 8px;
                background-color: red;
                color: white;
              }
               #totalb{
                border:1px solid green;
                padding-left: 10px;
                border-radius: 8px;
                background-color: blue;
                color: white;
              }
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
  		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript" src="gstatic/loader.js"></script>


		
    	<?php


        	$sql = "SELECT status, count(*) as number FROM assets where status='Assigned' OR status = 'UnServiceable' OR status='Disposed' OR status='Unlocated' GROUP BY status";
        	$query = $conn->query($sql);

    	?>

		

	<script type="text/javascript">  
    	google.charts.load('current', {'packages':['corechart']});  
    	google.charts.setOnLoadCallback(drawChart);  
    	function drawChart(){  
    	var data = google.visualization.arrayToDataTable([  
                ['status', 'Number'],  
                <?php  
                    while($row = $query->fetch_assoc()){  
                        echo "['".$row["status"]."', ".$row["number"]."],";  
                    }  
                ?>  
            ]);  
    	var options = {  
                title: '',   
                //is3D:true,  
                
                pieHole: 0.4  
            }; 
             
    	var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
    	chart.draw(data, options);  
		}  
	</script>


    </head>    
    <body>

		<div class="containe-fluid">

			<div class="row">
				<div class="col-lg-12">
			
			</div>
		</div>

		<div class="row mt-3 ml-3 mr-3">
			<div class="col-lg-12">
                <div class="card">
                    <div class="card-body"><h6>Dashboard</h6>
                    
                                        
                    </div>
                    
                </div>
            </div>
		</div> 
               
 
		<?php

        $sql = "SELECT Year(purchase_date) as Year, Sum(purchase_amount) as Number FROM assets GROUP BY Year(purchase_date)";
        $query = $conn->query($sql);

    	?>

    	<script type="text/javascript">
      		google.charts.load('current', {'packages':['corechart']});
      		google.charts.setOnLoadCallback(drawChart);

      		function drawChart() {

        	var data = google.visualization.arrayToDataTable([
           		['Year', 'Number'],  
                	<?php  
                    	while($row = $query->fetch_assoc()){  
                        	echo "['".$row["Year"]."', ".$row["Number"]."],";  
                    	}  
                	?>  
            	]); 

        	var options = {
          		title: '',
          		is3D: true,
        	};

        	var chart = new google.visualization.PieChart(document.getElementById('piechartko'));

        	chart.draw(data, options);
      		}
    	</script>

        <br>              
                
       
        <div class="page-content-wrap">
                    
                                        
            <div class="row">
                <div class="col-md-1">
                </div>
                <!-- FIRST CHART -->
                <div class="col-md-5">
                            
                           
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title-box">
                                     
                                <h6><p style="font-size: 1.6em">TOTAL ASSET VALUE</p></h6>
                                    
                            </div>                                    
                                                                     
                        </div>  
                        <div class="panel-body padding-0">
                            <div class="chart-holder" id="piechartko" style="height: 300px;width: 500px; "></div>
                        </div>                              
                                                              
                    </div>
                           
                            
                </div>

				<!-- SECOND CHART -->
                <div class="col-md-5">
                            
                            
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title-box">
                                          
                                    <h6><p style="font-size: 1.6em">ASSET STATUS</p></h6>
                                     
                            </div>
                        </div>
                        <div class="panel-body padding-0">
                        	<div class="chart-holder" id="piechart" style="height: 300px;width: 500px; "></div>
                                    <!--<div id="piechart" style="width: 900px; height: 500px;"></div>-->
                        </div>     
                                   
                    
                               
                	</div>
                </div>
            </div> 

            <?php
                           
       

           $query1=mysqli_query($conn,"SELECT Sum(totaldepreciation) AS PrevYear FROM assets where Year(purchase_date) < Year(CURDATE())" )or die(mysqli_error($conn));
           		while($row3 = mysqli_fetch_array($query1)){

       
             $Prev = $row3['PrevYear'];
          	}

            $query1=mysqli_query($conn,"SELECT Sum(totaldepreciation) AS CurrYear FROM assets where Year(purchase_date) = Year(CURDATE())" )or die(mysqli_error($conn));
          		while($row4 = mysqli_fetch_array($query1)){

          	$Curr = $row4['CurrYear'];

          	}

          	$query1=mysqli_query($conn,"SELECT Sum(totaldepreciation) AS Total FROM assets" )or die(mysqli_error($conn));
          		while($row5 = mysqli_fetch_array($query1)){

          	$Total = $row5['Total'];

          	}
                   
			?>
            <br>

            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-10">
                            
                           
                    <div class="panel panel-default" >
                        <div class="panel-heading">
                            <div class="panel-title-box" style="line-height: 50px">

                                        <h6><p style="font-size: 1.6em">TOTAL DEPRECIATION</p></h6>
                                      <!--  <span>Users vs returning</span>-->
                            </div>                                    
                                                                     
                        </div>                                
                        <div class="panel-body fixed-panel">
                            <div class="chart-wrap">

  								<div id="dashboard-stats" class="">
  					  									
    							<div class="row">
      								<span class="label" style="color:gray">Prev Year</span>
      								<div class="bar-wrap">
       								 	<div class="bar" data-value="<?php echo $Prev;?>"></div>
      							</div>
      							<span class="number"><?php echo number_format($Prev);?></span>
    							</div>
    							<div class="row">
      								<span class="label" style="color:gray">Current</span>
      								<div class="bar-wrap">
        								<div class="bar" data-value="<?php echo  $Curr;?>"></div>
      								</div>
      								<span class="number"><?php echo number_format($Curr);?></span>
    							</div>
       
     							<div class="row">
      							<span class="label" style="color:red">TOTAL</span>
      							<div class="bar-wrap">
        							<div class="bar" data-value="<?php echo $Total;?>"></div>
      							</div>
      							<span class="number"><span class="badge badge-info" style="font-size: 20px"><?php echo number_format($Total);?></span></span>
    							</div>

 								</div>
 							</div>
 						</div>	
                    </div>
                </div>    
    
            </div>   
    	<script src="js/jquery.min.js" type="text/javascript"></script>
    	<script src="js/jqbar.js" type="text/javascript"></script>
    	<link rel="stylesheet" href="css/jqbar.css" />

  
  		<script type="text/javascript">
          $(document).ready(function () {

              $('#bar-1').jqbar({ label: 'Label', value: 90, barColor: '#D64747', orientation: 'h', barWidth: 80 });
          	});
		</script>

		<br>
    		
  		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  		<script  src="js1/index.js"></script>

                                      
  				<div class="row">
  					<div class="col-md-2">
                </div>
                    <div class="col-md-10">
                     
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title-box">
                                    <h6><p style="font-size: 1.6em">TOTAL DISPOSAL VALUE</p></h6>
                                      <!--  <span>Users vs returning</span>-->
                                </div>
                                   
                            </div>
                            <div class="panel-body fixed-panel">
                            	<div id="chartContainer" style="height: 370px; width: 100%;"></div>
                         	</div>     		
                      
                		</div>                     
               		</div>
               	</div>	

			<?php

                               
         		$query1=mysqli_query($conn,"SELECT Sum(netbookvalue) AS total FROM assets where status='Disposed'")or die(mysqli_error($conn));
           		$row2=mysqli_fetch_array($query1);
          		$t = $row2['total'];

              	$query2=mysqli_query($conn,"SELECT Sum(netbookvalue) AS prevdisp FROM assets where  status='Disposed' and Year(purchase_date) < Year(CURDATE())")or die(mysqli_error($conn));
                $row3=mysqli_fetch_array($query2);  
                $p = $row3['prevdisp'];


              	$query3=mysqli_query($conn,"SELECT Sum(netbookvalue)  AS currdisp FROM assets where  status='Disposed' and Year(purchase_date) = Year(CURDATE())")or die(mysqli_error($conn));
                $row4=mysqli_fetch_array($query3);  
                $c = $row4['currdisp'];

               
				$dataPoints1 = array(

    				array("label"=> "TOTAL", "y"=> $t),
    				array(""),
    				array(""),
    				array("")
				);
				$dataPoints2 = array(

 
    				array(""),
    				array("label"=> "PREV. YRS.", "y"=> $p),
     				array(""),
     				array("")
				);
				$dataPoints3 = array(

    				array(""),
    				array(""),
    				array("label"=> "CURRENT", "y"=> $c),
    				array("")
				);

    
?>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2",
    title:{
        text: ""
    },
    legend:{
        cursor: "pointer",
        verticalAlign: "center",
        horizontalAlign: "right",
        itemclick: toggleDataSeries
    },
    data: [{
        type: "column",
        name: "TOTAL",
        indexLabel: "{y}",
        yValueFormatString: "",
        showInLegend: true,
        dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
    },{
        type: "column",
        name: "PREV",
        indexLabel: "{y}",
        yValueFormatString: "",
        showInLegend: true,
        dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
    },{
        type: "column",
        name: "CURR",
        indexLabel: "{y}",
        yValueFormatString: "",
        showInLegend: true,
        dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
    }]
    
});
chart.render();
 
function toggleDataSeries(e){
    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    }
    else{
        e.dataSeries.visible = true;
    }
    chart.render();
}
 
}
</script>


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        <script src="assets_pie/js/highcharts.js"></script>
        <script src="assets_pie/js/jquery-1.10.1.min.js"></script>
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>        
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>
        
        <!--<script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>-->       
        <script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>                
        <script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>                 
        
        <script type="text/javascript" src="js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>
        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>
        
        <script type="text/javascript" src="js/demo_dashboard.js"></script>

        <script>
                // <!--/. tells about the time  -->
                              function show2(){
                              if (!document.all&&!document.getElementById)
                              return
                              thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
                              var Digital=new Date()
                              var hours=Digital.getHours()
                              var minutes=Digital.getMinutes()
                              var seconds=Digital.getSeconds()
                              var dn="PM"
                              if (hours<12)
                              dn="AM"
                              if (hours>12)
                              hours=hours-12
                              if (hours==0)
                              hours=12
                              if (minutes<=9)
                              minutes="0"+minutes
                              if (seconds<=9)
                              seconds="0"+seconds
                              var ctime=hours+":"+minutes+":"+seconds+" "+dn
                              thelement.innerHTML=ctime
                              setTimeout("show2()",1000)
                              }
                              window.onload=show2
                      //-->
                       
                        </script> <!--/. Script where the format of the interface time,month,day and year relies -->