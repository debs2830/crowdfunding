<?php	require('connection.php');
$field_name[0] = "tnxid";
$field_value[0] = $_GET['id'];
$query_1=$field_name[0]."=".$field_value[0];

 if ($_GET['ifcomplete'] == "YES" || $_GET['ifcomplete'] == "1") {
$setinfo =0;

} else {
$setinfo =1;

}

$fieldname = $_GET['fieldname'];
$sql= "UPDATE eventsignup SET ". $fieldname . " = " .$setinfo . " WHERE tnxid = ".$_GET['id'];
if (!mysqli_query($con,$sql))
{
	die('Error: ' . mysqli_error($con));
	mysqli_close($con);
}
else
{
mysqli_close($con);
}

?>
