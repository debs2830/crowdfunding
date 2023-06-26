<?php
 require("connection.php"); 



$result=mysqli_query($con, "select * from  eventperson where eventid  = ". $_GET['id'] );
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
     
    xlsWriteLabel(0,0,"Title");
    xlsWriteLabel(0,1,"First Name");
    xlsWriteLabel(0,2,"Last Name");
	xlsWriteLabel(0,3,"Checked In");
	xlsWriteLabel(0,4,"Notes");
	xlsWriteLabel(0,5,"Date Entered");
     
    $xlsRow = 1;
    while ($row = mysqli_fetch_array($result)) {
    $result1=mysqli_query($con, "select * from  eventsignup where webid =".$row['tnxid']);
        while ($row1 = mysqli_fetch_array($result1)) {
    xlsWriteLabel($xlsRow,0,$row['title']);
    xlsWriteLabel($xlsRow,1,$row['firstname']);
    xlsWriteLabel($xlsRow,2,$row['lastname']);
	    xlsWriteLabel($xlsRow,3,$row['CHECKEDIN']);
			xlsWriteLabel($xlsRow,4,$row['notes']);
		xlsWriteLabel($xlsRow,5,$row['dateEntered']);
		
   
    $xlsRow++;
        }
    }
    xlsEOF();
?>
