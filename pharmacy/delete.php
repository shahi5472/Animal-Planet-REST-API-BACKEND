<?php

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if ($db->checkPharmacy($id)) {

            if ($db->deletePharmacy($id)) {
                $response['error'] = TRUE;
                $response['message'] = 'Pharmacy delete successful';
            } else {
                $response['error'] = FALSE;
                $response['message'] = 'Pharmacy delete failed';
            }
        } else {
            $response['error'] = TRUE;
            $response['message'] = 'This Pharmacy id not found';
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
