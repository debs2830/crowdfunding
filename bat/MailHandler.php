<?php

	$owner_email='reservations@bjhs.org';
	//SMTP server settings	
	$host = '';
    $port = '587';//"587";
    $username = '';
    $password = '';

    $user_email='';    
	$message_body='';
	$message_type='html';

	$max_file_size=50;//MB 
	$file_types='/(doc|docx|txt|pdf|zip|rar)$/';
	$error_text='something goes wrong';
	$error_text_filesize='File size must be less than';
	$error_text_filetype='Failed to upload file. This file type is not allowed. Accepted files types: doc, docx, txt, pdf, zip, rar.';

	$private_recaptcha_key='6LeZwukSAAAAACmqrbLmdpvdhC68NLB1c9EA5vzU'; //localhost
	
	
	$use_recaptcha=isset( $_POST["recaptcha_challenge_field"]) and isset($_POST["recaptcha_response_field"]);
	$use_smtp=($host=='' or $username=='' or $password=='');
	$max_file_size*=1048576;

		

try{
	include "libmail.php";
	$m= new Mail("utf-8");
	$m->From($from);
	$m->To($to);
	$m->Subject($subject);
	$m->Body($message,$message_type);
	//$m->log_on(true);

	if(isset($_FILES['attachment'])){
		if($_FILES['attachment']['size']>$max_file_size){
			$error_text=$error_text_filesize . ' ' . $max_file_size . 'bytes';
			die($error_text);			
		}else{			
			if(preg_match($file_types,$_FILES['attachment']['name'])){
				$m->Attach($_FILES['attachment']['tmp_name'],$_FILES['attachment']['name'],'','attachment');
			}else{
				$error_text=$error_text_filetype;
				die($error_text);				
			}
		}		
	}
	if(!$use_smtp){
		$m->smtp_on( $host, $username, $password, $port);
	}

	if($m->Send()){
		//die('success');
	}	
	
}catch(Exception $mail){
//	die($mail);
}	

?>