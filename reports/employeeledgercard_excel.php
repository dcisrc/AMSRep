<?php

session_start();
include('../db_connect.php'); 
require('../xlsxwriter.class.php');
include('../db_connect.php'); 




$writer = new XLSXWriter();
$writer->setAuthor($_SESSION['system_info']['company_name']);


    
    
	$employee_code = $_GET['empcode'];

    $emp_query = $conn->query("SELECT  employee_no, concat(lastname,', ',firstname) as empname, d.name as dept FROM  employee e LEFT JOIN department d ON e.department_id = d.id WHERE e.id=".$employee_code);
    while($row = $emp_query->fetch_array()){
    	$empname = $row['empname'];
    	$employee_no= $row['employee_no'];
        $department = $row['dept'];  
    }
   
$fname='elc'.'.xlsx';
$rowData=array();




	array_push($rowData,[$_SESSION['system_info']['company_name']]);
    
    array_push($rowData,['Employee Ledger Card']);
    
	array_push($rowData,['Date : '  . date('m/d/Y')]);
	
	array_push($rowData,['Employee: '.$empname] );
	
	array_push($rowData,['Employee No.: '.$employee_no ]);
	
	array_push($rowData,['Department: '.$department ]);
    
    
   
    array_push($rowData,['Item No','Property No.','Asset Number','Item Description','Acquisition Cost','PAR No.','Location']);


// function Footer()
// {
//     // Position at 1.5 cm from bottom

//    $this->SetXY(10,-40);
//    $this->Cell(80,7,'Conforme',0,0,'L');
//    $this->SetXY(10,-30);
//    $this->Cell(80,7,'','B');

//     $this->SetY(-15);
//     // Arial italic 8
//     $this->SetFont('Arial','',10);
//     // Page number
//     $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
// }





$x=50;
$total =0;
$ctr=1;
$oldemp='xxx';

   $employee_code = $_GET['empcode'];


    $asset_qry = $conn->query("SELECT *,a.assetassignee as employee_code, concat(e.lastname,', ',e.firstname) as empname, m.assignnumber as assignnumber, l.name as location  FROM assets a LEFT JOIN employee e on a.assetassignee=e.id LEFT JOIN department d on a.department_id = d.id  LEFT JOIN location l on a.location_id=l.id LEFT JOIN assetassignment m ON a.asset_code=m.assetcode WHERE a.assetassignee=".$employee_code." and m.assign_status='Active'") or die($conn->error);
          while($row=$asset_qry->fetch_array()){
        
        array_push( $rowData,[$ctr,'',$row['asset_code'],$row['asset_name'],$row['purchase_amount'],$row['assignnumber'],$row['location']]);


		$total += $row['purchase_amount'];

		$x += 5;
        $ctr+=1; 
		}
	
	//array_push( $rowData,'TOTAL',,number_format($total,2,'.',',');




$writer->writeSheet($rowData,$fname);  

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$fname.'"');
    header('Cache-Control: max-age=0');
    $writer->writeToStdOut();





?>