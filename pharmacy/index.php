<?php

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $pharmacies = $db->getAllPharmacy();

    $response['error'] = FALSE;
    $response['message'] = 'All pharmacy';
    $response['pharmacies'] = $pharmacies;
    echo json_encode($response);

} else {
    $response['error'] = TRUE;
    $response['message'] = 'Wrong request method';
    echo json_encode($response);
}



