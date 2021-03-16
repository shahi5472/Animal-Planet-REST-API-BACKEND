<?php

require_once '../post/PostController.php';
require_once '../auth/Session.php';

Session::init();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['post_id'])) {

        $doctorId = Session::get('id');
        $postId = $_POST['post_id'];

        if (PostController::doctorTakenUpdate($doctorId, $postId)) {
            $response['error'] = FALSE;
            $response['message'] = 'You taken this post.';
        } else {
            $response['error'] = TRUE;
            $response['message'] = 'Internal server error';
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

