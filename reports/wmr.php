<?php

session_start();
require('../fpdf184/fpdf.php');
include('../db_connect.php'); 



$prop_custodian = 'MAE T. OFFICIAR';

class PDF extends FPDF
{

function Header()
{

  

	$prop_custodian = 'MAE T. OFFICIAR';
    //Logo
    //parent::Header();
    //$this->Image('../images/logo.png', 10, 8, 45);
	$this->SetFont('Arial','B',10);
	$this->SetXY(150,10);

    $this->SetFont('Arial','B',12);
    $this->SetXY(10,20);
    $this->Cell(200,10,'WASTE MATERIALS REPORT',0,0,'C');
    $this->SetFont('Arial','B',10);
    $this->SetXY(10,35);
    $this->Cell(140,5,'Entity Name: '.$_SESSION['system_info']['company_name'],0,0);
	$this->SetXY(120,35);
    $this->Cell(40,5,'Fund Cluster: ');
    $this->SetXY(10,40);
    $this->Cell(110,7,'Place of Storage: ','LTRB');
    $this->SetXY(120,40);
    $this->Cell(75,7,'Date : ','TRB');
    $this->SetXY(10,47);
    $this->SetFont('Arial','B',10);
    $this->Cell(185,7,'ITEMS FOR DISPOSAL','LBR');

    $x = 54; 
    $this->SetXY(10,$x);
    $this->SetFont('Arial','B',10);
	$this->Cell(15,5,'','LTR');
	$this->SetXY(25,$x);
	$this->Cell(20,5,'','LTR');
    $this->SetXY(45,$x);
    $this->Cell(20,5,'','LTR');
    $this->SetXY(65,$x);
    $this->Cell(70,5,'','LTR','0','C');
   
    $this->SetXY(135,$x);
    $this->Cell(60,5,'Record of Sales ','LTR','0','C');
   
    
    $x = 59; 
    $this->SetXY(10,$x);
    $this->Cell(15,4,'Item','LR');
    $this->SetXY(25,$x);
    $this->Cell(20,4,'Quantity','LR');
    $this->SetXY(45,$x);
    $this->Cell(20,4,'Unit','LR');
    $this->SetXY(65,$x);
    $this->Cell(70,4,'Description','LR','0','C');
    $this->SetXY(135,$x);
    $this->SetFont('Arial','',9);
    $this->Cell(60,4,'Official Receipt ','LTR','0','C');

    $x = 63; 
    $this->SetXY(10,$x);
    $this->Cell(15,4,'','LBR');
    $this->SetXY(25,$x);
    $this->Cell(20,4,'','LBR');
    $this->SetXY(45,$x);
    $this->Cell(20,4,'','LBR');
    $this->SetXY(65,$x);
    $this->Cell(70,4,'','LBR','0','C');
    $this->SetXY(135,$x);
    $this->Cell(20,4,'No.','LBR','0','C');
    $this->Cell(20,4,'Date','LBR','0','C');
    $this->Cell(20,4,'Amount','LBR','0','C');

}

function Footer()
{

    $x=-97;
    $this->SetY($x);
   
    $this->Cell(100,7,'Certified Correct:','LT');
    $this->Cell(90,7,'Disposal Approved:','TR');
    $x=-90;
    $this->SetY($x);
    $this->Cell(15,5,'','L');
    $this->Cell(70,5,'','B');
    $this->Cell(15,5,'','');

    $this->Cell(5,5,'');
    $this->Cell(80,5,'','B');
    $this->Cell(5,15,'','R');
    $x=-85; 
    $this->SetY($x);
    $this->Cell(15,12,'','L');
    $this->MultiCell(70,4,'Signature Over Printed Name of Supply and/or Property Custodian','','C');
    $this->SetY($x);
    $this->Cell(120,5,'');
    $this->MultiCell(60,4,'Signature Over Printed Name of Head of Agency/Entity or his/her Authorized Representative','','C');
    $x=-72;
    $this->SetFont('Arial','B',11);
    $this->SetY($x);
    $this->Cell(190,7,'CERTIFICATE OF INSPECTION','LTR',0,'C');
    $this->SetFont('Arial','',10);
   
    $x=-65;
    $this->SetY($x);
    $this->Cell(190,5,'','LTR');
    $x=-60;
    $this->SetY($x);
    $this->Cell(190,10,'     I hereby certify that the property enumerated above was disposed as follows:','LR');
    $x=-50;
    $this->SetY($x);
    $this->Cell(190,5,'                 Item _______ Destroyed','LR');
    $x=-45;
    $this->SetY($x);
    $this->Cell(190,5,'                 Item _______ Sold st private sale','LR');
    $x=-40;
    $this->SetY($x);
    $this->Cell(190,5,'                 Item _______ Sold at pubic auction','LR');
    $x=-35;
    $this->SetY($x);
    $this->Cell(190,5,'                 Item _______ Transferred without cost to _____________________','LR');
    $x=-30;
    $this->SetY($x);
    $this->Cell(100,5,'Certified Correct:','LT');
    $this->Cell(90,5,'Withness to Disposal:','TR');
    $x=-25;
    $this->SetY($x);
    $this->Cell(15,5,'','L');
    $this->Cell(70,5,'','B');
    $this->Cell(15,5,'','');
    $this->Cell(70,5,'','B');
        
    $x=-20;
    $this->SetY($x);
    $this->Cell(20,8,'','L');
    $this->MultiCell(60,4,'Signature Over Printed Name of Inspection Officer','','C');
    $this->SetY($x);
    $this->Cell(120,5,'','');
    $this->MultiCell(60,4,'Signature Over Printed Name of Witness','','C');
    //$x=-14;
    //$this->SetY($x);
    $this->Cell(190,5,'','LBR');
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
$pdf->SetTitle('Waste Materials Report');
//$pdf->Header();

$x=70;
$total =0;

$assignee = null;



    $asset_qry = $conn->query("SELECT  aa.assetcode as asset_code, a.asset_name as asset_name, a.purchase_amount as purchase_amount, concat(e.firstname,' ',MID(e.middlename,1,1),'. ',e.lastname) as assignee , a.purchase_date as purchase_date, a.serial_number as serial_number, unit_of_measure FROM assetassignment aa LEFT JOIN assets a ON aa.assetcode=a.asset_code  LEFT JOIN employee e on a.assetassignee=e.id WHERE `condition` = 'Unserviceable' ") or die($conn->error);
          while($row=$asset_qry->fetch_array()){
          	if (is_null($assignee)){
        $assignee = $row['assignee'];}
        $y = 10;  	
  		$pdf->SetXY($y,$x);  
  		$pdf->Cell(15,10,'1','LBR');
        $y = 25;    
        $pdf->SetXY($y,$x);  
        $pdf->Cell(20,10,'1','LBR');
  		$y = 45;  
  		$pdf->SetXY($y,$x);
		$pdf->Cell(20,10,$row['unit_of_measure'],'LBR');
		$y=65;
		$pdf->SetXY($y,$x);
		$pdf->MultiCell(70,4,$row['asset_name'].' S/N:'.$row['serial_number'],'L');
		$y=135;
        $pdf->SetXY($y,$x);
		$pdf->Cell(20,10,'','LBR','0','C');
        $y = 155;  
        $pdf->SetXY($y,$x);
        $pdf->Cell(20,10,'','LBR','0','C');
        $y = 175;  
        $pdf->SetXY($y,$x);
        $pdf->Cell(20,10,'','LBR','0','C');

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
    $pdf->Cell(50,5,$prop_custodian);
    $pdf->SetFont('Arial','',10);



$pdf->Output();





?>