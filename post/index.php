<?php

require_once '../post/PostController.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['searchValue'])) {
        $value = $_GET;
        $response = PostController::index($value);
    } else {
        $response = PostController::index(null);
    }

    echo json_encode($response);

} else {
    $response['error'] = TRUE;
    $response['message'] = 'Wrong request method';
    echo json_encode($response);
}