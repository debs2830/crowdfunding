<?php 
session_start();
date_default_timezone_set('America/Denver');
if( $_SESSION['admin'] !=1	) {
	header( 'Location: http://www.bjhs.org/events/login.php' ) ; 
	
	}
?> 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>

<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
<meta content="utf-8" http-equiv="encoding" />
	<script
		src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

<title>Bais Yaakov's Anniversary Celebration</title>
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet"
	href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" href="css/normalize.min.css">
<link rel="stylesheet" href="css/main.css">
<script src="js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="js/dinner.js"></script>
</head>
<body>

	<form action="updateDinner.php" method="post" id="form" name="form" >
	
	<a href="menu.php">Back To Menu </a> | <a href="listEventDinner.php?eventid=<?php echo $_GET['eventid'];?>">Back To Event List </a>
		<table>
			<tr style="vertical-align: text-bottom;">

				<td style="vertical-align: text-bottom;">
					<div style="text-align: center;">
						<IMG SRC="https://www.bjhs.org/wp-content/uploads/2019/11/dinner2020-1024x299.jpg" ALT="" width="560" height="240"></div>
				</td>
				</tr>
				<tr>
				<td style="vertical-align: text-bottom;">
					<h1>BY's Parlor Meeting(Edit)</h1>
				</td>
			
		</table>
<?php
			require('connection.php');

$field_name[0] = "tnxid";
$field_value[0] = $_GET['id'];
$query_1=$field_name[0]."=".$field_value[0];
 
$result = $mysqli->query("SELECT * FROM eventsignup WHERE $query_1");
//var_dump(mysqli_fetch_array($result));
while ($row=mysqli_fetch_array($result))
{
						
echo '<table>';
echo '<tr>';
echo '<td>Date Submitted</td>';
echo '<td>';
$date=date_create( $row['dateadded']);
echo date_format($date,"m/d/Y g:i a") ;
	echo  '  </td>';
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
        echo '	title="Your first name is required." /> <br />';
        echo '<label for="lastname">Last Name</label>:<br /> <input type="text" value="'. $row['lastname'] .'"';
        echo '	id="lastname" name="lastname"  /> <br /> <br />';
		echo '	<label for="address">Address</label>:<br /> <input type="text" value="'. $row['address1'] .'"';
		echo '		id="address" name="address"  /> <br /> <br />';
		echo '	<table>';
		echo '		<tr>';
		echo '			<td><label for="city">City</label></td>';
			echo '		<td><label for="state">State</label></td>';
			echo '		<td><label for="zip">Zip</label></td>';
			echo '	</tr>';
			echo '	<tr>';
			echo '		<td><input type="text" id="city" name="city" value="'. $row['city'] .'"';
			echo '			 /></td>';
			echo '		<td><select name="state" style="width: 90px">';
							 
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
			echo '		<td><input type="text" id="zip" name="zip"  value="'. $row['zip'] .'" /></td>';
			echo '	</tr>';
			echo '</table>';
			echo '<br /> <label for="phone">Phone Number</label>: <br /> <input';
			echo '	type="tel" id="phone" name="phone"  value="'. $row['phone1'] .'"/> <br /> <label';
			echo '	for="email">Email Address</label>: <br /> <input type="email" value="'. $row['email'] .'"';
			echo '	id="email" name="email"  /> <br /> ';
	?>
    
    <script>
$( document ).ready(function() {
	$('input[name="eventlevel"][value="<? echo $row['levelgroup'];?>"]').attr('checked', 'checked');
	$('input[name="sublevel"][value="<? echo $row['levelname'];?>"]').attr('checked', 'checked');
	
		
	$('#payment option[value=<? echo $row['paymethod'];?>]').attr('selected','selected').change();
/*	$('input[name="eventlevel"][value="preevent"]').attr('checked');
	$('input[name="sublevel"][value=""]').attr('checked');*/

});
	</script>
   <div class='row' >

			
				<div id="leveltwoinfo" style="width:100%">
				<table style="width:90%;">
					<tr>
						<td style="vertical-align:top;">
							
<div  style="width:50%;float:left;">
 <input type="radio" name="sublevel" id="diamond" value="Diamond Scholarship"
							onclick="calc();" style="width: 25px;" /> <label for="diamond">$36,000
								Diamond Scholarship**</label><br /> 
	<input type="radio"	name="sublevel" id="FullS" value="Full Scholarship" onclick="calc();" style="width: 25px;" />
						<label for="FullS">$25,000 Full Scholarship** </label><br />
	<input type="radio"	name="sublevel" id="Major" value="Major Scholarship" onclick="calc();" style="width: 25px;" />
						<label for="Major">$20,000 Major Scholarship** </label><br />
						<input type="radio"	name="sublevel" id="ChaiS" value="Chai Scholarship" onclick="calc();" style="width: 25px;" />
						<label for="ChaiS">$18,000 Chai Scholarship**</label><br />
						
						<input type="radio"	name="sublevel" id="PartialS" value="Partial Scholarship" onclick="calc();" style="width: 25px;" />
						<label for="PartialS">$15,000 Partial Scholarship **</label><br /><input type="radio"	name="sublevel" id="GoldS" value="Gold Scholarship" onclick="calc();" style="width: 25px;" />
						<label for="GoldS">$10,000 Gold Scholarship** </label><br /><input type="radio"	name="sublevel" id="SilverS" value="Silver Scholarship" onclick="calc();" style="width: 25px;" />
						<label for="SilverS">$7,500 Silver Scholarship**</label><br />
							
						 <input type="radio" name="sublevel"
							id="BronzeS" value="Bronze Scholarship" onclick="calc();" style="width: 25px;" /><label
							for="BronzeS">$5,000 Bronze Scholarship**</label><br /> <input
							type="radio" name="sublevel" id="Diamond" value="Diamond"
							onclick="calc();" style="width: 25px;" /><label for="Diamond">$3,600 Diamond Page** </label><br /> <input
							type="radio" name="sublevel" id="Platinum" value="Platinum"
							onclick="calc();" style="width: 25px;" /><label for="Platinum">$2,500 Platinum Page**</label><br />
						  </div>
							<div style="width:50%;float:left;">
								<input type="radio"
							name="sublevel" id="Chai" value="Chai" onclick="calc();"
							style="width: 25px;" /><label for="Chai">$1,800 Chai Page**</label><br />
							
							<input type="radio" name="sublevel" id="Gold"
							value="Gold" onclick="calc();" style="width: 25px;" /><label
							for="Gold">$1,500 Gold Page**</label><br /> <input type="radio" name="sublevel" id="Silver"
							value="Silver" onclick="calc();" style="width: 25px;" /><label
							for="Silver">$1,100 Silver Page**</label><br /> 
							<input
							type="radio" name="sublevel" id="Bronze" value="Bronze"
							onclick="calc();" style="width: 25px;" /> <label for="Bronze">$750 Bronze Page*</label><br /> 
	<input type="radio" name="sublevel"	id="Full" value="Full" onclick="calc();"	style="width: 25px;" /><label for="Full">$500 Full Page*</label><br />	
						<input type="radio" name="sublevel"	id="Half" value="Half" onclick="calc();"	style="width: 25px;" /><label for="Half">$360 Half Page</label><br />
							<input type="radio" name="sublevel" id="Quarter"
							value="Quarter" onclick="calc();" style="width: 25px;" /><label
							for="Quarter">$250 Quarter Page</label><br />
                            
                              <input type="radio" name="sublevel" id="Eighth" value="Eighth"
							onclick="calc();" style="width: 25px;" /><label for="Eighth">$150 Eighth Page </label><br /> 
								  <input type="radio" name="sublevel" id="Greeting" value="Greeting"
							onclick="calc();" style="width: 25px;" /><label for="Greeting">$100 Greeting</label><br /> 
 <input type="radio" name="sublevel"
							id="eventonly4" value="none" onclick="calc();"
							style="width: 25px;" /> <label for="eventonly4">None</label>
                         
							</div>
<p style="clear:both;"></p>
							<h3>Event Only</h3>
							 <input type="radio" name="sublevel"
							id="eventonly1" value="DinnerOnly" onclick="calc();"
							style="width: 25px;" /> <label for="eventonly1">Dinner Reservation for 2 - $1,100</label><br /> <input type="radio" name="sublevel"
							id="eventonly2" value="DinnerOnlyUnder40" onclick="calc();"
							style="width: 25px;" /> <label for="eventonly2">Dinner Reservation for 2 (under 40) - $500</label><br />
							
							<div style="clear:both;padding-top:5px">
							<p>**Includes dinner for two<br>
*Includes Young Leadership dinner for two (under 40)</p></div>

						</td>
						 
					</tr>

				</table>

			</div>
			</div>
    
    <div id="levelfourinfo" style="display:none">
				<table style="width:415px;">
					<tr>
						<td style="vertical-align:top;">
							<h1>Donation </h1> 
                            <label for="eventonly2">Additional Donation Amount: </label>
                            <input type="text" id="donationamt" name="donationamt" onclick="calc();"  /> 
						</td>
						 
					</tr>

				</table>



			</div>
	<?
echo '<table style="width:500px" width="500px" id="info">';
echo '<tr style="vertical-align: text-top;">';
 
echo '<td style="vertical-align: text-top;">';
echo '<label for="adultnames">Ad Text: </label>';
 
echo '<textarea name="adtext" id="adtext" style="width:250px;height:150px;" value = "'.$row['adtext'] .' " >'.$row['adtext'] .'</textarea>';
 

echo '</td>';
    echo '<td style="vertical-align: text-top;">';
echo '<label for="adultnames">Comments: </label>';
 
echo '<textarea name="comments" id="comments" style="width:250px;height:150px;" value = "'.$row['adcomment'] .' " >'.$row['adcomment'] .'</textarea>';
 

echo '</td>';
echo '</tr>';
echo '</table> <BR/>	';
    
    
    

				$result1 = $mysqli->query("SELECT * FROM eventperson WHERE tnxid = ". $row['webid']);
                
                $idxper = 1;
				while ($row1=mysqli_fetch_array($result1))
				{
                    if($idxper == 1)
                    {
                         $Firstname1 = $row1['firstname'];
                          $Lastname1 = $row1['lastname'];
                         $sal1 = $row1['title'];
                    }
					 elseif($idxper == 2)
                    {
                         $Firstname2 = $row1['firstname'];
                          $Lastname2 = $row1['lastname'];
                         $sal2 = $row1['title'];
                    }
                    
                    $idxper++;
				}
					
					
				echo ' <hr>';
			    echo '<h2 id="txtEnterName">Please complete the names of the individuals attending the event</h2>';
		        echo '	<table>';
			    echo '	<tr id="person1">';
			    echo '	<td>1.';
				echo '	</td>';
							echo '<td> <input type="text" id="sal1" ';
				echo '		name="sal1" value="'. $sal1 .'" />';
					
				 
				echo '	</td>';
				echo '	<td>First Name: <input type="text" id="firstname1" ';
				echo '		name="firstname1" value="'. $Firstname1 .'" />';
					
				echo '	<td>';
					
				echo '	<td>Last Name: <input type="text" id="lastname1" name="lastname1"   value="'. $Lastname1 .'" />';
					
				echo '	<td>';
				
			echo '	</tr>';
				
                echo '	<tr id="person2">';
			    echo '	<td>2.';
				echo '	</td>';
							echo '<td> <input type="text" id="sal2" ';
				echo '		name="sal2" value="'. $sal2 .'" />';
					
				 
				echo '	</td>';
				echo '	<td>First Name: <input type="text" id="firstname2" ';
				echo '		name="firstname2" value="'. $Firstname2 .'" />';
					
				echo '	<td>';
					
				echo '	<td>Last Name: <input type="text" id="lastname2" name="lastname2"   value="'. $Lastname2 .'" />';
					
				echo '	<td>';
				
			echo '	</tr>';
    
				echo '</table>';


			echo '	<hr>';
    
    
echo '			   <label for="totaldue">Total Amount Due: $ </label>  <input';
echo '				type="text" style="width: 90px" id="totaldue" name="totaldue" required="required" value="'. $row['amtpayed'] .'"';
echo '				  />';
echo '			<br /><label for="nokids">Payment Method: </label> ';?>
		<select		name="payment" id="payment" required style="width: 125px"
			onchange="showCredit(this)">
<option value=" ">Select to change</option>

<option value="Credit">Credit Card</option>
				<option value="Later">Pay Later</option>
				<option value="Cash">Cash</option>
				<option value="Check">Check</option>
				 
				<option value="NOCHARGE">No Charge</option>
				<option value="ALREADYPAID">Already Paid</option></select>

	<?			
echo '		 <input type="hidden"  id="nc" name="nc"  />';
echo '			<div id="ccinfo" style="display:none">';
echo '			<br />';
echo '			<label for="ccnum">Credit Card #</label>';
		
echo '			<input type="text"';
echo '				id="ccnum" name="ccnum" />';
echo '				<br />';
echo '			<label for="ccmonth">Exp Date:</label>';
		
echo '			<select name="ccmonth" id="ccmonth" style="width: 70px" >';
echo '				<option value="" selected></option>';?>
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
                    <?
echo '			</select>';
echo '			<select name="ccyear" id="ccyear" style="width: 80px">';
?>
					<option value="" selected></option>
 <?
 $currenYear = date("Y");
 $yearGetTo = date("Y") + 10;
  for ($i =$currenYear ; $i <=$yearGetTo  ; $i++) {
    echo '<option value="'. substr($i, -2)    .'">'. $i .'</option>';
}
				

echo '			</select>';
echo '		<br />';
?>
 <div class="required">
			<label for="cvv">3 Digit Security Code: </label>
		
			<input type="text"
				id="cvv" name="cvv" />
				<br />
                      </div>
                
<?
echo '			</div>';
echo '				</fieldset>   ';
}      
echo '	   <input type="hidden" name="eventid" id="eventid" value="'.  $_GET['eventid'] .'"></input>';
	   
	   ?>
  <input type="hidden" id="changedby" name="changedby" value=""  />

<br/> <label for "checkingin">At event only: Checking In</label>
                <input name="checkingin" type="checkbox" id="checkingin" value="1"><br>
	
	<input type="hidden" name="formmode" value="adminxx"/> 
    <input type="hidden" name="pagename" id="pagename" value="edit" />
	<input type="hidden" id="formmode" name="formmode" value="adminxx" />
	 <input
			type="submit" value="Save Data"></input>
	</form>


</body>
</html>
