<?php
//for 2021, change that insert code happens on charge card page to avoid missing donations. 
//use code to change amount on thermometer
session_start();
// store session data
$_SESSION['id']=0;
$id= 10;
//searhc for and replace with new number
//$_POST['eventid']== 9
$initialgoal = 200000;
$secondgoal = 250000;
 require_once("connection.php"); 		

$sql = "SELECT * FROM crowdfundingTeams  WHERE eventid = $id  order by realname ";

$result = mysqli_query($con,$sql);
  $teamcount=mysqli_num_rows($result);
	$teamlisting;
$liteamlisting ;
$thermometer=[];
$thermometerTotal=[];
$thermometerGoal=[];
$thermometerLink=[];

                  	while ($row = mysqli_fetch_array($result)) {
			$teamlisting .='<option';
						//$liteamlisting .= "<li><a href='crowdfunding.php?name=" . $row['nickname']. "'>Team " . $row['realname'] . "</a>";
			//thermometer
						$thermometerTotal[$row['ID']]=0;
						$thermometerLink[$row['ID']]="<a href='/crowdfunding/". $row['nickname']. "'>Team " . $row['realname'] . "</a>";
					/*	$liteamlisting .= '<div style="width:95%;clear:both" >
			    <div id="thermoTeam_'.$row['ID'].'" class="thermometer horizontal" align="center">

        <div class="track">
            <div class="goal">
                <div class="amount"> </div>
            </div> <div class="progressthermo">
                <div class="amount"></div>
            </div>        </div>    </div></div>';*/
						
$thermometerGoal[$row['ID'] ] =$row['donationamount'] ;
$thermometer[$row['ID'] ] ='thermometer("thermoTeam_'.$row['ID'].'", '.$row['donationamount'] ;
			if (isset($_GET['name']) && strtolower($_GET['name']) == strtolower($row['nickname'] ) ) { 
			$teamlisting .=' selected ';
				$teamid = $row['ID'];
				$teamrealname = $row['realname'];
				$teamgoal = $row['donationamount'];
			}
			$teamlisting .= ' value="'.$row['ID']. '">Team '. $row['realname'] .'</option>';
							$liteamlisting .= "</li>";
					}


?>
<?php 
$pos = strrpos($_SERVER[REQUEST_URI], "/events/");

if ($pos === false)  {
	$fromwordpress = 1;
}else{ // note: three equal signs 
$fromwordpress = 0;?>
<!DOCTYPE html><head>

<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
<meta content="utf-8" http-equiv="encoding" />
<meta name="description"
	content="BJHS - Quadruple Your Donation Campaign" />

<title>Quadruple Your Donation Campaign</title>


<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<link rel="shortcut icon" href="https://www.bjhs.org/wp-content/uploads/2018/08/logo-small-transparent.png" />

<meta name="description" content="">
<meta name="viewport" content="width=device-width">
	<meta name="og:image" content="https://bjhs.org/events/img/crowdfunding.jpg" >
	<meta name="og:title" content="BJHS - Quadruple Your Donation Campaign" >
	<meta name="og:description" content="Every dollar donated to the Beth Jacob for the next 30 hours – until 6 pm on Wednesday - will be quadrupled by generous matchers. " >
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <link  rel="stylesheet"href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
   <link rel="stylesheet" href="/events/css/normalize.min.css">
<link rel="stylesheet" href="/events/css/main.css">
<link rel="stylesheet" href="/events/css/charidy.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
   <?php } ?> 




<div class="topimage container-fluid">
	<img src="img/crowdfunding.jpg" alt="" width="100%" height="auto">


	</div>

	<div class="container">
		<div class="row">
			
			<div class="col-sm-12 headline">
			<h1>PARTNER WITH BETH JACOB HIGH SCHOOL OF DENVER FOR
	<br>
<span class="headline-big">THE PROMISE OF A JEWISH FUTURE</span>
</h1>
		<h3>Every contribution makes a difference. 
<!--			Every person makes a difference. -->
			You make a difference!</h3>
				</div>
			
			
			<div id="firstcolumn"  class="col-md-4 col-sm-12 col-md-push-8">

<!--<div class="" style="margin-top:20px">
		<div id="countdowndiv" style="">
			Time Left to Donate: <br>
<span id="countdown"></span></div>

	<div class="bonusmessage" style="display:none;">
 <br>
NEW GOAL: $200,000
	
	</div>
<div class="bonusmessage2" style="display:none;">
<!-- BONUS ROUND NOW IN SESSION:<br>-->
<!--GOAL: $250,000
	
	</div>
U
	</div>-->
		
		
<div id="content " >	
	<div class="donatebox timer col-xs-12" >
		 <link rel="stylesheet" href="/events/clock/inc/TimeCircles.css" />
            <div id="DateCountdown" data-date="2021-05-05 18:00:00" style=" padding: 0px; box-sizing: border-box; background-color: #E0E8EF"></div>
		
<div id="totalprogress"></div>
		<div class="goaltotal">Goal: $<?php   echo  number_format($initialgoal, 0);;?> </div>
	<div style="width:90%;clear:both" >
    <div id="thermo1" class="thermometer horizontal" align="center">

        <div class="track">
            <div class="goal">
                <div class="amount">  </div>
            </div> <div class="progressthermo">
                <div class="amount"></div>
            </div>
           
        </div>

    </div>

</div>

      
	</div>
	
	<div class="col-xs-12 donatebox donors" style="
    text-align: left;
"><?php  include('doubledonationscript.php'); ?> 
		
	
     
<?php if (isset($teamid)) { 
	$query1 = "SELECT SUM(amtpayed) as totalsum FROM eventsignup WHERE eventid = $id   and adtext = '$teamid'"; 
	$query = "SELECT COUNT(*) as totalcount FROM eventsignup  WHERE eventid =$id and adtext = '$teamid'"; 
	
				
$resultsum = mysqli_query($con, $query1) ;
$resultcount = mysqli_query($con, $query); 
	
	
	while($row = mysqli_fetch_array($resultsum)){
	//$totalsum=   money_format('$%i', $row['totalsum']); 
	$totalsum=    number_format($row['totalsum'], 0);
	$totalsumInt=  $row['totalsum']; 
		if (empty($totalsumInt))  {
			$totalsumInt =0;
		}

    
}
	while($row = mysqli_fetch_array($resultcount)){

	$totalcount =  $row['totalcount'];
	
  
}
?>
	<div id="teamamount">
		
	<div class="teamname">
		<!--<div class="col-md-4 hidden-xs"><img src="https://www.bjhs.org/wp-content/uploads/2018/08/logo-small-transparent.png" alt="" class="img-circle"></div>-->
		<p class="col-sm-12">Team <?php echo $teamrealname;?></p></div>
		
		<div style="width:90%;clear:both" >
			<input id="teamlastnum" type="hidden" value="1"/>
    <div id="thermoTeam" class="thermometer horizontal" align="center">

        <div class="track">
            <div class="goal">
                <div class="amount">  </div>
            </div> <div class="progressthermo">
                <div class="amount"></div>
            </div>
           
        </div>

    </div>

</div>
		
		<div class="teamsum"><span id="totalprogress" class="totalamountteam"></span>  of <?php echo "$". number_format( $teamgoal, 0);?> raised</div>
		

		<h3 class="teamdonors"><span id="teamtotaldonor"><?php echo 	$totalcount;?></span> Donors</h3>
		<div class="teamgoal hidden"><?php echo $teamgoal;?></div>
		<div class="close-team"><p class="text-center">VIEW ALL</p></div>
			</div>
<?php } else   { ?>
		<h3><?php echo $result->num_rows;?> Donors</h3>
		<?php }?>

                   <?php  
		 if ($result->num_rows > 0) {
			
    // output data of each row
			 $totalamount = 0 ;
			 $amttotimesby= 4;
			 echo '<ul class="" id="donationsul2" style="overflow-y:scroll;height:600px;">';
			 $outputli;
		
    while($row = $result->fetch_assoc()) {
	
		$output ='' ;
		//if ($totalamount == 0 ) {
			$lastinput= '<input id="lastnum" type="hidden" value="' . $row["tnxid"] .'"/>';
			
		//}
		if ($totalamount > $secondgoal ) { 
			 $amttotimesby= 1;
		}
		$totalamount += $row['amtpayed']* $amttotimesby;
		$thermometerTotal[$row['ID']] += $row['amtpayed']* $amttotimesby;
	
        $output.= "<li data-nickname='" . $row["nickname"]."' ";
		if (isset($teamid) && $row["ID"] !=$teamid) { 
		$output.= " class='hidden' ";
		}
			$output.= ">". $row["firstname"].' ' .$row["lastname"]. " <span class='rtamt' style='font-weight:bold;'>  $" . ($row["amtpayed"]* $amttotimesby). "</span><small >";
		if ( $row["adcomment"]) {
			$output.= "<br>" .$row["adcomment"] . "";
		}
		if ( $row["realname"]) {
			$output.= "<br>Team " .$row["realname"] ;
		}
		$output.= "</small>"."</li>";
	 $outputli = $output .  $outputli;

    }
			 echo $outputli;
			 echo $lastinput;
			  echo '</ul>';
} else {
    echo 'Please wait until our campaign starts';
}
	//$totalamount = $totalamount * $amttotimesby;
		// echo '<br>Total Amount Donated: ' . $totalamount;
	echo '<input id="totalamount" type="hidden" value="' . $totalamount .'"/>';
					?>   


			
	</div>
	</div>
</div>		
			
			<div id="" class="col-md-8 col-xs-12 col-md-pull-4">
	<div align="center">
	</div>

<div class="innertext">
		<div class="sponsorinfo " >
	      <div class="donatebox donateboxtop" style="">
			  <div class="col-md-12 divdouble"><label style="font-size:1.1em;">Every dollar donated is <span class="bonusmessage" style="display: none">STILL </span>  <span id="wordsduplicated">quadrupled</span>!</label><br></div>
			  <div class="outsideboxes">
				
				  <div class="col-sm-4 col-xs-12 insideboxes"><div class="panel panel-default donate-sponsor" data-type="sponsorship" data-totalamt="120">
					  <div class="col-xs-4 sponsor-image"><img src="/events/img/logo-160x228.gif" alt="Beth Jacob High School of Denver" /></div>
					  <div class="col-xs-8 sponsor-text"><div class="panel-heading">Supporter </div>
					   <div class="panel-footer"><span class="sponsorship">$120</span><br>
OR $10 x 12 </div>
					  </div>
  
  
 
</div></div>
 <div class="col-sm-4 col-xs-12 insideboxes"><div class="panel panel-default donate-sponsor" data-type="sponsorship" data-totalamt="216">
					  <div class="col-xs-4 sponsor-image"><img src="/events/img/logo-160x228.gif" alt="Beth Jacob High School of Denver" /></div>
					  <div class="col-xs-8 sponsor-text"><div class="panel-heading">Sponsor </div>
					   <div class="panel-footer"><span class="sponsorship">$216</span><br>
OR $18 x 12 </div>
					  </div>
  
  
 
</div></div>
 <div class="col-sm-4 col-xs-12 insideboxes"><div class="panel panel-default donate-sponsor" data-type="sponsorship" data-totalamt="360">
					  <div class="col-xs-4 sponsor-image"><img src="/events/img/logo-160x228.gif" alt="Beth Jacob High School of Denver" /></div>
					  <div class="col-xs-8 sponsor-text"><div class="panel-heading">Patron </div>
					   <div class="panel-footer"><span class="sponsorship">$360</span><br>
OR $30 x 12 </div>
					  </div>
  
  
 
</div></div>
 <div class="col-sm-4 col-xs-12 insideboxes"><div class="panel panel-default donate-sponsor" data-type="sponsorship" data-totalamt="720">
					  <div class="col-xs-4 sponsor-image"><img src="/events/img/logo-160x228.gif" alt="Beth Jacob High School of Denver" /></div>
					  <div class="col-xs-8 sponsor-text"><div class="panel-heading">Benefactor </div>
					   <div class="panel-footer"><span class="sponsorship">$720</span><br>
OR $60 x 12 </div>
					  </div>
  
  
 
</div></div>
 <div class="col-sm-4 col-xs-12 insideboxes"><div class="panel panel-default donate-sponsor" data-type="sponsorship" data-totalamt="1200">
					  <div class="col-xs-4 sponsor-image"><img src="/events/img/logo-160x228.gif" alt="Beth Jacob High School of Denver" /></div>
					  <div class="col-xs-8 sponsor-text"><div class="panel-heading">Silver </div>
					   <div class="panel-footer"><span class="sponsorship">$1200</span><br>
OR $100 x 12 </div>
					  </div>
  
  
 
</div></div>
				  <div class="col-sm-4 col-xs-12 insideboxes"><div class="panel panel-default donate-sponsor" data-type="sponsorship" data-totalamt="1800">
					  <div class="col-xs-4 sponsor-image"><img src="/events/img/logo-160x228.gif" alt="Beth Jacob High School of Denver" /></div>
					  <div class="col-xs-8 sponsor-text"><div class="panel-heading">Supporter </div>
					   <div class="panel-footer"><span class="sponsorship">$1800</span><br>
OR $150 x 12 </div>
					  </div>
  
  
 
</div></div>
				
			  
			  </div>
			  <div class="row">
				  	 <div class="col-md-12">
			  <div class="col-md-12">OR</div>
			  <label for="totaldue">Donation Amount:  </label> 
			  <input
				type="number" style="width: 90px" id="totaldue" name="totaldue"  class="totaldue" 	 /> x <div id="amtduplicated" style="display: inline">4</div> <span class="newtotal"></span>
				   <div class="row" style="margin-top:20px;">
    <div class="col-md-8 col-md-offset-2" >
			<button id="donatebtn" class="btn btn-primary btn-lg" data-type='cc' ><i class="fa fa-credit-card"></i> DONATE </button>
			   
			</div>
<!--					   <div class=" col-md-4 " ><button id="donatebtnpaypal" class="btn btn-primary btn-lg" >DONATE VIA PAYPAL</button> </div>-->
					   
					   </div>
					   </div>
			
			  </div>
		
			  <div align="center" style="text-size:.8em; padding-top:20px;">

Beth Jacob High School is registered as a 501(c)3 organization and donations / contributions are tax-deductible to the extent of the law.
</div>
			</div>
				
		
				
			</div>
	<div class="row">
		<div class="donateboxover col-md-12 text-center" style="display: none;"><button class="btn btn-primary btn-lg" type="button"  style="margin-bottom: 10px;" data-target="#formModal" data-toggle="modal">YOU CAN STILL DONATE HERE</button> 
				
</div>
		</div>
		<!--end sponsor box				 -->
		
	
	<div class="panel-group donatebox about">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse1">About Campaign <i class="fas fa-chevron-down"></i></a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
      <div class="panel-body">Now more than ever is the time to invest in a Bais Yaakov Denver education and experience.<br>
<br>

The resilience it engenders to survive and thrive in a Covid19 era is a testimony to the Torah’s transformative powers.<br><br>



Since 1968, Beth Jacob High School of Denver has offered a program of excellence in Jewish and general studies, and an indelible experience that empowers young women to encounter their future.<br><br>


Bais Yaakov graduates emerge as proud, confident women, builders of Jewish families and communities.<br><br>


 
Please partner with Bais Yaakov of Denver TODAY. Your donation will ensure the promise of a Jewish future TOMORROW
<br>
<br>


<strong>Quadruple your Gift:</strong><br>
Your donation goes three times farther with this Crowdfunding Campaign. For every $1 you donate, our matching donors will give an additional $3.<br><br>

$18 becomes $72!<br>
$100 becomes $400!<br>
$180 becomes $720!<br>
$1,000 becomes $4,000!<br>
$1,800 becomes $7,200!<br><br>

30 hours<br><br>

<strong>THANK YOU!</strong></div>
    </div>
  </div>
</div>


<div class="donatebox teams">
            <div class="">
                <div class="row">
                    <div class="col-md-12 ">
                       
						<h3><?php echo   $teamcount;?> Teams</h3>
							<!--  <div id="matchers" class="tab-pane fade in ">
								  <div  class="" >
<h3 class="">Thank you to our generous Matchers: </h3>
		<p class="col-md-12">Ron & Sandy Schiff<br>
Foundation<br>
Rabbi Zev & Adina Beren<br>
Jeff & Sheva Weiskopf<br>
Anonymous<br>
Bryan & Dr. Susan Schiff<br>
          Jerry Rubin<br>
			Anonymous<br>
</div>
							</div>  
							-->
							
  
    


  <div id="teams">
    

	  <ul id="donationsul">
	  <?php
		  echo 	$liteamlisting;
		 // 
		  arsort($thermometerTotal);
		  foreach ($thermometerTotal as $key => $value) {
		   if ($thermometerGoal[$key] !='')  {
			  echo '<li class="col-xs-12 col-sm-6"><span class="col-xs-12 teambox">';
			  echo $thermometerLink[$key];
			  
			echo  '<div style="width:95%;clear:both" class="teamthermodiv" >
			    <div id="thermoTeam_'.$key.'" class="thermometer horizontal" align="center">

        <div class="track">
            <div class="goal">
                <div class="amount"> </div>
            </div> <div class="progressthermo">
                <div class="amount"></div>
            </div>        </div>    </div></div>';
			  
			  echo '<div class="teamgoallisting"><strong>';
			      echo "$". number_format($value, 0);
			  // echo   money_format('$%i', $thermometerGoal[$key]);
			 
			   
			  echo '</strong><br>of ';
			   	
			   echo "$". number_format($thermometerGoal[$key], 0);
			
			   echo ' raised</div>';
			  
			  
			  }
			  
	}
		  
		  echo '</span></li>';
		  
		  ?>
	  </ul>
  </div>


</div>
</div>
</div>
  


				</div><!--innertext-->  

    

	<span class="teamid hidden"><?php echo $teamid;?></span>
		<!-- <div class="sponsorinfo" >
	      <div class="donatebox" style=""><label>Every dollar donated is quadrupled!</label><br><label for="totaldue">Donation Amount:  </label>  <input
				type="number" style="width: 90px" id="totaldue" name="totaldue"  class="totaldue" 	 /> x 4 <span class="newtotal"></span>
				   <div class="row" style="margin-top:20px;">
           <div class="col-md-12">
			<button id="donatebtn" class="btn btn-primary btn-lg" data-type='cc'>DONATE VIA <i class="fa fa-credit-card"></i></button>
			</div>
					 
					   </div>
			</div>
				
</div><!--end sponsor box				 -->
<!--
        <div class="row">
		<div class="donateboxover col-md-12 text-center" style="display: none;"><button class="btn btn-primary btn-lg" type="button" onclick="location.href='https://denverkollel.org/donate-page/donation-form/'" style="margin-bottom: 10px;">YOU CAN STILL DONATE HERE</button> 
				
</div>
		</div>
-->

	

</div>


</div>

</div>	
	<footer style="min-height:300px;padding-top:50px;"></footer>

<?php 
 	setlocale(LC_MONETARY, 'en_US');

?>
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5600cd5d68738481"></script> 


<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      
      <div class="modal-body">
<!--
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
-->
     
		  <form action="/events/receiptDonation.php" method="post" id="form" name="form"  novalidate autocomplete="off" style="width: 100%">			
			  <div class="copysponsorinfo donatebox" ><label for="totaldue">Donation Amount:  </label>  <input
				type="number" style="width: 90px" id="totaldue" name="totaldue"  class="totaldue" required	 /> x 4 <span></span><span id="newtotal"></span></div>
		<input type = "hidden" name = "childnames" id = "childnames" value=""> </input>
				<input type = "hidden" name = "nokids" id = "nokids" value="0"> </input>
<div class="row" style="padding-top:20px;" id="divmonthlyoptions">
		<div class="col-md-6" align="center"><button type="button" id="donatemonthly" class="btn btn-default btn-bloc btn-donate-type" value="monthly">DONATE MONTHLY</button></div>
		<div class="col-md-6" align="center"><button type="button" id="donateonce" class="btn btn-default btn-bloc btn-donate-type" value="once">PAY IN FULL</button></div>
	<input type="hidden" id="payment-spread" name="payment-spread">
		</div>
    <div id="ccinfo" >
		<div class="form-group">
			
			  <label for="firstname">First Name:</label>
			<input class="form-control" type="text"
				id="firstname" name="firstname" autofocus
				required="required" title="Your first name is required." value="<? echo $_SESSION['post_data']['firstname'] ?>" /> 
		</div>
		<div class="form-group">
			<label for="lastname">Last Name:</label>
		<input type="text"
				id="lastname" name="lastname" class="form-control" required value="<? echo $_SESSION['post_data']['lastname'] ?>"/>
		
		</div>

		<div class="form-group">
			<label for="cvv">Address: </label>
		
			<input type="text"
				id="address" name="address" class="form-control" required/>
		</div>
		   			<div class="form-group">
                  
			<label for="cvv">City: </label>
		
			<input type="text"	id="city" name="city" class="form-control"/>
				
                      </div>
		   			<div class="form-group">
                  
			<label for="state">State: </label>
		
			<input type="text"	id="state" name="state" class="form-control"/>
				
                      </div>
                          			<div class="form-group">
			<label for="cvv">Billing Zip Code: </label>
		
			<input type="text"
				id="zip" name="zip" class="form-control" required/>
				
                      </div>

		
		

				<div class="form-group">
					<label
				for="email">Phone:</label>  <input type="text"
				id="email" name="phone"  required value=""  class="form-control"  /> 
					
		</div>

				<div class="form-group">
					<label
				for="email">Email Address:</label>  <input type="email"
				id="email" name="email"  required value="<? echo $_SESSION['post_data']['email']; ?>"  class="form-control"  /> 
					
		</div>
				<div class="form-group">
			<label for="ccnum">Credit Card #</label>
		
			<input type="text"
				id="ccnum" name="ccnum"  class="form-control" required/>
		</div>
		<div class="form-group">
				<label for="ccmonth">Exp Date:</label></div>
				<div class="form-group col-md-6 col-sm-12">
	
		
			<select name="ccmonth" id="ccmonth" class="form-control"  required>
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
					</select></div>
		<div class="form-group col-md-6 col-sm-12">
			<select name="ccyear" id="ccyear" class="form-control" required>
					<option value="<? echo $_SESSION['post_data']['ccyear'] ?>" selected><? echo $_SESSION['post_data']['ccyear'] ?></option>
				 <?
 $currenYear = date("Y");
 $yearGetTo = date("Y") + 10;
  for ($i =$currenYear ; $i <=$yearGetTo  ; $i++) {
    echo '<option value="'. substr($i, -2)    .'">'. $i .'</option>';
}
?>
					

			</select>
		</div>
				<div class="form-group">
                 
			<label for="cvv">3 Digit Security Code: </label>
		
			<input type="text"
				id="cvv" name="cvv" class="form-control" required />
				
                      </div>
                
		  			
		
		  			<div class="form-group">
						<label>Message or Dedication (75 characters maximum): </label>	<input type="text" name="notes"   id="notes"   value="<? 
		
	echo $_SESSION['post_data']['notes'];?>" maxlength="75" class="form-control"/></div>
		
		<div class="form-group">
			
			    
						<label>Select a Team</label>	
		
		<select class="form-control" name="team" id="team">
			<option value=""></option>
		<?php echo $teamlisting ;?>
                   
			</select>
		</div>
		
		
		
	<div id="errormsg" style="margin-bottom:5px;font-size:16px;"></div>
			<div class="form-group">
				<button type="submit"  id="submitbtn" class=" btn btn-primary "> DONATE NOW</button>
			<input type="hidden" name='noadults' value='1'>
		    <input type="hidden" name="tnxid" id="tnxid"></input>
	   <input type="hidden" name="eventid" id="eventid" value="<?php echo $id;?>"></input>
	     	   <input type="hidden" name="description" id="description" value="CrowdFunding Campaign">
	  <input type="hidden" name="payment"  id="payment" value="Credit">
	</div>


	<?php
echo '<input type="hidden" name="fromwordpress" value="';
if ($fromwordpress == 1) {
	echo '1';
}
echo '"/> ';
	if( !isset($_GET['mode']) )
	{
		echo '<input type="hidden" name="formmode" value="consumer"/> ';
	}
	else
	{
		echo '<input type="hidden" name="formmode" value="'.$_GET['mode'].'"/>';
	}
	?>
			</div>
		
      </div>
</form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">X</button>
        
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<div class="modal-header">   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></div>
      
      <div class="modal-body">
        <video width="100%" height="auto" src="/events/img/future.mp4" controls="controls" preload="auto"></video>
				
</div>
</div>
</div>
</div>
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>

	<script src="/events/js/plugins.js"></script>
	<script src="/events/js/countdown.js"></script>
	<script src="/events/js/main.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
<script type="text/javascript" src="https://www.paypalobjects.com/api/checkout.js"></script> 
<script src="/events/js/crowdfunding2.js"></script>
  <script type="text/javascript" src="/events/clock/inc/TimeCircles.js"></script>
<script>
$(document).ready(function(){
 
		//keep looking for more donations

	<?php //echo $thermometer;
	foreach ($thermometerGoal as $key => $value) {
		//echo 'console.log("'.$key.'");';
		if ($value != 0) {
		echo 'thermometer("thermoTeam_'.$key.'", "';//. $thermometerGoal[$key] ;
		echo $value;
	echo  '", "';
		echo $thermometerTotal[$key];
			echo '",0);';
			} else {
			echo '$("#thermoTeam_'.$key.' .track").remove();$("#thermoTeam_'.$key.'").removeClass("thermometer").css("padding-top","50px"); ';
		}
	}
	if ($totalamount == 0 )  {$totalamount = 0 ;}
	?>

if (<?php echo $totalamount;?> >= '<?php echo $initialgoal;?>') {
	 $('.bonusmessage').show();
	 $('#wordsduplicated').text('still quadrupled');
	$('#amtduplicated').text('4');

	 	
}
if (<?php echo $totalamount;?> >= <?php echo $secondgoal;?>) {
	$('.bonusmessage').hide(); 
	$('.bonusmessage2').show();
	 $('#wordsduplicated').text('');
	$('#amtduplicated').text('');
	$('.divdouble').text('');

	 	
}
	 	thermometer("thermo1", '<?php echo $initialgoal;?>', <?php echo $totalamount;?> );
		
	if ( $('.teamid').text()  != '' ) { 
	 	thermometer("thermoTeam", $('.teamgoal').text() , '<?php echo $thermometerTotal[$teamid];?>' );
		
	}
  setTimeout(getmoreresults, 40000);
});
</script>	
</body>
</html>


