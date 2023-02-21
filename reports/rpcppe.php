<?php

session_start();
require('../fpdf184/fpdf.php');
include('../db_connect.php'); 

$cutoff = $_GET['cutoff'];
$category = $_GET['catid'];

$result = $conn->query("SELECT name FROM category WHERE id = ".$category);
   while($row=$result->fetch_array()){
   $categoryname = $row[0];
   } 

class PDF extends FPDF
{

function Header()
{
   
    global $cutoff;
    global $category;
    global $categoryname;
  

    //Logo
    //parent::Header();
    //$this->Image('../images/logo.png', 10, 8, 45);
	$this->SetFont('Arial','B',8);
	$this->SetXY(10,10);
	$this->Cell(200,10,$_SESSION['system_info']['company_name']);
    $this->SetY(15);
    $this->Cell(300,10,'Asset Management System - Report on Physical Count of Property, Plant and Equipments (RPCPPE)');
    $this->SetY(20);
    $this->Cell(200,10,'Type: '.$categoryname); 
    $this->SetY(25);
	$this->Cell(40,10,'As of : '  . $cutoff);
	$this->SetY(30);
	//$this->Cell(200,10,'Fund Cluster :');
	$this->SetY(35);
	$this->Cell(200,10,'For which,_____________________________________ is accountable, having assumed such accountability on ____________');
	
	
    $this->SetXY(10,45);
    $this->SetFont('Arial','',8);
    $this->MultiCell(45,5,'','LTR');
    $this->SetXY(55,45);
    $this->MultiCell(50,5,'','LTR');
    $this->SetXY(105,45);
    $this->MultiCell(20,5,'Property','LTR');
    $this->SetXY(125,45);
    $this->MultiCell(15,5,'Unit of ','LTR');
    $this->SetXY(140,45);
    $this->MultiCell(18,5,'Unit ','LTR');
    $this->SetXY(158,45);
    $this->MultiCell(18,5,'Balance Per','LTR');
    $this->SetXY(176,45);
    $this->MultiCell(20,5,'On Hand Per','LTR');
    $this->SetXY(196,45);
    $this->MultiCell(50,5,'','LTR','C');
    $this->SetXY(246,45);
    $this->MultiCell(30,5,'','LTR','C');

    $this->SetXY(10,50);
    $this->MultiCell(45,5,'Article','LR');
    $this->SetXY(55,50);
    $this->MultiCell(50,5,'Description','LR');
    $this->SetXY(105,50);
    $this->MultiCell(20,5,'Number','LR');
    $this->SetXY(125,50);
    $this->MultiCell(15,5,'Measure','LR');
    $this->SetXY(140,50);
    $this->MultiCell(18,5,'Value','LR');
    $this->SetXY(158,50);
    $this->MultiCell(18,5,'Card','LR');
    $this->SetXY(176,50);
    $this->MultiCell(20,5,'Count','LR');
    $this->SetXY(196,50);
    $this->MultiCell(50,5,'Shortage/Overage','LBR','C');
    $this->SetXY(246,50);
    $this->MultiCell(30,5,'Remarks','LR','C');

    $this->SetXY(10,55);
    $this->MultiCell(45,5,'','LBR');
    $this->SetXY(55,55);
    $this->MultiCell(50,5,'','LBR');
    $this->SetXY(105,55);
    $this->MultiCell(20,5,'','LBR');
    $this->SetXY(125,55);
    $this->MultiCell(15,5,'','LBR');
    $this->SetXY(140,55);
    $this->MultiCell(18,5,'','LBR');
    $this->SetXY(158,55);
    $this->MultiCell(18,5,'(Quantity)','LTBR');
    $this->SetXY(176,55);
    $this->MultiCell(20,5,'(Quantity)','LTBR');
    $this->SetXY(196,55);
    $this->MultiCell(20,5,'Quantity','LBR','C');
    $this->SetXY(216,55);
    $this->MultiCell(30,5,'Value','LBR','C');

    $this->SetXY(246,55);
    $this->MultiCell(30,5,'','LBR','C');


}

function Footer()
{
	$this->SetFont('Arial','',8);
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



    $asset_qry = $conn->query("SELECT *,a.assetassignee as employee_code, concat(e.lastname,', ',e.firstname) as empname  FROM assets a LEFT JOIN employee e on a.assetassignee=e.id LEFT JOIN department d on a.department_id = d.id LEFT JOIN category c on a.category_id = c.id  WHERE category_id = ". $category . " AND purchase_date <= " . $cutoff . " ORDER BY a.assetassignee") or die($conn->error);
          while($row=$asset_qry->fetch_array()){

         if ($pdf->GetY() > 160) {
             $pdf->AddPage('L','A4');
             $x=60;
         }
        
		$y = 10;  	
        $pdf->SetXY($y,$x);
		$pdf->Cell(85,10,$row['asset_name']);
        $y = 55;  	
  		$pdf->SetXY($y,$x);
		$pdf->Cell(85,10,'Model:'. $row['model'].'; S/N:'. $row['serial_number']);		
		$y=105;
		$pdf->SetXY($y,$x);
		$pdf->Cell(15,10,$row['asset_code']);
		$y=125;
		$pdf->SetXY($y,$x);
		$pdf->Cell(15,10,$row['unit_of_measure']);
		$y=140;
		$pdf->SetXY($y,$x);
		$pdf->Cell(18,10,number_format($row['purchase_amount'],2,'.',','),0,0,'R');

		$y=158;
		$pdf->SetXY($y,$x);
		$pdf->Cell(18,10,'1',0,0,'R');
		
		//$y=135;
		////$pdf->SetXY($y,$x);
		//$pdf->SetXY($y,$x);
		//$pdf->Cell(10,10,$row['purchase_date']);
		
		//$total += $row['purchase_amount'];

		$x += 5;

		}
	// $y = 10;
	// $x+=5;
	// $pdf->SetXY($y,$x);
	// $pdf->Cell(10,10,'TOTAL');
	// $y=155;
	// $pdf->SetXY($y,$x);
 //    $pdf->Cell(35,10,number_format($total,2,'.',','),'BT',2,'R');
 //    $pdf->Cell(35,1,'','B',0,'R');




$pdf->Output();





?>