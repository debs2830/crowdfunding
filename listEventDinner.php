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

$sql = "SELECT * FROM eventsignup  WHERE eventid =". $_GET['eventid'] ." ORDER BY lastname";

$result = mysqli_query($con,$sql);

$query1 = "SELECT SUM(amtpayed) as totalsum FROM eventsignup WHERE eventid =". $_GET['eventid'] ; 

$query = "SELECT COUNT(*) as totalcount FROM eventperson  WHERE eventid =". $_GET['eventid'] ; 
$querypreevent = "SELECT COUNT(*) as totalcount FROM eventperson  WHERE eventid =". $_GET['eventid'] . " AND notes='preevent'";
$querydinner = "SELECT COUNT(*) as totalcount FROM eventperson  WHERE eventid =". $_GET['eventid']. " AND notes='dinner'"; 

$resultsum = mysqli_query($con, $query1) or die(mysql_error());
$resultcount = mysqli_query($con, $query) or die(mysql_error());
$resultcountpreevent = mysqli_query($con, $querypreevent) or die(mysql_error());
$resultcountdinner = mysqli_query($con, $querydinner) or die(mysql_error());
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
	<script type="text/javascript" src="js/jquery-table2ecel.js"></script>
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
				
				$("#export").click(function(e){
			e.preventDefault();
		$('#datatables select').val(-1).change();
  $("#datatables").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "EventList",
    filename: "EventList" //do not include extension
  }); 
			$('#datatables select').val(100).change();
});
				
				
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
		<?php if ($_GET['eventid'] == 2 )			 {
echo '<IMG SRC="https://www.bjhs.org/wp-content/uploads/2018/04/shasbanner.jpg" ALT="" style="width:200px;" >';	
}elseif  ($_GET['eventid'] == 5 )	{	
	echo '<IMG SRC="https://www.bjhs.org/wp-content/uploads/2019/01/website-sign.jpg" ALT="Dinner" style="width:200px;" >';

}else {
echo '<IMG SRC="https://www.bjhs.org/wp-content/uploads/2017/11/by2017parlor.jpg" ALT="" style="width:200px;" >';
	}?>	
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
//}
	while($row = mysqli_fetch_array($resultcountpreevent)){

	echo "<b>Number of Preevent Attendees: ". $row['totalcount'];
	echo "</b> |";
  
}
	while($row = mysqli_fetch_array($resultcountdinner)){

	echo "<b>Number of Dinner Attendees: ". $row['totalcount'];
	echo "</b> |";
  
}

?>
<button class="btn btn-outline" id="export">Download Database as Excel</button> | <a href="downloadexcellist.php?id=<?php echo $_GET['eventid']?>">Download Attendee List as Excel</a>
	<div>

		<table id="datatables" class="display" style="font-size:small">

			<thead>

				<tr>

					<th class="noExl"></th>

					<th class="noExl"></th>
                    <th>Paid</th>
					<th>Sign up Date</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Total</th>
					   <th># Adults</th>
					 <th>Sub Level</th>
					<th>Ad Text</th>
					<th>Email</th>
                    <th>Address</th>
					<th>City</th>
					<th>State</th>
					<th>Zip</th>
					
					<th>Names</th>
                 
                    <th>Level</th>
                   
					
					<th>Pay Method</th>
					
					<th>Comment</th>
					<th>Added By</th>
                    <th>Changed By</th>
                    <th>Change Date</th>
                    <th>Information Complete</th>

                    <th>Ad Complete</th>

				</tr>
			</thead>

			<tbody>

				<?php
				while ($row = mysqli_fetch_array($result)) {
				
                        ?>

				<tr>

					<td class="noExl"><?php
					$url = "delete.php?type=dinner&id=".$row['webid']."&eventid=".$_GET['eventid'];
					$site_title = "<img src='img/trash-box-icon.png' alt='Delete Record'/>";
					Echo "<a href=$url onclick=\"return confirm('Are you sure this registration should be deleted?')\">$site_title</a>";

					?></td>

					<td class="noExl"><?php
					if ($_GET['eventid'] ==5) {
				 $url = "editLuncheon";
		} else {
						$url = "editDinner";
					}
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
					<td> <?php
						
$sqlquery = "SELECT * FROM eventperson WHERE tnxid = '". $row['tnxid'] ."'";
				
				$result1 = $mysqli->query($sqlquery);
				    $num_rows = mysqli_num_rows($result1);
                    echo $num_rows;
                    ?>    
                        
                         </td>
					 <td><?=$row['levelname']?></td>
					<td style="font-size:smaller"><?=$row['adtext']?></td>
					<td><?=$row['email']?></td>

                    <td><?=$row['address1']?></td>

					<td><?=$row['city']?></td>

					<td><?=$row['state']?></td>

					<td><?=$row['zip']?></td>

					
					<td><?php


				while ($row1=mysqli_fetch_array($result1))
				{
					echo    $row1['title'] . " "  . $row1['firstname']  . " " . $row1['lastname']  ."<br/>"  ;
				}
					
					
				?></td>
                    
                    

                    <td><?=$row['levelgroup']?></td>
                  
				

					<td><?=$row['paymethod']?></td> 
					<td style="font-size:smaller"> <?=$row['adcomment']?></td>
					 
                    <td><?=$row['enteredby']?></td>
                    <td><?=$row['changedby']?></td>
                    <td><?=$row['datemodified']?></td>
                  <td id="infoTD<? echo $row['tnxid']?>" class="underline" onclick="sentinfocomplete('<? echo $row['tnxid']?>','info', 'infocomplete');return false;">
                             
                             <?php if ($row['infocomplete'] == 1) :  
							  echo "YES";
                              else :  
                              echo "NO";
                              endif; ?>
                             </td>
                 
                 
                    
                    <td id="adTD<? echo $row['tnxid']?>" class="underline" onclick="sentinfocomplete('<? echo $row['tnxid']?>','ad', 'ADCOMPLETE');return false;">
					<?php if ($row['adcomplete'] == 1) :  
							  echo "YES";
                              else :  
                              echo "NO";
                              endif; ?>
					</td>
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
