<?php

session_start();

include('../db_connect.php'); 

$cutoff = $_GET['cutoff'];
$category = $_GET['catid'];
$json = array();
$data_array=array();

//$writer->writeSheet($rowData,'rpcppe'); 
   $asset_qry = $conn->query("SELECT *, a.assetassignee as employee_code, concat(e.lastname,', ',e.firstname) as empname  FROM assets a LEFT JOIN employee e on a.assetassignee=e.id LEFT JOIN department d on a.department_id = d.id LEFT JOIN category c on a.category_id = c.id  WHERE category_id = ". $category . " AND purchase_date <= " . $cutoff . " ORDER BY a.assetassignee") or die($conn->error);
         while($row=$asset_qry->fetch_array()){
        
 		

        //array_push($json,$data_array);
        array_push($json,[$row['employee_code'],$row['empname']]);
	}
	

//echo $response;
//echo json_encode($json);
echo $json;
?>