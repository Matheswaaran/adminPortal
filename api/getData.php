<?php
    include 'includes/dbconfig.php';
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $response = array();

    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_BASE);

    if (!$db){
        $response["status"] = "error";
        $response["message"] = "Error in Connection";
    } else {
        switch ($request->action){
            case 'GET_EMPLOYEES':
                $select_qry = "SELECT * FROM employee_table";
                if ($res = mysqli_query($db, $select_qry)){
                    $result = array();
                    while ($row = mysqli_fetch_array($res)){
                        $employee["eid"] = $row["eid"];
                        $employee["name"] = $row["name"];
                        $employee["cid"] = $row["cid"];
                        $employee["auth"] = $row["auth"];
                        $employee["aadhar_uid"] = $row["aadhar_uid"];
                        $employee["aadhar_string"] = $row["aadhar_string"];
                        $employee["skill"] = $row["skill"];
                        $employee["emp_type"] = $row["emp_type"];
                        $result[] = $employee;
                    }
                    $response["records"] = $result;
                }else{
                    $response["status"] = "error";
                    $response["message"] = "Error in Query Execution";
                }
                break;
            case 'GET_USERS':
                $select_qry = "SELECT * FROM users_table";
                if ($res = mysqli_query($db, $select_qry)) {
                    $result = array();
                    while ($row = mysqli_fetch_array($res)) {
                        $user["uid"] = $row["uid"];
                        $user["name"] = $row["first_name"] . " " . $row["last_name"];
                        $user["username"] = $row["username"];
                        $user["aadhar_uid"] = $row["aadhar_uid"];
                        $user["email_id"] = $row["email_id"];
                        $user["address"] = $row["address_1"] . " , " . $row["address_2"] . " , " . $row["district"] . " , " . $row["state"] . " - " . $row["pincode"];
                        $user["contact_no"] = $row["contact_no"];
                        $user["blocked"] = $row["blocked"];
                        $result[] = $user;
                    }
                    $response["records"] = $result;
                    $response["status"] = "success";
                    $response["message"] = "Users fetched successfuly";
                } else {
                    $response["status"] = "error";
                    $response["message"] = "Error in Query Execution";
                }
                break;
            case 'GET_SITES':
                $select_qry = "SELECT * FROM site_table";
                if ($res = mysqli_query($db, $select_qry)){
                    $result = array();
                    while ($row = mysqli_fetch_array($res)){
                        $site["sid"] = $row["sid"];
                        $site["name"] = $row["name"];
                        $site["address"] = $row["address"] . " , " . $row["district"] . " , " . $row["state"] . " - " . $row["pincode"];
                        $site["type"] = $row["type"];
                        $site["gid"] = $row["gid"];
                        $result[] = $site;
                    }
                    $response["records"] = $result;
                }else{
                    $response["status"] = "error";
                    $response["message"] = "Error in Query Execution";
                }
                break;
            case 'GET_PKG_CONTRACTORS':
                $select_qry = "SELECT * FROM package_contractors";
                if ($res = mysqli_query($db, $select_qry)){
                    $result = array();
                    while ($row = mysqli_fetch_array($res)){
                        $contractor["pkg_id"] = $row["pkg_id"];
                        $contractor["name"] = $row["name"];
                        $contractor["sid"] = $row["sid"];
                        $contractor["email"] = $row["email"];
                        $contractor["aadhar_uid"] = $row["aadhar_uid"];
                        $contractor["aadhar_string"] = $row["aadhar_string"];
                        $contractor["uid"] = $row["uid"];
                        $result[] = $contractor;
                    }
                    $response["records"] = $result;
                }else{
                    $response["status"] = "error";
                    $response["message"] = "Error in Query Execution";
                }
                break;
            case 'GET_CONTRACTORS':
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
                        $contractor["uid"] = $row["uid"];
                        $result[] = $contractor;
                    }
                    $response["records"] = $result;
                }else{
                    $response["status"] = "error";
                    $response["message"] = "Error in Query Execution";
                }
                break;
            case 'GET_ALL':
                $select_contract = "SELECT * FROM contract_users";
                $select_pkg_contract = "SELECT * FROM package_contractors";
                $select_sites = "SELECT * FROM site_table";
                $select_user = "SELECT * FROM users_table";
                $select_employees = "SELECT * FROM employee_table";
                $data = array();
                if ($res = mysqli_query($db, $select_contract)){
                    $result = array();
                    while ($row = mysqli_fetch_array($res)){
                        $contractor["cid"] = $row["cid"];
                        $contractor["name"] = $row["name"];
                        $contractor["sid"] = $row["sid"];
                        $contractor["email"] = $row["email"];
                        $contractor["aadhar_uid"] = $row["aadhar_uid"];
                        $contractor["aadhar_string"] = $row["aadhar_string"];
                        $contractor["uid"] = $row["uid"];
                        $result[] = $contractor;
                    }
                    $data["contractors"] = $result;
                }else{
                    $response["status"] = "error";
                    $response["message"] = "Error in Query Execution";
                }
                if ($res = mysqli_query($db, $select_pkg_contract)){
                    $result = array();
                    while ($row = mysqli_fetch_array($res)){
                        $contractor["pkg_id"] = $row["pkg_id"];
                        $contractor["name"] = $row["name"];
                        $contractor["sid"] = $row["sid"];
                        $contractor["email"] = $row["email"];
                        $contractor["aadhar_uid"] = $row["aadhar_uid"];
                        $contractor["aadhar_string"] = $row["aadhar_string"];
                        $contractor["uid"] = $row["uid"];
                        $result[] = $contractor;
                    }
                    $data["pkg_contractors"] = $result;
                }else{
                    $response["status"] = "error";
                    $response["message"] = "Error in Query Execution";
                }
                if ($res = mysqli_query($db, $select_sites)){
                    $result = array();
                    while ($row = mysqli_fetch_array($res)){
                        $site["sid"] = $row["sid"];
                        $site["name"] = $row["name"];
                        $site["address"] = $row["address"] . " , " . $row["district"] . " , " . $row["state"] . " - " . $row["pincode"];
                        $site["type"] = $row["type"];
                        $site["gid"] = $row["gid"];
                        $result[] = $site;
                    }
                    $data["sites"] = $result;
                }else{
                    $response["status"] = "error";
                    $response["message"] = "Error in Query Execution";
                }
                if ($res = mysqli_query($db, $select_user)) {
                    $result = array();
                    while ($row = mysqli_fetch_array($res)) {
                        $user["uid"] = $row["uid"];
                        $user["name"] = $row["first_name"] . " " . $row["last_name"];
                        $user["username"] = $row["username"];
                        $user["aadhar_uid"] = $row["aadhar_uid"];
                        $user["email_id"] = $row["email_id"];
                        $user["address"] = $row["address_1"] . " , " . $row["address_2"] . " , " . $row["district"] . " , " . $row["state"] . " - " . $row["pincode"];
                        $user["contact_no"] = $row["contact_no"];
                        $user["blocked"] = $row["blocked"];
                        $result[] = $user;
                    }
                    $data["users"] = $result;
                } else {
                    $response["status"] = "error";
                    $response["message"] = "Error in Query Execution";
                }
                if ($res = mysqli_query($db, $select_employees)){
                    $result = array();
                    while ($row = mysqli_fetch_array($res)){
                        $employee["eid"] = $row["eid"];
                        $employee["name"] = $row["name"];
                        $employee["cid"] = $row["cid"];
                        $employee["auth"] = $row["auth"];
                        $employee["aadhar_uid"] = $row["aadhar_uid"];
                        $employee["aadhar_string"] = $row["aadhar_string"];
                        $employee["skill"] = $row["skill"];
                        $employee["emp_type"] = $row["emp_type"];
                        $result[] = $employee;
                    }
                    $data["employees"] = $result;
                }else{
                    $response["status"] = "error";
                    $response["message"] = "Error in Query Execution";
                }
                $response["records"] = $data;
                break;
            default:
                $response['status'] = "error";
                $response['message'] = "Switch case error";
                break;
        }
    }

    echo json_encode($response);
?>