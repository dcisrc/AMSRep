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
	$this->SetX(140);
	$this->Cell(40,10,'Date : '  . date('m/d/Y'));
    $this->SetY(15);
    $this->Cell(300,10,'Asset Management System - Activity Logs');
    $this->SetXY(10,25);
    $this->SetFont('Arial','',10);
    $this->Cell(30,7,'Date',1);
    $this->SetX(40);
    $this->Cell(30,7,'IP Address',1);
    $this->SetX(70);
    $this->Cell(30,7,'User',1);
    $this->SetX(100);
    $this->Cell(40,7,'Module',1);
    $this->SetX(140);
    $this->Cell(45,7,'Action',1);
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
$pdf->SetTitle('Activity Logs');
//$pdf->Header();

$x=30;
$total =0;
$oldcat='';



    $activity_qry = $conn->query("SELECT access_date,module,action,mac,e.firstname as user FROM activitylogs a LEFT JOIN employee e on a.login_id=e.id  ORDER BY access_date desc") or die($conn->error);
          while($row=$activity_qry->fetch_array()){
        
        $y = 10;  	
  		$pdf->SetXY($y,$x);  
  		
  	

        //fix localhost IP
        if ($row['mac'] == "::1"){
        	$mac = "local";
        }
        else{
        	$mac = $row['mac'];
        }	


		
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,$row['access_date']);
		$y=40;
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,$mac);
		$y=70;
		$pdf->SetXY($y,$x);
		$pdf->Cell(20,10,$row['user']);
		
		$y=100;
		$pdf->SetXY($y,$x);
		$pdf->MultiCell(40,10,$row['module']);
		$y=140;
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,$row['action']);

		$x += 5;

		
        }
	$y = 10;
	$x+=5;
	$pdf->SetXY($y,$x);
	//$pdf->Cell(10,10,'TOTAL');
	//$y=100;
	//$pdf->SetXY($y,$x);
    //$pdf->Cell(30,10,number_format($total,2,'.',','),0,0,'R');



$pdf->Output();





?>