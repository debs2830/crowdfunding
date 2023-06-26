<?php
$eventnum = 8;
?>

<style>

input{
width:100%;
	
	}

hr {
	margin:0;}</style>
    <? if ( $_GET['mode'] == "adminxx" ) {?>
    <p><a href="menu.php">Back to Menu</a> - <a href="/events/listEvent.php?eventid=<?php echo $eventnum;?>" target="_blank">List</a> - <a href="/events/listCheckin.php?eventid=<?php echo $eventnum;?>" target="_blank">Check in</a></p><? }?>
	<form action="/events/insertGeneral.php" method="post" id="form1"
		><input type="hidden" name="noadults" id="noadults" value="1">
		<table>
			<tr style="vertical-align: text-bottom;">

				<td style="vertical-align: text-bottom;">
					
				</td>
			</tr>
			<tr>
				<td style="vertical-align: text-bottom;">
            
		<h3>Beth Jacob Performance</h3>
				</td>
		
		</table>

	
		<table width="100%"><tr><td colspan="2"><label for="firstname">First Name</label>: <br /> <input type="text"
				id="firstname" name="firstname" autofocus
				required="required" title="Your first name is required." value="" /></td>
		
	    <td> <label
				for="lastname">Last Name</label>:<br /> <input type="text"
				id="lastname" name="lastname" required value=""
				  /></td></tr><tr><td colspan="3">
			  <label for="address">Address</label>:
			<input type="text" id="address" name="address"  <? if ( $_GET['mode'] != "adminxx" ) {?>required<? } ?> value="" />
	  </td></tr>
				<tr>
					<td><label for="city">City</label></td>
					<td><label for="state">State</label></td>
					<td><label for="zip">Zip</label></td>
				</tr>
				<tr>
					<td><input type="text" id="city" name="city" <? if ( $_GET['mode'] != "adminxx" ) {?>required<? } ?>  value=""/>
					</td>
					<td><select name="state" <? if ( $_GET['mode'] != "adminxx" ) {?>required<? } ?> style="width: 90px">

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
					<td><input type="text" id="zip" name="zip" <? if ( $_GET['mode'] != "adminxx" ) {?>required<? } ?> value="" /></td>
				</tr>
			<tr><td colspan="3">
			<label for="phone">Phone Number</label>: <br /> <input type="tel"
				id="phone" name="phone" <? if ( $_GET['mode'] != "adminxx" ) {?>required<? } ?> value=""/></td>
				</tr>
	 <tr><td colspan="3"><label
				for="email">Email Address</label>: <br /> <input type="email"
				id="email" name="email" <? if ( $_GET['mode'] != "adminxx" ) {?>required<? } ?>  value=""/><? if ( $_GET['mode'] == "adminxx" ) {?> <input id="search" type="hidden" style="padding:2px;font-size:.6em;width:300px;" /><div style="margin:20px 0 0 0;"> <span id="results" style="color:#68a;"></span> <? } ?>
		<br><input name="allowemail" type="checkbox" style="width:5%;" value="1" checked="checked"/>I would like to receive Beth Jacob emails
			</td></tr></table>
	<hr>
			
<div class='row' >
	
			
				<div id="leveltwoinfo" style="width:100%">
					<h3>Reservations and Dedications</h3>
				<table style="width:100%; ">
					<tr>
						<td style="vertical-align:top;">
					
<div  style="width:50%;float:left;">
	 <input type="radio" name="sublevel"
							id="eventonly" value="Couvert only" onclick="calc();"
							style="width: 25px;" /> <label for="eventonly2">$75 Couvert Only</label>
	<br>
 <input type="radio" name="sublevel" id="diamond" value="Diamond"
							onclick="calc();" style="width: 25px;" /> <label for="diamond">$250
								Diamond Sponsor*</label><br /> 
<input type="radio"	name="sublevel" id="gold" value="Gold" onclick="calc();" style="width: 25px;" />
						<label for="GoldS">$180 Gold Sponsor* </label><br />
	
	<input type="radio"	name="sublevel" id="silver" value="Silver " onclick="calc();" style="width: 25px;" />
						<label for="SilverS">$136 Silver Sponsor*</label><br />
							
						<br>
                              <input type="radio" name="sublevel" id="ad" value="Ad only"
							onclick="calc();" style="width: 25px;" /><label for="Eighth">$50 Ad in Playbill</label><br /> 
								  <input type="radio" name="sublevel" id="greeting" value="Greeting"
							onclick="calc();" style="width: 25px;" /><label for="Greeting">$25 Listing in the Playbill</label><br /> 

                         
						
							
							<div style="clear:both;padding-top:5px">
							<p>*Includes an ad in playbill</p></div>
							</div>
						</td>
						 
					</tr>

				</table>

			</div>
	  </div> <!-- close row-->
			

			
			<div  style="clear:both;">
						<label for="eventonly2">Additional Donation Amount:  </label>

              <input type="number" id="donationamt" name="donationamt" onChange="calc();" min="0" value="" style="width:50%;" /> 
              <div id="info"style="display:none;">
							<h4>Ad Text</h4> <textarea name="adtext"   id="adtext1"
								style="width:90%;height:100px;"></textarea>
</div>
							
	  </div>	
                        
                      
		
	  <hr>
			<div id="reservenames" style="display: none;">
			<h4 id="txtEnterName">Please enter the names of the individuals attending the event</h4>
			<table>
				<tr><td></td><td></td><td>First Name</td><td>Last Name</td></tr>
				<tr id="person1">
				<td>1.
				  </td>
							<td>
					
					<select name="sal1" style="width: 90px"  >
						<option value="" selected></option>
						<option value="Rabbi">Rabbi</option>
						<option value="Dr.">Dr.</option>
						<option value="Mr.">Mr.</option>
						<option value="Mrs.">Mrs.</option>
						<option value="Ms.">Ms.</option>
					</select>
					</td>
					<td><input type="text" id="firstname1" 
						name="firstname1" />
					
					<td>
					
					<td><input type="text" id="lastname1" name="lastname1"   />
					
					<td>
				
				</tr>
				<tr id="person2">
					<td>2.
					
					
					
					</td>
							<td>
					
					<select name="sal2" style="width: 90px">
						<option value="" selected></option>
						<option value="Rabbi">Rabbi</option>
						<option value="Dr.">Dr.</option>
						<option value="Mr.">Mr.</option>
						<option value="Mrs.">Mrs.</option>
						<option value="Ms.">Ms.</option>
					</select>
					</td>
					<td><input type="text" id="firstname2"
						name="firstname2" />
					
					<td>
					
					<td><input type="text" id="lastname2" name="lastname2" />
					
					<td>
				
				</tr>
				
			</table>
</div>

	  <hr>
      <h4>Comments</h4> <textarea name="comments" rows="2"
								id="comments" style="width:100%;height:50px;"> </textarea><br><br>


			<label for="totaldue">Total Amount Due: $ </label> <input type="text"
				style="width: 90px" id="totaldue" name="totaldue"
				 required="required"  value="" <? if ( $_GET['mode'] != "adminxx" ) {
					echo 'readonly';
				}
				 ?> /> <br /> 
<? if ( $_GET['mode'] == "adminxx" ) {?>
<br/><label for="enteredby">Data Entered By </label>  

<input	type="text" style="width: 90px" id="enteredby" name="enteredby" required value="<? echo $_SESSION['post_data']['enteredby'] ?>"  />
<? } else {?>
<input	type="hidden" style="width: 90px" id="enteredby" name="enteredby" value="user"   />

<? }?>
<br>

<label
				for="payment">Payment Method: </label> <select name="payment"
				id="payment" 
				onchange="showCredit(this)">
				<option value="<? echo $_SESSION['post_data']['payment'] ?>"  selected>-select-</option>
				<option value="Credit">Credit Card</option>
				<option value="Later">Pay at the Door</option>
<? if ( $_GET['mode'] == "adminxx" ) {?>
				<option value="Cash">Cash</option>
				<option value="Check">Check</option>
				 
				<option value="NOCHARGE">No Charge</option>
				<option value="ALREADYPAID">Already Paid</option>
				<? }?>
			</select> 
            <? if ( $_GET['mode'] == "adminxx" ) {?>

<label for="nc">Initials for N/C </label>  <input
				type="text" style="width: 90px" id="nc" name="nc"  /> 



		 
			<br />
            <? }?>
		<div id="errmsg" style="display: none;color:red; font-size:1.2em;">There was a problem with your credit card. Please check the numbers and try again.</div>
			<div id="ccinfo" style="display:none">
				<div>
				 <label for="ccnum">Credit Card #</label> <input
					type="text" id="ccnum" name="ccnum"  value="" /> 
					</div>
					<br /> <label for="ccmonth">Exp
					Date:</label> <select name="ccmonth" id="ccmonth"
					style="width: 70px">
					<option value="<? echo $_SESSION['post_data']['ccmonth'] ?>"  selected></option>
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
					<option value="<? echo $_SESSION['post_data']['ccyear'] ?>"  selected></option>
 <?
 $currenYear = date("Y");
 $yearGetTo = date("Y") + 10;
  for ($i =$currenYear ; $i <=$yearGetTo  ; $i++) {
    echo '<option value="'. substr($i, -2)    .'">'. $i .'</option>';
}
?>
					

			  </select> 
                <div class="required">
			<label for="cvv">3 Digit Security Code: </label>
		
			<input type="text"
				id="cvv" name="cvv"  value="" style="width: 25%;" />
				<br />
              </div>
                
			</div> <? if ( $_GET['mode'] == "adminxx" ) {?><br />
                <label for "checkingin">At event only: Checking In</label>
                <input name="checkingin" type="checkbox" id="checkingin" value="1"><br>
                <br /><? } ?>
	<?php  if (isset($_GET['mode']) ) { $mode = $_GET['mode'];}
		if (isset($wordpress)) { $mode ='wordpress' ; } ?> 
	<input type="hidden" id="formmode" name="formmode" value="<? echo $mode;?>" />
    	<input type="hidden" name="tnxid" id="tnxid"></input>
<input  type="hidden" name="eventid" id="eventid" value="<?php echo $eventnum;?>"></input>
            <input type="hidden" name="description" value="Luncheon" />
            <input  type="button" value="Register for Event" style="margin-top:10px; width:50%; display: block;margin-bottom:10px;" id="btnsubmit"></input>
<input type="hidden" name="authcode"  id="authcode"> 
<input name="askad" type="hidden" value="0" id='askad'>
	</form>
  <script src="/events/js/luncheon.js"></script>
