<?php

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($db->checkUser($email, null)) {
            if ($db->login($password)) {
                $response['error'] = FALSE;
                $response['message'] = 'User information';
                $response['user'] = $db->getUser($email, null);
            } else {
                $response['error'] = TRUE;
                $response['message'] = 'Password incorrect';
            }
        } else {
            $response['error'] = TRUE;
            $response['message'] = $email . ' not found';
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
