<?php

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $userId = $_GET['userId'];

    $notifications = $db->getAllNotificationByUserId($userId);

    $response['error'] = FALSE;
    $response['message'] = 'All notification';
    $response['notifications'] = $notifications;
    echo json_encode($response);

} else {
    $response['error'] = TRUE;
    $response['message'] = 'Wrong request method';
    echo json_encode($response);
}
