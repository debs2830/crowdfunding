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

$sql = "SELECT * FROM crowdfundingTeams  WHERE eventid =". $_GET['eventid'] ." ORDER BY nickname";

$result = mysqli_query($con,$sql);





?>
<!DOCTYPE html>
<html>
    <head>
        <title>BJHS Team Listing</title>
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

			<div align="center">	CROWDFUNDING TEAMS	
				</div>
        <div><a href="downloadexcel.php?id=<?php echo $_GET['eventid'] ?> ">Download Database as Excel</a> 
            <table id="datatables" class="display" >
                <thead>
                    <tr>
					<th></th>
					<th></th>
                     <th>Name</th>
                        <th>Nickname</th>
                        <th>Goal</th>
                        <th>Donors</th>
                      
                        <th>Total Raised</th>
                         <th>Date</th>
                          
                                                            
                    </tr>
                </thead>
                <tbody>
                    <?php
                  	while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
						<td>
				<?php
						$url = "deleteTeam.php?id=".$row['ID'];
							 $site_title = "<img src='img/trash-box-icon.png' alt='Delete Team'/>";
							  Echo "<a href=$url onclick=\"return confirm('Are you sure this registration should be deleted?')\">$site_title</a>";
							  
							  ?>
					
						</td>
						<td>
		<?php
	 $site_title = "<img src='img/pencil-edit-icon.png' alt='Edit Record'/>";
							  echo "<a href=editTeam.php?id=".$row['ID'].">$site_title</a>"; 
							 ?> 
						</td>
                   
                            <td><a href="/crowdfunding/<?=$row['nickname']?>"><?=$row['realname']?></a></td>
                            <td><?=$row['nickname']?></td>
                            <td><?
		echo  money_format('$%i', $row['donationamount']); 
		?></td>
             <?php              
$query1 = "SELECT SUM(amtpayed) as totalsum FROM eventsignup WHERE eventid =". $_GET['eventid']  . " and adtext = '".$row['ID'] ."'"; 

$query = "SELECT COUNT(*) as totalcount FROM eventsignup  WHERE eventid =". $_GET['eventid']  . " and adtext = '".$row['ID'] ."'"; 
				
$resultsum = mysqli_query($con, $query1) or die(mysql_error());
$resultcount = mysqli_query($con, $query) or die(mysql_error()); 
							
		while($row = mysqli_fetch_array($resultsum)){
	$totalsum=   money_format('$%i', $row['totalsum']); 

    
}

	while($row = mysqli_fetch_array($resultcount)){

	$totalcount =  $row['totalcount'];
	
  
}
							?>
							   <td><?=$totalcount;?></td>
                            <td><?=	$totalsum;?></td>
                         
                             
                          
                             
                               <td>
						<?php
						$phpdate = strtotime( $row['dateEntered'] );
						$mysqldate = date( 'M d, Y', $phpdate );
					echo $phpdate;
						?>
						
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
				<a href="menu.php">Back To Menu</a> |
				<a href="createTeam.php?event=<?php echo $_GET['eventid'];?>">Add another Team</a>
        </div>
    </body>
</html>  