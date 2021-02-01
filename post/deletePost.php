<?php

require_once '../post/PostController.php';
require_once '../commets/Comments.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if (PostController::deletePostById($id)) {
            if (CommentsController::deleteCommentsByPostId($id)) {
                $response['error'] = FALSE;
                $response['message'] = 'Successful';
            } else {
                $response['error'] = TRUE;
                $response['message'] = 'Unsuccessful';
            }
        } else {
            $response['error'] = TRUE;
            $response['message'] = 'Try again';
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
