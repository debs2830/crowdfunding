<?php 
session_start();
	session_set_cookie_params(86400);
date_default_timezone_set('America/Denver');
if( $_SESSION['admin'] !=1	) {
	header( 'Location: http://www.bjhs.org/events/login.php' ) ; 
	
	}
?>
<?php
 require("connection.php"); 		


$sql = "SELECT * FROM eventsignup 
LEFT JOIN crowdfundingTeams
ON eventsignup.adtext = crowdfundingTeams.ID
WHERE eventsignup.eventid =". $_GET['eventid'] ." ORDER BY lastname";
$result = mysqli_query($con,$sql);

$query1 = "SELECT SUM(amtpayed) as totalsum FROM eventsignup WHERE eventid =". $_GET['eventid'] ; 

$query = "SELECT COUNT(*) as totalcount FROM eventperson  WHERE eventid =". $_GET['eventid'] ; 


$resultsum = mysqli_query($con, $query1) or die(mysql_error());
$resultcount = mysqli_query($con, $query) or die(mysql_error());
//$resultcountpreevent = mysqli_query($con, $querypreevent) or die(mysql_error());
//$resultcountdinner = mysqli_query($con, $querydinner) or die(mysql_error());
?>
<!DOCTYPE html>
<html>
<head>
<title>Bais Yaakov Event Registration List</title>
<link rel="stylesheet"

	href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />


<link rel="stylesheet" href="css/normalize.min.css">

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
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
								
$.get( "markedcheckin.php", { id:idNum, ifcheck: $.trim($('#checkTD' + idNum).text()), eventid : $('#eventid').val() } )
.done(function( data ) {
	if( $('#checkTD' + idNum).text() == "YES") {
 $('#checkTD' + idNum).text('NO');
	} else {
		 $('#checkTD' + idNum).text('YES');
	}

});
							   } //end function sentCheck
							   
	   function sentinfocomplete(idNum, tdname, fieldnamest) {
	   $.get( "infocomplete.php", { id:idNum, ifcomplete: $.trim($('#' + tdname + 'TD' + idNum).text()), eventid : $('#eventid').val(), fieldname:fieldnamest} )
.done(function( data ) {
	if( $('#' + tdname + 'TD' + idNum).text() == "YES") {
 $('#' + tdname +'TD' + idNum).text('NO');
	} else {
		 $('#'+ tdname +'TD' + idNum).text('YES');
	}
	});

	   } //end send info complete

   function sentPay(idNum) {
								
$.get( "markedpaid.php", { id:idNum, ifpaid: $.trim($('#paidTD' + idNum).text()), eventid : $('#eventid').val() } )
.done(function( data ) {
	if( $('#paidTD' + idNum).text() == "YES") {
 $('#paidTD' + idNum).text('NO');
	} else {
		 $('#paidTD' + idNum).text('YES');
	}

});
							   } //end function sentPay
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

            $("#datatables").css("width","2000px");
        }
                });
            })
        </script>

</head>

<body>
<table>
	<tr style="vertical-align: text-bottom;">
			<td style="vertical-align: text-bottom;">

				<div style="text-align: center;">

	</div>

			</td>

			<td style="vertical-align: text-bottom;">
				<h1>Registration System</h1> 


			</td>
		</tr>
	</table>
<?php
// Print out result

while($row = mysqli_fetch_array($resultsum)){
	echo "<b>Total: ".  money_format('$%i', $row['totalsum']); 
	echo "</b> |";
    
}
//while($row = mysqli_fetch_array($resultcount)){
//
//	echo "<b>Number of Attendees: ". $row['totalcount'];
//	echo "</b> |";
//  


?>
<a href="downloadexceldb.php?id=<?php echo $_GET['eventid']?>">Download Database as Excel</a> | <a href="downloadexcellist.php?id=<?php echo $_GET['eventid']?>">Download Attendee List as Excel</a>
	<div>

		<table id="datatables" class="display" style="font-size:small">

			<thead>

				<tr>

					<th></th>

					<th></th>
                    <th>Paid</th>
					<th>Sign up Date</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Total</th>
				
					<th>Ad Text</th>
					<th>Email</th>
                    <th>Address</th>
					<th>City</th>
					<th>State</th>
					<th>Zip</th>
					
				
                 
                
                   
					
					<th>Pay Method</th>
					
					<th>Comment</th>
					<th></th>
					<th>Added By</th>
                    <th>Changed By</th>
                    <th>Change Date</th>
                   
				</tr>
			</thead>

			<tbody>

				<?php
				while ($row = mysqli_fetch_array($result)) {
				
                        ?>

				<tr>

					<td><?php
					$url = "delete.php?type=dinner&id=".$row['webid']."&eventid=".$_GET['eventid'];
					$site_title = "<img src='img/trash-box-icon.png' alt='Delete Record'/>";
					Echo "<a href=$url onclick=\"return confirm('Are you sure this registration should be deleted?')\">$site_title</a>";

					?></td>

					<td><?php
					
				 $url = "editcrowdfunding";
	
					$url = "$url.php?id=".$row['tnxid']."&eventid=".$_GET['eventid'];
					$site_title = "<img src='img/pencil-edit-icon.png' alt='Edit Record'/>";
					Echo "<a href=$url>$site_title</a>";

					?></td> 
                     <td id="paidTD<? echo $row['tnxid']?>" onclick="sentPay('<? echo $row['tnxid']?>');return false;" class="underline">
                              
                             <?php if ($row['payed'] == 1) :  
							  echo "YES";
                              else :  
                              echo "NO";
                              endif; ?>
                             </td>
					<td><?php
					$date=date_create( $row['dateadded']);
					echo date_format($date,"m/d/Y") 
						?>
					</td>

					<td><?=$row['firstname']?></td>

					<td><?=$row['lastname']?></td>
	<td><?=$row['amtpayed']?></td>
				   
				
					<td ><?=$row['nickname']?></td>
					<td><?=$row['email']?></td>

                    <td><?=$row['address1']?></td>

					<td><?=$row['city']?></td>

					<td><?=$row['state']?></td>

					<td><?=$row['zip']?></td>

					
			
                    
                    

                  
				

					<td><?=$row['paymethod']?></td> 
					<td style="font-size:smaller">  <?=$row['adcomment']?></td>
					<td> <?=$row['notes']?></td>
					 
                    <td><?=$row['enteredby']?></td>
                    <td><?=$row['changedby']?></td>
                    <td><?=$row['datemodified']?></td>
        
                 
                    
                   
                    		</tr>

				<?php
                }
                    ?>

			</tbody>

		</table>

		<br /> <br /> <br /> <a href="menu.php">Back To Menu</a>

	</div>

</body>

</html>
