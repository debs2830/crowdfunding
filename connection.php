<?php $my_db= 'wahvqo0a_8481723549104875' ;

/** MySQL database username */
$my_user= 'wahvqo0a_748' ;

/** MySQL database password */
$my_password='o7ExI4-WnrHoDoC2JiSd=GJ2+hu5iOb!' ;

/** MySQL hostname */
$localhost='localhost' ;

$con=mysqli_connect($localhost,$my_user,$my_password,$my_db);// Check connection
if (mysqli_connect_errno())

   {

   echo "Failed to connect to MySQL: " . mysqli_connect_error();

   }
   $link = $con;
      $mysqli = $con;

