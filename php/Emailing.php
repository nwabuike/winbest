<?php
$toEmail = "nwabuikeanthony@gmail.com";
$mailHeaders = "From: " . $user_name . "<" . $user_email . ">\r\n";
$mailBody = "User Name: " . $user_name . "\n";
$mailBody .= "User Email: " . $user_email . "\n";
$mailBody .= "Phone: " . $user_phone . "\n";
$mailBody .= "Address: " . $user_address . "\n";
$mailBody .= "Bundle-Jamb-sci: " . $user_bundle_jamb_sci . "\n";
$mailBody .= "Bundle-Jamb-Art: " . $user_bundle_jamb_art . "\n";
$mailBody .= "Bundle-Waec-Sci: " . $user_bundle_waec_art . "\n";
$mailBody .= "Bundle-WaecS-Art: " . $user_bundle_waec_sci . "\n";
// $file = "files/codexworld.pdf";

if (mail($toEmail, "Book Order form $user_name ", $mailBody, $mailHeaders)) {
    // $output = json_encode(array('type'=>'message', 'text' => 'Hi '.$user_name .', thank you for the message. We will get back to you shortly.'));
    // die($output);
    echo "Thank you";
} else {
    // $output = json_encode(array('type'=>'error', 'text' => 'Unable to send email, please contact '.$toEmail .', Or call 09038356928'));
    // die($output);
    echo "Error: occured";
}
?>