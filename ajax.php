<?php
//require_once('startsession.php');
//  if(!isset($_SESSION['login_id']))
//  header('location:login.php');
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

if($action == 'login'){
	$login = $crud->login();
	if($login){
		$_SESSION['user_action'] = "Successful Login";
		$save = $crud->save_logs();
	    if($save)
		echo $login;
	}
	else{
		$_SESSION['user_action'] = "Unsuccessful Login";
		$save = $crud->save_logs();
	    if($save)
		echo $login;
	}

}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		$_SESSION['user_action'] = "User Logged out";
		$save = $crud->save_logs();
	    if($save)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)

		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'save_role'){
	$save = $crud->save_role();
	if($save)
		echo $save;
}
if($action == 'delete_role'){
	$save = $crud->delete_role();
	if($save)
		echo $save;
}

if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}

if($action == 'changepassword'){
	$save = $crud->changepassword();
	if($save)

		echo $save;
}

if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_employee"){
	$save = $crud->save_employee();
	if($save)
		$_SESSION['user_action'] = "Saved Employee";
		$savelogs = $crud->save_logs();
		if($savelogs)
		echo $save;
}
if($action == "delete_employee"){
	$save = $crud->delete_employee();
	if($save)
		echo $save;
}


if($action == "save_asset"){
	$save = $crud->save_asset();
	if($save)
		$_SESSION['user_action'] = "Saved Asset";
		$savelogs = $crud->save_logs();
		if($savelogs)
		echo $save;
}
if($action == "delete_asset"){
	$save = $crud->delete_asset();
	if($save)
		$_SESSION['user_action'] = "Deleted Asset";
		$savelogs = $crud->save_logs();
		if($savelogs)
		echo $save;
}

if($action == "search_asset"){
	$save = $crud->search_asset();
	if($save)
	    echo $save;
}
if($action == "save_assetitem"){
	$save = $crud->save_assetitem();
	if($save)
		echo $save;
}
if($action == "delete_assetitem"){
	$save = $crud->delete_assetitem();
	if($save)
		echo $save;
}	

if($action == "save_inventory"){
	$save = $crud->save_inventory();
	if($save)
		echo $save;
}	

if($action == "save_supplies"){
	$save = $crud->save_supplies();
	if($save)
		echo $save;

}
if($action == "delete_supplies"){
	$save = $crud->delete_supplies();
	if($save)
		echo $save;	

}
if($action == "add_item_delivery"){
	$save = $crud->add_item_delivery();
	if($save)
		echo $save;	

}
if($action == "add_item_issuance"){
	$save = $crud->add_item_issuance();
	if($save)
		echo $save;	

}
if($action == "delete_inventory"){
	$save = $crud->delete_inventory();
	if($save)
		echo $save;	
}
if($action == "close_inventory"){
	$save = $crud->close_inventory();
	if($save)
		echo $save;	
}
if($action == "check_inventory_details"){
	$save = $crud->check_inventory_details();
	if($save)
		echo $save;
}

if($action == "save_inventory_details"){
	$save = $crud->save_inventory_details();
	if($save)
		echo $save;
}

if($action == "save_office"){
	$save = $crud->save_office();
	if($save)
		$_SESSION['user_action'] = "Saved Office";
		$savelogs = $crud->save_logs();
		if($savelogs)
		echo $save;
}

if($action == "delete_office"){
	$save = $crud->delete_office();
	if($save)
		echo $save;
}	


if($action == "save_department"){
	$save = $crud->save_department();
	if($save)
		$_SESSION['user_action'] = "Saved Department";
		$savelogs = $crud->save_logs();
		if($savelogs)
		echo $save;
}

if($action == "delete_department"){
	$save = $crud->delete_department();
	if($save)
		echo $save;
}	
if($action == "save_category"){
	$save = $crud->save_category();
	if($save)
		echo $save;
}
if($action == "delete_category"){
	$save = $crud->delete_category();
	if($save)
		echo $save;
}	

if($action == "save_fundcluster"){
	$save = $crud->save_fundcluster();
	if($save)
		echo $save;
}
if($action == "delete_fundcluster"){
	$save = $crud->delete_fundcluster();
	if($save)
		echo $save;
}	

if($action == "save_location"){
	$save = $crud->save_location();
	if($save)
		echo $save;
}
if($action == "delete_location"){
	$save = $crud->delete_location();
	if($save)
		echo $save;	
}
if($action == "save_position"){
	$save = $crud->save_position();
	if($save)
		echo $save;
}
if($action == "delete_position"){
	$save = $crud->delete_position();
	if($save)
		echo $save;
}

if($action == "add_asset_assignment"){
	$save = $crud->add_asset_assignment();
	if($save)
		echo $save;
}

if($action == "update_unassigned_assets"){
	$save = $crud->update_unassigned_assets();
	if($save)
		echo $save;
}

if($action == "remove_asset_assignment"){
	$save = $crud->remove_asset_assignment();
	if($save)
		echo $save;
}

if($action == "update_assigned_assets"){
	$save = $crud->update_assigned_assets();
	if($save)
		echo $save;
}

if($action == "add_asset_transfer"){
	$save = $crud->add_asset_transfer();
	if($save)
		echo $save;
}

if($action == "update_prevassigned_assets"){
	$save = $crud->update_prevassigned_assets();
	if($save)
		echo $save;
}


// if($action == "get_permissions"){
// 	$get = $crud->get_permissions();
// 	//if($save)
// 		echo json_encode($get);
// }

if($action == "save_permission"){

	$save = $crud->save_permission();
	if($save)
		echo $save;
}

if($action == "remove_permission"){
	
	$save = $crud->remove_permission();
	if($save)
		echo $save;
}

?>