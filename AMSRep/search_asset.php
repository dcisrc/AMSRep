<?php
include('./db_connect.php');

$asset_code = $_GET['asset_code'];



$asset_qry = $conn->query("SELECT asset_name, concat(e.firstname,' ', e.lastname) as assignee, specifications, model, serial_number, manufacturer FROM assets a LEFT JOIN employee e ON a.assetassignee = e.id WHERE asset_code='" . $asset_code ."'");
	//status <> 'Unserviceable' and status <> 'Unlocated' and status <> 'Disposed'");
	if ($asset_qry->num_rows > 0){
		while( $row = $asset_qry-> fetch_assoc()){
   			$asset_name = $row['asset_name'];
   			$assignee = $row['assignee'];
   			$specifications = $row['specifications'];
   			$manufacturer = $row['manufacturer'];
   			$model = $row['model'];
   			$serial_number = $row['serial_number'];

		}	



		echo  $asset_name . ' / '. $specifications.'<br><br>';
		echo  'Manufacturer :' . $manufacturer. '   Model:' . $model. '   Serial No.: '.$serial_number. '<br>';
		echo 'Assigned to : ' . $assignee;
    }
    else { echo 'Asset Not Found!'; }
?>