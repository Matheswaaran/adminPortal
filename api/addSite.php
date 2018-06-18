<?php
    include 'includes/SessionUtils.php';
    $session = new SessionUtils();
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $name = $request->name;
    $address_1 = $request->address_1;
    $address_2 = $request->address_2;
    $district = $request->district;
    $state = $request->state;
    $pincode = $request->pincode;
    $type = $request->type;
    $admin_id = $request->admin_id;
    $response = array();

    $db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);

    if (!$db){
        $response['status'] = "error";
        $response['message'] = "Error in Connection";
    }else{
        $insert_sql = "INSERT INTO site_table(name, address_1, address_2, district, state, pincode, type, admin_id) VALUES ('$name','$address_1', '$address_2','$district','$state', '$pincode','$type','$admin_id')";

        if (mysqli_query($db, $insert_sql)){
            $response['status'] = "success";
            $response['message'] = "Site added successfully";
        }else{
            $response['status'] = "error";
            $response['message'] = "Error in Query Execution";
        }
    }

    echo json_encode($response);
?>