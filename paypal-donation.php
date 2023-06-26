<?php

//use code to change amount on thermometer
session_start();
// store session data
$_SESSION['id']=0;
$id= 6;

 require_once("connection.php"); 		

$sql = "SELECT * FROM crowdfundingTeams  WHERE eventid = $id order by realname";

$result = mysqli_query($con,$sql);

	$teamlisting;


                  	while ($row = mysqli_fetch_array($result)) {
			$teamlisting .='<option';
						
			if (isset($_GET['team']) && $_GET['team'] == strtolower($row['ID'] ) ) { 
			$teamlisting .=' selected ';
				
			}
			$teamlisting .= ' value="'.$row['ID']. '">'. $row['realname'] .'</option>';
							$liteamlisting .= "</li>";
					}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Crowdfunding Paypal Donation</title>
		<link rel="shortcut icon" href="https://www.bjhs.org/wp-content/uploads/2018/08/logo-small-transparent.png" />

	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <link  rel="stylesheet"href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
   <link rel="stylesheet" href="/events/css/normalize.min.css">
<link rel="stylesheet" href="/events/css/main.css">
<link rel="stylesheet" href="/events/css/charidy.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
</head>

<body >
<div class="topimage">
	<img src="img/spacer.gif" alt="" width="100%" height="400px;" data-target="#modalVideo" data-toggle="modal"></div>
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>

	<script src="/events/js/main.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
<script type="text/javascript" src="https://www.paypalobjects.com/api/checkout.js"></script> 
	
	<div class="container">
	<div align="center" style="margin-top:30px;">
	<h2>Please click on the PayPal logo to complete your transaction. </h2></div>
<div class="row">	
	<div class="form-group col-md-6">

						<label>Message or Dedication (75 characters maximum): </label><input type="text" name="description" id="description" class="form-control"></div></div>
	<div class="form-group col-md-6">
			
			    
						<label>Select a Team</label>	
		
		<select class="form-control" name="team" id="team">
			<option value=""></option>
		<?php echo $teamlisting ;?>
                   
			</select>
		</div>
		
	<div class="row col-md-6"><div id="paypal-button-container" align="center" style="margin-top:30px;"></div></div>
	</div>
   <script>
	   
        paypal.Button.render({

            env: 'production', // Or 'sandbox',
			 client: {
            sandbox:    'AaxPdt8uJPsBlgWa_XofrIL9jmmEj7XQ1DM16T47_wWRLkf7u1kk5mT7BFNb-3-jZw77KZDCqDp5TqnX',
            production: 'AWv6ot-PKJF8LevRugWe10qqhfi_o2kbEfKhiq8RJ0roTqt0ND3v0mOQz6Ckq-C0ShLZCj7DUMa1CM_V'
        },
            commit: true, // Show a 'Pay Now' button

            style: {
                color: 'gold',
                size: 'medium'
            },

             payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions:  [
  {
    "amount": {
    "total": "<?php echo $_GET['amt'];?>",
    "currency": "USD",
 
    },
    "description": $('#description').val() ,
    "invoice_number": "",
   }
  ]
                }
            });
        },
 onCancel: function(data, actions) {
           window.location = "https://www.bjhs.org/events/crowdfunding.php";
 
        },
           onAuthorize: function(data, actions) {

            // Get the payment details

            return actions.payment.get().then(function(data) {

                // Display the payment details and a confirmation button
			
                var billing = data.payer.payer_info.shipping_address;
			
				
                $('#firstname').val(data.payer.payer_info.first_name);
				$('#lastname').val(data.payer.payer_info.last_name);
			$('#address').val(billing.line1 );
			      $('#city').val(  billing.city);
                   $('#zip').val( billing.postal_code);
				$('#email').val(data.payer.payer_info.email);
				$('#phone').val(data.payer.payer_info.phone);
				$('#notes').val($('#description').val());
				$('#form #team').val($('.container #team').val());
				$('#payment').val('Paypal');
				//$('#approvalcode').val(data.cart);
			            $('#paypal-button-container').hide();
            

                    // Execute the payment

                    return actions.payment.execute().then(function() {
						$.ajax({
				 type: "POST",
  			url: 'insertGeneral.php',
				
			data:$('form').serialize()  ,
				 success: function(result) {
				 $('form').submit();

				 }
  	}); //end ajax 
						
						  
                    });
              
            });
        }

    },
           


     '#paypal-button-container');
				 
				
				 
    </script>
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" style="display: none;">

     
		  <form action="receiptDonation.php" method="post" id="form" name="form"  novalidate autocomplete="off" style="width: 100%">			
			  <input type="text"  id="totaldue" name="totaldue" required value="<?php echo $_GET['amt'];?>"	 />
		<input type = "hidden" name = "childnames" id = "childnames" value=""> </input>
				<input type = "hidden" name = "nokids" id = "nokids" value="0"> </input>

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
			<label for="cvv">Zip Code: </label>
		
			<input type="text"
				id="zip" name="zip" class="form-control" required/>
				
                      </div>
				<div class="form-group">
					<label
				for="email">Phone:</label>  <input type="text"
				id="phone" name="phone"  required value="<? echo $_SESSION['post_data']['phone']; ?>"  class="form-control"  /> 
					
		</div>
				<div class="form-group">
					<label
				for="email">Email Address:</label>  <input type="email"
				id="email" name="email"  required value="<? echo $_SESSION['post_data']['email']; ?>"  class="form-control"  /> 
					
		</div>
			
			<div class="form-group">
				<input type="hidden" name="notes"   id="notes"  />
			<input type="hidden" name='noadults' value='1'>
		    <input type="hidden" name="tnxid" id="tnxid"></input>
	   <input type="hidden" name="eventid" id="eventid" value="6"></input>
	     	   <input type="hidden" name="description" id="description" value="CrowdFunding Campaign">
	  <input type="hidden" name="payment"  id="payment" value="Paypal">
	  <input type="hidden" name="team"  id="team" value="">
	</div>


	
			</div>
		
      </div>
</form>
        
     
  </div>

</body>
</html>
