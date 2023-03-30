<?php include('db_connect.php');



$item_id = $_GET['item_id'];
$item_id_tr = substr($item_id,0,10); //avoid SQL injection
//$response = 0;


	$result = mysqli_query($conn,"SELECT  sum(if(isnull(dep),0,dep)-if(isnull(wdw),0,wdw)) as bal from supplies_txn  where item_id ='".$item_id_tr."'");

	//$response = array();
	
	while($row = mysqli_fetch_array($result)) {
   		
	   
        $response = $row['bal'];
	}
    
    
echo $response;



?>



