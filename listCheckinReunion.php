<?php 
session_start();
if( $_SESSION['admin'] !=1	) {
	header( 'Location: http://www.bjhs.org/events/login.php' ) ; 
	
	}
?><?php
require('connection.php');// Check connection

 
$result = mysqli_query($con,"SELECT * FROM eventsignup  WHERE eventid =  ". $_GET['eventid'] ." ORDER BY lastname");

$query = "SELECT COUNT(*) FROM eventsignup  WHERE eventid =  ". $_GET['eventid']; 
$resultcount = mysqli_query($con, $query) or die(mysql_error());

$query = "SELECT COUNT(*) FROM eventsignup  WHERE CHECKEDIN = 1 AND  eventid =  ". $_GET['eventid']; 
$resultcountCheckin = mysqli_query($con, $query) or die(mysql_error());

?>

<!DOCTYPE html>

<html>

<head>

<title>Bais Yaakov Event Check In</title>

<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet"
	href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<link rel="stylesheet" href="css/normalize.min.css">





<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


<style>
* {
	font-family: arial;
}
			.underline {
			text-decoration: underline;
			}

</style>

<script type="text/javascript" charset="utf-8">
 function sentCheck(idNum) {
								
$.get( "markedcheckin.php", { id:idNum, ifcheck: $.trim($('#checkTD' + idNum).text()), eventid : $('#eventid').val() , ind:0} )
.done(function( data ) {
	if( $('#checkTD' + idNum).text() == "YES") {
 $('#checkTD' + idNum).text('NO');
	} else {
		 $('#checkTD' + idNum).text('YES');
	}

});
							   } //end function sentCheck

            $(document).ready(function(){
                $('#datatables').dataTable({
                    "sPaginationType":"full_numbers",
                    "bAutoWidth": true,
                    "bJQueryUI":true,
					"sDom" : 'T<"clear">lfrtip',
                     'iDisplayLength': 100,
					"oTableTools" : {
						"sSwfPath" : "/media/swf/copy_csv_xls_pdf.swf",
						"aButtons" : [ "copy", "xls", {
							"sExtends" : "pdf",
							"sPdfOrientation" : "landscape",
							"sPdfMessage" : "Event List",
							"sTitle" : "Event List"
						} ]},
                    "fnInitComplete": function() {

          $("#datatables").css("width","75%");
        }
                });
            })
        </script>

</head>

<body>


<div style="width: 90%;" align="center">
	<table >

		<tr style="vertical-align: text-bottom;">



			<td style="vertical-align: text-bottom;">

				

			</td>

			<td style="vertical-align: text-bottom;">
				

			</td>
		</tr>
	</table>
<?php
// Print out result
while($row = mysqli_fetch_array($resultcount)){
	echo "<b>Number of Attendees: ". $row['COUNT(*)'];
	echo "</b> |";
  
}
while($row = mysqli_fetch_array($resultcountCheckin)){
	echo "<b>Number of Checked In: ". $row['COUNT(*)'];
	echo "</b> |";
  
}

?>
	<div>

		<table id="datatables" class="display" style="font-size:small">

			<thead>

				<tr>
                    <th>Checked In</th>
		
					<th>First Name</th>
					<th>Last Name</th><th>Maiden Name</th>
					</tr>
		  </thead>

			<tbody>

				<?php
				while ($row = mysqli_fetch_array($result)) {

                        ?>

				<tr>
<td id="checkTD<? echo $row['tnxid']?>" onclick="sentCheck('<? echo $row['tnxid']?>');return false;" class="underline" data-txid="<? echo $row['tnxid']?>">
                               <?php 

							   if  ($row['checkedin'] == '1'):
                             echo "YES";
                              else :  
                              echo "NO";
                             endif; 
?>
                             </td>
				

					<td><?=$row['firstname']?></td>

					<td><?=$row['lastname']?></td><td><?=$row['notes']?></td>
	</tr>

				<?php
                }
                    ?>

			</tbody>

		</table>

		<br /> <br /> <br /> <a href="menu.php">Back To Menu</a>

	</div>
</div>
</body>

</html>
