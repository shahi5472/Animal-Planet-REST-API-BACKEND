<?php
date_default_timezone_set("Asia/Dhaka");

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $userId = $_POST['userId'];
    $data = $_POST['data'];
    $created_at = date("Y-m-d  h:i:s");
    $updated_at = date("Y-m-d  h:i:s");

    if ($db->createNotification($userId, $data, $created_at, $updated_at)) {
        $response['error'] = FALSE;
        $response['message'] = 'Notification successful';
    } else {
        $response['error'] = TRUE;
        $response['message'] = 'invalid error';
    }

    echo json_encode($response);
} else {
    $response['error'] = TRUE;
    $response['message'] = 'Wrong request method';
    echo json_encode($response);
}


