<?php


//require('fpdf184/fpdf.php');
require('../code39.php');
include('../db_connect.php'); 


$pdf = new PDF_Code39();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->SetTitle('Sticker Tags');
//$pdf->Header();
 $x = 15;
 $y = 10;
 $ctr = 1;

    $asset_qry = $conn->query("SELECT *,a.assetassignee as employee_code, concat(e.lastname,', ',e.firstname) as empname, l.name as location  FROM assets a LEFT JOIN employee e on a.assetassignee=e.id LEFT JOIN department d on a.department_id = d.id LEFT JOIN location l on a.location_id = l.id ORDER BY asset_code") or die($conn->error);
          while($row=$asset_qry->fetch_array()){
    
    if ($ctr % 2 ==0) {

    
		
 
    
        //box
		$y= 10;
  		$pdf->SetXY($y,$x);  
  		$pdf->Cell(80,35,'',1);
  		$y= 110;
  		$pdf->SetXY($y,$x);  
  		$pdf->Cell(80,35,'',1);
  		//barcode
  		$x+=3;
  		$y = 30;  	
  		$pdf->Code39($y,$x,$t_asset_code,1,8);
  		$y = 130;  	
  		$pdf->Code39($y,$x,$row['asset_code'],1,8);
  		
  			
		$x+=10;
		$y=10;
  		$pdf->SetFont('Arial','',8);
		//$pdf->SetXY($y,$x);
		//$pdf->Cell(10,10,$row['asset_code']);
		//$x+=5;
		$y=10;
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,'Description : '.$t_asset_name);
		$y=110;
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,'Description : '.$row['asset_name']);
		$x+=5;
		$y=10;
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,'Serial Number : '.$t_serial_number);
		$y=110;
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,'Serial Number : '.$row['serial_number']);
		$x+=5;
		$y=10;
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,'Date Acquired : '.$t_purchase_date);
		$y=110;
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,'Date Acquired : '.$row['purchase_date']);
		$x+=5;
		$y=10;
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,'Location : '.$t_location);
		$y=110;
		$pdf->SetXY($y,$x);
		$pdf->Cell(10,10,'Location : '.$row['location']);
		$x+=15;
		
		

	}
	else {

    $t_asset_code=$row['asset_code'];
    $t_asset_name=$row['asset_name'];
    $t_serial_number=$row['serial_number'];
    $t_purchase_date=$row['purchase_date'];
    $t_location=$row['location'];
			
		}	
	$ctr+=1;	

	if ($x > 250){
		$pdf->AddPage();
    	$x = 15;
    }

	}	
	$y = 10;
	$x+=5;
	
    


$pdf->Output();





?>