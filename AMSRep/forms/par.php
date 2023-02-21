<?php

session_start();
require('../fpdf184/fpdf.php');
include('../db_connect.php'); 

$parnumber = $_GET['parnumber'];

$prop_custodian = 'MAE T. OFFICIAR';

class PDF extends FPDF
{

function Header()
{

    global $parnumber;

	$prop_custodian = 'MAE T. OFFICIAR';
    //Logo
    //parent::Header();
    //$this->Image('../images/logo.png', 10, 8, 45);
	$this->SetFont('Arial','B',10);
	$this->SetXY(150,10);

    $this->SetFont('Arial','B',12);
    $this->SetXY(10,25);
    $this->Cell(200,10,'PROPERTY ACKNOWLEDGEMENT RECEIPT ',0,0,'C');
    $this->SetFont('Arial','B',10);
    $this->SetXY(10,35);
    $this->Cell(140,10,'Entity Name: '.$_SESSION['system_info']['company_name'],0,0);
	$this->SetXY(150,35);
    $this->Cell(40,10,'PAR No: '.$parnumber);
    $this->SetXY(10,40);
    $this->Cell(40,10,'Fund Cluster: ');
    $this->SetXY(150,40);
    $this->Cell(40,10,'Date : ');

    $x = 50; 
    $this->SetXY(10,$x);
    $this->SetFont('Arial','',9);
	$this->Cell(10,10,'Qty.','LTR');
	$this->SetXY(20,$x);
	$this->Cell(10,10,'Unit','LTR');
    $this->SetXY(30,$x);
    $this->Cell(80,10,'Description','LTR','0','C');
   
    $this->SetXY(110,$x);
    $this->Cell(35,5,'Property ','LTR','0','C');
    $this->SetXY(145,$x);
    $this->Cell(20,5,'Date','LTR','0','C');
    $this->SetXY(165,$x);
    $this->Cell(40,10,'Amount ','LTR','0','C');

    $x = 55; 
	$this->SetXY(10,$x);
    $this->Cell(10,5,'','LBR');
	$this->SetXY(20,$x);
	$this->Cell(10,5,'','LBR');
    $this->SetXY(30,$x);
    $this->Cell(80,5,'','LBR');
    $this->SetXY(110,$x);
    $this->Cell(35,5,'Number','LBR','0','C');
    $this->SetXY(145,$x);
    $this->Cell(20,5,'Acquired','LBR');
    $this->SetXY(165,$x);
    $this->Cell(40,5,'','LBR');
}

function Footer()
{

    $x=-95;
    $this->SetY($x);
    $x=-90;
    $this->Cell(100,5,'Received by:','LTR');
    $this->Cell(90,5,'Issued/Approved by:','LTR');
    $this->SetY($x);
    $this->Cell(15,5,'','L');
    $this->Cell(70,5,'','B');
    $this->Cell(15,5,'','R');

    $this->Cell(5,5,'');
    $this->Cell(80,5,'','B');
    $this->Cell(5,15,'','R');
    $x=-85; 
    $this->SetY($x);
    $this->Cell(100,5,'Signature Over Printed Name','LR',0,'C');
    $this->Cell(90,5,'Signature Over Printed Name','R',0,'C');
    $x=-80;
    $this->SetY($x);
    $this->Cell(15,5,'','L');
    $this->Cell(70,5,'','B');
    $this->Cell(15,5,'','R');

    $this->Cell(5,5,'');
    $this->Cell(80,5,'','B');
    $this->Cell(5,5,'','R');
    $x=-75; 
    $this->SetY($x);
    $this->Cell(100,5,'Position/Office','LR',0,'C');
    $this->Cell(90,5,'Position/Office','R',0,'C');
    $x=-70; 
    $this->SetY($x);
    $this->Cell(15,5,'','L');
    $this->Cell(70,5,'','B');
    $this->Cell(15,5,'','R');
   
    $this->Cell(5,5,'');
    $this->Cell(80,5,'','B');
    $this->Cell(5,5,'','R');
    $x=-65;
    $this->SetY($x);
    $this->Cell(100,5,'Date','LR',0,'C');
    $this->Cell(90,5,'Date','R',0,'C');
    $x=-60;
    $this->SetY($x);
    $this->Cell(190,5,'Remarks:','LTR');
    $x=-55;
    $this->SetY($x);
    $this->Cell(190,5,'','LR');
    $x=-50;
    $this->SetY($x);
    $this->Cell(190,5,'Acquisition Details:','LR');
    $x=-45;
    $this->SetY($x);
    $this->Cell(190,5,'Supplier Name:','LR');
    $x=-40;
    $this->SetY($x);
    $this->Cell(190,5,'P.O. No:','LR');
    $x=-35;
    $this->SetY($x);
    $this->Cell(190,5,'D.R. No:','LR');
    $x=-30;
    $this->SetY($x);
    $this->Cell(190,5,'IAR No:','LR');
    $x=-25;
    $this->SetY($x);
    $this->Cell(190,5,'RIS No:','LR');
    $x=-20;
    $this->SetY($x);
    $this->Cell(190,5,'Warranty:','LBR');

    
    //$this->SetY(-15);
    //$this->SetFont('Arial','',10);
    // Page number
    //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->SetTitle('Property Acknowledgement Receipt');
//$pdf->Header();

$x=60;
$total =0;

$assignee = null;



    $asset_qry = $conn->query("SELECT  aa.assetcode as asset_code, a.asset_name as asset_name, a.purchase_amount as purchase_amount, concat(e.firstname,' ',MID(e.middlename,1,1),'. ',e.lastname) as assignee , a.purchase_date as purchase_date, a.serial_number as serial_number FROM assetassignment aa LEFT JOIN assets a ON aa.assetcode=a.asset_code  LEFT JOIN employee e on a.assetassignee=e.id WHERE assignnumber='".$parnumber."'") or die($conn->error);
          while($row=$asset_qry->fetch_array()){
          	if (is_null($assignee)){
        $assignee = $row['assignee'];}
        $y = 10;  	
  		$pdf->SetXY($y,$x);  
  		$pdf->Cell(10,10,'1','LBR');
  		$y = 20;  
  		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,'pc.','LBR');
		$y=30;
		$pdf->SetXY($y,$x);
		$pdf->Cell(80,10,$row['asset_name'].' S/N:'.$row['serial_number'],'LBR');
		$y=110;
		$pdf->SetXY($y,$x);
		$pdf->Cell(35,10,$row['asset_code'],'LBR');
		$y=145;
        $pdf->SetXY($y,$x);
        $pdf->Cell(20,10,$row['purchase_date'],'LBR');
		$y=165;
		$pdf->SetXY($y,$x);
		$pdf->Cell(40,10,number_format($row['purchase_amount'],2,'.',','),'LBR',0,'R');
		$total += $row['purchase_amount'];
        //$y=165;
        //$pdf->SetXY($y,$x);
        //$pdf->Cell(20,10,'','LBR');
        //$y=185;
		
        //$pdf->SetXY($y,$x);
        //$pdf->Cell(20,10,'','LBR');

		$x += 10;

		}
	$y = 10;
	$x+=5;
	//$pdf->SetXY($y,$x);
	//$pdf->Cell(10,10,'TOTAL');
	
	//$pdf->SetXY($y,$x);
    //$pdf->Cell(20,10,number_format($total,2,'.',','),0,0,'R');
    $pdf->SetXY(40,-90);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(50,5,$assignee);
    $pdf->SetFont('Arial','',10);



$pdf->Output();





?>