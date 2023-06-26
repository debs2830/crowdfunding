<?php
session_start();
ini_set('display_errors', 0);

if ( $_POST['lastname']  == '' ) { 
	echo 'There was an error processing your form. Please go back a page and try again';
	die();
}

// store session data
$_SESSION['id']=0;
$_SESSION['post_data'] = $_POST;

$approved = 0;
$id = rand(1,10000);
$paid = 0;
$transactionid = 0;

	if($_POST['payment']== "Credit")
	{

	$paid = 1;
	$approved = 1;
//$transactid=$response_array[4];
		$transactid=$_POST['authcode'];
	
	}
	else
	{
			$approved = 1;
		
		if($_POST['payment'] == "NOCHARGE" || $_POST['payment'] == "ALREADYPAID" || $_POST['payment'] == "Check"|| $_POST['payment'] == "Cash")
		{
			$paid = 1;
		}
		
		
	}
	if (	$approved == 1 ) {	
	
	 require("insertSignup.php"); 
		
		
		 require("connection.php"); 

//enter into database individual names

				for($i=1; $i <=2; $i++ ) {

				if($_POST['firstname' .$i] != '')
				{
//					$notes = $_POST['eventlevel'];
//					if ($notes == 'dinnercouple' || $notes == 'dinnersingle') {
//						$notes = 'dinner';
//					}
 $firstname = $con->real_escape_string($_POST['firstname' .$i]);
 $lastname  = $con->real_escape_string($_POST['lastname'. $i]);
 $title = $con->real_escape_string($_POST['sal'. $i]);
					
					$sql1 = "INSERT INTO eventperson(eventid,firstname,lastname,title,tnxid,checkedin, notes)
					VALUES('$_POST[eventid]','" .$firstname ."', '". $lastname."', '". $title ."',$last_id, $checkingin, 'dinner' )";
					
					
try {
	mysqli_query($con,$sql1);
}  catch(Exception $e) {

die('There has been an error');

	
}
				
						
				}
				}
	
			//send email 
				$to  ='reservations@bjhs.org,adkarnowsky@bjhs.org,debs2830@gmail.com';
		//$to='debs2830@gmail.com';
			$subject = ($_POST['description'] =='Yearbook' ? 'Yearbook Ad' : 'Parlor Meeting Reservation');
		$message = '<html><br>The following  reservation form has been completed';
		if ($paid == 0 ) {
		$message = $message . ' (Not Paid Yet)';
		}
		$message = $message . ':<br><br>';
		$message = $message . '
					Name: ' . $_POST['firstname'] . ' '  . $_POST['lastname'] . ' <br>
					Address: ' . $_POST['address'] . ' <br>
					City: ' . $_POST['city'] . ' <br>
		            State: ' . $_POST['state'] . ' <br>
					Zip: ' . $_POST['zip'] . ' <br>
					Phone: ' . $_POST['phone'] . ' <br>
					Email: ' . $_POST['email'] . ' <br>
					Invoice #: ' . $id . ' <br>
						Payment Type: ' . $_POST['payment'] . ' <br>';
					if ($transactionid != '' ) {
					$message = $message . 'CC Auth #: ' . $transactionid . ' <br>';
					}
				$message = $message . 'Event: ' . $_POST['eventlevel'] . ' <br>
					Journal Option: ' . $_POST['sublevel'] . ' <br>';
		if ($_POST['donationamt'] != '' ) {
					$message = $message . 'Additional Donation: ' . $_POST['donationamt'] . ' <br>';
					}
							$message .='Ad: ' . $_POST['adtext'] . ' <br>
						Comments: ' . $_POST['comments'] . ' <br>
						Entered By: ' . $_POST['enteredby']. '<br>
					Total Amount Charged: $' . $_POST['totaldue'] . ' <br> </body> </html>';

			// To send HTML mail, the Content-type header must be set
$headers = 'From:Beth Jacob of Denver <office@bjhs.org>' . "\r\n" .
    'Reply-To: office@bjhs.org>' . "\r\n" ;
    	    $header .= "MIME-Version: 1.0 \r\n";
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$from = 'office@bjhs.org';
			// Mail it
//include('bat/MailHandler.php');
			mail($to, $subject, $message, $headers);
	

			// multiple recipients
			$to  = $_POST['email'];
			$subject = 'Beth Jacob Parlor Meeting Reservation';
			$message = '<html>';
			
				$message .='Thank you for your donation towards the Beth Jacob Parlor Meeting Dinner and Journal.<br>The following information has been received:<br><br>';
			$message .=  '	Name: ' . $_POST['firstname'] . ' '  . $_POST['lastname'] . ' <br>
		Address: ' . $_POST['address'] . ' <br>
		City: ' . $_POST['city'] . ' <br>
		State: ' . $_POST['state'] . ' <br>
		Zip: ' . $_POST['zip'] . ' <br>
		Phone: ' . $_POST['phone'] . ' <br>
		Email: ' . $_POST['email'] . ' <br>
		Invoice #: ' . $id . ' <br>
		';
		if ($paid != 1) {
							' If you have not yet paid, Please make checks payable to Beth Jacob, 5100 West 14th Ave,  Denver, CO 80204 or contact Beth Jacob for Payment options ';}
	$message = $message . '<br>'
							.'Donation Amount: $' . $_POST['totaldue'] . ' <br> </body> </html>';
			
		
if ( $_POST['email'] != "" ) {
	//	mail($to, $subject, $message, $headers);
	//include('bat/MailHandler.php');
}

				//$_SESSION['id'] = mysql_insert_id($con);
		if ( $_POST['formmode'] == 'wordpress') { 
			if($_POST['description'] =='Yearbook' )  {
	header("Location:/yearbook-complete/"); } else  {
			header("Location:/parlor-meeting-complete/");	
			}
			die();
		}
	header("Location:receiptdinner.php?id=".$id."&mode=".$_POST['formmode']);
			}
			mysqli_close($con);
	
?>