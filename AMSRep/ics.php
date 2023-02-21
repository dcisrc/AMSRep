<?php


require('fpdf184/fpdf.php');
include('db_connect.php'); 

$mrnumber = $_GET['mrnumber'];

$prop_custodian = 'MAE T. OFFICIAR';

class PDF extends FPDF
{

function Header()
{

    global $mrnumber;

	$prop_custodian = 'MAE T. OFFICIAR';
    //Logo
    //parent::Header();
    //$this->Image('../images/logo.png', 10, 8, 45);
	$this->SetFont('Arial','B',10);
	$this->SetXY(150,10);
    $this->SetFont('Times','B',12);
	$this->SetFont('Arial','B',10);
    $this->SetXY(40,30);
    $this->Cell(140,10,'INVENTORY CUSTODIAN SLIP',0,0,'C');
    $this->SetXY(10,40);
    $this->Cell(140,10,'Entity Name: DBP Data Center, Inc.',0,0,'L');
    $this->SetXY(10,45);
    $this->Cell(140,10,'Fund Cluster: Corporate Budget',0,0,'L');
	$this->SetXY(140,45);
    $this->Cell(4,10,'ICS No:'.$mrnumber);
  
    $this->SetXY(10,55);
    $this->SetFont('Arial','',9);
	$this->Cell(15,5,'','LTR');
	$this->SetXY(25,55);
	$this->Cell(12,5,'','LTR');
    $this->SetXY(37,55);
    $this->Cell(50,5,'Amount','LTRB',0,'C');
    $this->SetXY(87,55);
    $this->Cell(50,5,'','LTR');
    $this->SetXY(137,55);
    $this->Cell(18,5,'','LTR');
    $this->SetXY(155,55);
    $this->Cell(18,5,'Estimated','LTR',0,'C');


    $this->SetXY(10,60);
    $this->Cell(15,5,'Quantity','LR');
    $this->SetXY(25,60);
    $this->Cell(12,5,'Unit','LR',0,'C');
    $this->SetXY(37,60);
    $this->Cell(25,5,'Unit','LR',0,'C');
	$this->SetXY(62,60);
    $this->Cell(25,5,'Total Cost','LR',0,'C');
	$this->SetXY(87,60);
	$this->Cell(50,5,'Description','LR',0,'C');
    $this->SetXY(137,60);
    $this->Cell(18,5,'Item No.','LR',0,'C');
    $this->SetXY(155,60);
    $this->Cell(18,5,'Usefule Life','LR',0,'C');


    $this->SetXY(10,65);
    $this->Cell(15,5,'','LBR');
    $this->SetXY(25,65);
    $this->Cell(12,5,'','LBR');
    $this->SetXY(37,65);
    $this->Cell(25,5,'Cost','LBR',0,'C');
    $this->SetXY(62,65);
    $this->Cell(25,5,'','LBR');
    $this->SetXY(87,65);
    $this->Cell(50,5,'','LBR');
    $this->SetXY(137,65);
    $this->Cell(18,5,'','LBR');
    $this->SetXY(155,65);
    $this->Cell(18,5,'','LBR');

}

function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-70);
   
    $this->Cell(100,5,'Received From:','LTR');
    $this->Cell(90,5,'Received by:','LTR');
    $this->SetY(-65);
    $this->Cell(15,10,'','L');
    $this->Cell(70,10,'','B');
    $this->Cell(15,10,'','R');

    $this->Cell(5,10,'');
    $this->Cell(80,10,'','B');
    $this->Cell(5,10,'','R');

    $this->SetY(-55);
    $this->Cell(100,5,'Signature Over Printed Name','LR',0,'C');
    $this->Cell(90,5,'Signature Over Printed Name','R',0,'C');

    $this->SetY(-50);
    $this->Cell(15,10,'','L');
    $this->Cell(70,10,'','B');
    $this->Cell(15,10,'','R');

    $this->Cell(5,10,'');
    $this->Cell(80,10,'','B');
    $this->Cell(5,10,'','R');

    $this->SetY(-45);
    $this->Cell(100,5,'Position/Office','LR',0,'C');
    $this->Cell(90,5,'Position/Office','R',0,'C');

    $this->SetY(-40);
    $this->Cell(15,10,'','L');
    $this->Cell(70,10,'','B');
    $this->Cell(15,10,'','R');

    $this->Cell(5,10,'');
    $this->Cell(80,10,'','B');
    $this->Cell(5,10,'','R');

    $this->SetY(-30);
    $this->Cell(100,5,'Date','LBR',0,'C');
    $this->Cell(90,5,'Date','BR',0,'C');



    
    $this->SetY(-15);
    $this->SetFont('Arial','',10);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->SetTitle('Inventory Custodian Slip');
//$pdf->Header();

$x=80;
$total =0;

$assignee = null;



    $asset_qry = $conn->query("SELECT  aa.assetcode as asset_code, a.asset_name as asset_name, a.purchase_amount as purchase_amount, concat(e.firstname,' ',MID(e.middlename,1,1),'. ',e.lastname) as assignee , a.purchase_date as purchase_date, a.serial_number as serial_number FROM assetassignment aa LEFT JOIN assets a ON aa.assetcode=a.asset_code  LEFT JOIN employee e on a.assetassignee=e.id WHERE mrnumber='".$mrnumber."'") or die($conn->error);
          while($row=$asset_qry->fetch_array()){
          	if (is_null($assignee)){
        $assignee = $row['assignee'];}
        $y = 10;  	
  		$pdf->SetXY($y,$x);  
  		$pdf->Cell(10,10,'1','');
  		$y = 25;  
  		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,'pc.','');
		$y=37;
		$pdf->SetXY($y,$x);
        $pdf->Cell(20,10,number_format($row['purchase_amount'],2,'.',','),'',0,'R');
		
		$y=62;
		$pdf->SetXY($y,$x);
        $pdf->Cell(20,10,number_format($row['purchase_amount'],2,'.',','),'',0,'R');
        $y=87;
        $pdf->SetXY($y,$x);
        $pdf->Cell(50,10,$row['asset_name']);
		$y=137;
		$pdf->SetXY($y,$x);
		$pdf->Cell(20,10,$row['asset_code'],'');
		
		$y=155;
        $pdf->SetXY($y,$x);
        $pdf->Cell(15,10,'','');
		

		$x += 10;

		}
	



$pdf->Output();





?>