<?php

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['contact'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $created_at = date("Y-m-d  h:i:s");
        $updated_at = date("Y-m-d  h:i:s");

        if ($db->createHospital($name, $address, $contact, $created_at, $updated_at)) {
            $response['error'] = FALSE;
            $response['message'] = 'Create hospital successful';
            $response['hospital'] = $db->getAllHospital();
        } else {
            $response['error'] = TRUE;
            $response['message'] = 'Require fields are missing, try again';
        }
        echo json_encode($response);
    } else {
        $response['error'] = TRUE;
        $response['message'] = 'Something is wrong, try again';
        echo json_encode($response);
    }
} else {
    $response['error'] = TRUE;
    $response['message'] = 'Wrong request method';
    echo json_encode($response);
}


