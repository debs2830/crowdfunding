<?php


if($_GET['mode'] == "adminxx")	{
session_start();
session_set_cookie_params(166400);
	$_SESSION['admin']=1;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
<meta content="utf-8" http-equiv="encoding" />



<title>Bais Yaakov's Receipt</title>
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet"
	href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="css/normalize.min.css">
<link rel="stylesheet" href="css/main.css">

<script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>

		
		<table>
			<tr style="vertical-align: text-bottom;">

				<td style="vertical-align: text-bottom;">
					<div style="text-align: center;">
						<img  src="<?php  if ($_GET['id']== 2 ) {
			echo '//www.bjhs.org/wp-content/uploads/2018/04/shasbanner.jpg';
		} elseif ($_GET['id']== 9 ) {
			echo 'img/spacer.gif';
		} else {
	echo 'img/BYD-campaign-22-flyer.jpg';
}
								   
								   ?>" alt="" width="650" height="auto">
					</div>
				</td>
				</tr>
				<tr>
				<td style="vertical-align: text-bottom;">
<!--					<h1>Receipt</h1>-->
				</td>
			</tr>
		</table>

		
	<?php  if ($_GET['id']== 2 ) {
			echo '<h1>Thank you for your donation to the Rabbi & Mrs. Schwab Shas Campaign<br><br>Your donation has been received</h1>';
		} elseif ($_GET['id']== 3 ) {
			echo '<h1>Thank you for reserving for the 50th Anniversary Reunion<br><br>We look forward to seeing you there!</h1>';
		}
								   
								   ?>
	
	
	
<!--        <h1>A confirmation email has been sent to your email address.</h1>-->
		
		 
		 
	<br />
	<br />
	<?php
	if($_GET['mode'] == "adminxx")	{
				echo '<h1><a href="';
		if ($_GET['id']== 1 ) {
			echo 'shas';
		} elseif ($_GET['id']== 2 ) {
			echo 'reunion';
		}
		echo 'menu.php?mode=adminxx">OK - DONE - Another Sign Up</a></h1>';
		
	}
	else
	{
	echo '<h2><a href="//www.bjhs.org">Return to the Bais Yaakov Web Site</a></h2>';
	}
		 ?>
	</form>
	<script
		src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script>
		window.jQuery
				|| document
						.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')
	</script>

</body>
</html>