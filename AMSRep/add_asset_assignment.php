<?php
include('db_connect.php');
$this->db = $conn;
//echo '<script>alert('error');</script>';

 extract($_POST);
 if(isset($_POST['mr_number'])){

		
 		$mr_number = $_POST['mr_number'];
 		$mr_date = $_POST['mr_date'];
 		$assignee_id = $_POST['assignee_id'];
 		$asset_code = $_POST['asset_code'];

		
 		
 		//$sql = "INSERT INTO assetassignment (mrnumber, mrdate, employeee_id, assetcode) VALUES ('".$mr_number."', '".$mr_date."', '".$assignee_id."', '".$asset_code."')";
 		//$save= $this->db->query($sql);
 		//if($save)
		//	return 1;

		if(mysqli_query($conn, "INSERT INTO assetassignment (mrnumber, mrdate, employeee_id, assetcode) VALUES ('".$mr_number."', '".$mr_date."', '".$assignee_id."', '".$asset_code."')" {
     		echo '1';}
    	else {
       		echo "Error: " . $sql . "" . mysqli_error($conn);
    	}



 	}
 	//else{
 		//$_SESSION['error'] = 'Pls. fill up required fields.';
 		//header('location: assignasset.php');
 	//	echo '<script>alert('error');</script>';
 	//}


?>