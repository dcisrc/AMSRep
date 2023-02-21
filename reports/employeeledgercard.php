<?php

session_start();
require('../fpdf184/fpdf.php');
include('../db_connect.php'); 





class PDF extends FPDF
{

function Header()
{
    //Logo
    //parent::Header();
    //$this->Image('../images/logo.png', 10, 8, 45);
	$this->SetFont('Arial','B',10);
	$this->SetXY(10,10);
	$this->Cell(200,10,$_SESSION['system_info']['company_name']);
    $this->SetY(15);
    $this->Cell(300,10,'Asset Management System - Employee Ledger Card');
    $this->SetX(140);
	$this->Cell(40,10,'Date : '  . date('m/d/Y'));
    $this->SetXY(10,30);
    $this->SetFont('Arial','',10);
    $this->Cell(30,7,'Asset Code',1);
    $this->SetX(40);
    $this->Cell(85,7,'Asset Details',1);
    $this->SetX(125);
    $this->Cell(30,7,'Purchase Amount',1);
    $this->SetX(155);
    $this->Cell(35,7,'Purchase Date',1);
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
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->SetTitle('Employee Ledger Card');
//$pdf->Header();

$x=40;
$total =0;
$oldemp='xxx';

$employee_code = $_GET['empcode'];

    $asset_qry = $conn->query("SELECT *,a.assetassignee as employee_code, concat(e.lastname,', ',e.firstname) as empname  FROM assets a LEFT JOIN employee e on a.assetassignee=e.id LEFT JOIN department d on a.department_id = d.id LEFT JOIN category c on a.category_id = c.id WHERE a.assetassignee=".$employee_code) or die($conn->error);
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
		$pdf->Cell(85,10,$row['asset_name'].' S/N:'.$row['serial_number']);
		$y=135;
		$pdf->SetXY($y,$x);
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,$row['purchase_date']);
		$y=155;
		$pdf->SetXY($y,$x);
		$pdf->Cell(35,10,number_format($row['purchase_amount'],2,'.',','),0,0,'R');
		$total += $row['purchase_amount'];

		$x += 5;

		}
	$y = 10;
	$x+=5;
	$pdf->SetXY($y,$x);
	$pdf->Cell(10,10,'TOTAL');
	$y=155;
	$pdf->SetXY($y,$x);
    $pdf->Cell(35,10,number_format($total,2,'.',','),'BT',2,'R');
    $pdf->Cell(35,1,'','B',0,'R');




$pdf->Output();





?>