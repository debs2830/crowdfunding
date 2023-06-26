<?php 
session_start();
if( $_SESSION['admin'] !=1	) {
	header( 'Location: http://www.bjhs.org/events/login.php' ) ; 
	
	}
?><?php 

 require("connection.php"); 
			
if($_POST['payment']== "Credit" && $_POST['ccnum'] != '')
	{
		$id = rand();

		 require("chargecard.php"); 

   if ($msg == 'approved') {
			$sql="update eventsignup  
                set  payed = 1,
                cctnxid = '$response->transaction_id'
                 where tnxid = '$_POST[tnxid]'";
           mysqli_query($con,$sql);
        }
        else
        {
            echo "<h1>Credit Card Authorization Error! Please go back and correct any information!</h1>";
			echo $response->error_message;
        }
}


$ad1 = $_POST['adtext'];
$ad = $con->real_escape_string($ad1);
$text1 = $_POST['comments'];
//$event = explode("|", $_POST['eventlevel']);
$id = $_POST['webid'];

if ($_POST['checkingin'] == 1) {
	$checkingin = 1;
	}else{
$checkingin = 0;
	}
	
	if($_POST['payment'] == "NOCHARGE" || $_POST['payment'] == "ALREADYPAID" || $_POST['payment'] == "Check")
		{
			$paid = 1;
		}
		

			 if (!mysqli_query($con,"DELETE FROM eventperson WHERE tnxid = " .$_POST['webid'] ))
                 {
                     die('Error: ' . mysqli_error($con));
                 }
             
	for($i=1; $i < 3; $i++ ) {
				if($_POST['firstname' .$i] != '')
				{
		$notes = $_POST['eventlevel'];
					if ($notes == 'dinnercouple' || $notes == 'dinnersingle') {
						$notes = 'dinner';
					}
			$sql1 = "INSERT INTO eventperson(eventid,firstname,lastname,title,tnxid,checkedin, notes)
			VALUES('". $_POST['eventid'] ."','".$_POST['firstname'. $i] ."', '". $_POST['lastname'. $i] ."', '". $_POST['sal'. $i]."',$id,  $checkingin,  '". $notes ."' )";
					
					mysqli_query($con,$sql1);
				}
				
				}//end for loop

$text = $con->real_escape_string($text1);
		$sql="update eventsignup  
		set firstname = '$_POST[firstname]',
		lastname = '$_POST[lastname]',
		email = '$_POST[email]',
		phone1 = '$_POST[phone]',
		address1 = '$_POST[address]',
		zip = '$_POST[zip]',
		city = '$_POST[city]',
		state = '$_POST[state]',
		amtpayed = '$_POST[totaldue]',";
		if ($_POST['payment'] != " " ) {
	$sql= $sql . " paymethod = '$_POST[payment]' ,";
		}
		
		$sql= $sql ."adtext = '$ad',
		adcomment = '$text',
		 datemodified = now(),
         changedby = '$_POST[changedby]',";
		if ($_POST['eventlevel'] != "" ) {
	$sql= $sql . " levelgroup = '" .$_POST['eventlevel']. "',";
		}
		if ($_POST['sublevel'] != "" ) {
		$sql= $sql . " levelname = '". $_POST['sublevel']. "',";
		}
		
				if ($paid ==1 ) {
		$sql= $sql . " payed = 1,";
		}
		
$sql= $sql ."  changedby = '$_POST[changedby]'  where tnxid = '$_POST[tnxid]'"
             
		;
if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));
			mysqli_close($con);
		}
else
{
//header("Location:listEventDinner.php?eventid=1C");
echo 'The information was updated. <a href="listEventDinner.php?eventid=7">Back to full list</a>';
}
?>