<?php

session_start();
require('../fpdf184/fpdf.php');
include('../db_connect.php'); 





class PDF extends FPDF
{

function Header()
{
    include('../db_connect.php'); 
    
	$employee_code = $_GET['empcode'];

    $emp_query = $conn->query("SELECT  employee_no, concat(lastname,', ',firstname) as empname, d.name as dept FROM  employee e LEFT JOIN department d ON e.department_id = d.id WHERE e.id=".$employee_code);
   if ($emp_query->num_rows > 0) { 

	    while($row = $emp_query->fetch_array()){
	    	$empname = $row['empname'];
	    	$employee_no= $row['employee_no'];
 	       $department = $row['dept'];  
	    }
    //Logo
    //parent::Header();
    //$this->Image('../images/logo.png', 10, 8, 45);
		$this->SetFont('Arial','B',10);
		$this->SetXY(10,10);
		$this->Cell(200,10,$_SESSION['system_info']['company_name']);
	    $this->SetY(15);
    	$this->Cell(300,10,'Employee Ledger Card');
	    $this->SetXY(10,20);
		$this->Cell(40,10,'Date : '  . date('m/d/Y'));
		$this->SetXY(10,25);
		$this->Cell(40,10,'Employee: '.$empname );
		$this->SetX(200);
		$this->Cell(40,10,'Employee No.: '.$employee_no );
		$this->SetXY(10,30);
		$this->Cell(40,10,'Department: '.$department );
	    $this->SetXY(10,40);
    
    	$this->SetFont('Arial','',10);
	    $this->Cell(15,7,'Item No',1);
    	$this->Cell(30,7,'Property No.',1);
	    $this->Cell(40,7,'Asset Number',1);
    	//$this->SetX(40);
	    $this->Cell(85,7,'Item Description',1);
    	//$this->SetX(125);
	    $this->Cell(30,7,'Acquisition Cost',1);
    	//$this->SetX(155);
	    $this->Cell(35,7,'PAR No.',1);
    	$this->Cell(35,7,'Location',1);
} else {
  echo "No record found...";
}


function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','',10);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L');
$pdf->SetFont('Arial','',10);
$pdf->SetTitle('Employee Ledger Card');

//$pdf->Header();

$x=50;
$total =0;
$ctr=1;
$oldemp='xxx';

   $employee_code = $_GET['empcode'];


    $asset_qry = $conn->query("SELECT *,a.assetassignee as employee_code, concat(e.lastname,', ',e.firstname) as empname, m.assignnumber as assignnumber, l.name as location  FROM assets a LEFT JOIN employee e on a.assetassignee=e.id LEFT JOIN department d on a.department_id = d.id LEFT JOIN category c on a.category_id = c.id LEFT JOIN location l on a.location_id=l.id LEFT JOIN assetassignment m ON a.asset_code=m.assetcode WHERE a.assetassignee=".$employee_code." and m.assign_status='Active'") or die($conn->error);
          while($row=$asset_qry->fetch_array()){
        
        $y = 10;  	
  		$pdf->SetXY($y,$x);  
  		
  		// if ($row['employee_code']!=$oldemp){
  		// 	if ($row['employee_code'] == null){
  		// 		$pdf->SetFont('Arial','UBI',10);
		// 		$pdf->Cell(10,10,'Assignee: Unassigned');
		// 		$oldemp = '';
		// 		$pdf->SetFont('Arial','',10);
		// 		$x+=10;

  		// 	}
  		// 	else {
  			
  		// 		$pdf->SetFont('Arial','UBI',10);
		// 		$pdf->Cell(10,10,'Assignee: '.$row['empname']);
		// 		$oldemp = $row['employee_code'] ;
		// 		$pdf->SetFont('Arial','',10);
		// 		$x+=10;
		// 	}
		// }

		

		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,$ctr);
		$y=56;
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,$row['asset_code']);
		$y=96;
		$pdf->SetXY($y,$x);
		$pdf->Cell(85,10,$row['asset_name']);
		$y=175;
		
		$pdf->SetXY($y,$x);
		$pdf->Cell(35,10,number_format($row['purchase_amount'],2,'.',','),0,0,'R');
		//$pdf->Cell(10,10,$row['purchase_date']);
		$y=210;
		$pdf->SetXY($y,$x);
		$pdf->Cell(85,10,$row['assignnumber']);
		$y=235;
		$pdf->SetXY($y,$x);
		$pdf->Cell(85,10,$row['location']);


		$total += $row['purchase_amount'];

		$x += 5;
        $ctr+=1; 
		}
	$y = 10;
	$x+=5;
	$pdf->SetXY($y,$x);
	$pdf->Cell(10,10,'TOTAL');
	$y=175;
	$pdf->SetXY($y,$x);
    $pdf->Cell(35,10,number_format($total,2,'.',','),'BT',2,'R');
    $pdf->Cell(35,1,'','B',0,'R');




$pdf->Output();





?>