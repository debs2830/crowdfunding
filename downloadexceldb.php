<?php
 require("connection.php"); 


$result=mysqli_query($con, "select * from  eventsignup where eventid =" . $_GET['id'] );
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
    xlsWriteLabel(0,5,"City");
    xlsWriteLabel(0,6,"State");
    xlsWriteLabel(0,7,"Zip");
    xlsWriteLabel(0,8,"Names");
    xlsWriteLabel(0,9,"# Attendees");
    xlsWriteLabel(0,10,"Level");
    xlsWriteLabel(0,11,"Sublevel");
    xlsWriteLabel(0,12,"Total");
     xlsWriteLabel(0,13,"Pay Method");
     xlsWriteLabel(0,14,"Ad Text");
     xlsWriteLabel(0,15,"Comments");
     xlsWriteLabel(0,16,"Added By");
     xlsWriteLabel(0,17,"Changed By");
     xlsWriteLabel(0,18,"Added Date");
     xlsWriteLabel(0,19,"Change Date");
     xlsWriteLabel(0,20,"Ad Complete");
     xlsWriteLabel(0,21,"Info Complete");
	      xlsWriteLabel(0,22,"Allow Email");
    $xlsRow = 1;
	
    while ($row = mysqli_fetch_array($result)) {
    
    xlsWriteLabel($xlsRow,0,$row['firstname']);
    xlsWriteLabel($xlsRow,1,$row['lastname']);
    xlsWriteLabel($xlsRow,2,$row['email']);
    xlsWriteLabel($xlsRow,3,$row['phone1']);
    xlsWriteLabel($xlsRow,4,$row['address1']);
    xlsWriteLabel($xlsRow,5,$row['city']);
    xlsWriteLabel($xlsRow,6,$row['state']);
    xlsWriteLabel($xlsRow,7,$row['zip']);
       $varnames = ''; 
   

				$field_name[0] = "tnxid";
				$field_value[0] = $row['webid'];
				$query_1=$field_name[0]."=".$field_value[0];

$result1=mysqli_query($con,  "SELECT * FROM eventperson WHERE $query_1");

				while ($row1=mysqli_fetch_array($result1))
				{
					$varnames = $varnames .    $row1['title'] . " "  . $row1['firstname']  . " " . $row1['lastname']. "-" .  $row1['CHECKEDIN'] . ";";
				}
        $num_rows = mysqli_num_rows($result1);

    xlsWriteLabel($xlsRow,8,$varnames);
    xlsWriteNumber($xlsRow,9,$num_rows);
    xlsWriteLabel($xlsRow,10,$row['levelgroup']);
    xlsWriteLabel($xlsRow,11,$row['levelname']);
    xlsWriteNumber($xlsRow,12,$row['amtpayed']);
    xlsWriteLabel($xlsRow,13,$row['paymethod']);
    xlsWriteLabel($xlsRow,14,$row['adtext']);
//    xlsWriteLabel($xlsRow,15,$row['adcomment']);
	    xlsWriteLabel($xlsRow,15,$row['notes']);
    xlsWriteLabel($xlsRow,16,$row['enteredby']);
    xlsWriteLabel($xlsRow,17,$row['changedby']);
    xlsWriteLabel($xlsRow,18,$row['dateadded']);
    xlsWriteLabel($xlsRow,19,$row['datemodified']);
        if ($row['adcomplete'] == 0):
        xlsWriteLabel($xlsRow,20,"NO");
        else:
        xlsWriteLabel($xlsRow,20,"YES");
        endif;
     if ($row['infocomplete'] == 0):
        xlsWriteLabel($xlsRow,21,"NO");
        else:
        xlsWriteLabel($xlsRow,21,"YES");
        endif;
      xlsWriteLabel($xlsRow,1,$row['allowemail']);
 
    
    $xlsRow++;
    }
    xlsEOF();
?>
