<?php
    include 'includes/dbconfig.php';

    $response = array();

    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_BASE);

    if (!$db){
        $response["status"] = "error";
        $response["message"] = "Error in Connection";
    }else{
        $select_qry = "SELECT * FROM employee_table";
        if ($res = mysqli_query($db, $select_qry)){
            $result = array();
            while ($row = mysqli_fetch_array($res)){
                $employee["name"] = $row["first_name"] . " ". $row["last_name"];
                $employee["aadhar_uid"] = $row["aadhar_uid"];
                $employee["address"] =  $row["address_1"] . " , " . $row["address_2"] . " , " . $row["district"] . " , " . $row["state"] . " - " . $row["pincode"];
                $employee["contact_no"] = $row["contact_no"];
                $employee["skill"] = $row["skill"];
                $employee["emp_type"] = $row["emp_type"];
                $result[] = $employee;
            }

            $response["records"] = $result;
        }else{
            $response["status"] = "error";
            $response["message"] = "Error in Query Execution";
        }
    }

    echo json_encode($response);
?>