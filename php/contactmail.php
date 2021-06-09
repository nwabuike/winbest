<?php
if($_POST)
{
require('constant.php');
    
    $user_name      = filter_var($_POST["fullname"], FILTER_SANITIZE_STRING);
    $user_email     = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
	$user_phone     = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
	$user_state     = filter_var($_POST["state"], FILTER_SANITIZE_STRING);
	$user_bundle_w     = filter_var($_POST["bundle_waec"], FILTER_SANITIZE_STRING);
	$user_bundle_j    = filter_var($_POST["bundle_jamb"], FILTER_SANITIZE_STRING);
	// $content   = filter_var($_POST["comments"], FILTER_SANITIZE_STRING);
	// connect to the database

    
    if(empty($user_name)) {
		$empty[] = "<b>Full Name</b>";		
	}
	if(empty($user_email)) {
		$empty[] = "<b>Email</b>";
	}
	if(empty($user_phone)) {
		$empty[] = "<b>Phone Number</b>";
	}	
	if(empty($user_state)) {
		$empty[] = "<b>State</b>";
	}
	// if(empty($user_bundle_w) || ($user_bundle_j)) {
	// 	$empty[] = "<b>Please Choose any bundle u want to a for is </b>";
	// }
	
	if(!empty($empty)) {
		$output = json_encode(array('type'=>'error', 'text' => implode(", ",$empty) . ' Required!'));
        die($output);
	}
	
	if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){ //email validation
	    $output = json_encode(array('type'=>'error', 'text' => '<b>'.$user_email.'</b> is an invalid Email, please correct it.'));
		die($output);
	}
	// $db = mysqli_connect('localhost', 'root', '', 'prep50books');
	// if ($db->connect_error) {
	// 	die("Connection failed: " . $conn->connect_error);
	// 	}
	// $query = "INSERT INTO idid (fullName, email, phone, address, waecBundle, JambBundle, created_at, updated_at) 
	// 				  VALUES('$user_name', '$user_email', '$user_phone', '$user_state','$user_bundle_w', '$user_bundle_j', now(), now())";
	// 		$qry = mysqli_query($db, $query);
	// 		if($qry){
	// 			// mysqli_close ($db);
	// 			$output = json_encode(array('type'=>'success', 'text' => 'Successfuly stored'));
	// 			die($output);
	// 		   echo 200;
	// 		  } else {
	// 			$output = json_encode(array('type'=>'error', 'text' => 'Not saved in the database '.$qry .''));
	// 			die($output);
	// 		  }
	
	//reCAPTCHA validation
	if (isset($_POST['g-recaptcha-response'])) {
		
		// require('../recaptcha/src/autoload.php');		
		
		// $recaptcha = new \ReCaptcha\ReCaptcha(SECRET_KEY, new \ReCaptcha\RequestMethod\SocketPost());

		$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

		  if (!$resp->isSuccess()) {
				$output = json_encode(array('type'=>'error', 'text' => '<b>Captcha</b> Validation Required!'));
				die($output);				
		  }	
	}
	
	$toEmail = "deaconscbt@gmail.com";
	$mailHeaders = "From: " . $user_name . "<" . $user_email . ">\r\n";
	$mailBody = "User Name: " . $user_name . "\n";
	$mailBody .= "User Email: " . $user_email . "\n";
	$mailBody .= "Phone: " . $user_phone . "\n";
	$mailBody .= "Address: " . $user_state . "\n";
	$mailBody .= "Bundle-Waec: " . $user_bundle_w . "\n";
	$mailBody .= "Bundle-Jamb: " . $user_bundle_j . "\n";

	if (mail($toEmail, "Book Order", $mailBody, $mailHeaders)) {
	    $output = json_encode(array('type'=>'message', 'text' => 'Hi '.$user_name .', thank you for the message. We will get back to you shortly.'));
	    die($output);
	} else {
	    $output = json_encode(array('type'=>'error', 'text' => 'Unable to send email, please contact '.$toEmail .', Or call 09038356928'));
	    die($output);
	}
}
