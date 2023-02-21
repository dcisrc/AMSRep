<?php
include('./db_connect.php');

$search_text = $_GET['search_text'];
$uri = $_GET['uri'];



$search_qry = $conn->query("SELECT * FROM employee WHERE firstname like '%" . $search_text ."%' or lastname like '%".$search_text."%'");
	//status <> 'Unserviceable' and status <> 'Unlocated' and status <> 'Disposed'");
	if ($search_qry->num_rows > 0){
    
		while( $row = $search_qry-> fetch_assoc()){
        $empid=$row['id'];
        $empno=$row['employee_no'];
   			$firstname = $row['firstname'];
   			$lastname = $row['lastname'];
        echo '<tr>';
        echo  '<td><a href=reports/'.$uri.'.php?empcode='.$empid.'>'. $empno .'</a></td>';
        echo  '<td><a href=reports/'.$uri.'.php?empcode='.$empid.'>'. $firstname . ' '. $lastname.'</a></td>';
        echo '</tr>';
   			

		}	



		
    }
    else { echo 'Not Found!'; }
?>