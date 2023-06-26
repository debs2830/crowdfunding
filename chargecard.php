<?php
		$testmode = ($_POST['firstname'] =='test' ? 'true': false);

			$post_url = "https://secure.authorize.net/gateway/transact.dll";
$amount = (isset($_POST['payment-spread']) && $_POST['payment-spread']=='monthly'? (int)($_POST['totaldue']/$_POST['duration'])	: $_POST['totaldue'] );
				$post_values = array(
					"x_login"			=> "2y6HyNqA2M",
					"x_tran_key"		=> "2D29tYVgrZ6629qV",
				

				"x_version"			=> "3.1",
				"x_delim_data"		=> "TRUE",
				"x_delim_char"		=> "|",
				"x_relay_response"	=> "FALSE",

				"x_type"			=> "AUTH_CAPTURE",
				"x_method"			=> "CC",
				"x_card_num"		=> $_POST['ccnum'],
				"x_card_code"		=>  $_POST['cvv'],
				"x_exp_date"		=> $_POST['ccmonth'].$_POST['ccyear'],

				"x_amount"			=> $amount,
				"x_description"		=> $_POST['description'],

				"x_first_name"		=>  $_POST['firstname'],
				"x_last_name"		=> $_POST['lastname'],
				"x_email"			=>  $_POST['email'],
				"x_address"			=> $_POST['address'],
				"x_city" => $_POST['city'],
				"x_state"			=> $_POST['state'],
				"x_zip"				=> $_POST['zip'],
				"x_phone" =>$_POST['phone'],
				"x_po" => $id,
				"x_test_request" =>$testmode,
				"x_invoice_num" => $_POST['team'],
				"x_custom01"				=> $_POST['notes'],
					"x_custom02"				=> $_POST['team'],
					

			);

			$post_string = "";
			foreach( $post_values as $key => $value )
				{ $post_string .= "$key=" . urlencode( $value ) . "&"; }
			$post_string = rtrim( $post_string, "& " );


			$request = curl_init($post_url); 
				curl_setopt($request, CURLOPT_HEADER, 0); 
				curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); 
				curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); 
				curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE);
				$post_response = curl_exec($request); 
				// Connection to Authorize.net			
			curl_close ($request); // close curl object

						
			$response_array = explode($post_values["x_delim_char"],$post_response);


			if($response_array[0] =='1'){
				echo $response_array[4];
			
				$msg = 'approved';
			
				if ($_POST['description'] != 'Parlor Meeting') {
					
							include_once("insertGeneral.php");
				}
			}
			
			else if($response_array[0] =='2'){
			 	$msg .= $response_array[3] ;
				echo 'Error';

			}
			else{
				echo 'Error';
				$msg .= $response_array[3];
			}
		