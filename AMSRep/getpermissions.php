<?php include('db_connect.php');

//if(isset($_GET['role_id'])){

$result = mysqli_query($conn,"SELECT role_id, permission_id, 'test' as test FROM rolepermissions");//  WHERE role_id ".$_GET['role_id']);

$data = array();
while($row = mysqli_fetch_array($result)) {
   $row_array['role_id'] = $row->role_id;
   $row_array['permission_id'] = $row->permission_id;
   $row_array['test'] = $row->test;

   array_push($data['data'],$row_array);
}



echo json_encode($data);

//}



?>



