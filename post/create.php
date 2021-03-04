<?php

require_once '../controller/db_functions.php';

require_once '../post/PostController.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['animalType']) && isset($_POST['userId'])) {

        $title = $_POST['title'];
        $description = $_POST['description'];
        $animalType = $_POST['animalType'];
        $userId = $_POST['userId'];
        $created_at = date("Y-m-d  h:i:s");
        $updated_at = date("Y-m-d  h:i:s");

        $result = $db->createPost($title, $description, $animalType, $userId, $created_at, $updated_at);

        if ($result) {
            $response['error'] = FALSE;
            $response['message'] = 'Create post successful';
            $post_data = PostController::getSinglePostById($result);
            $response = $post_data;
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

