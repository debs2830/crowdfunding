<?php 
session_start();
date_default_timezone_set('America/Denver');
	session_set_cookie_params(166400);

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

$resultsum = mysqli_query($con, $query1) or die(mysql_error());
$resultcount = mysqli_query($con, $query) or die(mysql_error());

?>
<!DOCTYPE html>
<html>
    <head>
        <title>BJHS Event Check In</title>
        <link rel="stylesheet"
	href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
   <script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
     
		<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="css/normalize.min.css"><link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <style>
            *{
                font-family: arial;
            }
			.underline {
			text-decoration: underline;
			}
        </style>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function(){
                $('#datatables').dataTable({
                    "sPaginationType":"full_numbers",
                    "bAutoWidth": true,
                    "bJQueryUI":true,
					"sDom" : 'T<"clear">lfrtip',
					"oTableTools" : {
						"sSwfPath" : "/media/swf/copy_csv_xls_pdf.swf",
						"aButtons" : [ "copy", "xls", {
							"sExtends" : "pdf",
							"sPdfOrientation" : "landscape",
							"sPdfMessage" : "Event List",
							"sTitle" : "Event List"
						} ]},
                    "fnInitComplete": function() {

            $("#datatables").css("width","100%");
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
                    <input type="hidden" id="eventid" value="<? echo $_GET['eventid'] ?>" />
					<!--TODO: PULL DYNAMICALLY FROM DB-->
					<?php if ($_GET['eventid'] == 2 )			 {
echo '<IMG SRC="http://www.bjhs.org/wp-content/uploads/2018/04/shasbanner.jpg" ALT="Dinner" style="width:200px;" >';	
}else {
echo '<IMG SRC="http://www.bjhs.org/wp-content/uploads/2017/11/by2017parlor.jpg" ALT="Dinner" style="width:200px;" >';
	}?>	
					</div>
				</td>
				<td style="vertical-align: text-bottom;">
		
				</td>
				
			</tr>
			
		</table>
		<div align="center">		
				<h2>Bais Yaakov Reunion Reservations</h2></div>
        <div><a href="downloadexcel.php?id=<?php echo $_GET['eventid'] ?> ">Download Database as Excel</a> 
            <table id="datatables" class="display" >
                <thead>
                    <tr>
					<th></th>
					<th></th>
                     <th>Sign up Date</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                      
                        <th>City</th>
                         <th># Adults</th>
                          
                             <th>SponsorInfo</th>
                            <th>Class</th>
                      <th>Total</th>
                      
                                            <th>Maiden Name</th>
                                           
                              <th>Pay Method</th>
                               <th>Paid?</th>
                                <th>Checked IN?</th>
                                
                    </tr>
                </thead>
                <tbody>
                    <?php
                  	while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
						<td>
						<?php
						$url = "delete.php?id=".$row['tnxid']."&eventid=".$_GET['eventid'];
							 $site_title = "<img src='img/trash-box-icon.png' alt='Delete Record'/>";
							  Echo "<a href=$url onclick=\"return confirm('Are you sure this registration should be deleted?')\">$site_title</a>";
							  
							  ?>
						</td>
						<td>
		<?php
		if ($_GET['eventid']== 2 ) {
				 $url = "editshas.php?id=".$row['tnxid']."&eventid=".$_GET['eventid'];}
		elseif ($_GET['eventid'] ==3) {
				 $url = "editreunion.php?id=".$row['tnxid']."&eventid=".$_GET['eventid'];}
		
							 $site_title = "<img src='img/pencil-edit-icon.png' alt='Delete Record'/>";
							  Echo "<a href=$url>$site_title</a>"; 
							 ?> 
						</td>
                        <td>
						<?php
						$phpdate = strtotime( $row['dateadded'] );
						$mysqldate = date( 'M-d-Y ', $phpdate );
						echo $mysqldate;
						?>
						
						</td>
                            <td><?=$row['firstname']?></td>
                            <td><?=$row['lastname']?></td>
                            <td><?=$row['email']?></td>
                          
                            <td><?=$row['city']?></td>
                            <td><?=$row['numadults']?></td>
                             
                            <td><? if ($row['adtext'] != '' ) {
								echo  $row['adtext']; }
						 ?>
						</td>
                                 <td><?=$row['amtdescr']?></td>
                              <td><?=$row['amtpayed']?></td>
                                  
                                  <td><?=$row['notes']?></td>
                                
                              <td><?=$row['paymethod']?></td>
                             <td id="paidTD<? echo $row['tnxid']?>" onclick="sentPay('<? echo $row['tnxid']?>');return false;" class="underline">
                              
                             <?php if ($row['payed'] == 1) :  
							  echo "YES";
                              else :  
                              echo "NO";
                              endif; ?>
                             </td>
                              
                             <td id="checkTD<? echo $row['tnxid']?>" onclick="sentCheck('<? echo $row['tnxid']?>');return false;" class="underline">
                               <?php if ($row['checkedin'] == 1): 
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
			<br/>
			<br/>
			<br/>
				<a href="menu.php">Back To Menu</a>
        </div>
    </body>
</html>  <script>
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

                               </script>