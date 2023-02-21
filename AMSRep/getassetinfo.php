<?php include('db_connect.php');



$asset_code = $_GET['asset_code'];
$asset_code_tr = substr($asset_code,0,20); //avoid SQL injection

//if(isset($asset_code)){



	$result = mysqli_query($conn,"SELECT asset_code, asset_name, model, serial_number, unit_of_measure, purchase_date, invoice_number, supplier FROM assets WHERE asset_code = '".$asset_code_tr."'");
    $data = array();
	$row_array = array();
	$response = '';
	while($row = mysqli_fetch_array($result)) {
   		
	    $response = '<tr><td>'.$row['asset_code'].'</td><td>'.$row['asset_name'].'</td><td>'.$row['unit_of_measure'].'</td><td>'.$row['purchase_date'].'</td><td>'.$row['invoice_number'].'</td><td>'.$row['supplier'].'</td></tr>';   
        
	}

echo $response;



?>



