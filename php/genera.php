<?php
require_once("db_connection.php");
date_default_timezone_set("Africa/Lagos");
if ((isset($_POST['fullname']) && $_POST['fullname'] != '')) {
    
    // $i = implode(" ", $_POST['bundle_jamb']);
    $user_name = $conn->real_escape_string($_POST['fullname']);
    $user_email = $conn->real_escape_string($_POST['email']);
    $user_phone = $conn->real_escape_string($_POST['phone']);
    $user_address = $conn->real_escape_string($_POST['address']);
    $user_state = $conn->real_escape_string($_POST['state']);
    $user_bundle_j = $conn->real_escape_string($_POST['jambBundle']);
    $user_bundle_w = $conn->real_escape_string($_POST['waecBundle']);
    $user_bundle_w_j = $conn->real_escape_string($_POST['waec_jambBundle']);
    $user_date= date("M d, Y h:i a");
    // $user_bundle_jamb_sci = implode(', ',$_POST['bundle_jambSci']);
    // $user_bundle_jamb_art = implode(', ',$_POST['bundle_jambArt']);
    // $user_bundle_waec_sci = implode(', ',$_POST['bundle_waecSci']);
    // $user_bundle_waec_art = implode(', ',$_POST['bundle_waecArt']);
    // echo $user_bundle_sci;
    // echo $user_bundle_art;
    // $user_bundle_j = $fids;
    // require_once("constant.php");
    $sql = "INSERT INTO users (fullname, email, phone, address, state, jambSoftSciBundle, waecSoftSciBundle, jamb_waec, created_at) 
VALUES('".$user_name."', '".$user_email."', '".$user_phone."', '".$user_address. "', '".$user_state."','".$user_bundle_j."', '".$user_bundle_w."','".$user_bundle_w_j."','".$user_date."')";
// echo $sql;
    if (!$result = $conn->query($sql)) {
        $output = json_encode(array('type'=>'error', 'text' => 'There was an error running the query [' . $conn->error . ']'));
    die($output);
        // die('There was an error running the query [' . $conn->error . ']');
    } else {
        require_once("contact_mail.php");
        // require_once("./Emailing.php");
        $output = json_encode(array('type'=>'message', 'text' => 'Hi '.$user_name .', thank you for the message. We will get back to you shortly.'));
    die($output);
    }
    return !$result;
}
//  else {
//     $output = json_encode(array('type'=>'error', 'text' => 'There was an error running the query [' . $conn->error . ']'));
//     die($output);
// }

