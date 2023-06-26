<?php 
date_default_timezone_set('America/Denver');
require ('connection.php'); 

			//put database here
 $sql="SELECT firstname,	lastname, notes, amtdescr from eventsignup  where eventid = 3 and numadults= 1 order by amtdescr  desc";

	

try {
    $result = mysqli_query($con,$sql);
    if ($query === FALSE) {

        throw new Exception($e);
    }

  //  $result = $query->fetch_assoc();
} catch(Exception $e) {


echo 'Information is temporary unvailable';
}
$year = '';
	while ($row = mysqli_fetch_array($result)) {
		if ($year != $row['amtdescr']) {
			echo '<strong>' . $row['amtdescr']. ':</strong><br>';
			$year = $row['amtdescr'];
		}
		echo $row['firstname'];
		echo ' ';
		echo $row['lastname'];
		if ($row['notes'] !=  $row['lastname']) { 
		echo ' (' .$row['notes'] .')';
}
		echo '<br>';
	}

?>