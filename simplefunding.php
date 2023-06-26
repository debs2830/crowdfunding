<?php
 require_once("connection.php"); 		

$sql = "SELECT * FROM crowdfundingTeams  WHERE eventid = 17 ORDER BY nickname";

$result = mysqli_query($con,$sql);
  $teamcount=mysqli_num_rows($result);
	$teamlisting;
$liteamlisting ;

                  	while ($row = mysqli_fetch_array($result)) {
			$teamlisting .='<option';
						$liteamlisting .= "<li><a href='crowdfunding.php?name=" . $row['nickname']. "'>Team " . $row['realname'] . "</a>";
			if (isset($_GET['name']) && strtolower($_GET['name']) == strtolower($row['nickname'] ) ) { 
			$teamlisting .=' selected ';
				$teamid = $row['ID'];
				$teamrealname = $row['realname'];
				$teamgoal = $row['donationamount'];
			}
			$teamlisting .= ' value="'.$row['ID']. '">'. $row['realname'] .'</option>';
							$liteamlisting .= "</li>";
					}


?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Crowd Funding</title>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <link  rel="stylesheet"href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
   <link rel="stylesheet" href="/registration/css/normalize.min.css">
<link rel="stylesheet" href="/registration/css/main.css">
<link rel="stylesheet" href="/registration/css/charidy.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

</head>

<body class='container'>
	<div   class="topbar ">
		<img src="http://denverkollel.org/wp-content/uploads/2015/04/350logob.png">
		<h1>Quadruple Your Giving Campaign</h1>
</div>
	<div><p>This form is only for orders taken offline<br>
To charge a credit card, please use the main form <a href="crowdfunding.php">here</a></p>
	</div>
	<form action="/events/insertGeneral.php" method="post" id="form" name="form"   autocomplete="off" style="width: 100%">			
			  <div class="copysponsorinfo donatebox" ><label for="totaldue">Donation Amount:  </label>  <input
				type="number" style="width: 90px" id="totaldue" name="totaldue"  class="totaldue"  required	 /> </div>
		<input type = "hidden" name = "childnames" id = "childnames" value=""> </input>
				<input type = "hidden" name = "nokids" id = "nokids" value="0"> </input>

    <div id="ccinfo" >
		<div class="form-group">
			
			  <label for="firstname">First Name:</label>
			<input class="form-control" type="text"
				id="firstname" name="firstname" autofocus
				 title="Your first name is ." value="" /> 
		</div>
		<div class="form-group">
			<label for="lastname">Last Name:</label>
		<input type="text"
				id="lastname" name="lastname" class="form-control"  value=""/>
		
		</div>
	<div class="form-group">
			<label for="lastname" style="z-index: 1000">Other Name or Anonymous :</label>
		<input type="text"
				id="adultnames" name="adultnames" class="form-control"  value=""/>
		
		</div>
		

				<div class="form-group">
					<label
				for="email">Email Address:(if you want them to get a thank you email)</label>  <input type="email"
				id="email" name="email"     class="form-control"  /> 
					
		</div>
				<div class="form-group">
		
		<label for="nokids">Payment Method: </label> 
				<select 	name="payment" id="payment" class="form-control">
				<option value="" selected>-:Payment:-</option>
				
				<option value="Later">Pay Later</option>
						<option value="Paid">Paid by CC</option>
				<option value="Check">Check</option>
					<option value="Cash">Cash</option>
		
				
		  </select> </div>
		  			
		
		<div class="form-group">
			
			    
						<label>Select a Team</label>	
		
		<select class="form-control" name="team" id="team">
			<option value=""></option>
		<?php echo $teamlisting ;?>
                   
			</select>
		</div>
		
		
		  			<div class="form-group">
						<label>Message or Dedication (75 characters maximum): </label>	<input type="text" name="notes"   id="notes"   value="" maxlength="75" class="form-control"/></div>
	<div id="errormsg" style="margin-bottom:5px;font-size:16px;"></div>
			<div class="form-group">
				<button type="submit"  id="submitbtn" class=" btn btn-primary "> DONATE NOW</button>
			<input type="hidden" name='noadults' value='1'>
		    <input type="hidden" name="tnxid" id="tnxid"></input>
	   <input type="hidden" name="eventid" id="eventid" value="17"></input>
	     	   <input type="hidden" name="description" id="description" value="BJHS Crowdfunding Campaign">
	  
	</div>


		<input type="hidden" name="formmode" value="adminxx"/>
	
			</div>
		
      </div>
</form>
</body>
</html>