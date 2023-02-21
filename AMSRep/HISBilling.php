<?php


require('fpdf184/fpdf.php');
//include('db_connect.php'); 

//$billnumber = $_GET['billing_id'];



class PDF extends FPDF
{

function Header()
{

    //Logo
    //parent::Header();
    //$this->Image('../images/logo.png', 10, 8, 45);
	$this->SetFont('Arial','B',12);
	$this->SetXY(150,10);


    $this->SetFillColor(255,255,0);
    $this->SetXY(50,25);
    $this->Cell(110,20,'',1,2,'C',true);

    
    $this->SetXY(40,25);
    $this->Cell(140,10,'xxxxxx ALL PHIC CLAIMS',0,0,'C');
    $this->SetXY(40,30);
    $this->Cell(140,10,'Billing Computation',0,0,'C');
    $this->SetXY(40,35);
    $this->Cell(140,10,'AUGUST 2020',0,0,'C');
	$this->SetXY(20,45);




}

function Footer()
{
   
    $this->SetFont('Arial','',10);
    $this->SetXY(50,-100);
    $this->Cell(10,10,'Prepared by: Sulangi, Carl Angelo');

    $this->SetXY(50,-80);
    $this->Cell(10,10,'Verified by: Reyes, Daisy');

    $this->SetXY(50,-60);
    $this->Cell(10,10,'Noted by: Sulangi, Carl Angelo');


    $this->SetXY(50,-40);
    $this->Cell(10,10,'Approved by: Asuncion, Bayani Jr.');
    
    //$this->SetY(-15);
       
    //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->SetTitle('PHIC Claims Billing');
//$pdf->Header();

$x=50;
$total =0;

$assignee = null;

    

    //$billing_qry = $conn->query("SELECT  * WHERE billnumber='".$billnumber."'") or die($conn->error);
    //      while($row=$asset_qry->fetch_array()){
      
        
        $y = 50;  	
  		$pdf->SetXY($y,$x);  
  		$pdf->Cell(10,7,'Total No. of Billable Claims');
  		$y = 130;  
  		$pdf->SetXY($y,$x);
		$pdf->Cell(30,7,'403',0,0,'R');

        $x = $x + 6;
		$y=50;
		$pdf->SetXY($y,$x);
		$pdf->Cell(60,7,'x Fee per Claim (VAT Excl.)');
		$y=130;
		$pdf->SetXY($y,$x);
		$pdf->Cell(30,7,'1,925.00','B',0,'R');

        $x = $x + 6;
		$y=50;
		$pdf->SetXY($y,$x);
		$pdf->Cell(20,7,'Total Billable (VAT Excl.)');
		$y=130;
        $pdf->SetXY($y,$x);
        $pdf->Cell(30,7,'775,775.00',0,0,'R');

        $x = $x + 10;
		$y=50;
        $pdf->SetXY($y,$x);
        $pdf->Cell(20,7,'Total Billable (VAT Excl.)');
        $y=130;
        $pdf->SetXY($y,$x);
        $pdf->Cell(30,7,'775,775.00',0,0,'R');

        $x = $x + 6;
        $y=50;
        $pdf->SetXY($y,$x);
        $pdf->Cell(20,7,'Add: 12% VAT');
        $y=130;
        $pdf->SetXY($y,$x);
        $pdf->Cell(30,7,'83,830.00','B',0,'R');


        $x = $x + 6;
        $y=50;
        $pdf->SetXY($y,$x);
        $pdf->Cell(20,7,'Total Billable (VAT Incl.)');
        $y=130;
        $pdf->SetXY($y,$x);
        $pdf->Cell(30,7,'692,656.25',0,0,'R');

        $x = $x + 10;
        $y=50;
        $pdf->SetXY($y,$x);
        $pdf->Cell(20,7,'Total Billable (VAT Excl.)');
        
        $y=130;
        $pdf->SetXY($y,$x);
        $pdf->Cell(30,7,'692,656.25',0,0,'R');

        $x = $x + 6;
        $y=50;
        $pdf->SetXY($y,$x);
        $pdf->Cell(20,7,'TAX at 7%');
        $y=130;
        $pdf->SetXY($y,$x);
        $pdf->Cell(30,7,'7 %','B',0,'R');

        $x = $x + 6;
        $y=50;
        $pdf->SetXY($y,$x);
        $pdf->Cell(20,7,'7% TAX AMT');
        $y=130;
        $pdf->SetXY($y,$x);
        $pdf->Cell(30,7,'7 %',0,0,'R');

        $x = $x + 10;
        $y=50;
        $pdf->SetXY($y,$x);
        $pdf->Cell(20,7,'Total Billable (VAT Incl.)');
        $y=130;
        $pdf->SetXY($y,$x);
        $pdf->Cell(30,7,'775,775.00',0,0,'R');


        $x = $x + 6;
        $y=50;
        $pdf->SetXY($y,$x);
        $pdf->Cell(20,7,'Less 7% TAX');
        $y=130;
        $pdf->SetXY($y,$x);
        $pdf->Cell(30,7,'48,485.94','B',0,'R');


        $pdf->SetFont('Arial','B',10);
        $x = $x + 6;
        $y=50;
        $pdf->SetXY($y,$x);
        $pdf->Cell(30,7,'Net Amount Collectible');
        $y=130;
        $pdf->SetXY($y,$x);
        $pdf->SetFillColor(255,255,0);
        $pdf->Cell(30,7,'727,289.06','BT',0,'R',true);
        $y=130;
        $pdf->SetXY($y,$x);
        $pdf->Cell(30,6,'','B',0,'R');
        $pdf->SetFont('Arial','',10);




		//}



$pdf->Output();





?>