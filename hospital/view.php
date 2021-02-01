<?php

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if ($db->checkHospital($id)) {

            $response['error'] = TRUE;
            $response['message'] = 'Hospital information';
            $response['hospital'] = $db->getHospitalById($id);

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
