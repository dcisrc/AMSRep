<?php

session_start();
require('../fpdf184/fpdf.php');
include('../db_connect.php'); 
$inv = $_GET['id'];

class PDF extends FPDF
{

function Header()
{
	include('../db_connect.php'); 
	$inv = $_GET['id'];
	$header_qry = $conn->query("SELECT description, inv_date FROM inventory WHERE id=".$inv) or die($conn->error);
	while($row=$header_qry->fetch_array()){
        $desc = $row['description']; 
        $inv_date = $row['inv_date'];

	}
    //Logo
    //parent::Header();
    //$this->Image('../images/logo.png', 10, 8, 45);
	$this->SetFont('Arial','B',10);
	$this->SetXY(10,10);
	$this->Cell(200,10,$_SESSION['system_info']['company_name']);
    $this->SetY(15);
    $this->Cell(300,10,'Asset Management System - Inventory Report (Per Employee)');
    $this->SetY(20);
    $this->Cell(300,10,$desc);
    $this->SetX(140);
	$this->Cell(40,10,'Inventory Date : '  . $inv_date);
    $this->SetXY(10,30);
    $this->SetFont('Arial','',10);
    $this->Cell(30,7,'Asset Code',1);
    $this->SetX(40);
    $this->Cell(85,7,'Asset Details',1);
    $this->SetX(125);
    $this->Cell(30,7,'Serial Number',1);
    $this->SetX(155);
    $this->Cell(35,7,'Status',1);
}

function Footer()
{

	include('../db_connect.php'); 
	$inv = $_GET['id'];
	$header_qry = $conn->query("SELECT concat(e.lastname,', ',e.firstname) as empname FROM inventory i LEFT JOIN employee e ON i.employee_id=e.id WHERE i.id=".$inv) or die($conn->error);
	while($row=$header_qry->fetch_array()){
        $cust = $row['empname']; 
        

	}
    // Position at 1.5 cm from bottom
    $this->SetFont('Arial','',10);
    $this->SetY(-60);
    $this->Cell(50,7,'Prepared by:');
    $this->SetX(120);
    $this->Cell(50,7,'Approved by:');
    $this->SetY(-42);
    $this->Cell(50,7,$cust,0,0,'C');
    $this->SetX(120);
    $this->Cell(50,7,'Gina A. Gonzales',0,0,'C');
    $this->SetY(-35);
	$this->Cell(50,7,'Property Custodian','T',0,'C');
	$this->SetX(120);
	$this->Cell(50,7,'Finance Head','T',0,'C');
    $this->SetY(-15);
    // Arial italic 8
    
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

}



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->SetTitle('Inventory Report');
//$pdf->Header();

$x=40;
$total =0;
$oldemp='xxx';



    $asset_qry = $conn->query("SELECT i.id, a.assetassignee as employee_code, concat(e.lastname,', ',e.firstname) as empname, id.asset_code as asset_code, a.asset_name as asset_name , a.serial_number as serial_number, id.asset_status as status FROM inventory i LEFT JOIN inventorydetails id ON i.id=id.inv_id LEFT JOIN assets a ON id.asset_code = a.asset_code LEFT JOIN employee e on a.assetassignee=e.id LEFT JOIN department d on e.department_id = d.id  WHERE i.id=".$inv." order by a.assetassignee" ) or die($conn->error);
          while($row=$asset_qry->fetch_array()){
        
        $y = 10;  	
  		$pdf->SetXY($y,$x);  
  		
  		if ($row['employee_code']!=$oldemp){
  			if ($row['employee_code'] == null){
  				$pdf->SetFont('Arial','UBI',10);
				$pdf->Cell(10,10,'Assignee: Unassigned');
				$oldemp = '';
				$pdf->SetFont('Arial','',10);
				$x+=10;

  			}
  			else {
  			
  				$pdf->SetFont('Arial','UBI',10);
				$pdf->Cell(10,10,'Assignee: '.$row['empname']);
				$oldemp = $row['employee_code'] ;
				$pdf->SetFont('Arial','',10);
				$x+=10;
			}
		}

		

		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,$row['asset_code']);
		$y=40;
		$pdf->SetXY($y,$x);
		$pdf->Cell(85,10,$row['asset_name']); 
		$y=125;
		$pdf->SetXY($y,$x);
		
		$pdf->Cell(10,10,$row['serial_number']);
		$y=155;
		$pdf->SetXY($y,$x);
		$pdf->Cell(35,10,$row['status']);
		//$pdf->Cell(35,10,number_format($row['purchase_amount'],2,'.',','),0,0,'R');
		//$total += $row['purchase_amount'];

		$x += 5;

		}
	$y = 10;
	$x+=5;
	$pdf->SetXY($y,$x);
	$pdf->Cell(10,10,'TOTAL');
	$y=155;
	$pdf->SetXY($y,$x);
    //$pdf->Cell(35,10,number_format($total,2,'.',','),'BT',2,'R');
    $pdf->Cell(35,1,'','B',0,'R');




$pdf->Output();





?>