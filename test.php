<?php
 require("connection.php"); 		
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="CREATE TABLE crowdfundingTeams (
   ID int NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    nickname varchar(50) NULL,
	realname varchar(150) NULL,
	donationamount int NULL,
	eventid int NULL
   
); ";

$sql="alter TABLE crowdfundingTeams 
ADD column dateEntered TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   
; ";

//	$sql="select * from  crowdfundingTeams  ";
if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error. "<br>";
}

die();
// Associative array
$res =$con->query($sql); 

	$row = $res->fetch_assoc();; 
var_dump($row);


	
mysqli_close($con);
?> 