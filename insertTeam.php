<?php 
	 require("connection.php"); 
$nickname = $con->real_escape_string($_POST['nickname']);
$realname = $con->real_escape_string($_POST['realname']);
$donationamt = $con->real_escape_string($_POST['donationamt']);
$peopleGoal = $con->real_escape_string($_POST['peopleGoal']);
 $nickname =strtolower( str_replace(" ", "-", $nickname ) );
			//put database here

if (isset ($_POST['ID'])) { 
	$sql="UPDATE crowdfundingTeams set nickname = '$nickname',realname='$realname',donationamount='$donationamt', peopleGoal='$peopleGoal' where ID =" . $_POST['ID'];
	
	//edit
} else { 
 $sql="INSERT INTO crowdfundingTeams  (nickname,
 realname,
 donationamount,peopleGoal,
 eventid
 
	
		)
		VALUES
		('$nickname','$realname','$donationamt','$peopleGoal' , $_POST[eventid]  )";
//$result = mysqli_query($con,$sql);

}

try {
    $query = mysqli_query($con,$sql);
$last_id = $con->insert_id;
	
    if ($query === FALSE) {

        throw new Exception($e);
    }

  //  $result = $query->fetch_assoc();
} catch(Exception $e) {



	$msg = $e->getMessage();
			
			// use wordwrap() if lines are longer than 70 characters
			$message = wordwrap($msg,70);
			 $message .= "<br>The exception was created on line: " . $e->getLine();
$message .= '<br>' . $query;
			$message .= '<table>';
foreach ($_POST as $key => $value) {
         $message .=  "<tr>";
         $message .=  "<td>";
         $message .=  $key;
         $message .=  "</td>";
         $message .=  "<td>";
         $message .=  $value;
         $message .=  "</td>";
         $message .=  "</tr>";
    }
	$message .= '</table>';
	 $message .= '<br>SQL:' . $sql;
						$headers = "From: info@bjhs.org" . "\r\n" ;
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// send email
			mail("debs2830@gmail.com","BJHS Website errors",$message, $headers);
}

?> 
A new team has been created for <?php echo $_POST['realname'];?>
<br>
Please use this link <a href="https://www.bjhs.org/crowdfunding/<?php echo  $nickname;?>">https://www.bjhs.org/crowdfunding/<?php echo  $nickname;?></a><br>
<br>
<a href="createTeam.php?eventid=<?php echo $_POST['eventid'];?>">Create another Team</a><br>
<a href="viewTeams.php?eventid=<?php echo $_POST['eventid'];?>">View Full Team Listing</a><br>
