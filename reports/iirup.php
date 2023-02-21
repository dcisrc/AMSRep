<?php

session_start();
require('../fpdf184/fpdf.php');
include('../db_connect.php'); 


$empcode = $_GET['empcode'];
$emp_qry = $conn->query("SELECT firstname, middlename, lastname, d.name as dept from employee e LEFT JOIN department d ON e.id=d.id
    WHERE e.id = ".$empcode) or die($conn->error);
    while($row=$emp_qry->fetch_array()){
        $empfullname = $row['firstname']." ".$row['lastname'];
        $dept = $row['dept'];
    };

class PDF extends FPDF
{

function Header()
{
    //Logo
    //parent::Header();
    //$this->Image('../images/logo.png', 10, 8, 45);

    global $empfullname;
    global $dept;

	$this->SetFont('Arial','B',8);
	$this->SetXY(10,10);
	$this->Cell(200,10,$_SESSION['system_info']['company_name']);
    $this->SetY(14);
    $this->Cell(300,10,'Asset Management System - Inventory and Inspection Report of Unserviceable Property (IIRUP)');
    $this->SetY(20);
    // $this->Cell(200,10,'Type:'); 
    $this->SetY(25);
	$this->Cell(40,10,'As of : '  . date('m/d/Y'));
	$this->SetY(30);
	//$this->Cell(200,10,'Fund Cluster :');
	$this->SetY(30);
	$this->Cell(200,10,$empfullname);
    $this->SetX(120);
    $this->Cell(40,10,$dept);
    $this->SetY(39);
    $this->SetFont('Arial','IB',6);
    $this->Cell(40,5,'(Name of Accountable Officer','T','C');
    $this->SetX(70);
    //$this->Cell(30,5,'(Designation)','T','C');
    $this->SetX(120);
    $this->Cell(50,5,'(Station)','T','C');
	
    $this->SetFont('Arial','B',6);

    $this->SetXY(10,45);
    $this->MultiCell(135,5,'INVENTORY','LTR','C');
    $this->SetXY(145,45);
    $this->MultiCell(120,5,'INSPECTION and DISPOSAL','LTR','C');



	$this->SetFont('Arial','',6);
    $this->SetXY(10,50);
    $this->MultiCell(12,5,'','LTR');
    $this->SetXY(22,50);
    $this->MultiCell(28,5,'','LTR');
    $this->SetXY(50,50);
    $this->MultiCell(15,5,'','LTR','C');
    $this->SetXY(65,50);
    $this->MultiCell(10,5,'','LTR');
    $this->SetXY(75,50);
    $this->MultiCell(10,5,'','LTR');
    $this->SetXY(85,50);
    $this->MultiCell(15,5,'','LTR');
    $this->SetXY(100,50);
    $this->MultiCell(15,8,'Accumulated','LTR');
    $this->SetXY(115,50);
    $this->MultiCell(15,5,'','LTR');
    $this->SetXY(130,50);
    $this->MultiCell(15,5,'','LTR');

    $this->SetXY(145,50);
    $this->MultiCell(75,5,'DISPOSAL','LTR','C');
    
    $this->SetXY(220,50);
    $this->MultiCell(15,8,'Appraised','LTR');
     $this->SetXY(235,50);
    $this->MultiCell(30,5,'RECORD OF SALES','LTR','C');
    
    


    $this->SetXY(10,55);
    $this->MultiCell(12,5,'Date','LR','C');
    $this->SetXY(22,55);
    $this->MultiCell(28,5,'Particulars/','LR','C');
    $this->SetXY(50,55);
    $this->MultiCell(15,5,'Property','LR','C');
    $this->SetXY(65,55);
    $this->MultiCell(10,5,'Qty','LR','C');
    $this->SetXY(75,55);
    $this->MultiCell(10,5,'Unit','LR','C');
    $this->SetXY(85,55);
    $this->MultiCell(15,5,'Total','LR','C');
    $this->SetXY(100,55);
    $this->MultiCell(15,5,'Impairment','LR','C');
    $this->SetXY(115,55);
    $this->MultiCell(15,5,'Carrying','LR','C');
    $this->SetXY(130,55);
    $this->MultiCell(15,5,'','LR');

    $this->SetXY(145,55);
    $this->MultiCell(15,5,'Sale','LTR','C');
    $this->SetXY(160,55);
    $this->MultiCell(15,5,'Transfer','LTR','C');
    $this->SetXY(175,55);
    $this->MultiCell(15,5,'Destruction','LTR','C');
    $this->SetXY(190,55);
    $this->MultiCell(15,5,'Others','LTR','C');
    $this->SetXY(205,55);
    $this->MultiCell(15,5,'Total','LTR');
    $this->SetXY(220,55);
    $this->MultiCell(15,5,'Value','LR');
    $this->SetXY(235,55); 
    $this->MultiCell(15,5,'OR No.','LTR');
    $this->SetXY(250,55);
    $this->MultiCell(15,5,'Amount','LTR');

    $this->SetXY(10,60);
    $this->MultiCell(12,5,'Acquired','LBR','C');
    $this->SetXY(22,60);
    $this->MultiCell(28,5,'Articles','LBR','C');
    $this->SetXY(50,60);
    $this->MultiCell(15,5,'Number','LBR','C');
    $this->SetXY(65,60);
    $this->MultiCell(10,5,'','LBR','C');
    $this->SetXY(75,60);
    $this->MultiCell(10,5,'Cost','LBR','C');
    $this->SetXY(85,60);
    $this->MultiCell(15,5,'Cost','LBR','C');
    $this->SetXY(100,60);
    $this->MultiCell(15,5,'Losses','LBR','C');
    $this->SetXY(115,60);
    $this->MultiCell(15,5,'Amount','LBR','C');
    $this->SetXY(130,60);
    $this->MultiCell(15,5,'Remarks','LBR');

    $this->SetXY(145,60);
    $this->MultiCell(15,5,'','LBR','C');
    $this->SetXY(160,60);
    $this->MultiCell(15,5,'','LBR','C');
    $this->SetXY(175,60);
    $this->MultiCell(15,5,'','LBR','C');
    $this->SetXY(190,60);
    $this->MultiCell(15,5,'(Specify)','LBR','C');
    $this->SetXY(205,60);
    $this->MultiCell(15,5,'','LBR');
    $this->SetXY(220,60);
    $this->MultiCell(15,5,'','LBR');
    $this->SetXY(235,60); 
    $this->MultiCell(15,5,'','LBR');
    $this->SetXY(250,60);
    $this->MultiCell(15,5,'','LBR');




}

function Footer()
{
	$this->SetFont('Arial','',7);
    $this->SetXY(10,-45);
    $this->Cell(135,32,'',1);
    $this->SetXY(145,-45);
    $this->Cell(70,32,'',1);
    $this->SetXY(215,-45);
    $this->Cell(60,32,'',1);

    $this->SetXY(10,-44);
    $this->MultiCell(140,5,'I HEREBY request inspection and disposition, pursuant to Section 79 of P.D. No. 1445, of the property enumerated above');

    $this->SetXY(148,-44);
    $this->MultiCell(65,3,'    I CERTIFY that I have inspected each and every article enumerated in this report and that the dispositions made thereof was, in my judgement, the best for the public interest.');
    $this->SetXY(216,-44);
    $this->MultiCell(50,3,'  I CERTIFY that I have witnessed the disposition of the articles enumerated on this report this    day of    ');
   
    $this->SetXY(20,-25);
    $this->MultiCell(50,3.5,'(Signature over Printed Name of Accountable Officer)','T','C');
	$this->SetXY(148,-25);
    $this->MultiCell(50,3.5,'(Signature over Printed Name of Inspection Officer)','T','C');
	$this->SetXY(216,-25);
	$this->MultiCell(50,3.5,'(Signature over Printed Name of Witness)','T','C');	
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
$pdf->SetFont('Arial','',6);
$pdf->SetTitle('IIRUP');
//$pdf->Header();

$x=65;
$total =0;
$oldemp='xxx';



    $asset_qry = $conn->query("SELECT *, a.assetassignee as employee_code, concat(e.lastname,', ',e.firstname) as empname  FROM assets a LEFT JOIN employee e on a.assetassignee=e.id LEFT JOIN department d on a.department_id = d.id LEFT JOIN category c on a.category_id = c.id
        WHERE a.condition = 'Unserviceable'
        ORDER BY a.assetassignee") or die($conn->error);
          while($row=$asset_qry->fetch_array()){
        
		$y = 10;  	
        $pdf->SetXY($y,$x);
		$pdf->Cell(20,10,$row['purchase_date']);
        $y = 22;
        $pdf->SetXY($y,$x);
        $pdf->Cell(30,10,$row['asset_name']);
        $y = 50;  	
  		$pdf->SetXY($y,$x);
		$pdf->Cell(25,10, $row['asset_code']);	
        $y=65;
        $pdf->SetXY($y,$x);
        $pdf->Cell(10,10,'1',0,0,'R');	
		
		$y=75;
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,number_format($row['purchase_amount'],2,'.',','),0,0,'R');

		
		
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