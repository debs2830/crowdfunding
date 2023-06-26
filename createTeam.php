<?php

//use code to change amount on thermometer
session_start();
// store session data
$id = (isset ($_GET['eventid']) ? $_GET['eventid'] : 17);
?>

<!DOCTYPE html><head>

<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
<meta content="utf-8" http-equiv="encoding" />
<meta name="description"
	content="Denver Kollel - Because Torah Learning is for Every Jew" />

<title>Triple Your Donation Campaign</title>
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<meta name="description" content="">
<meta name="viewport" content="width=device-width">
	<meta name="og:image" content="https://bjhs.org/events/img/banner-charidy.jpg" >
	<meta name="og:title" content="The Kollel is holding its Quadruple Giving campaign NOW!" >
	<meta name="og:description" content="Every dollar donated to the Denver Kollel for the next 30 hours – until 6 pm on Wednesday - will be quadrupled by generous matchers. So what are you waiting for? Join in building the future of Torah in Denver NOW! " >
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <link  rel="stylesheet"href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
   <link rel="stylesheet" href="/events/css/normalize.min.css">
<link rel="stylesheet" href="/events/css/main.css">
<link rel="stylesheet" href="/events/css/charidy.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">






<div   class="topbar">
		<img src="https://www.bjhs.org/wp-content/uploads/2018/08/logo-small-transparent.png">
		<h1>Triple Your Giving Campaign</h1>
</div>


     
		  <form action="/events/insertTeam.php" method="post" id="form" name="form"  novalidate autocomplete="off" style="width: 100%;margin-top:20px;">			
			  
		<div class="form-group">
			
			  <label for="firstname"> Name:</label>
			<input class="form-control" type="text"
				id="realname" name="realname" autofocus
				required="required"  /> 
			<small>Put just the name. We will add the word TEAM in front. IE:  Fleisher</small>
		</div>
		<div class="form-group">
			<label for="lastname">Nickname:</label>
		<input type="text"
				id="nickname" name="nickname" class="form-control" required />
		<small> only letters and dashes. no spaces or weird characters  </small>
		</div>

		<div class="form-group">
			<label for="cvv">Donation Amount: </label>
		
			<input type="number"
				id="donationamt" name="donationamt" class="form-control" required/>
		</div>
			  <div class="form-group">
			<label for="cvv">Amount of People Goal: </label>
		
			<input type="number"
				id="peopleGoal" name="peopleGoal" class="form-control" required/>
		</div>
			  	<div class="form-group">
					<button type="submit">SUBMIT</button>
			  </div>
		   		
	   <input type="hidden" name="eventid" id="eventid" value="<?php echo $id;?>"></input>
	     	   <input type="hidden" name="description" id="description" value="Charidy Campaign">
	
	</div>



			</div>
		
      </div>
</form>


<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
<script src="/events/js/plugins.js"></script>
	<script src="/events/js/main.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>



</body>
</html>


