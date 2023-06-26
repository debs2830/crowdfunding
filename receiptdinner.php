<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
<meta content="utf-8" http-equiv="encoding" />



<title>Bais Yaakov's </title>
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>


<link rel="stylesheet" href="css/main.css">

<script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>

		
		<table>
			<tr style="vertical-align: text-bottom;">

				<td style="vertical-align: text-bottom;">
					<div style="text-align: center;">
<!--						<img  src="https://www.bjhs.org/wp-content/uploads/2022/11/BYD-dinner23-scaled.jpg" alt="" width="650" height="270">-->
					</div>
				</td>
				</tr>
				<tr>
				<td style="vertical-align: text-bottom;">
<!--					<h1>Beth Jacob's Parlour Meeting Dinner</h1>-->
				</td>
			</tr>
		</table>

<!--		<h1>Thank you for signing up!</h1>-->
<!--        <h1>A confirmation email has been sent to your email address.</h1>-->
		<h1>Thank you</h1>
	<h2>Your information will be processed</h2>
		 
		 
	<br />
	<br />
	<?php
	if($_GET['mode'] == "adminxx")
					{
		echo '<h1><a href="dinner.php?mode=adminxx">OK - DONE - Another Sign Up</a></h1>';
	}
	else
	{
	echo '<h2><a href="http://www.bjhs.org">Return to the Bais Yaakov Web Site</a></h2>';
		// remove all session variables
	}
		 ?>
	</form>
	
</body>
</html>

