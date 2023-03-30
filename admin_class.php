<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
		//For added security - avoid brute force
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = str_replace("'", '', $username);
		$password = str_replace("'", '', $password);
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."'");  // and password = '".$password."'");
		if($qry->num_rows > 0){
			
			foreach ($row=$qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
            	    $hash = $row['password'];
					}
					if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    					$ip = $_SERVER['HTTP_CLIENT_IP'];
					} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
					} else {
    					$ip = $_SERVER['REMOTE_ADDR'];
					}
			        $_SESSION['ip'] = $ip;
			        sleep(3);
			if (password_verify($password,$hash) ){
				return 1;
            }
		}
		else{
			return 3;
			
		}
	}

	function login2(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '".$email."' and password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			    save_logs('Login successful');
				return 1;
		}else{
			save_logs('Login unsuccessful');
			return 3;
		}
	}

	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}

	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user(){
		extract($_POST);
		$hash = password_hash($password,PASSWORD_DEFAULT);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		//$data .= ", password = '$password' ";
		$data .= ", password = '$hash' ";
		$data .= ", status = 'ACTIVE' ";
		$data .= ", type = '$type' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		}
		if($save){
			return 1;
		}
	}

	function save_role(){
		extract($_POST);
		$data =" role_name='$role_name' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO roles set ".$data);
		}else{
			$save = $this->db->query("UPDATE roles set ".$data." where role_id=".$id);
		}
		if($save)
			return 1;
	}

	function delete_role(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM roles where role_id = ".$role_id);
		if($delete)
			return 1;
	}

	function delete_user(){
		extract($_POST);
		$data = " status = 'DELETED'";
		$delete = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		if($delete)
			return 1;
	}

	function signup(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", contact = '$contact' ";
		$data .= ", address = '$address' ";
		$data .= ", username = '$email' ";
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = 3";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("INSERT INTO users set ".$data);
		if($save){
			$qry = $this->db->query("SELECT * FROM users where username = '".$email."' and password = '".md5($password)."' ");
			if($qry->num_rows > 0){
				foreach ($qry->fetch_array() as $key => $value) {
					if($key != 'passwors' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}
			}
			return 1;
		}
	}

	function changepassword(){
		extract($_POST);
        if ($newpassword <> $verifypassword)
        {
        	return 4;
        }
        else {
     		$hash = password_hash($newpassword,PASSWORD_DEFAULT);
			$data = " password = '$hash' ";
		    $data .= " WHERE id= ".$_SESSION['login_id'];
		
			$save = $this->db->query("UPDATE users set ".$data);
			if($save){
				return 1;
				}
		}
	
	}

	function save_logs(){
		extract($_POST);
		$date = date("Y/m/d");
		$data = " login_id = ". $_SESSION['login_id'] ;
		$data .= ", action = '".$_SESSION['user_action']."'" ;
		$data .= ", msg = 'test'";
		$data .= ", module = '$module' ";
		$data .= ", access_date = '".$date. "'";
		$data .= ", mac = '". $_SESSION['ip']."'";
			$save = $this->db->query("INSERT INTO activitylogs set ".$data);
		if($save){
			return 1;
		}
	}

	function save_settings(){
		extract($_POST);
		$data = " companyname = '$companyname' ";
		$data .= ", use_assetitem = '$useassetitem' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/img/'. $fname);
					$data .= ", logo = '$fname' ";
		}
		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set ".$data);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set ".$data);
		}
		if($save){
		$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['setting_'.$key] = $value;
		}
			return 1;
				}
	}
	
	function save_employee(){
		extract($_POST);
		$data =" firstname='$firstname' ";
		$data .=", middlename='$middlename' ";
		$data .=", lastname='$lastname' ";
		//$data .=", position_id='$position_id' ";
		$data .=", department_id='$department_id' ";
		//$data .=", salary='$salary' ";
		if(empty($id)){
			$i= 1;
			while($i == 1){
			$e_num=date('Y') .'-'. mt_rand(1,9999);
				$chk  = $this->db->query("SELECT * FROM employee where employee_no = '$e_num' ")->num_rows;
				if($chk <= 0){
					$i = 0;
				}
			}
			$data .=", employee_no='$e_num' ";

			$save = $this->db->query("INSERT INTO employee set ".$data);
		}else{
			$save = $this->db->query("UPDATE employee set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	function delete_employee(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM employee where id = ".$id);
		if($delete)
			return 1;
	}

	function save_assetitem(){
		extract($_POST);
		$data =" name='$name' ";
		$data .=", pnsuffix = '$pnsuffix' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO assetitem set ".$data);
		}else{
			$save = $this->db->query("UPDATE assetitem set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	
	function delete_assetitem(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM assetitem where id = ".$id);
		if($delete)
			return 1;
	}

	function save_asset(){
		extract($_POST);
		$data =" asset_code='$asset_code' ";
		$data .=", asset_name='$asset_name' ";
		$data .=", category_id='$category_id' ";
		$data .=", invoice_number = '$invoice_number' ";
		$data .=", unit_of_measure = '$unit_of_measure' ";
		$data .=", department_id='$department_id' ";
		$data .=", location_id='$location_id' ";
		$data .=", depstartdate='$depstartdate' ";
		$data .=", depreciation_rate='$depreciation_rate' ";
		$data .=", manufacturer='$manufacturer' ";
		$data .=", model='$model' ";
		$data .=", purchase_amount='$purchase_amount' ";
		$data .=", purchase_date='$purchase_date' ";
		$data .=", serial_number='$serial_number' ";
		$data .=", specifications='$specifications' ";
		$data .=", supplier='$supplier' ";
		$data .=", userlife='$userlife' ";
		$data .=", totaldepreciation='$totaldepreciation'";
		$data .=", netbookvalue = '$netbookvalue'";
		$data .=", `condition` = '$condition'";
		if(empty($id)){
			$data .=", status = 'Unassigned'";
			$save = $this->db->query("INSERT INTO assets set ".$data);
		}else{
			$data .=", status = '$status'";
			$save = $this->db->query("UPDATE assets set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	function delete_asset(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM assets where id = ".$id);
		if($delete)
			return 1;
	}

	function save_supplies(){
		extract($_POST);
		$data =" item_code = '$item_code' ";
		$data .=", item_description = '$item_description' ";
		$data .=", item_type = '$item_type'";
		$data .=", unit_of_measure = '$unit_of_measure'";
		$data .=", pcs_unit = '$pcs_unit'";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO supplies_master set ".$data);
		}else{
			$save = $this->db->query("UPDATE supplies_master set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	function delete_supplies(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM supplies_master where id = ".$id);
		if($delete)
			return 1;
	}

	function add_item_delivery(){
		extract($_POST);
		$data = " item_id='$item_id',";
 		$data .= " ref_no='$po_number', ";
 		$data .= " tran_date='$tran_date',";
 		$data .= " tran_code = 'DEL' ,";
 		$data .= " dep = '$qty' ,";
 		$data .= " purchase_price = '$price'";
		$save = $this->db->query("INSERT INTO supplies_txn set ".$data);
		if($save)
			return 1;
	}

	function add_item_issuance(){
		extract($_POST);
		$data = " item_id='$item_id',";
 		$data .= " ref_no='$cr_number', ";
 		$data .= " tran_date='$tran_date',";
 		$data .= " department_id='$department',";
 		$data .= " tran_code = 'WDW' ,";
 		$data .= " wdw = '$qty'";
 		$save = $this->db->query("INSERT INTO supplies_txn set ".$data);
		if($save)
			return 1;
	}

	function save_inventory(){
		extract($_POST);
		$data =" inv_date='$inv_date' ";
		$data .=", description = '$description' ";
		$data .=", employee_id = ". $_SESSION['login_id'];
		$data .=", rpt_status = 'Open'";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO inventory set ".$data);
		}else{
			$save = $this->db->query("UPDATE inventory set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	function delete_inventory(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM inventory where id = ".$id);
		if($delete)
			return 1;
	}

	function close_inventory(){
		extract($_POST);
		$save = $this->db->query("UPDATE inventory set rpt_status='Closed' WHERE id=".$id);
		if($save)
			return 1;
	}

	function check_inventory_details(){
		extract($_POST);
		$data = " inv_id = '$id' ";
		$data .= "and asset_code = '$asset_number' ";
		$check = $this->db->query("SELECT * FROM inventorydetails WHERE ".$data);
		if($check ->num_rows > 0){
			return 0;
		}
		else{
			return 1;
		}

	}	

	function save_inventory_details(){
		extract($_POST);
		$data = " inv_id = '$id' ";
		$data .= "and asset_code = '$asset_number' ";
		$check = $this->db->query("SELECT * FROM inventorydetails WHERE ".$data);
		if($check->num_rows > 0)
			return 2;
		else
		 	$data = " inv_id = '$id' ";
			$data .= ", asset_code = '$asset_number' ";
			$data .=", asset_status = '$asset_status' ";
			$data .=", remarks = '$remarks'";
			$save = $this->db->query("INSERT INTO inventorydetails set ".$data);
			if($save)
				return 1;
	}

	function save_category(){
		extract($_POST);
		$data =" name='$name' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO category set ".$data);
		}else{
			$save = $this->db->query("UPDATE category set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	function delete_category(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM category where id = ".$id);
		if($delete)
			return 1;
	}

	function save_fundcluster(){
		extract($_POST);
		$data =" name='$name' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO fund_cluster set ".$data);
		}else{
			$save = $this->db->query("UPDATE fund_cluster set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	function delete_fundcluster(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM fund_cluster where id = ".$id);
		if($delete)
			return 1;
	}

	function save_location(){
		extract($_POST);
		$data =" name='$name' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO location set ".$data);
		}else{
			$save = $this->db->query("UPDATE location set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	function delete_location(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM location where id = ".$id);
		if($delete)
			return 1;
	}

	function save_office(){
		extract($_POST);
		$data =" name='$name' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO office set ".$data);
		}else{
			$save = $this->db->query("UPDATE office set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	function delete_office(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM office where id = ".$id);
		if($delete)
			return 1;
	}

	function save_department(){
		extract($_POST);
		$data =" name='$name' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO department set ".$data);
		}else{
			$save = $this->db->query("UPDATE department set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	function delete_department(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM department where id = ".$id);
		if($delete)
			return 1;
	}

	function save_position(){
		extract($_POST);
		$data =" name='$name' ";
		$data .=", position_id = '$position_id' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO position set ".$data);
		}else{
			$save = $this->db->query("UPDATE position set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	function delete_position(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM position where id = ".$id);
		if($delete)
			return 1;
	}

	function add_asset_assignment(){
		extract($_POST);
		$data = " assignnumber='$assign_number',";
 		$data .= " assigndate='$assign_date', ";
 		$data .= " employee_id = '$assignee_id' ,";
 		$data .= " assetcode = '$asset_code' ,";
 		$data .= " assign_mode = 'Purchase' ,";
 		$data .= " assign_status = 'Active' ";
		$save = $this->db->query("INSERT INTO assetassignment set ".$data);
		//$save = $this->db->query("UPDATE assets set status='ASSIGNED'," . $data1);
		if($save)
			return 1;
	}

	function update_unassigned_assets(){
		extract($_POST);
		$data = " mr_number='$assign_number',";
 		$data .= " mr_date='$assign_date', ";
		$data .= " assetassignee = '$assignee_id' where ";
		$data .= " asset_code = '$asset_code' ";
		$save = $this->db->query("UPDATE assets set status = 'Assigned', ".$data);
        if($save)
           return 1; 
	}

	function remove_asset_assignment(){
		extract($_POST);
 		$data = " assetcode = '$asset_code' ";
 		$data .= "and  mr_number = '$mr_number'  ";
		$save = $this->db->query("DELETE FROM assetassignment WHERE ".$data);
		//$save = $this->db->query("UPDATE assets set status='ASSIGNED'," . $data1);
		if($save)
			return 1;
	}

	function add_asset_transfer(){
		extract($_POST);
		$data = " prevassignnumber ='$par_number' ,";
 		$data .= " assigndate ='$ptrdate' ,";
 		$data .= " employee_id = '$assignee_id' ,";
 		$data .= " assignnumber = '$ptr_number' ,";
 		$data .= " assetcode = '$asset_code' ,";
 		$data .= " assign_status = 'Active' ,";
 		$data .= " assign_mode =  'Transfer' ";
		$save = $this->db->query("INSERT INTO assetassignment set ".$data);
		if($save)
			return 1;
	}

	function update_prevassigned_assets(){
		extract($_POST);
		$data = " where assignnumber ='$par_number' and assetcode = '$asset_code' ";
		$save = $this->db->query("UPDATE assetassignment set assign_status = 'Inactive' ".$data);
        if($save)
           return 1; 
	}
	
	function save_permission(){
		extract($_POST);
		$data =" role_id = '$mrole_id' ";
		$data .=", permission_id = '$perm' ";
		$save = $this->db->query("INSERT INTO rolepermissions set ".$data);
		if($save)
			return 1;
	}

	function remove_permission(){
		extract($_POST);
		$data =" id = '$id' ";
		$save = $this->db->query("DELETE FROM rolepermissions WHERE ".$data);
		if($save)
			return 1;
	}

   //  function add_item_issuance(){
	// 	extract($_POST);
	// 	$data = " item_id='$item_id',";
 	// 	$data .= " ref_no='$cr_number', ";
 	// 	$data .= " tran_date='$tran_date',";
 	// 	$data .= " tran_code = 'WDW' ,";
 	// 	$data .= " wdw = '$qty' ,";
 	// 	$data .= " purchase_price = '$price' ,";
	// 	$data .= " dep_id = '$department'";
	// 	$save = $this->db->query("INSERT INTO supplies_txn set ".$data);
	// 	if($save)
	// 		return 1;
	// }

}