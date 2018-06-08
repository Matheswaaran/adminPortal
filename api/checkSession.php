<?php
    include 'includes/SessionUtils.php';

//    $message = $_GET["msg"];

    $session = new SessionUtils();
    $response = array();
    if ($session->chkSession($_SESSION['admin_username'])){
        $response['status'] = "success";
        $response['message'] = "Session already exists. Make sure to logout when you leave.";
    }else{
        $response['status'] = "error";
        $response['message'] = "Session doesn't exists. Login to Continue.";
    }

    echo json_encode($response);
?>