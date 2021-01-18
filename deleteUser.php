<?php

require_once 'db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        if ($db->checkUser(null, $id)) {
            $response['error'] = FALSE;
            $response['message'] = 'Successful';
            $response['user'] = [];
        } else {
            $response['error'] = TRUE;
            $response['message'] = 'User not found';
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