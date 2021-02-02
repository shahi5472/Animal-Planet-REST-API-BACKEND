<?php

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['postId']) && isset($_POST['userId']) && isset($_POST['message'])) {

        $postId = $_POST['postId'];
        $userId = $_POST['userId'];
        $message = $_POST['message'];
        $created_at = date("Y-m-d  h:i:s");
        $updated_at = date("Y-m-d  h:i:s");

        if ($db->insertComment($postId, $userId, $message, $created_at, $updated_at)) {
            $response['error'] = TRUE;
            $response['message'] = 'successful';
        } else {
            $response['error'] = FALSE;
            $response['message'] = 'invalid error';
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
