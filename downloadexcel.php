<?php
 require("connection.php"); 
 

$result=mysqli_query($con, "select * from  eventsignup where eventid = ". $_GET['id'] );
    function xlsBOF()
    {
  echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
   return;
    }
    function xlsEOF()
    {
    echo pack("ss", 0x0A, 0x00);
   return;
    }
    function xlsWriteNumber($Row, $Col, $Value)
  {
    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
    echo pack("d", $Value);
    return;
    }
   function xlsWriteLabel($Row, $Col, $Value )
   {
    $L = strlen($Value);
   echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
    echo $Value;
    return;
    }
    header("Pragma: public");
   header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");;
    header("Content-Disposition: attachment;filename=list.xls");
    header("Content-Transfer-Encoding: binary ");
    xlsBOF();
     
    xlsWriteLabel(0,0,"Firstname");
    xlsWriteLabel(0,1,"Lastname");
    xlsWriteLabel(0,2,"Email");
    xlsWriteLabel(0,3,"Phone");
    xlsWriteLabel(0,4,"Address");
    xlsWriteLabel(0,5,"Zip");
    xlsWriteLabel(0,6,"City");
    xlsWriteLabel(0,7,"State");
    xlsWriteLabel(0,8,"Paid");
    xlsWriteLabel(0,9,"Amount Charged");

    xlsWriteLabel(0,10,"Pay Method");
    xlsWriteLabel(0,11,"Date");
	   xlsWriteLabel(0,12,"Checked In");
	   xlsWriteLabel(0,13,"Notes");
xlsWriteLabel(0,14,"Amount Adults");
xlsWriteLabel(0,15,"Description");
    $xlsRow = 1;
    while ($row = mysqli_fetch_array($result)) {
    
    xlsWriteLabel($xlsRow,0,$row['firstname']);
    xlsWriteLabel($xlsRow,1,$row['lastname']);
    xlsWriteLabel($xlsRow,2,$row['email']);
    xlsWriteLabel($xlsRow,3,$row['phone1']);
    xlsWriteLabel($xlsRow,4,$row['address1']);
    xlsWriteLabel($xlsRow,5,$row['zip']);
    xlsWriteLabel($xlsRow,6,$row['city']);
    xlsWriteLabel($xlsRow,7,$row['state']);
    xlsWriteLabel($xlsRow,8,$row['payed']);
    xlsWriteLabel($xlsRow,9,$row['amtpayed']);
		
    xlsWriteLabel($xlsRow,10,$row['paymethod']);
    xlsWriteLabel($xlsRow,11,$row['dateadded']);
    xlsWriteLabel($xlsRow,12,$row['checkedin']);
    xlsWriteLabel($xlsRow,13,$row['notes']);
		xlsWriteLabel($xlsRow,14,$row['numadults']);
		xlsWriteLabel($xlsRow,15,$row['amtdescr']);
    $xlsRow++;
    }
    xlsEOF();
?>
