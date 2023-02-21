
    
 <?php
//use Phppot\DataSource;
//use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
include 'db_connect.php'; 
$mysqli = new mysqli('localhost','root','','assets');

 if(isset($_POST["Import"])){
 	
    
    $filename=$_FILES["file"]["tmp_name"];    
    if($_FILES["file"]["size"] > 0)
    {
		
    	 //get last asset code number used
		 $qry = $conn->query("SELECT asset_code FROM assets ORDER BY asset_code desc LIMIT 1");
			while($row=$qry->fetch_array()){
			//format new asset code	
			$last_serial = 	substr($row['asset_code'],2,5);
			

			}

           
	       
        	$file = fopen($filename, "r");
          	while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
            {
            


            	if($getData[0]=='asset_name')
            	{	
            	}
            	else{	

					
              
                    	for ($ctr = 0;$ctr<=$getData[1];$ctr++){
                    		$last_serial++;
                    		$newnum = str_pad($last_serial,5,'0',STR_PAD_LEFT);
							$newac=substr(date('Y'),-2).$newnum;

                    		 $sql = "INSERT into assets (asset_code, asset_name, category_id, department_id, purchase_amount, purchase_date , invoice_number, supplier, specifications, manufacturer, model, unit_of_measure, fund_cluster_id, status, `condition`) 
                    		values  ('".$newac. "','".$getData[0]."',".$getData[2].",".$getData[3].",".$getData[4].",'".$getData[5]."','".$getData[6]."','".$getData[7]."','".$getData[8]. "','".$getData[9]."','".$getData[10]."','".$getData[11]."',".$getData[12].",'Unassigned','Serviceable')";
                    	
                    	mysqli_query($conn, $sql);
					
                    	} 
               
        
            	 				echo "<script type=\"text/javascript\">
            	 					alert(\"CSV File has been successfully Imported.\"$result);
            	 					window.location = \"index.php\"
          			 				</script>";

            	 	
        		}
            }
      
           fclose($file);  
    }
    else {


    }


		echo "<script type=\"text/javascript\">
        			alert(\"Invalid File:Please Upload Valid CSV File.\");
       			window.location = \"index.php\"
         	 </script>";   


  }   


  header('Location: assetsmasterlist.php');
 ?>