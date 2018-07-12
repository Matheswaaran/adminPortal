<?php
    include 'includes/dbconfig.php';
    include 'includes/SessionUtils.php';

    $response = array();

    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_BASE);

    if (!$db){
        $response["status"] = "error";
        $response["message"] = "Error in Connection";
    }else{
        $select_qry = "SELECT * FROM users_table";
        if ($res = mysqli_query($db, $select_qry)){
            $result = array();
            while ($row = mysqli_fetch_array($res)){
                $user["user_id"] = $row["user_id"];
                $user["name"] = $row["first_name"] . " " . $row["last_name"];
                $user["username"] = $row["username"];
                $user["email_id"] = $row["email_id"];
                $user["address"] = $row["address_1"] . " , " . $row["address_2"] . " , " . $row["district"] . " , " . $row["state"] . " - " . $row["pincode"];
                $user["contact_no"] = $row["contact_no"];
                $user["blocked"] = $row["blocked"];
                $result[] = $user;
            }

            $response["records"] = $result;
            $response["status"] = "success";
            $response["message"] = "Users fetched successfuly";
        }else{
            $response["status"] = "error";
            $response["message"] = "Error in Query Execution";
        }
    }

    echo json_encode($response);
?>