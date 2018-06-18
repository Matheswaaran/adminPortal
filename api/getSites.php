<?php
    include 'includes/SessionUtils.php';

    $response = array();

    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_BASE);

    if (!$db){
        $response["status"] = "error";
        $response["message"] = "Error in Connection";
    }else{
        $select_qry = "SELECT * FROM site_table";
        if ($res = mysqli_query($db, $select_qry)){
            $result = array();
            while ($row = mysqli_fetch_array($res)){
                $site["name"] = $row["name"];
                $site["address"] = $row["address_1"] . " , " . $row["address_2"] . " , " . $row["district"] . " , " . $row["state"] . " - " . $row["pincode"];
                $site["type"] = $row["type"];
                $result[] = $site;
            }

            $response["records"] = $result;
        }else{
            $response["status"] = "error";
            $response["message"] = "Error in Query Execution";
        }
    }

    echo json_encode($response);
?>