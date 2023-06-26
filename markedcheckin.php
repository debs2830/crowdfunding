<?php 
session_start();
if( $_SESSION['admin'] !=1	) {
	header( 'Location: http://www.bjhs.org/events/login.php' ) ; 
	
	}
?><?php
	require("connection.php"); 

$field_name[0] = "tnxid";
$field_value[0] = $_GET['id'];
$query_1=$field_name[0]."=".$field_value[0];

if ($_GET['ifcheck'] == "YES") {
$setcheck =0;

} else {
$setcheck =1;

}


 if ($_GET['ind']=="1") {
$sql= "UPDATE eventperson SET CHECKEDIN = " . $setcheck . " WHERE id = ".$_GET['id'];
 } else  {
$sql= "UPDATE eventsignup SET CHECKEDIN = " . $setcheck . " WHERE tnxid = ".$_GET['id'];
//$sql= "UPDATE eventperson SET CHECKEDIN = " . $setcheck . " WHERE tnxid = ".$_GET['id'];

}

echo $sql;
if (!mysqli_query($con,$sql))
{
	die('Error: ' . mysqli_error($con));
	mysqli_close($con);
}
else
{
mysqli_close($con);
   // header("Location:listEvent.php?eventid=".$_GET['eventid'] );
}

?>
