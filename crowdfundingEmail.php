<?php 
$message  = '<html>
<body><div align="center">
	<div style="width:700px; text-align: center;" >
	<div style="height:10px; background-color:rgb(153, 102, 153);"></div>
	<div><img src="https://www.bjhs.org/wp-content/uploads/2023/05/Image.jpeg" alt="" style="height:auto;width:100%;" ></div>
	<h1 style="color:rgb(153, 102, 153);">Thank you so much for partnering with us! </h1>
<div align="center">
<div style="text-align:left;width:75%;">
			
		Donor name: ' . $_POST['firstname'] . ' '  . $_POST['lastname'] . ' <br><br>
Organization legal name: Beth Jacob High School of Denver <br>
Organization Address : 5100 W. 14th Ave. Denver CO 80204 <br><br>
Receipt Number: ' . $id . ' <br>
Appears on Statement: BETH JACOB HIGH SCHOOL OF DENVER <br><br>
Amount: $' . $_POST['totaldue'] ;
if (!empty($_POST['duration']))  {
	$message  .= ' over ' . $_POST['duration'] . ' months';
}
$message  .= ' <br> <br>
Date: '. date('m/d/Y') . ' <br><br>
Tax ID: 84-0585743<br><br>
No goods or services have been provided in consideration of this contribution.<br>
All donations are tax deductible.

		</div>
		</div>
		<div style="height:10px; background-color:rgb(153, 102, 153);margin-top:10px;"></div>
		
	</div>
	</div>
</body>
</html>';

