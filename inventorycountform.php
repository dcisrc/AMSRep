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
	$this->SetFont('Arial','B',8);
	$this->SetXY(10,10);
	$this->Cell(200,10,$_SESSION['system_info']['company_name']);
    $this->SetY(15);
    $this->Cell(300,10,'Asset Management System - Inventory Count Form');
    $this->SetY(20);
    $this->Cell(200,10,'Date : '  . date('m/d/Y')); 
    $this->SetY(25);
	
// TOP alingmnet / 1st Row	
    $this->SetXY(10,35);
    $this->SetFont('Arial','',8);
    $this->MultiCell(25,5,'','LTR');
    $this->SetXY(35,35);
    $this->MultiCell(38,5,'','LT');
    $this->SetXY(72,35);
    $this->MultiCell(25,5,'','LTR');
    $this->SetXY(97,35);
    $this->MultiCell(25,5,' Old Property No. ','LTR');
    $this->SetXY(122,35);
    $this->MultiCell(35,5,'       New Property No.','LTR');
    $this->SetXY(157,35);
    $this->MultiCell(13,5,'  Unit of','LTR');
    $this->SetXY(170,35);
    $this->MultiCell(16,5,'','LTR');
    $this->SetXY(186,35);
    $this->MultiCell(15,5,'  Qty per','LTR');
    $this->SetXY(201,35);
    $this->MultiCell(15,5,'  Qty per','LTR');
    $this->SetXY(216,35);
    $this->MultiCell(35,5,'','LTR');
    $this->SetXY(251,35);
    $this->MultiCell(20,5,'','LTR');
    $this->SetXY(271,35);
    $this->MultiCell(20,5,'','LTR');

// Middle alingmnet / 2nd Row  
    $this->SetXY(10,40);
    $this->MultiCell(25,5,'     Article/Item','LR');
    $this->SetXY(35,40);
    $this->MultiCell(38,5,'                Description','L');
    $this->SetXY(72,40);
    $this->MultiCell(25,5,'     ASSET TAG','LR');
    $this->SetXY(97,40);
    $this->MultiCell(25,5,'      Assigned','LR');
    $this->SetXY(122,40);
    $this->MultiCell(35,5,' Assigned (to be filled up','LR');
    $this->SetXY(157,40);
    $this->MultiCell(13 ,5,'Measure','LR');
    $this->SetXY(170,40);
    $this->MultiCell(16,5,'Unit Value','LR');
    $this->SetXY(186,40);
    $this->MultiCell(15,5,' Property','LR');
    $this->SetXY(201,40);
    $this->MultiCell(15,5,' Physical','LR');
    $this->SetXY(216,40);
    $this->MultiCell(35,5,'Location/WWhereabouts','LR');
    $this->SetXY(251,40);
    $this->MultiCell(20,5,'    Condition','LR');    
    $this->SetXY(271,40);
    $this->MultiCell(20,5,'  Remarks','LR');    

// BOTTOM alingmnet / 3rd Row  
    $this->SetXY(10,45);
    $this->MultiCell(25,5,'','LBR');
    $this->SetXY(35,45);
    $this->MultiCell(38,5,'','LBR');
    $this->SetXY(72,45);
    $this->MultiCell(25,5,'','LBR');
    $this->SetXY(97,45);
    $this->MultiCell(25,5,'','LBR');
    $this->SetXY(122,45);
    $this->MultiCell(35,5,'       during validation)','LBR');
    $this->SetXY(157,45);
    $this->MultiCell(13,5,'','LBR');
    $this->SetXY(170,45);
    $this->MultiCell(16,5,'','LBR');
    $this->SetXY(186,45);
    $this->MultiCell(15,5,'    Card','LBR');
    $this->SetXY(201,45);
    $this->MultiCell(15,5,'   Count','LBR');
    $this->SetXY(216,45);
    $this->MultiCell(35,5,'','LBR');
    $this->SetXY(251,45);
    $this->MultiCell(20,5,'','LBR');
    $this->SetXY(271,45);
    $this->MultiCell(20,5,'','LBR');


}

function Footer()
{
/*	$this->SetFont('Arial','',8);
    $this->SetXY(10,-35);
    $this->Cell(276,22,'',1);
    $this->SetXY(10,-35);
    $this->Cell(20,5,'Certified Correct by:');
    $this->SetX(105);
    $this->Cell(20,5,'Approved by:');
    $this->SetX(216);
    $this->Cell(20,5,'Witnessed by:');
    $this->SetXY(30,-25);
    $this->MultiCell(50,3.5,'Signature over Printed Name of Inventory Committee Chair and Members','T','C');
	$this->SetXY(125,-25);
    $this->MultiCell(50,3.5,'Signature over Printed Name of Head of Agency/Entity or Authorized Representative','T','C');
	$this->SetXY(226,-25);
	$this->MultiCell(50,3.5,'Signature over Printed Name of COA Representative','T','C');	
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
 */   
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4');
$pdf->SetFont('Arial','',8);
$pdf->SetTitle('List of Assigned Assets Per Employee');

//$pdf->Header();

$x=60;
$total =0;
$oldemp='xxx';

   $asset_qry = $conn->query("SELECT aa.assetcode, a.asset_name, aa.assignnumber, aa.prevassignnumber, a.unit_of_measure, a.purchase_amount, a.condition, id.asset_status as status, d.name as depname, l.name as locname, id.remarks FROM assetassignment aa
            LEFT JOIN assets a ON a.asset_code = aa.assetcode
            LEFT JOIN department d ON d.id = a.department_id
            LEFT JOIN location l ON l.id = a.location_id
            LEFT JOIN inventorydetails id ON id.asset_code = aa.assetcode") or die($conn->error);
          while($row=$asset_qry->fetch_array()){

         if ($pdf->GetY() > 160) {
             $pdf->AddPage('L','A4');
             $x=60;
         }

        $y=10;    
        $pdf->SetXY($y,$x);
        $pdf->Cell(75,1,$row['assetcode']);
        $y=38;    
        $pdf->SetXY($y,$x);
        $pdf->Cell(85,1,$row['asset_name']);       
        $y=72;
        $pdf->SetXY($y,$x);
//        $pdf->Cell(15,10,$row['assignnumber']);
        $y=100;
        $pdf->SetXY($y,$x);
        $pdf->Cell(15,1,$row['prevassignnumber']);
        $y=123;
        $pdf->SetXY($y,$x);
        $pdf->Cell(15,1,$row['assignnumber']);
        $y=160;
		$pdf->SetXY($y,$x);
		$pdf->Cell(15,1,$row['unit_of_measure']);
		$y=168;
		$pdf->SetXY($y,$x);
		$pdf->Cell(18,1,number_format($row['purchase_amount'],2,'.',','),0,0,'R');
        $y=225;
        $pdf->SetXY($y,$x);
        $pdf->Cell(15,1,$row['locname']);
        $y=250;
        $pdf->SetXY($y,$x);
        $pdf->Cell(15,1,$row['condition']);
        $y=270;
        $pdf->SetXY($y,$x);
        $pdf->Cell(15,1,$row['remarks']);

        $x+=4;
}		

$pdf->Output();

?>