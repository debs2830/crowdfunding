<?php
 session_start();
// store session data
$_SESSION['id']=0;



$_SESSION['post_data'] = $_POST;

if ( $_POST['lastname']  == '' ) { 
	echo 'There was an error processing your form. Please go back a page and try again';
	die();
}


$paid = 1;
$approved = 0;
$checkedin = 0;
$notes = $_POST['notes'];

if (isset($_POST[checkingin]) ){
	$checkedin = 1;
	}

if($_POST['payment']== "Later") {
	$paid = 0;
	$approved = 1;
}
$transactionid = 0;

$id = rand(10000, 999999);


	
$transactionid=(isset($response_array[4]) ? $response_array[4] : $_POST['authcode']) ;
 if (!empty($transactionid )) {
	 $paid = 1;
	 $approved = 1;
	 

	}// end approves





// Check connection	

	

// multiple recipients

$to= 'debs2830@gmail.com,office@bjhs.org,ayschwab@bjhs.org,radk@denverkollel.org';
//$to= 'debs2830@gmail.com';
//$to='rmf@denverkollel.org';
$subject = 'Reservation';
	 if ($_POST['eventid']== 2 ) {
$subject = 'Shas Campaign';		} 
elseif ($_POST['eventid']== 3 ) {
$subject = 'Reunion Reservation';
		}elseif (  $_POST['eventid']== 13|| $_POST['eventid']== 17 ) {
$subject = 'BJHS Crowdfunding Campaign';
		}

// message

$message = '

<html><br>The following form has been completed:<br><br>';

$message = $message . '

Name: ' . $_POST['firstname'] . ' '  . $_POST['lastname'] . ' <br>
Address: ' . $_POST['address'] . ' <br>
City: ' . $_POST['city'] . ' <br>
State: ' . $_POST['state'] . ' <br>
Zip: ' . $_POST['zip'] . ' <br>
Phone: ' . $_POST['phone'] . ' <br>
Email: ' . $_POST['email'] . ' <br>

Adult Attending: ' . $_POST['noadults'] . ' <br>
Kids Attending: ' . $_POST['nokids'] . ' <br>
Auth Code: ' . $transactionid . ' <br>
Team: ' . $_POST['team'] . ' <br>';
if ($_POST['totaldue'] > 0 ) { 
	$message = $message . 'Total Amount: ' . $_POST['totaldue']. ' <br>';
		$message = $message . 'Payment Type: ' . $_POST['payment']. ' <br>';

if ($transactionid != 0) {
	$message = $message .
'Invoice #: ' . $id . ' <br>
CC Auth #: ' . $transactionid . ' <br>';
}
}//end has donation
if ($_POST['notes'] != '' ) { 
	$message = $message . 'Extra Notes: ' . $_POST['notes']. ' <br>' ;
}
if (!empty($_POST['adtext'] )) { 
	$message = $message . 'Sponsor Information: ' . $_POST['adtext']. ' <br>' ;
}
if ($_POST['amtdescr'] !='' ) { 
	$message = $message . 'Description: ' . $_POST['amtdescr']. ' <br>' ;
}
if (isset($_POST['payment-spread']))  {
	$message .='<br>Will pay : ' . $_POST['payment-spread'];
}
 	$message = $message . '  <br> </body> </html>';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:Bais Yaakov <adkarnowsky@bjhs.org>' . "\r\n";
mail($to, $subject, $message, $headers);

 //send thank you to donor
if ($_POST['description']== "CrowdFunding Campaign" ) {
			$to  = $_POST['email'];
			$subject = 'Beth Jacob of Denver Crowdfunding Campaign ';
			include ("crowdfundingEmail.php");
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From:Beth Jacob of Denver <adkarnowsky@bjhs.org>' . "\r\n";

			mail($to, $subject, $message, $headers);
}
 require("insertSignup.php"); 
 $_SESSION['id'] = mysqli_insert_id($con);


	if ( $_POST['eventid']== 16) { 
	header("Location:/performance-reservation/");
			die();
		}

//if ($_POST[firstname] != 'test') {
	header("Location:receipt.php?id=".$_POST['eventid']."&mode=".$_POST['formmode']);
	//}

	mysqli_close($con);

die();

 ?>