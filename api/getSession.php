<?php
    $response = array();

    $response["admin_id"] = $_SESSION["admin_id"];
    $response["admin_username"] = $_SESSION["admin_username"];

    echo json_encode($response);
?>