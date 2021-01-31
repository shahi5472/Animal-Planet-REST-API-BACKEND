<?php

require_once '../post/PostController.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $response = PostController::index();

    echo json_encode($response);

} else {
    $response['error'] = TRUE;
    $response['message'] = 'Wrong request method';
    echo json_encode($response);
}