<?php include('db_connect.php');

$item_id = $_GET['id'];
$item_id_tr = substr($item_id,0,10); //avoid SQL injection
$qty = $_GET['qty'];
$price = $_GET['price'];
$amount = $qty * $price;

  $result = mysqli_query($conn,"SELECT item_code, item_description, unit_of_measure FROM supplies_master WHERE id = '".$item_id_tr."'");
    $data = array();
  $row_array = array();
  $response = '';
  while($row = mysqli_fetch_array($result)) {
      $response = '<tr><td>'.$row['item_code'].'</td><td>'.$row['item_description'].'</td><td>'.$row['unit_of_measure'].'</td><td>'.$qty.'</td><td>'.$price.'</td><td>'.$amount.'</td></tr>';   
  }
echo $response;



?>



