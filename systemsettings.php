<?php

  //session_start();
    if(!isset($_SESSION['login_id']))
        header('location:login.php');
  	include('db_connect.php');


	// if(!isset($_SESSION['system_info'])){
	$sql = "SELECT * FROM system_info";
	$qry = $conn->query($sql);
		while($row = $qry->fetch_assoc()){
			$_SESSION['system_info'][$row['meta_field']] = $row['meta_value'];
		}
	// }

?>