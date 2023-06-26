<?php 
session_start();
if( $_SESSION['admin'] !=1	) {
	header( 'Location: http://www.bjhs.org/events/login.php' ) ; 
	
	}
?>
<?php		 require("connection.php"); 


$field_name[0] = "tnxid";
$field_value[0] = $_GET['id'];
$query_1=$field_name[0]."=".$field_value[0];
$type= (isset($_GET['type']) && $_GET['type'] == 'dinner'? 'dinner': '');
//all non dinner events
 if ($type == '' ) {
 	$sql= "DELETE FROM eventsignup WHERE tnxid = ".$_GET['id'];

 } else {
$sql= "DELETE FROM eventsignup WHERE webid = ".$_GET['id'];
 }
if (!mysqli_query($con,$sql))
{
	die('Error: ' . mysqli_error($con));
	mysqli_close($con);
}
else
{
mysqli_query($con,$sql);
}

$sql2= "DELETE FROM eventperson WHERE tnxid = ".$_GET['id'];
if (!mysqli_query($con,$sql2))
{
	die('Error: ' . mysqli_error($con));
	mysqli_close($con);
}
else
{
mysqli_query($con,$sql2);

}

mysqli_close($con);

    if($type == "")
    {
        header("Location:listEvent.php?eventid=".$_GET['eventid']);
    }
	//dinner list
    else
    {
        header("Location:listEventDinner.php?eventid=".$_GET['eventid']);
    }
	?>
