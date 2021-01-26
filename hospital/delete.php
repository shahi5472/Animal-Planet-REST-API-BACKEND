<?php

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if ($db->checkHospital($id)) {

            if ($db->deleteHospital($id)) {
                $response['error'] = TRUE;
                $response['message'] = 'Hospital delete successful';
            } else {
                $response['error'] = FALSE;
                $response['message'] = 'Hospital delete failed';
            }
        } else {
            $response['error'] = TRUE;
            $response['message'] = 'This hospital id not found';
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
