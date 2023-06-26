<?php 
session_start();
if( $_SESSION['admin'] !=1	) {
	header( 'Location: http://www.bjhs.org/events/login.php' ) ; 
	
	}
?>
<?php 

 require("connection.php"); 		
		
		$transactid = '0';
$id = rand(10000, 999999);
$paid = $_POST['payed']; //reset payment
if ($_POST[payment] == 'Check') {
	$paid=1;
}
if($_POST[ccnum] != "" && $_POST['totaldue'] > 0 )

{
	
  require("chargecard.php"); 

    if ($msg == 'approved') {

	 $paid = 1;
$transactid= $response->transaction_id;
	}
	else
	{ 
	  $_SESSION['errormsg']=  "Credit Card Authorization Error! Please go back and correct any information!";
		header("Location:editlearn.php?mode=".$_POST['formmode']);
	}	// end approves

}//end charge cc
	
		
$id = $_POST['webid'];
	$field_name[0] = "tnxid";
		$field_value[0] = $_POST['webid'];
	$query_1=$field_name[0]."=".$field_value[0];

$nametodisplay = ($_POST['noadults']!='' ? $con->real_escape_string($_POST['noadults'] ): $_POST['firstname'] . ' ' . $_POST['lastname']);

$text = $con->real_escape_string($text1);
		$sql="update eventsignup  
		set firstname = '$_POST[firstname]',
		lastname = '$_POST[lastname]',
		email = '$_POST[email]',
		phone1 = '$_POST[phone]',
		address1 = '$_POST[address]',
		zip = '$_POST[zip]',
		city = '$_POST[city]',
		state = '$_POST[state]',
		amtpayed = '$_POST[totaldue]',
		paymethod = '$_POST[payment]' ,
	 numadults = '$_POST[noadults]' ,
	numchild = '$_POST[nokids]' ,
	 otheramt = '$_POST[otheramt]' ,
	 adcomment = '$_POST[adcomment]' ,
		 amtdescr = '$_POST[amtdescr]' ,";
 if ($_POST['payment']!="" ){

$sql=$sql ."	paymethod = '$_POST[payment]' ,	
payed ='$paid' , ";
	 }
	  if (isset($_POST['children']) ){

$sql=$sql ."	adtext = '$_POST[children]' ,";	
	 }
	 
$sql=$sql ."	names1 = '$nametodisplay' ,
		names2 = '$_POST[childnames]' ,
				notes = '$_POST[notes]' ,
		 datemodified = now(),
         changedby = '$_POST[changedby]' 
     
         where tnxid = '$_POST[tnxid]'"
             
		;
if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));
			mysqli_close($con);
		}
else
{
header("Location:listCrowdfunding.php?eventid=". $_POST[eventid]);
}
?>