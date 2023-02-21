<?php


require('fpdf184/fpdf.php');
include('db_connect.php'); 

class PDF extends FPDF
{

function Header()
{
    //Logo
    //parent::Header();
    //$this->Image('../images/logo.png', 10, 8, 45);
	$this->SetFont('Arial','B',10);
	$this->SetXY(10,10);
	$this->Cell(200,10,'DBP Data Center, Inc.');
    $this->SetY(15);
    $this->Cell(300,10,'List of Unlocated Assets Report');
    $this->SetXY(10,25);
    $this->SetFont('Arial','U',10);
    $this->Cell(25,10,'Asset Code');
    $this->SetX(40);
    $this->Cell(25,10,'Asset Details');
    $this->SetX(100);
    $this->Cell(25,10,'Purchase Amount');
    $this->SetX(130);
    $this->Cell(25,10,'Purchase Date');
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
$pdf->SetTitle('List of Unlocated Assets');
//$pdf->Header();

$x=30;
$total =0;
$olddep='';



    $asset_qry = $conn->query("SELECT *,d.name as departmentname FROM assets a LEFT JOIN employee e on a.assetassignee=e.id LEFT JOIN department d on a.department_id = d.id LEFT JOIN category c on a.category_id = c.id WHERE status='UNLOCATED' ORDER BY d.name ") or die($conn->error);
          while($row=$asset_qry->fetch_array()){
        
        $y = 10;  	
  		$pdf->SetXY($y,$x);  
  		
  		if ($row['departmentname']!=$olddep){
  					$pdf->SetFont('Arial','UBI',10);
				$pdf->Cell(10,10,'Department: '.$row['departmentname']);
				$olddep = $row['departmentname'] ;
				$pdf->SetFont('Arial','',10);
				$x+=5;
			}
		
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,$row['asset_code']);
		$y=40;
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,$row['asset_name'].' S/N:'.$row['serial_number']);
		$y=100;
		$pdf->SetXY($y,$x);
		$pdf->Cell(30,10,number_format($row['purchase_amount'],2,'.',','),0,0,'R');
		$total += $row['purchase_amount'];
		$y=130;
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,$row['purchase_date']);

		$x += 5;

		}
	$y = 10;
	$x+=5;
	$pdf->SetXY($y,$x);
	$pdf->Cell(10,10,'TOTAL');
	$y=100;
	$pdf->SetXY($y,$x);
    $pdf->Cell(30,10,number_format($total,2,'.',','),0,0,'R');



$pdf->Output();





?>