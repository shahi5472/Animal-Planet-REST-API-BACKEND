<?php
date_default_timezone_set("Asia/Dhaka");

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['contact'])) {

        $name = $_POST['name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $created_at = date("Y-m-d  h:i:s");
        $updated_at = date("Y-m-d  h:i:s");

        if (!empty($_FILES['file']['name'])) {
            $photo = explode(".", $_FILES['file']['name']);
            $photo = end($photo);
            $photo_name = "IMG_" . rand(10000000000, 9999999999999) . "." . $photo;
        }

        $result = $db->createPharmacy($name, $address, $contact, $created_at, $updated_at);
        if ($result) {
            $response['error'] = FALSE;
            $response['message'] = 'Create Pharmacy successful';

            $db->imageInsert($photo_name, 'pharmacy', $result, $created_at, $updated_at);
            move_uploaded_file($_FILES['file']['tmp_name'], '../userview/uploads/' . $photo_name);

        } else {
            $response['error'] = TRUE;
            $response['message'] = 'Require fields are missing, try again';
        }
        echo json_encode($response);
    } else {
        $response['error'] = TRUE;
        $response['message'] = 'Something is wrong, try again ' . $_POST['name'];
        echo json_encode($response);
    }
} else {
    $response['error'] = TRUE;
    $response['message'] = 'Wrong request method';
    echo json_encode($response);
}


