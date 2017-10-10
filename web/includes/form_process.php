<?php

	// email from contact form
	$contact_email = $_REQUEST['contact_email']; 
	// name from contact form
    $contact_name = $_REQUEST['contact_name'];
	// message from contact form
    $contact_message = $_REQUEST['contact_message']; 
	
	// if all inputs are not empty
	if($contact_email != "" && $contact_name != "" && $contact_message != ""){
	
		// check for valid email address
		if (filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
	
			// name to appear in the from field in the email
			$from = "Intent Theme <email@yourdomain.com>";
			
			// email address to receive the enquiry - CHANGE THIS TO YOUR DESIRED EMAIL ADDRESS
			$to = "example@example.com";

			// headers of the email sent
			$headers = "From:" . $from . "\r\n";
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			// subject line to appear in inbox
			$subject = "New website enquiry"; 
			
			// message contents
			$message = "<html><body>";
			$message .= "<p>From: " . $contact_name . "</p>";
			$message .= "<p>Email: " . $contact_email . "</p>";
			$message .= "<p>Message: " . $contact_message . "</p>";
			$message .= "</body></html>";

			// php send mail function
			$send = mail($to, $subject, $message, $headers);
			
			// send response back in form of json
			$contact_json = array ('contact_status'=>'0');
			echo json_encode($contact_json, JSON_NUMERIC_CHECK);
			
		} else {
			$contact_json = array ('contact_status'=>'1');
			echo json_encode($contact_json, JSON_NUMERIC_CHECK);
		}
	
	// invalid email address
	} else {
		$contact_json = array ('contact_status'=>'1');
		echo json_encode($contact_json, JSON_NUMERIC_CHECK);
	}

?>

