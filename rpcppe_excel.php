<?php

session_start();

include('../db_connect.php'); 
require('../xlsxwriter.class.php');

$cutoff = $_GET['cutoff'];
$category = $_GET['catid'];
$writer = new XLSXWriter();
$writer->setAuthor($_SESSION['system_info']['company_name']);

$result = $conn->query("SELECT name FROM category WHERE id = ".$category);
   while($row=$result->fetch_array()){
   $categoryname = $row[0];
   } 

   
    global $cutoff;
    global $category;
    global $categoryname;
 
    $data1='';
	$fname='rpcppe.xlsx';
	$rowData=array();

	

    $x=60;
    $total =0;
    $oldemp='xxx';

    $setData='';
    array_push($rowData,[$_SESSION['system_info']['company_name']]);
    array_push($rowData,['']);
    array_push($rowData,['Asset Management System - Report on Physical Count of Property, Plant and Equipments (RPCPPE)']);
    array_push($rowData,[$categoryname]);
    array_push($rowData,['As of : '  . $cutoff]);
    array_push($rowData,['Fund Cluster :']);
    array_push($rowData,['For which,_____________________________________ is accountable, having assumed such accountability on ____________']);
    array_push($rowData,['']);
    array_push($rowData,['Article','Description','Property Number','Unit of Measure','Unit Value ','Balance Per Card','On Hand Per Count','Shortage/Overage','Remarks']);

    //$writer->writeSheet($rowData,'rpcppe'); 
    $asset_qry = $conn->query("SELECT *, a.assetassignee as employee_code, concat(e.lastname,', ',e.firstname) as empname  FROM assets a LEFT JOIN employee e on a.assetassignee=e.id LEFT JOIN department d on a.department_id = d.id LEFT JOIN category c on a.category_id = c.id  WHERE category_id = ". $category . " AND purchase_date <= " . $cutoff . " ORDER BY a.assetassignee") or die($conn->error);
         while($row=$asset_qry->fetch_array()){

        array_push( $rowData,[$row['asset_name'],'Model:'. $row['model'].'; S/N:'. $row['serial_number'], $row['asset_code'],$row['unit_of_measure'],$row['purchase_amount']] );
           
		}

        
    //$writer->writeSheet($rowData,'rcpppe',$col_options = ['widths'=>[50,50,50,10,50]]);  
	$writer->writeSheet($rowData,'rcpppe');  

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$fname.'"');
    header('Cache-Control: max-age=0');
    $writer->writeToStdOut();

?>