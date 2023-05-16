<?php

session_start();

include('../db_connect.php'); 
require('../xlsxwriter.class.php');

//$cutoff = $_GET['cutoff'];
//$category = $_GET['catid'];
$writer = new XLSXWriter();
$writer->setAuthor($_SESSION['system_info']['company_name']);

/*$result = $conn->query("SELECT name FROM category WHERE id = ".$category);
   while($row=$result->fetch_array()){
   $categoryname = $row[0];
   } 
*/
   
//    global $cutoff;
//    global $category;
//    global $categoryname;
 
    $data1='';
    $fname='icfrep.xlsx';
	 $rowData=array();

	 $x=60;
    $total =0;
    $oldemp='xxx';

    $setData='';
    array_push($rowData,[$_SESSION['system_info']['company_name']]);
    array_push($rowData,['']);
    array_push($rowData,['Asset Management System - Inventory Count Form']);
//    array_push($rowData,[$categoryname]);
//    array_push($rowData,['As of : ' .date('m/d/Y')];
    array_push($rowData,['Article','Description','Asset Tag','Old Property No. Assigned','New Property No. Assigned','Unit of Measure','Unit Value','Qty. Per Property Card','Qty. Per Physical Count','Location/Whereabout','Condition','Remarks']);

    //$writer->writeSheet($rowData,'rpcppe'); 
    $asset_qry = $conn->query("SELECT aa.assetcode, a.asset_name, aa.assignnumber, aa.prevassignnumber, a.unit_of_measure, a.purchase_amount, a.condition, id.asset_status as status, d.name as depname, l.name as locname, id.remarks FROM assetassignment aa
            LEFT JOIN assets a ON a.asset_code = aa.assetcode
            LEFT JOIN department d ON d.id = a.department_id
            LEFT JOIN location l ON l.id = a.location_id
            LEFT JOIN inventorydetails id ON id.asset_code = aa.assetcode") or die($conn->error);
         while($row=$asset_qry->fetch_array()){

        array_push( $rowData,[$row['assetcode'], $row['asset_name'], '', $row['prevassignnumber'], $row['assignnumber'],$row['unit_of_measure'], $row['purchase_amount']] );
           
		}

        
    //$writer->writeSheet($rowData,'rcpppe',$col_options = ['widths'=>[50,50,50,10,50]]);  
	$writer->writeSheet($rowData,'icfrep');  

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$fname.'"');
    header('Cache-Control: max-age=0');
    $writer->writeToStdOut();

?>