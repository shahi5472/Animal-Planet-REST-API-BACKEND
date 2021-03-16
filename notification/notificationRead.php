<?php
date_default_timezone_set("Asia/Dhaka");

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $userId = $_GET['userId'];
    $notificationId = $_GET['notificationId'];
    $dateTime = date("Y-m-d  h:i:s");

    $notifications = $db->readNotification($notificationId, $userId, $dateTime);

    $response['error'] = FALSE;
    $response['message'] = 'Read notification';
    echo json_encode($response);

} else {
    $response['error'] = TRUE;
    $response['message'] = 'Wrong request method';
    echo json_encode($response);
}
