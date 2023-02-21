<?php


require('../fpdf184/fpdf.php');
include('../db_connect.php'); 

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
	$this->Cell(200,10,'No. '.$mrnumber);
    $this->SetFont('Arial','B',10);
    $this->SetXY(40,25);
    $this->Cell(140,10,'MEMORANDUM RECEIPT FOR EQUIPMENT, SEMI',0,0,'C');
    $this->SetXY(40,30);
    $this->Cell(140,10,'EXPANDABLE AND NON-EXPANDABLE PROPERTY',0,0,'C');
    $this->SetXY(40,35);
    $this->Cell(140,10,'DBP DATA CENTER, INC., Philippines',0,0,'C');
	$this->SetXY(20,45);
    $this->Cell(200,10,'I acknowledged to have received from    '.$prop_custodian);
    $this->SetXY(20,50);
    $this->Cell(200,10,'the following property for which I am responsible, subject to the provisions of the Accounting Law,');
    $this->SetXY(20,55);
    $this->Cell(200,10,'and which will be used in the office of ');



    $this->SetXY(10,70);
    $this->SetFont('Arial','',9);
	$this->Cell(10,5,'QTY.','LTR');
	$this->SetXY(20,70);
	$this->Cell(10,5,'UNIT','LTR');
    $this->SetXY(30,70);
    $this->Cell(60,5,'NAME & DESCRIPTION','LTR');
    $this->SetXY(90,70);
    $this->Cell(20,5,'DATE ','LTR');
    $this->SetXY(110,70);
    $this->Cell(20,5,'PROPERTY ','LTR');
    $this->SetXY(130,70);
    $this->Cell(15,5,'CLASS','LTR');
    $this->SetXY(145,70);
    $this->Cell(20,5,'UNIT','LTR');
    $this->SetXY(165,70);
    $this->Cell(20,5,'TOTAL ','LTR');
    $this->SetXY(185,70);
    $this->Cell(20,5,'REMARKS','LTR');

	$this->SetXY(10,75);
    $this->Cell(10,5,'','LBR');
	$this->SetXY(20,75);
	$this->Cell(10,5,'','LBR');
    $this->SetXY(30,75);
    $this->Cell(60,5,'','LBR');
    $this->SetXY(90,75);
    $this->Cell(20,5,'ACQUIRED ','LBR');
    $this->SetXY(110,75);
    $this->Cell(20,5,'NUMBER ','LBR');
    $this->SetXY(130,75);
    $this->Cell(15,5,'NUMBER','LBR');
    $this->SetXY(145,75);
    $this->Cell(20,5,'VALUE','LBR');
    $this->SetXY(165,75);
    $this->Cell(20,5,'VALUE ','LBR');
    $this->SetXY(185,75);
    $this->Cell(20,5,'','LBR');
}

function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-40);
    // Arial italic 8
    $this->SetFont('Arial','',8);

    $this->MultiCell(100,3,'This form shall be prepared in duplicate. After both copiea are signed by the receiving employee, the original shall be kept by the Property Custodian and the duplicate by the receiving responsible employee.',0,'J');
    $this->SetFont('Arial','',10);
    
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
$pdf->SetTitle('Memorandum Receipt');
//$pdf->Header();

$x=80;
$total =0;

$assignee = null;



    $asset_qry = $conn->query("SELECT  aa.assetcode as asset_code, a.asset_name as asset_name, a.purchase_amount as purchase_amount, concat(e.firstname,' ',MID(e.middlename,1,1),'. ',e.lastname) as assignee , a.purchase_date as purchase_date, a.serial_number as serial_number FROM assetassignment aa LEFT JOIN assets a ON aa.assetcode=a.asset_code  LEFT JOIN employee e on a.assetassignee=e.id WHERE assignnumber='".$mrnumber."'") or die($conn->error);
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
		$pdf->Cell(60,10,$row['asset_name'].' S/N:'.$row['serial_number'],'LBR');
		$y=90;
		$pdf->SetXY($y,$x);
		$pdf->Cell(20,10,$row['purchase_date'],'LBR');
		$y=110;
		$pdf->SetXY($y,$x);
		$pdf->Cell(20,10,$row['asset_code'],'LBR');
		
		$y=130;
        $pdf->SetXY($y,$x);
        $pdf->Cell(15,10,'','LBR');
		$y=145;
		$pdf->SetXY($y,$x);
		$pdf->Cell(20,10,number_format($row['purchase_amount'],2,'.',','),'LBR',0,'R');
		$total += $row['purchase_amount'];
        $y=165;
        $pdf->SetXY($y,$x);
        $pdf->Cell(20,10,'','LBR');
        $y=185;
		
        $pdf->SetXY($y,$x);
        $pdf->Cell(20,10,'','LBR');

		$x += 10;

		}
	$y = 10;
	$x+=5;
	$pdf->SetXY($y,$x);
	$pdf->Cell(10,10,'TOTAL');
	$y=145;
	$pdf->SetXY($y,$x);
    $pdf->Cell(20,10,number_format($total,2,'.',','),0,0,'R');
    $pdf->SetXY(135,-40);
    $pdf->SetFont('Arial','UB',10);
    $pdf->Cell(50,5,$assignee);
    $pdf->SetFont('Arial','',10);



$pdf->Output();





?>