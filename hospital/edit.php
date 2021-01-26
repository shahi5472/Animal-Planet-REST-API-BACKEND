<?php

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['address']) && isset($_POST['contact'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $updated_at = date("Y-m-d  h:i:s");

        if ($db->checkHospital($id)) {
            if ($db->updateHospital($id, $name, $address, $contact, $updated_at)) {
                $response['error'] = FALSE;
                $response['message'] = 'Update hospital successful';
                $response['hospital'] = $db->getHospitalById($id);
            } else {
                $response['error'] = TRUE;
                $response['message'] = 'Hospital update failed, try again';
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


