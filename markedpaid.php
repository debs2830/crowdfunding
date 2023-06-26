<?php 
session_start();
if( $_SESSION['admin'] !=1	) {
	header( 'Location: http://www.bjhs.org/events/login.php' ) ; 
	
	}
?><?php
require('connection.php');
//set pay to yes
$field_name[0] = "tnxid";
$field_value[0] = $_GET['id'];
$query_1=$field_name[0]."=".$field_value[0];


if ($_GET['ifpaid'] == "YES") {
$setpaid =0;

} else {
$setpaid =1;

}

 
$sql= "UPDATE eventsignup SET PAYED = ". $setpaid ." WHERE tnxid = ".$_GET['id'];
if (!mysqli_query($con,$sql))
{
	die('Error: ' . mysqli_error($con));
	mysqli_close($con);
}
else
{
mysqli_close($con);
  //  header("Location:listEvent.php?eventid=".$_GET['eventid'] );

}

?>
