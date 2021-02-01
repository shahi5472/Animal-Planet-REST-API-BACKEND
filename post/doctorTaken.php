<?php

require_once '../post/PostController.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['doctor_id']) && isset($_POST['post_id'])) {

        $doctorId = $_POST['doctor_id'];
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

