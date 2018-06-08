<?php
//    include 'includes/dbconfig.php';
    include 'includes/SessionUtils.php';

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $username = $request->username;
    $password = $request->password;
    $session = new SessionUtils();
    $en_password = $session->encryptIt($password);
    $response = array();

    if (isset($username) && isset($password)){
        $db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
        if (!$db){
            $response['status'] = "error";
            $response['message'] = "Error in Connection";
        }else{
            $select_sql = "SELECT * FROM admin_users WHERE username = '$username' AND password = '$en_password'";
            if ($select_sql = mysqli_query($db, $select_sql)){
                if (mysqli_num_rows($select_sql) == 1){
                    $select_arr = mysqli_fetch_array($select_sql, MYSQLI_ASSOC);
                    $session->AdminLogin($select_arr["admin_id"],$select_arr["username"]);
                    $response['status'] = "success";
                    $response['message'] = "Login Successful";
                }else{
                    $response['status'] = "error";
                    $response['message'] = "Invalid Credentials";
                }
            }else{
                $response['status'] = "error";
                $response['message'] = "Invalid Credentials";
            }
        }
    }else{
        $response['status'] = "error";
        $response['message'] = "Data is not passed to the APIs";
    }

    echo json_encode($response);
?>