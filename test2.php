<?php
require("connection.php"); 


// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql = "INSERT INTO eventsignup (customerid, firstname,	lastname, email,	allowemail, phone1,	address1, zip,	city,	state, numadults,	numchild, payed,	amtpayed,	paymethod, dateadded, names1,	names2, webid,	cctnxid, eventid, adtext,	adcomment, levelgroup,	levelname, nc,checkedin, notes, amtdescr, enteredby ) VALUES ('Ahuva Zret Admire' ,'Ahuva Zussman\'s!!!','Secret Admire ' ,'tamarzussman@gmail.com' ,0 ,'7209329030' ,'1636 Tennyson St' ,'80204' ,'Denver ' ,'Co' ,'1' ,'0' ,1 ,'4' ,'Credit' ,now() ,'' ,'' ,945831 ,'' ,'6' ,'33' ,'I love you!! Keep up the awesomeness!!!!' ,'' ,'' ,'',0 , 'I love you!! Keep up the awesomeness!!!!', '' ,'' )
";

if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error. "<br>";
}


