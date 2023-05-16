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
		$_SESSION['user_action'] = "Save New User";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == 'update_user'){
	$save = $crud->save_user();
	if($save)
		$_SESSION['user_action'] = "Update User";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == 'delete_user'){
	$save = $crud->delete_user();
	$_SESSION['user_action'] = "Deleted User";
	$_SESSION['modulename'] = "Manage User Module";
	$save = $crud->save_logs();
	if($save)
		echo $save;
}

if($action == 'save_role'){
	$save = $crud->save_role();
	if($save)
		$_SESSION['user_action'] = "Saved Role";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == 'update_role'){
	$save = $crud->save_role();
	if($save)
		$_SESSION['user_action'] = "Updated Role";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == 'delete_role'){
	$save = $crud->delete_role();
	$_SESSION['user_action'] = "Deleted Role";
	$_SESSION['modulename'] = "Manage Role Module";
	$save = $crud->save_logs();
	if($save)
		echo $save;
}

if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		$_SESSION['user_action'] = "Saved Sign Up";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == 'changepassword'){
	$save = $crud->changepassword();
	if($save)
		$_SESSION['user_action'] = "Change Password";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		$_SESSION['user_action'] = "Saved Settings";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "save_employee"){
	$save = $crud->save_employee();
	if($save)
		$_SESSION['user_action'] = "Saved Employee";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "update_employee"){
	$save = $crud->save_employee();
	if($save)
		$_SESSION['user_action'] = "Updated Employee";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "delete_employee"){
	$save = $crud->delete_employee();
	$_SESSION['user_action'] = "Deleted Employee";
	$_SESSION['modulename'] = "Manage Employee Module";
	$save = $crud->save_logs();
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

if($action == "update_asset"){
	$save = $crud->save_asset();
	if($save)
		$_SESSION['user_action'] = "Updated Asset";
		$savelogs = $crud->save_logs();
		if($savelogs)
		echo $save;
}

if($action == "delete_asset"){
	$save = $crud->delete_asset();
	//if($save)
		$_SESSION['user_action'] = "Deleted Asset";
	    $_SESSION['modulename'] = "Manage Assets";
	    $save = $crud->save_logs();
        if($save)
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
		$_SESSION['user_action'] = "Saved Asset Item";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "update_assetitem"){
	$save = $crud->save_assetitem();
	if($save)
		$_SESSION['user_action'] = "Update Asset Item";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "delete_assetitem"){
	$save = $crud->delete_assetitem();
	$_SESSION['user_action'] = "Deleted Asset Item";
	$_SESSION['modulename'] = "Manage Assets Items";
	$save = $crud->save_logs();
	if($save)
		echo $save;
}	

if($action == "save_supplies"){
	$save = $crud->save_supplies();
	if($save)
		$_SESSION['user_action'] = "Saved Supplies";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == 'update_supplies'){
	$save = $crud->save_supplies();
	if($save)
		$_SESSION['user_action'] = "Update Supplies";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "delete_supplies"){
	$save = $crud->delete_supplies();
	$_SESSION['user_action'] = "Deleted Supplies";
	$_SESSION['modulename'] = "Manage Supplies Module";
	$save = $crud->save_logs();
	if($save)
		echo $save;	
}

if($action == "add_item_delivery"){
	$save = $crud->add_item_delivery();
	if($save)
		$_SESSION['user_action'] = "Saved Item Delivery";
		$save = $crud->save_logs();
		if($save)
		echo $save;	
}

if($action == "update_item_delivery"){
	$save = $crud->add_item_delivery();
	if($save)
		$_SESSION['user_action'] = "Update Item Delivery";
		$save = $crud->save_logs();
		if($save)
		echo $save;	
}

if($action == "add_item_issuance"){
	$save = $crud->add_item_issuance();
	if($save)
		$_SESSION['user_action'] = "Saved Item Issuance";
		$save = $crud->save_logs();
		if($save)
		echo $save;	
}

if($action == "save_inventory"){
	$save = $crud->save_inventory();
	if($save)
		$_SESSION['user_action'] = "Saved Inventory";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}	

if($action == "update_inventory"){
	$save = $crud->save_inventory();
	if($save)
		$_SESSION['user_action'] = "Update Inventory";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}	

if($action == "delete_inventory"){
	$save = $crud->delete_inventory();
	$_SESSION['user_action'] = "Deleted Inventory";
	$_SESSION['modulename'] = "Manage Inventory Module";
	$save = $crud->save_logs();
	if($save)
		echo $save;	
}

if($action == "close_inventory"){
	$save = $crud->close_inventory();
	if($save)
		$_SESSION['user_action'] = "Saved Close Inventory";
		$save = $crud->save_logs();
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
		$_SESSION['user_action'] = "Saved Inventory";
		$save = $crud->save_logs();
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

if($action == "update_office"){
	$save = $crud->save_office();
	if($save)
		$_SESSION['user_action'] = "Update Office";
		$savelogs = $crud->save_logs();
		if($savelogs)
		echo $save;
}

if($action == "delete_office"){
	$save = $crud->delete_office();
	$_SESSION['user_action'] = "Deleted Office";
	$_SESSION['modulename'] = "Manage Office Module";
	$save = $crud->save_logs();
	if($save)
		echo $save;
}	

if($action == "save_supplier"){
	$save = $crud->save_supplier();
	if($save)
		$_SESSION['user_action'] = "Saved Supplier";
		$savelogs = $crud->save_logs();
		if($savelogs)
		echo $save;
}

if($action == "update_supplier"){
	$save = $crud->save_supplier();
	if($save)
		$_SESSION['user_action'] = "Update Supplier";
		$savelogs = $crud->save_logs();
		if($savelogs)
		echo $save;
}

if($action == "delete_supplier"){
	$save = $crud->delete_supplier();
	$_SESSION['user_action'] = "Deleted Supplier";
	$_SESSION['modulename'] = "Manage Supplier";
	$save = $crud->save_logs();
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

if($action == "update_department"){
	$save = $crud->save_department();
	if($save)
		$_SESSION['user_action'] = "Update Department";
		$savelogs = $crud->save_logs();
		if($savelogs)
		echo $save;
}

if($action == "delete_department"){
	$save = $crud->delete_department();
	$_SESSION['user_action'] = "Deleted Department";
	$_SESSION['modulename'] = "Manage Department";
	$save = $crud->save_logs();
	if($save)
		echo $save;
}	

if($action == "save_category"){
	$save = $crud->save_category();
	if($save)
		$_SESSION['user_action'] = "Saved Category";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "update_category"){
	$save = $crud->save_category();
	if($save)
		$_SESSION['user_action'] = "Update Category";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "delete_category"){
	$save = $crud->delete_category();
	$_SESSION['user_action'] = "Delete Category";
	$_SESSION['modulename'] = "Category Module";
	$save = $crud->save_logs();
	if($save)
		echo $save;
}	

if($action == "save_fundcluster"){
	$save = $crud->save_fundcluster();
	if($save)
		$_SESSION['user_action'] = "Saved Fund Cluster";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "update_fundcluster"){
	$save = $crud->save_fundcluster();
	if($save)
		$_SESSION['user_action'] = "Update Fund Cluster";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "delete_fundcluster"){
	$save = $crud->delete_fundcluster();
	$_SESSION['user_action'] = "Deleted Fund Cluster";
	$_SESSION['modulename'] = "Manage Fund Cluster Module";
	$save = $crud->save_logs();
	if($save)
		echo $save;
}	

if($action == "save_location"){
	$save = $crud->save_location();
	if($save)
		$_SESSION['user_action'] = "Saved Location";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "update_location"){
	$save = $crud->save_location();
	if($save)
		$_SESSION['user_action'] = "Update Location";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "delete_location"){
	$save = $crud->delete_location();
	$_SESSION['user_action'] = "Deleted Location";
	$_SESSION['modulename'] = "Manage Location Module";
	$save = $crud->save_logs();
	if($save)
		echo $save;	
}

if($action == "save_position"){
	$save = $crud->save_position();
	if($save)
		$_SESSION['user_action'] = "Saved Position";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "update_position"){
	$save = $crud->save_position();
	if($save)
		$_SESSION['user_action'] = "Update Position";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "delete_position"){
	$save = $crud->delete_position();
	$_SESSION['user_action'] = "Deleted Position";
	$_SESSION['modulename'] = "Manage Position Module";
	$save = $crud->save_logs();
	if($save)
		echo $save;
}

if($action == "save_notification"){
	$save = $crud->save_notification();
	if($save)
		$_SESSION['user_action'] = "Saved Notification";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "update_notification"){
	$save = $crud->save_notification();
	if($save)
		$_SESSION['user_action'] = "Update Notification";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "delete_notification"){
	$save = $crud->delete_notification();
	$_SESSION['user_action'] = "Deleted Notification";
	$_SESSION['modulename'] = "Manage Notification Module";
	$save = $crud->save_logs();
	if($save)
		echo $save;
}

if($action == "save_permission"){
	$save = $crud->save_permission();
	if($save)
		$_SESSION['user_action'] = "Added Permission";
		$save = $crud->save_logs();
		if($save)
  		   echo $save;
}

if($action == "update_permission"){
	$save = $crud->save_permission();
	if($save)
		$_SESSION['user_action'] = "Updated Permission";
		$save = $crud->save_logs();
		if($save)
  		   echo $save;
}

if($action == "delete_permission"){
	$save = $crud->delete_permission();
	$_SESSION['user_action'] = "Deleted Permission";
	$_SESSION['modulename'] = "Manage Permission Module";
	$save = $crud->save_logs();
	if($save)
		echo $save;
}

if($action == "add_asset_assignment"){
	$save = $crud->add_asset_assignment();
	if($save)
		$_SESSION['user_action'] = "Saved Asset Assignment";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "update_unassigned_assets"){
	$save = $crud->update_unassigned_assets();
	if($save)
		$_SESSION['user_action'] = "Update Unassigned Asset";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "remove_asset_assignment"){
	$save = $crud->remove_asset_assignment();
	$_SESSION['user_action'] = "Deleted Asset Assignment";
	$_SESSION['modulename'] = "Manage Asset Assignment Module";
	$save = $crud->save_logs();
	if($save)
		echo $save;
}

if($action == "update_assigned_assets"){
	$save = $crud->update_assigned_assets();
	if($save)
		$_SESSION['user_action'] = "Update Assigned Asset";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "add_asset_transfer"){
	$save = $crud->add_asset_transfer();
	if($save)
		$_SESSION['user_action'] = "Add Asset Transfer";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "update_prevassigned_assets"){
	$save = $crud->update_prevassigned_assets();
	if($save)
		$_SESSION['user_action'] = "Update Assigned Asset";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "save_rolepermission"){
	$save = $crud->save_rolepermission();
	if($save)
		$_SESSION['user_action'] = "Saved Role Permission";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "update_rolepermission"){
	$save = $crud->save_rolepermission();
	if($save)
		$_SESSION['user_action'] = "Update Role Permission";
		$save = $crud->save_logs();
		if($save)
		echo $save;
}

if($action == "remove_rolepermission"){
	$save = $crud->remove_rolepermission();
	$_SESSION['user_action'] = "Removed Role Permission";
	$_SESSION['modulename'] = "Manage Roles Module";
	$save = $crud->save_logs();
	if($save)
		echo $save;
}

?>