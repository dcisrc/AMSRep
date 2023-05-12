<?php

session_start();
include('../db_connect.php'); 
require('../xlsxwriter.class.php');
include('../db_connect.php'); 




$writer = new XLSXWriter();
$writer->setAuthor($_SESSION['system_info']['company_name']);
$sheetname = 'Employee_ledger_sheet';

$styles1= array( 'font'=>'Calibri','font-size'=>20,'font-style'=>'bold');
$styles2= array( 'font'=>'Calibri','font-size'=>12,'font-style'=>'bold', 'border'=>'top,bottom,left,right','border-style'=>'thin','wrap_text'=>true);
$styles3= array( 'font'=>'Calibri','font-size'=>11,'font-style'=>'normal'); 
$styles4= array( 'font'=>'Calibri','font-size'=>11,'font-style'=>'normal', 'border'=>'top,bottom,left,right','border-style'=>'thin');
$styles5= array( 'font'=>'Calibri','font-size'=>9,'font-style'=>'normal','border'=>'top','border-style'=>'thin'); 
$styles6= array( 'font'=>'Calibri','font-size'=>11,'font-style'=>'bold', 'border'=>'top,bottom,left,right','border-style'=>'thin','halign'=>'center');


$columnformats = array('col1'=>'integer', 
					   'col2'=>'string',
					   'col3'=>'string',
					   'col4'=>'string',
					   'col5'=>'#,##0.00',
					   'col6'=>'string',
					   'col7'=>'string');   
    
	$employee_code = $_GET['empcode'];

    $emp_query = $conn->query("SELECT  employee_no, concat(lastname,', ',firstname) as empname, d.name as dept FROM  employee e LEFT JOIN department d ON e.department_id = d.id WHERE e.id=".$employee_code);
    while($row = $emp_query->fetch_array()){
    	$empname = $row['empname'];
    	$employee_no= $row['employee_no'];
        $department = $row['dept'];  
    }
   
$fname='ELC'.date('mdY').'-'.$empname.'.xlsx';




    
    $writer->writeSheetHeader($sheetname, $columnformats, $col_options = ['widths'=>[8,15,15,40,13,20,15],'suppress_row'=>true] );
	
    $writer->writeSheetRow($sheetname, $rowdata = [$_SESSION['system_info']['company_name']], $styles1 );
    
    
    $writer->markMergedCell($sheetname, $start_cell_row=1, $start_cell_column=0, $end_cell_row=1, $end_cell_column=3);
	$writer->writeSheetRow($sheetname, $rowdata = ['EMPLOYEE LEDGER CARD'], $styles2 );

	$writer->writeSheetRow($sheetname, $rowdata= ['Date : '  . date('m/d/Y')], $styles3 );
	
	$writer->writeSheetRow($sheetname, $rowdata = ['Employee: '.$empname,'','','','Employee No.: '.$employee_no] , $styles3  );
		
    $writer->writeSheetRow($sheetname, $rowdata = ['Department: '.$department ], $styles3  );
    
    $writer->writeSheetRow($sheetname, $rowdata = ['']);
  
    
    $writer->writeSheetRow($sheetname, $rowdata  = array('Item No','Property No','Asset Number','Item Description','Acquisition Cost','PAR No.','Location'), $row_options = ['height'=>30 , $styles2, $styles2 , $styles2 , $styles2 , $styles2 , $styles2 , $styles2] );




$x=50;
$total =0;
$ctr=1;
$oldemp='xxx';

   $employee_code = $_GET['empcode'];


    $asset_qry = $conn->query("SELECT *,a.assetassignee as employee_code, concat(e.lastname,', ',e.firstname) as empname, m.assignnumber as assignnumber, l.name as location  FROM assets a LEFT JOIN employee e on a.assetassignee=e.id LEFT JOIN department d on a.department_id = d.id  LEFT JOIN location l on a.location_id=l.id LEFT JOIN assetassignment m ON a.asset_code=m.assetcode WHERE a.assetassignee=".$employee_code." and m.assign_status='Active'") or die($conn->error);
          while($row=$asset_qry->fetch_array()){
        
      

        $writer->writeSheetRow($sheetname, $rowData = [$ctr,'',$row['asset_code'],$row['asset_name'],$row['purchase_amount'],$row['assignnumber'],$row['location']], $row_options = ['height'=>20, $styles4, $styles4, $styles4, $styles4, $styles4, $styles4, $styles4] );
		
		$total += $row['purchase_amount'];

		$x += 5;
        $ctr+=1; 
		}
	    //$writer->writeSheetRow('Sheet1', $rowdata = ['']);
	    $writer->markMergedCell($sheetname, $start_cell_row=$ctr+6, $start_cell_column=1, $end_cell_row=$ctr+6, $end_cell_column=3);
	 	$writer->writeSheetRow($sheetname, $rowdata = ['','TOTAL','','',$total,'',''],$row_options = [$styles4, $styles6, $styles4, $styles4, $styles4 , $styles4, $styles4]);
	 	
        $writer->writeSheetRow($sheetname, $rowdata = ['']);
        $writer->writeSheetRow($sheetname, $rowdata = ['']);
        $writer->writeSheetRow($sheetname, $rowdata = ['']);
		$writer->writeSheetRow($sheetname, $rowdata = ['','Conforme:'],$row_options = $styles3);
		$writer->writeSheetRow($sheetname, $rowdata = ['']);
        $writer->writeSheetRow($sheetname, $rowdata = ['','SIGNATURE OVER PRINTED NAME',''],$row_options = $styles3, $styles5,$styles5);
        
       

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$fname.'"');
    header('Cache-Control: max-age=0');
    $writer->writeToStdOut();

	//$writer->writeToFile($fname);
exit();



?>