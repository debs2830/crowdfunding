<?php
require_once("connection.php");
// Create connection


	$sql = "SELECT  firstname, lastname, amtpayed,tnxid,adcomment, names1, nickname, ID, realname
	FROM eventsignup
	LEFT JOIN crowdfundingTeams
ON eventsignup.adtext = crowdfundingTeams.ID
 where eventsignup.eventid=17 ";
//if (isset($teamid ) ){
//		$sql .= " and adtext = '$teamid'";
//	} 

if (isset($_POST['teamid'])) { 
		$sql .= " and  adtext = '".$_POST['teamid']."'  " ;
}

	if (isset($_POST['lastnum'] ) && $_POST['lastnum'] != ""){
		$sql .= " and tnxid > " . $_POST['lastnum'] ." order by  dateadded  asc   limit 1";
	} else {
		$sql .= " order by  dateadded asc  " ;
		
		//$sql .= " and tnxid < 3813" ; //for testing
	}
		//$sql .="   ";
//$sql .=" order by tnxid desc limit 1 ";
//echo $sql;
//die();
	if (isset($_POST['lastnum'] ) && $_POST['lastnum'] != ""){
		
if ($result=mysqli_query($con,$sql))
  {
		$data = array();
		//echo mysqli_num_rows($result);
while($row = $result->fetch_assoc()){
    $data[] = $row;
}
echo json_encode($data);
	} //has response
	} //end has last num 
else{

	
 $result = $con->query($sql) or die($con->error);
	/*
	while($row = $result->fetch_assoc()){
    print_r( $row);
	echo '<br>';
	
}
die();*/
	
}


	
?>
