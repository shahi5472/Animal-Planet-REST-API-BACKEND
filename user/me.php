<?php

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if ($db->checkUser(null, $id)) {
            $response['error'] = FALSE;
            $response['message'] = 'User information';
            $response['user'] = $db->getUser(null, $id);
        } else {
            $response['error'] = TRUE;
            $response['message'] = 'User not found';
        }
        echo json_encode($response);
    } else {
        $response['error'] = TRUE;
        $response['message'] = 'Require field missing, try again';
        echo json_encode($response);
    }
} else {
    $response['error'] = TRUE;
    $response['message'] = 'Wrong request method';
    echo json_encode($response);
}
