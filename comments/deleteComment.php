<?php

require_once '../comments/Comments.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id'])) {

        $id = $_POST['id'];

        if (CommentsController::deleteCommentsById($id)) {
            $response['error'] = FALSE;
            $response['message'] = 'Delete comment';
        } else {
            $response['error'] = TRUE;
            $response['message'] = 'Can\'t delete this comment';
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
