<?php include('db_connect.php');



$assignnumber = $_GET['assignnumber'];
$assign_number_tr = substr($assignnumber,0,20); //avoid SQL injection

//if(isset($asset_code)){



	$result = mysqli_query($conn,"SELECT assignnumber, assetcode, a.asset_name as asset_name, a.model as model, a.serial_number as serial_number, a.purchase_amount as purchase_amount, a.unit_of_measure as unit_of_measure, a.purchase_date as purchase_date, a.`condition` as `condition`, a.invoice_number as invoice_number, a.supplier as supplier, concat(e.lastname, ' ,', e.firstname) as assignee, employee_id FROM assetassignment aa LEFT JOIN assets a ON aa.assetcode=a.asset_code LEFT JOIN employee e ON aa.employee_id = e.id
		WHERE assignnumber = '".$assignnumber."'");

	$json = array();
	$data_array=array();
   
	$response = '';
	while($row = mysqli_fetch_array($result)) {
   		
	   // $response += '<tr><td>'.$row['assetcode'].'</td><td>'.$row['asset_name'].'</td><td>'.$row['purchase_amount'].'</td><td>'.$row['purchase_date'].'</td></tr>';  

        //using array
        $data_array['assignnumber'] = $row['assignnumber'];
        $data_array['assetcode'] = $row['assetcode'];
        $data_array['asset_name'] = $row['asset_name'];
        $data_array['purchase_amount']  = $row['purchase_amount'];
        $data_array['purchase_date'] = $row['purchase_date'];
        $data_array['condition'] = $row['condition'];
        $data_array['assignee'] = $row['assignee'];
        $data_array['employee_id'] = $row['employee_id'];

        array_push($json,$data_array);
	}
	

//echo $response;
echo json_encode($json);
//	echo $json;
//echo $data_array;

?>



