<?php 
session_start();
date_default_timezone_set('America/Denver');
if( $_SESSION['admin'] !=1	) {
	header( 'Location: http://www.bjhs.org/registration/login.php' ) ; 
	
	}
?> 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>

<meta name="keywords" content="denver kollel, denver torah" />
<meta name="title" content="Jewish Family Extravaganza" />
<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
<meta content="utf-8" http-equiv="encoding" />
<meta name="description"
	content="BJHS - Because Torah Learning is for Every Jew" />

<title>Edit Shas Campaign</title>
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet"
	href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="css/normalize.min.css">
<link rel="stylesheet" href="css/main.css">
<script src="js/vendor/modernizr-2.6.2.min.js"></script>
    
</head>
<body>
<script type="text/javascript" charset="utf-8">
Number.prototype.formatMoney = function(c, d, t) {
				var n = this, c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "."
						: d, t = t == undefined ? "," : t, s = n < 0 ? "-" : "", i = parseInt(n = Math
						.abs(+n || 0).toFixed(c))
						+ "", j = (j = i.length) > 3 ? j % 3 : 0;
				return s + (j ? i.substr(0, j) + t : "")
						+ i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t)
						+ (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
			};
$(window).bind("pageshow", function() {
    var form = $('form'); 
    // let the browser natively reset defaults
    form[0].reset();
	var randomnumber=Math.floor(Math.random()*9999999);
		 
});

			function calcTotalA(sel) {
				
				var amount = 0;
				var total = 0;
				if (document.getElementById('sederoption').checked) {
		amount =5000;
	
				} else if (document.getElementById('krachoption').checked) {
		amount=1000;
	} 
	else if (document.getElementById('mesechtaoption').checked) {
		amount=500;
	}
	else if (document.getElementById('perekoption').checked) {
		amount=180;
	}else if (document.getElementById('dafoption').checked) {
		amount=50;
	}
							var otheramt = parseFloat($('#otheramt').val() );
				if (otheramt < 0 || isNaN(otheramt)) {
					otheramt = 0 ;
					}
						
				
				var total1 = 0;
					total1= amount + otheramt;
				
				var elem = document.getElementById("totaldue");
				elem.value = (total1).formatMoney(2, '.', ',');

			}

			if (!("autofocus" in document.createElement("input"))) {
				document.getElementById("firstname").focus();
			}	
			function showCredit(sel) {
				var e1 = document.getElementById("payment");
				var paymeth = e1.options[e1.selectedIndex].value;
				var e = document.getElementById("ccinfo");
				if(paymeth == "Credit")
				{
				  e.style.display = 'block';
				}
				else
				{
				document.getElementById("cc").value = "";
				document.getElementById("ccmonth").value = "";
				document.getElementById("ccyear").value = "";
				document.getElementById("ccnum").value = "";
				e.style.display = 'none';
				}
			}
           
</script>
	<form action="update.php" method="post" id="form" name="form" onsubmit="return validateForm1();">
		<input type="hidden" name="eventlevel" id="eventlevel" value=" "></input>
		<input type="hidden" name="eventsublevel" id="eventsublevel" value=" "></input>
		<input type="hidden" name="childnames" id="childnames" value=" "> </input>
		 
		<a href="menu.php">Back To Menu </a> | <a href="listEvent.php?eventid=2">Back To Event List </a>
		<table>
			<tr style="vertical-align: text-bottom;">

				<td style="vertical-align: text-bottom;">
					<div style="text-align: center;">
						
					</div>
				</td>
				</tr>
				<tr>
				<td style="vertical-align: text-bottom;">
					<h1>Shas - Edit Entry</h1>
				</td>
			
		</table>
<?php
require('connection.php');
$field_name[0] = "tnxid";
$field_value[0] = $_GET['id'];
$query_1= "SELECT * FROM eventsignup WHERE tnxid = " . $_GET['id'];
 
$result = $mysqli->query($query_1);

if (!$result) {
	echo 'There was no record found with this id';

}
while ($row=mysqli_fetch_array($result))
{
$phpdate = strtotime( $row['dateadded'] );
$mysqldate = date( 'M-d-Y ', $phpdate );
$mysqltime= date( 'H:i:s', $phpdate );
echo '<table>';
echo '<tr>';
echo '<td>Date Submitted</td>';
echo '<td>'. $mysqldate . '  </td>';
echo '</tr>';
echo '<tr>';
echo '<td>Time Submitted</td>';
echo '<td>'. $mysqltime . ' </td>';
echo '</tr>';
echo '<tr>';
echo '<td>CC TNX ID</td>';
echo '<td>'. $row['cctnxid'] .' </td>';
echo '</tr>';
echo '</table>';

echo'<input type="hidden" name="tnxid" id="tnxid"  value="'. $row['tnxid'] .'"></input>';
		echo'<input type="hidden" name="webid" id="webid"  value="'. $row['webid'] .'"></input>';	 
		echo '<fieldset id="registration">';
        echo '<label for="firstname">First Name</label>: <br /> <input type="text"';
        echo '	id="firstname" name="firstname" autofocus="autofocus" value="'. $row['firstname'] .'"';
        echo '	required="required" title="Your first name is required." /> <br />';
        echo '<label for="lastname">Last Name</label>:<br /> <input type="text" value="'. $row['lastname'] .'"';
        echo '	id="lastname" name="lastname" required="required" onblur="fillName()" /> <br /> <br />';
		echo '	<label for="address">Address</label>:<br /> <input type="text" value="'. $row['address1'] .'"';
		echo '		id="address" name="address" required="required" /> <br /> <br />';
		echo '	<table>';
		echo '		<tr>';
		echo '			<td><label for="city">City</label></td>';
			echo '		<td><label for="state">State</label></td>';
			echo '		<td><label for="zip">Zip</label></td>';
			echo '	</tr>';
			echo '	<tr>';
			echo '		<td><input type="text" id="city" name="city" value="'. $row['city'] .'"';
			echo '			required="required" /></td>';
			echo '		<td><select name="state" required="required" style="width: 90px">';
							 
			echo '				<option value="AK">AK</option>';
			echo '				<option value="AL">AL</option>';
			echo '				<option value="AR">AR</option>';
			echo '				<option value="AZ">AZ</option>';
			echo '				<option value="CA">CA</option>';
			echo '				<option value="CO" selected>CO</option>';
			echo '				<option value="CT">CT</option>';
			echo '				<option value="DE">DE</option>';
			echo '				<option value="FL">FL</option>';
			echo '				<option value="GA">GA</option>';
			echo '				<option value="HI">HI</option>';
			echo '				<option value="IA">IA</option>';
			echo '				<option value="ID">ID</option>';
			echo '				<option value="IL">IL</option>';
			echo '				<option value="IN">IN</option>';
			echo '				<option value="KS">KS</option>';
			echo '				<option value="KY">KY</option>';
			echo '				<option value="LA">LA</option>';
			echo '				<option value="MA">MA</option>';
			echo '				<option value="MD">MD</option>';
			echo '				<option value="ME">ME</option>';
			echo '				<option value="MI">MI</option>';
			echo '				<option value="MN">MN</option>';
			echo '				<option value="MO">MO</option>';
			echo '				<option value="MS">MS</option>';
			echo '				<option value="MT">MT</option>';
			echo '				<option value="NC">NC</option>';
			echo '				<option value="ND">ND</option>';
			echo '				<option value="NE">NE</option>';
			echo '				<option value="NH">NH</option>';
			echo '				<option value="NJ">NJ</option>';
			echo '				<option value="NM">NM</option>';
			echo '				<option value="NV">NV</option>';
			echo '				<option value="NY">NY</option>';
			echo '				<option value="OH">OH</option>';
			echo '				<option value="OK">OK</option>';
			echo '				<option value="OR">OR</option>';
			echo '				<option value="PA">PA</option>';
			echo '				<option value="RI">RI</option>';
			echo '				<option value="SC">SC</option>';
			echo '				<option value="SD">SD</option>';
			echo '				<option value="TN">TN</option>';
			echo '				<option value="TX">TX</option>';
			echo '				<option value="UT">UT</option>';
			echo '				<option value="VA">VA</option>';
			echo '				<option value="VT">VT</option>';
			echo '				<option value="WA">WA</option>';
			echo '				<option value="WI">WI</option>';
			echo '				<option value="WV">WV</option>';
			echo '				<option value="WY">WY</option>';
			echo '		</select></td>';
			echo '		<td><input type="text" id="zip" name="zip" required="required" value="'. $row['zip'] .'" /></td>';
			echo '	</tr>';
			echo '</table>';
			echo '<br /> <label for="phone">Phone Number</label>: <br /> <input';
			echo '	type="tel" id="phone" name="phone" required="required" value="'. $row['phone1'] .'"/> <br /> <label';
			echo '	for="email">Email Address</label>: <br /> <input type="email" value="'. $row['email'] .'"';
			echo '	id="email" name="email" required="required" /> <br /> ';
?>
    <script>
$( document ).ready(function() {
	$('input[name="adtext"][value="<? echo $row['adtext'];?>"]').attr('checked', 'checked');
			
	$('#payment option[value=<? echo $row['paymethod'];?>]').attr('selected','selected').change();
/*	$('input[name="eventlevel"][value="preevent"]').attr('checked');
	$('input[name="sublevel"][value=""]').attr('checked');*/

});
	</script>
<table style="width:80%" >
<tr style="vertical-align: text-top;">
<td width="303">

<input type="hidden" name="noadults" id="noadults" value="0">
<h2>Dedication Opportunities</h2><br>
<input type="radio" onclick='calcTotalA();' id="sederoption" name="adtext" value="Seder"><label for="sederoption">Seder(Order) $5000 each</label><br>
	<input type="radio" onclick='calcTotalA();' id="krachoption" name="adtext" value="Krach"><label for="krachoption">Krach (Volume) $1000 each</label><br>
	<input type="radio" onclick='calcTotalA();' id="mesechtaoption" name="adtext" value="Mesechta"><label for="mesechtaoption">Mesechta (Tractate) $500 each</label><br>
	<input type="radio" onclick='calcTotalA();' id="perekoption" name="adtext" value="Perek"><label for="perekoption">Perek (Chapter) $180 each</label><br>
	<input type="radio" onclick='calcTotalA();' id="dafoption" name="adtext" value="Daf"><label for="dafoption">Daf (Folio) $50 each</label><br>
<br>

</td>
<td width="245" style="vertical-align: text-top;">
	If you would like to specify which part of shas to sponsor: 
	<input type="text" name="amtdescr"  value="<?php echo $row['amtdescr'];?>" >
  </td>
</tr>

</table>	
<?php

			echo '	<hr>';
    
    
 echo '	<label for="otheramt">Additional Donation: $ </label> ';
echo '			<input type="text" style="width: 90px" id="otheramt" name="otheramt" value="'. $row['otheramt'] .'"  onchange="calcTotalA()" onblur=calcTotalA()" /> ';

		
		
echo '				 <br /> ';
echo '			   <label for="totaldue">Total Amount Due: $ </label>  <input';
echo '				type="text" style="width: 90px" id="totaldue" name="totaldue" required="required" value="'. $row['amtpayed'] .'"';
echo '				  />';
echo '				<br /><label for="nokids">Payment Method: </label> ';
echo '				<select';
echo '				name="payment" id="payment" required="required" style="width: 125px"';
echo '				onchange="showCredit(this)">';

echo '				<option value=""  >-:Payment:-</option>';
    if($row['paymethod'] == "Credit")
    {
        echo '				<option value="Credit" selected>Credit Card</option>';
    }
    else
    {
        echo '				<option value="Credit">Credit Card</option>';
    }
     if($row['paymethod'] == "Cash")
    {
        echo '				<option value="Cash" selected>Cash</option>';
    }
    else
    {
        echo '				<option value="Cash">Cash</option>';
    }
if($row['paymethod'] == "Check")
    {
       echo '				<option value="Check" selected>Check</option>';
    }
    else
    {
       echo '				<option value="Check">Check</option>';
    }
 	if($row['paymethod'] == "Later")
    {
      echo '              <option value="Later" selected>Pay Later</option>';
    }
    else
    {
      echo '              <option value="Later">Pay Later</option>';
    }			
if($row['paymethod'] == "NOCHARGE")
    {
   echo '				<option value="NOCHARGE" selected>No Charge</option>';
    }
    else
    {
      echo '				<option value="NOCHARGE">No Charge</option>';
    }	

if($row['paymethod'] == "ALREADYPAID")
    {
   echo '				<option value="ALREADYPAID" selected>Already Paid</option>';
    }
    else
    {
     echo '				<option value="ALREADYPAID">Already Paid</option>';
    }	

				
echo '			</select> <label for="nc">Initials for N/C </label>  <input';
echo '				type="text" style="width: 90px" id="nc" name="nc"  />';
echo '			<div id="ccinfo" style="display:none">';
echo '			<br />';
echo '			<label for="cc">Credit Card:</label>:';
			
echo '			<select';
echo '				name="cc" id="cc" style="width: 125px">';
echo '				<option value="VISA">VISA</option>';
echo '				<option value="MASTERCARD">Mastercard</option>';
echo '				<option value="AMEX">American Express</option>';
echo '				<option value="DISCOVER">Discover</option>';
echo '			</select>';
echo '			<br />';
echo '			<label for="ccnum">Credit Card #</label>';
		
echo '			<input type="text"';
echo '				id="ccnum" name="ccnum" />';
echo '				<br />';
echo '			<label for="ccmonth">Exp Date:</label>';
		
echo '			<select name="ccmonth" id="ccmonth" style="width: 70px" >';
echo '				<option value="" selected></option>';
echo '				<option value="1">JAN</option>';
echo '				<option value="2">FEB</option>';
echo '				<option value="3">MAR</option>';
echo '				<option value="4">APR</option>';
echo '				<option value="5">MAY</option>';
echo '				<option value="6">JUN</option>';
echo '				<option value="7">JUL</option>';
echo '				<option value="8">AUG</option>';
echo '				<option value="9">SEP</option>';
echo '				<option value="10">OCT</option>';
echo '				<option value="11">NOV</option>';
echo '				<option value="12">DEC</option>';
echo '			</select>';
echo '			<select name="ccyear" id="ccyear" style="width: 80px">';

 $currenYear = date("Y");
 $yearGetTo = date("Y") + 10;
  for ($i =$currenYear ; $i <=$yearGetTo  ; $i++) {
    echo '<option value="'. substr($i, -2)    .'">'. $i .'</option>';
}
				
echo '			</select>';
echo '		<br />';
echo '			</div>';
echo '				</fieldset>   ';
echo ' <br/><label for="changedby">Data Changed By </label>  <input	type="text" style="width: 90px" id="changedby" name="changedby" required  />';

}  

echo '	   <input type="hidden" name="eventid" id="eventid" value="2"/>';
	   
	   ?>
 <input type="hidden" name="description" id="eventid" value="Shas Campaign" />
	<?php
	if( !isset($_GET['mode']) )
	{
		echo '<input type="hidden" name="formmode" value="consumer"/> ';
	}
	else
	{
		echo '<input type="hidden" name="formmode" value="'.$_GET['mode'].'"/>';
	}
	?><input type = "hidden" name = "childnames" id = "childnames" value=""> </input>
				<input type = "hidden" name = "nokids" id = "nokids" value="0"> </input>
	 <input
			type="submit" value="Save Data"></input>
	</form>
	<script
		src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script>
		window.jQuery
				|| document
						.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')
	</script>

	<script src="js/plugins.js"></script>

</body>
</html>
