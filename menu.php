<?php 
session_start();

if ($_POST['password'] == 'chofetz') {
	session_set_cookie_params(166400);
	$_SESSION['admin']=1;
}

if( $_SESSION['admin'] !=1	) {
	header( 'Location: http://www.bjhs.org/events/login.php' ) ; 
	
	}
	

?>
<!DOCTYPE html>
<html>
<head>
<title>Bais Yaakov Event System</title>
<link rel="stylesheet"
	href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="css/normalize.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<style>
* {
	font-family: arial;
}
</style>
<script type="text/javascript" charset="utf-8">
            $(document).ready(function(){
                $('#datatables').dataTable({
					"ordering": true,
					"order":[ 1, 'asc'],
                    "bFilter": false,"bInfo": false,
					"bPaginate": false,
					 "aaSorting": [[ 2, "desc" ]],
                    "fnInitComplete": function() 
					{
					$("#datatables").css("width","50%");
					}
                });
            })
        </script>

</head>
<body>

<h1>BY Event Management System</h1>
<div>
  <?php 
	 require("connection.php"); 
 function amtSignUp ($eventid, $con, $checkedin) {
		$sql = 	"SELECT * FROM eventsignup where eventid = $eventid ";			  

		if ( $checkedin == 1 ) {
		$sql .=	"and checkedin = 1";
		}
		$result =$con->query($sql );
	return  $result->num_rows;  
					  }
					  
		  function amtTotalPerson ($eventid, $con, $checkedin) {
$sql = "SELECT * FROM eventperson where eventid = $eventid ";
if ( $checkedin == 1 ) {
		$sql .=	"and checkedin = 1";
		}
$result =$con->query($sql);

$row_cnt = $result->num_rows;

return $row_cnt;
}
			function amttotalPeople ($eventid, $con, $checkedin) {

$sql = "SELECT SUM(numadults) AS total_value, SUM(numchild) AS total_value_child  FROM eventsignup WHERE eventid = $eventid ";
if ( $checkedin == 1 ) {
		$sql .=	"and checkedin = 1";
		}
$res =$con->query($sql); 

	$row = $res->fetch_assoc();; 
	$sum = $row['total_value'];
	$sum1 = $row['total_value_child'];
	$total = 0;
	$total = $sum + $sum1;
	
	return $total;
}
		  
function amtPaidSignup ($eventid, $con) {
$res =$con->query("SELECT sum(amtpayed) as total FROM eventsignup where eventid = $eventid");

	$row = $res->fetch_assoc();
	return money_format('$%i', $row['total']);
 	
}
function echolist($eventid, $isdinner=0) {
	echo "<a href='listEvent";
	if ($isdinner ==1 ) {
		echo 'Dinner';
		}
	echo ".php?eventid=$eventid' target='_blank'>List</a>";
	
	}
?>
  <table id="datatables" class="display" >
    <thead>
      <tr>
        <th>Event Name</th>
        <th>Event Date</th>
        <th>#Reservation</th>
        <th>#People</th>
        <th>#Checked In</th>
        <th>#Total $</th>
        <th>New Registration</th>
        <th>Registration List</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php $eventNum = 1;
			?>
          Dinner 2018</td>
        <td>1/15/2018</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="dinner.php?mode=adminxx">New Sign Up</a></td>
        <td><?php echolist($eventNum, 1);?> - <a href="listCheckin.php?eventid=<?php echo $eventNum;?>">Check in</a> </td>
      </tr>
		 <tr>
        <td><?php $eventNum = 2;
			?>
          Shas Campaign 2018</td>
        <td>6/10/2018</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="shas.php?mode=adminxx">New Sign Up</a></td>
        <td><?php echolist($eventNum, 0);?>  </td>
      </tr>
     
		 <tr>
        <td><?php $eventNum = 3;
			?>
          Reunion 2018</td>
        <td>6/3/2018</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="reunion.php?mode=adminxx">New Sign Up</a></td>
        <td><a href="listEventReunion.php?eventid=3">List</a> - <a href="listCheckinReunion.php?eventid=<?php echo $eventNum;?>">Check in</a> </td>
      </tr>
     <tr>
        <td><?php $eventNum = 4;			?>
          Dinner 2019</td>
        <td>1/15/2019</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="dinner.php?mode=adminxx">New Sign Up</a></td>
        <td><?php echolist($eventNum, 1);?> - <a href="listCheckin.php?eventid=<?php echo $eventNum;?>">Check in</a> </td>
      </tr>
		 <tr>
        <td><?php $eventNum = 5;			?>
          Luncheon 2019</td>
        <td>2/18/2019</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="luncheon.php?mode=adminxx">New Sign Up</a></td>
        <td><?php echolist($eventNum, 1);?> - <a href="listCheckin.php?eventid=<?php echo $eventNum;?>">Check in</a> </td>
      </tr>
		<tr>
        <td><?php $eventNum = 6;			?>
          Crowdfunding 2019</td>
        <td>6/4/2019</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="simplefunding.php">New Sign Up</a><br> <a href="createTeam.php?eventid=<?php echo $eventNum;?>">Create Team</a><br>
			<a href="viewTeams.php?eventid=<?php echo $eventNum;?>">View Teams</a></td>
        <td><a href="listCrowdfunding.php?eventid=6">List</a> - <a href="listCheckin.php?eventid=<?php echo $eventNum;?>">Check in</a> </td>
      </tr>
		<tr>
        <td><?php $eventNum = 7;			?>
          Dinner 2020</td>
        <td>1/12/2020</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="dinner.php?mode=adminxx">New Sign Up</a></td>
        <td><?php echolist($eventNum, 1);?> - <a href="listCheckin.php?eventid=<?php echo $eventNum;?>">Check in</a> </td>
      </tr>
		 <tr>
        <td><?php $eventNum = 8;			?>
          Luncheon 2020</td>
        <td>2/17/2020</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="luncheon.php?mode=adminxx">New Sign Up</a></td>
        <td><?php echolist($eventNum, 1);?> - <a href="listCheckin.php?eventid=<?php echo $eventNum;?>">Check in</a> </td>
      </tr>
		<tr>
        <td><?php $eventNum = 9;			?>
          Crowdfunding 2020</td>
        <td>7/14/2020</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="simplefunding.php">New Sign Up</a><br> <a href="createTeam.php?eventid=<?php echo $eventNum;?>">Create Team</a><br>
			<a href="viewTeams.php?eventid=<?php echo $eventNum;?>">View Teams</a></td>
        <td><a href="listCrowdfunding.php?eventid=<?php echo $eventNum;?>">List</a> </td>
      </tr><tr>
        <td><?php $eventNum = 10;			?>
          Crowdfunding 2021</td>
        <td>05/06/2021</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="simplefunding.php">New Sign Up</a><br> <a href="createTeam.php?eventid=<?php echo $eventNum;?>">Create Team</a><br>
			<a href="viewTeams.php?eventid=<?php echo $eventNum;?>">View Teams</a></td>
        <td><a href="listCrowdfunding.php?eventid=<?php echo $eventNum;?>">List</a> </td>
      </tr>
        <tr>
        <td><?php $eventNum = 11;			?>
          Dinner 2022</td>
        <td>1/9/2022</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="dinner.php?mode=adminxx">New Sign Up</a></td>
        <td><?php echolist($eventNum, 1);?> - <a href="listCheckin.php?eventid=<?php echo $eventNum;?>">Check in</a> </td>
      </tr> <tr>
        <td><?php $eventNum = 12;			?>
          Performance 2022</td>
        <td>3/6/2022</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="performance.php?mode=adminxx">New Sign Up</a></td>
        <td><?php echolist($eventNum, 0);?> </td>
      </tr>
		<tr>
        <td><?php $eventNum = 13;			?>
          Crowdfunding 2022</td>
        <td>05/24/2022</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="simplefunding.php">New Sign Up</a><br> <a href="createTeam.php?eventid=<?php echo $eventNum;?>">Create Team</a><br>
			<a href="viewTeams.php?eventid=<?php echo $eventNum;?>">View Teams</a></td>
        <td><a href="listCrowdfunding.php?eventid=<?php echo $eventNum;?>">List</a> </td>
      </tr>
		<tr>
        <td><?php $eventNum = 14;			?>
          Dinner 2023</td>
        <td>1/15/2023</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="dinner.php?mode=adminxx">New Sign Up</a></td>
        <td><?php echolist($eventNum, 1);?> - <a href="listCheckin.php?eventid=<?php echo $eventNum;?>">Check in</a> </td>
      </tr><tr>
        <td><?php $eventNum = 15;			?>
          Yearbook 2023</td>
        <td>6/15/2023</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="yearbook.php?mode=adminxx">New Sign Up</a></td>
        <td><?php echolist($eventNum, 1);?> - <a href="listCheckin.php?eventid=<?php echo $eventNum;?>">Check in</a> </td>
      </tr><tr>
        <td><?php $eventNum = 16;			?>
          Performance 2023</td>
        <td>3/6/2022</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="performance.php?mode=adminxx">New Sign Up</a></td>
        <td><?php echolist($eventNum, 0);?> </td>
      </tr>
		<tr>
        <td><?php $eventNum = 17;			?>
          Crowdfunding 2023</td>
        <td>05/16/2023</td>
		  <td><?php	echo amtSignUp($eventNum, $con,0);?></td>
          <td> <?php echo amttotalPeople ($eventNum, $con,0);?></td>
        <td><?php	echo amtSignUp($eventNum, $con,1);?></td>
        <td><?php echo amtPaidSignup($eventNum, $con); ?></td>
        <td><a href="simplefunding.php">New Sign Up</a><br> <a href="createTeam.php?eventid=<?php echo $eventNum;?>">Create Team</a><br>
			<a href="viewTeams.php?eventid=<?php echo $eventNum;?>">View Teams</a></td>
        <td><a href="listCrowdfunding.php?eventid=<?php echo $eventNum;?>">List</a> </td>
      </tr>
<!--      when you add a new line, adjust the list event page and delete to the appropriate one-->
    </tbody>
  </table>
</div>

</body>
</html>