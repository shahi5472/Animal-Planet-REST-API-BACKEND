<?php

require_once '../post/PostController.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $post_id = $_GET['postID'];

    if ($post_id != "") {

        $response['error'] = FALSE;
        $response['message'] = 'Post data';
        $response = PostController::getSinglePostById($post_id);

    } else {
        $response['error'] = TRUE;
        $response['message'] = 'Post id missing';
    }
    echo json_encode($response);

} else {
    $response['error'] = TRUE;
    $response['message'] = 'Wrong request method';
    echo json_encode($response);
}
