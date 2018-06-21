<?php
include 'includes/dbconfig.php';

$response = array();

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_BASE);

if (!$db){
    $response["status"] = "error";
    $response["message"] = "Error in Connection";
}else{
    $select_qry = "SELECT * FROM contract_users";
    if ($res = mysqli_query($db, $select_qry)){
        $result = array();
        while ($row = mysqli_fetch_array($res)){
            $contractor["name"] = $row["first_name"] . " ". $row["last_name"];
            $contractor["username"] = $row["username"];
            $contractor["email_id"] = $row["email_id"];
            $contractor["aadhar_uid"] = $row["aadhar_uid"];
            $contractor["address"] =  $row["address_1"] . " , " . $row["address_2"] . " , " . $row["district"] . " , " . $row["state"] . " - " . $row["pincode"];
            $contractor["contact_no"] = $row["contact_no"];
            $result[] = $contractor;
        }

        $response["records"] = $result;
    }else{
        $response["status"] = "error";
        $response["message"] = "Error in Query Execution";
    }
}

echo json_encode($response);
?>