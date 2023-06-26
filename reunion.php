<?php
session_start();
// store session data
$_SESSION['id']=0;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>


<meta name="title" content="Shas Legacy Campgaign" />
<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
<meta content="utf-8" http-equiv="encoding" />
<meta name="description"
	content="Bais Yaakov of Denver" />

<title>Reunion Reservation</title>
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet"
	href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet"
	href="css/normalize.min.css">
<link rel="stylesheet"
	href="css/main.css">

<style>
input[type="radio"] {
width:25px;
}
</style>
</head>
<body>
<script type="text/javascript" charset="utf-8">

		
			function validateForm()
			{
				
				
				var e1 = document.getElementById("payment");
				var paymeth = e1.options[e1.selectedIndex].value;
				if(paymeth = "")
				{
						alert("Please select a payment method");
						return false;
				}
			
				if( $('#totaldue').val() == 0 && $('#formmode').val() != 'adminxx' ) 
				{
						alert("Please enter donation amount");
						return false;
				}
				return true;
			}

			Number.prototype.formatMoney = function(c, d, t) {
				var n = this, c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "."
						: d, t = t == undefined ? "," : t, s = n < 0 ? "-" : "", i = parseInt(n = Math
						.abs(+n || 0).toFixed(c))
						+ "", j = (j = i.length) > 3 ? j % 3 : 0;
				return s + (j ? i.substr(0, j) + t : "")
						+ i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t)
						+ (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
			};
			function calcTotalA(sel) {
				
				var amount = 0;
				var total = 0;
			
				if (document.getElementById('goldoption').checked) {
		amount =2500;
	
				} else if (document.getElementById('silveroption').checked) {
		amount=1000;
	} 
	else if (document.getElementById('bronzeoption').checked) {
		amount=360;
	}
	else if (document.getElementById('couvertoption').checked) {
		amount=100;
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
				
				document.getElementById("ccmonth").value = "";
				document.getElementById("ccyear").value = "";
				document.getElementById("ccnum").value = "";
				e.style.display = 'none';
				}
			}
			
		</script>
	<form action="insertGeneral.php" method="post" id="form" name="form" onsubmit="return validateForm();" autocomplete="off">
		
	


	  <table>
			<tr style="vertical-align: text-bottom;">

				<td valign="top" style="vertical-align: text-bottom;">
					<div style="text-align: center;">
					<img src="https://www.bjhs.org/wp-content/uploads/2018/04/reunion-banner.jpg" >
                  </div>
				</td>
				</tr>
				<tr>
				<td style="vertical-align: text-bottom;">
					<h1>&nbsp;</h1>
				</td>
			
		</table>

		<fieldset id="registration">
			 <?
if ($_SESSION['errormsg'] != '' ) {
	echo '<h3>Credit Card Authorization Error! Please go back and correct any information!</h3>';
//echo '<p>'. $_SESSION['errormsg'] . '</p>';
$_SESSION['errormsg'] = '';
}
?>
 
			<label for="firstname">First Name</label>: <br /> <input type="text"
				id="firstname" name="firstname" autofocus
				required="required" title="Your first name is required." value="<? echo $_SESSION['post_data']['firstname'] ?>"/> <br />
			<label for="lastname">Last Name</label>:<br /> <input type="text"
				id="lastname" name="lastname" required value="<? echo $_SESSION['post_data']['lastname'] ?>"/> <br /> <br />
			<label for="address">Address</label>:<br /> <input type="text"
				id="address" name="address" required value="<? echo $_SESSION['post_data']['address'] ?>"/> <br /> <br />
			<table>
				<tr>
					<td><label for="city">City</label></td>
					<td><label for="state">State</label></td>
					<td><label for="zip">Zip</label></td>
				</tr>
				<tr>
					<td><input type="text" id="city" name="city"
						required="required" value="<? echo $_SESSION['post_data']['city'] ?>"/></td>
					<td><select name="state" required style="width: 90px">
							 
							<option value="AK">AK</option>
							<option value="AL">AL</option>
							<option value="AR">AR</option>
							<option value="AZ">AZ</option>
							<option value="CA">CA</option>
							<option value="CO" selected>CO</option>
							<option value="CT">CT</option>
							<option value="DE">DE</option>
							<option value="FL">FL</option>
							<option value="GA">GA</option>
							<option value="HI">HI</option>
							<option value="IA">IA</option>
							<option value="ID">ID</option>
							<option value="IL">IL</option>
							<option value="IN">IN</option>
							<option value="KS">KS</option>
							<option value="KY">KY</option>
							<option value="LA">LA</option>
							<option value="MA">MA</option>
							<option value="MD">MD</option>
							<option value="ME">ME</option>
							<option value="MI">MI</option>
							<option value="MN">MN</option>
							<option value="MO">MO</option>
							<option value="MS">MS</option>
							<option value="MT">MT</option>
							<option value="NC">NC</option>
							<option value="ND">ND</option>
							<option value="NE">NE</option>
							<option value="NH">NH</option>
							<option value="NJ">NJ</option>
							<option value="NM">NM</option>
							<option value="NV">NV</option>
							<option value="NY">NY</option>
							<option value="OH">OH</option>
							<option value="OK">OK</option>
							<option value="OR">OR</option>
							<option value="PA">PA</option>
							<option value="RI">RI</option>
							<option value="SC">SC</option>
							<option value="SD">SD</option>
							<option value="TN">TN</option>
							<option value="TX">TX</option>
							<option value="UT">UT</option>
							<option value="VA">VA</option>
							<option value="VT">VT</option>
							<option value="WA">WA</option>
							<option value="WI">WI</option>
							<option value="WV">WV</option>
							<option value="WY">WY</option>
					</select></td>
					<td><input type="text" id="zip" name="zip" required value="<? echo $_SESSION['post_data']['zip'] ?>"/></td>
				</tr>
			</table>
			<br /> <label for="phone">Phone Number</label>: <br /> <input
				type="tel" id="phone" name="phone" required value="<? echo $_SESSION['post_data']['phone'] ?>"/> <br /> <label
				for="email">Email Address</label>: <br /> <input type="email"
				id="email" name="email" required value="<? echo $_SESSION['post_data']['email'] ?>" /> 
                  <input id="search" type="hidden" style="padding:2px;font-size:.6em;width:300px;" /><div style="margin:20px 0 0 0;"> <span id="results" style="color:#68a;"></span> <br /> 
			<p>	Class of: <input  required type="text" name="amtdescr"  id="amtdescr" value="<? echo $_SESSION['post_data']['amtdescr'] ?>"></p>
<p>	Maiden Name: <input  required type="text" name="notes"  id="notes" value="<? echo $_SESSION['post_data']['notes'] ?>"></p>
<p><input type="radio"  id="willattend_0" name="noadults" value="1"><label for="willattend_0">I will be attending</label><br>
	<input type="radio"  id="willattend_1" name="noadults" value="0"><label for="willattend_1">I will not be able to attend, keep as donation. </label>
</p>
<table style="width:80%" >
<tr style="vertical-align: text-top;">
<td width="303" colspan="2">

<h2>Sponsorship Opportunities</h2><br>
<input type="radio" onclick='calcTotalA();' id="goldoption" name="adtext" value="Gold"><label for="goldoption">Gold $2500 each (Includes Gold listing in 50th reunion program)</label><br>
	
	<input type="radio" onclick='calcTotalA();' id="silveroption" name="adtext" value="Silver"><label for="silveroption">Silver $1000 each (Includes Silver listing in 50th reunion program)</label><br>
	<input type="radio" onclick='calcTotalA();' id="bronzeoption" name="adtext" value="Bronze"><label for="bronzeoption">Bronze $360 each (Includes Bronze listing in 50th reunion program)</label><br>
	<input type="radio" onclick='calcTotalA();' id="couvertoption" name="adtext" value="Couvert"><label for="couvertoption">Couvert $100 each</label><br>
<br>
We look forward to your participation! For any cost-related issues, please contact <a href="mailto:reunion50bjhs@gmail.com" target="_blank">reunion50bjhs@gmail.com</a>.
</td>


  
</tr>

</table>	
				
				<input type = "hidden" name = "childnames" id = "childnames" value=""> </input>
				<input type = "hidden" name = "nokids" id = "nokids" value="0"> </input>

		<label for="otheramt">Additional Donation: $ </label> 
		<input type="number" style="width: 90px" id="otheramt" name="otheramt" min='0'  onchange="calcTotalA()" onblur="calcTotalA()" value="<? 
		if ($_SESSION['post_data']['otheramt'] != "" ) {
					echo $_SESSION['post_data']['otheramt'] ;
		} else {
			echo "0"; } ?>"/>
				<br />
			   <label for="totaldue">Total Amount Due: $ </label>   <input
				type="text" style="width: 90px" id="totaldue" name="totaldue" min="100" required="required"	 value="<? echo $_SESSION['post_data']['totaldue'] ?>" <? if ( $_GET['mode'] != "adminxx" ) {?>readonly <? }?>/><br>

                 
		<label for="nokids">Payment Method: </label> 
				<select
				name="payment" id="payment" required style="width: 125px"
				onchange="showCredit(this)">
				<option value="" selected>-:Payment:-</option>
				<option value="Credit">Credit Card</option>
				<option value="Later">Pay Later</option>
<? if ( $_GET['mode'] == "adminxx" ) {?>
				<option value="Cash">Cash</option>
				<option value="Check">Check</option>
				 
				<option value="NOCHARGE">No Charge</option>
				<option value="ALREADYPAID">Already Paid</option>
				<? }?>
		
				
		  </select> 
		  <div id="ccinfo" style="display:none">
			<br />
			
			<label for="ccnum">Credit Card #</label>
		
			<input type="text" 	id="ccnum" name="ccnum" value="<? echo $_SESSION['post_data']['ccnum'] ?>"/>
				<br />
			<label for="ccmonth">Exp Date:</label>
		
			<select name="ccmonth" id="ccmonth" style="width: 70px" >

				<option value="<? echo $_SESSION['post_data']['ccmonth'] ?>" selected><? echo $_SESSION['post_data']['ccmonth'] ?></option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
			</select>
			<select name="ccyear" id="ccyear" style="width: 80px">
				<option value="<? echo $_SESSION['post_data']['ccyear'] ?>" selected><? echo $_SESSION['post_data']['ccyear'] ?></option>
				 <?
 $currenYear = date("Y");
 $yearGetTo = date("Y") + 10;
  for ($i =$currenYear ; $i <=$yearGetTo  ; $i++) {
    echo '<option value="'. substr($i, -2)    .'">'. $i .'</option>';
}
?>
					

			</select>
		<br />
                 <div class="required">
			<label for="cvv">3 Digit Security Code: </label>
		
			<input type="text" id="cvv" name="cvv" style="width: 90px" value="<? echo $_SESSION['post_data']['cvv'] ?>"/>
                      </div>
			</div>
				</fieldset>   
          <input type="hidden" name="tnxid" id="tnxid"></input>
	   <input type="hidden" name="eventid" id="eventid" value="3"></input>
       	   <input type="hidden" name="description" id="eventid" value="Reunion Reservation"></input>
	   
	   
	<?php
	if( !isset($_GET['mode']) )
	{
		echo '<input type="hidden" name="formmode" id="formmode" value="consumer"/> ';
	}
	else
	{
		echo '<input type="hidden" name="formmode" id="formmode" value="'.$_GET['mode'].'"/>';
	}
	?>
	   <input type="submit" value="Reserve Now"></input>
	</form>
	<script src="js/plugins.js"></script>
	<script src="js/main.js"></script>


</body>
</html>
