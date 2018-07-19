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
            $contractor["cid"] = $row["cid"];
            $contractor["name"] = $row["name"];
            $contractor["sid"] = $row["sid"];
            $contractor["email"] = $row["email"];
            $contractor["aadhar_uid"] = $row["aadhar_uid"];
            $contractor["aadhar_string"] = $row["aadhar_string"];
            $contractor["gid"] = $row["gid"];
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