<?php
require_once("db_connection.php");
if ((isset($_POST['fullname']) && $_POST['fullname'] != '') && (isset($_POST['phone']) && $_POST['phone'] != '')) {
    
    // $i = implode(" ", $_POST['bundle_jamb']);
    $user_name = $conn->real_escape_string($_POST['fullname']);
    $user_email = $conn->real_escape_string($_POST['email']);
    $user_phone = $conn->real_escape_string($_POST['phone']);
    $user_state = $conn->real_escape_string($_POST['address']);
    // $user_bundle_w = $conn->real_escape_string($_POST['bundle_waec']);
    $user_bundle_w = implode(', ',$_POST['bundle_waec']);
    // echo $fids;
    // $user_bundle_j = $fids;
    // require_once("constant.php");
    $sql = "INSERT INTO users (fullname, email, phone, address, waecBundle, created_at) 
VALUES('".$user_name."', '".$user_email."', '".$user_phone."', '".$user_state."','".$user_bundle_w."', now())";
    if (!$result = $conn->query($sql)) {
        $output = json_encode(array('type'=>'error', 'text' => 'There was an error running the query [' . $conn->error . ']'));
    die($output);
        // die('There was an error running the query [' . $conn->error . ']');
    } else {
        // require_once("./contact_mail.php");
        // require_once("./Emailing.php");
        $output = json_encode(array('type'=>'message', 'text' => 'Hi '.$user_name .', thank you for the message. We will get back to you shortly.'));
    die($output);
    }
} else {
    echo "Please fill Name and Email";
}

