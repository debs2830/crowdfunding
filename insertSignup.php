<?php 
	 require("connection.php"); 

if (isset($_POST['allowemail']) ) {
$allowemail = 1;
} else {
	$allowemail = 0;
	}
if (isset($_POST['adtext'])) {
				$ad1 = $_POST['adtext'];
$ad = $con->real_escape_string($ad1);
} else {
	$ad = '';
	}
if (isset( $_POST['team'])) {

	$ad = $con->real_escape_string($_POST['team']);
}
	
if (isset( $_POST['comments'])) {

	$text = $con->real_escape_string($_POST['comments']);
}else {
	$text ='';
	}

if ( $_POST['eventid'] == 7 ) {
	$ad = $text;
	$text =  null;
}
	

if (isset( $_POST['notes'])) {

	$text = $con->real_escape_string($_POST['notes']);
}

	$address = $con->real_escape_string($_POST['address']);

	
if (isset($_POST['checkingin']) && $_POST['checkingin'] == 1) {
	$checkingin = 1;
	}else{
$checkingin = 0;
	}
if (isset( $_POST['notes'])) {

	$notes = $con->real_escape_string($_POST['notes']);
}  else {$notes= null;}

if (isset($_POST['payment-spread']) && $_POST['payment-spread'] == 'monthly')  {
	$notes ='12 months';
}
$customerid= substr($_POST['firstname'],0,1) . substr($_POST[lastname],0,1);

  $amtdescr =( isset($_POST['amtdescr']) ?$_POST['amtdescr'] :null);
$firstname = ucwords(strtolower($_POST['firstname']));
$lastname = ucwords(strtolower($_POST['lastname']));
$nametodisplay = ($_POST['adultnames']!='' ? $con->real_escape_string($_POST['adultnames'] ): $firstname . ' ' . $lastname);


$checksql = "select  tnxid  from eventsignup where firstname = '$firstname' and cctnxid = '$transactionid' and eventid =  " .$_POST['eventid'] ;

    $query = mysqli_query($con,$checksql);

	
	

if(mysqli_num_rows($query) && $_POST['payment'] == 'Credit')  {

	 $message = '<br>Duplicate:' . $sql;
	 $message .= '<br>row:' . mysqli_num_rows($query);
				$message .= '<table>';
		foreach ($_POST as $key => $value) {
	if ($key != 'ccnum')  {
         $message .=  "<tr>";
         $message .=  "<td>";
         $message .=  $key;
         $message .=  "</td>";
         $message .=  "<td>";
         $message .=  $value;
         $message .=  "</td>";
         $message .=  "</tr>";
		}
    }
	$message .= '</table>';
$to = 'debs2830@gmail.com';
						$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From:Beth Jacob of Denver <adkarnowsky@bjhs.org>' . "\r\n";

			mail($to, 'DUPLICATE', $message, $headers);
} 
else  {
	
			//put database here
 $sql="INSERT INTO eventsignup  (customerid,
		firstname,		lastname,
		email,		allowemail,
		phone1,		
		address1, 		zip,		city,		state,
		numadults,		numchild,
		payed,		amtpayed,		paymethod,
		dateadded,
		names1,		names2,
		webid,		cctnxid,
		eventid,
		adtext,		adcomment,
		levelgroup,		levelname,
         nc,checkedin,    
		 notes, amtdescr,
		 enteredby
		)
		VALUES
		('$customerid'
		,'$firstname','$lastname '
		,'$_POST[email]'
		,$allowemail
		,'$_POST[phone]'
		,'$address'
		,'$_POST[zip]'
		,'$_POST[city]'
		,'$_POST[state]'
		,'$_POST[noadults]'
		,'$_POST[nokids]'
		,$paid
		,'$_POST[totaldue]'
		,'$_POST[payment]'
		,now()
		,'$nametodisplay'
		,'$_POST[childnames]'
		,$id
		,'$transactionid'
		,'$_POST[eventid]'
		,'$ad'
		,'$text'
		,'$_POST[eventlevel]'
		,'$_POST[sublevel]'
         ,'$_POST[nc]',$checkingin
		 , '$notes', '$amtdescr'
			,'$_POST[enteredby]'
        
        )";
//$result = mysqli_query($con,$sql);

	

try {
    $query = mysqli_query($con,$sql);
	$last_id = $con->insert_id;
	
    if ($query === FALSE) {
		
			$message = '';
			 $message .= "<br>The exception was created on line: " ;
		$message .= '<br>' . $query;
			$message .= '<table>';
		foreach ($_POST as $key => $value) {
	if ($key != 'ccnum')  {
         $message .=  "<tr>";
         $message .=  "<td>";
         $message .=  $key;
         $message .=  "</td>";
         $message .=  "<td>";
         $message .=  $value;
         $message .=  "</td>";
         $message .=  "</tr>";
		}
    }
	$message .= '</table>';
	 $message .= '<br>SQL:' . $sql;
						$headers = "From: info@bjhs.org" . "\r\n" ;
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// send email
			mail("debs2830@gmail.com","BJHS Website errors #1",$message, $headers);


    }
//
  //  $result = $query->fetch_assoc();
} catch(Exception $e) {

	$msg = $e->getMessage();
			
			// use wordwrap() if lines are longer than 70 characters
			$message = wordwrap($msg,70);
			 $message .= "<br>The exception was created on line: " . $e->getLine();
$message .= '<br>' . $query;
			$message .= '<table>';
foreach ($_POST as $key => $value) {
	if ($key != 'ccnum')  {
         $message .=  "<tr>";
         $message .=  "<td>";
         $message .=  $key;
         $message .=  "</td>";
         $message .=  "<td>";
         $message .=  $value;
         $message .=  "</td>";
         $message .=  "</tr>";
    }
    }
	$message .= '</table>';
	 $message .= '<br>SQL:' . $sql;
						$headers = "From: info@bjhs.org" . "\r\n" ;
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// send email
			mail("debs2830@gmail.com","BJHS Website errors",$message, $headers);
}
}
