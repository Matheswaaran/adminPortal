<?php
    include 'includes/dbconfig.php';
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $removeError = false;
    $response = array();

    $db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);

    if (!$db){
        $response['status'] = "error";
        $response['message'] = "Error in Connection";
    } else {
        foreach ($request as $user){
            $remove_sql = "DELETE FROM users_table WHERE user_id = '$user->user_id'";
            if (mysqli_query($db, $remove_sql)){
                $removeError = false;
            }else{
                $removeError = true;
            }
        }

        if (!$removeError){
            $response['status'] = "success";
            $response['message'] = "Users Deleted Successfully";
        } else{
            $response['status'] = "error";
            $response['message'] = "Error in query execution";
        }
    }

    echo json_encode($response);

?>