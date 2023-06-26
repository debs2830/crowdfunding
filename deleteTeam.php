<?php 
session_start();
if( $_SESSION['admin'] !=1	) {
	header( 'Location: http://www.bjhs.org/events/login.php' ) ; 
	
	}
?>
<?php		 require("connection.php"); 


//all non dinner events

 	$sql= "DELETE FROM crowdfundingTeams WHERE ID = ".$_GET['id'];

if (!mysqli_query($con,$sql))
{
	die('Error: ' . mysqli_error($con));
	mysqli_close($con);
}


mysqli_close($con);

 header("Location:viewTeams.php?eventid=6");
	?>
