<?php
date_default_timezone_set("Asia/Dhaka");

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['email']) && isset($_POST['user_type'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $user_type = $_POST['user_type'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $specialists = $_POST['specialists'];
        $password = 'admin';
        $created_at = date("Y-m-d h:i:s");
        $updated_at = date("Y-m-d h:i:s");

        if (!empty($_FILES['file']['name'])) {
            $photo = explode(".", $_FILES['file']['name']);
            $photo = end($photo);
            $photo_name = "IMG_" . rand(10000000000, 9999999999999) . "." . $photo;
        }

        if ($db->checkUser($email, null)) {
            $response['error'] = TRUE;
            $response['message'] = $email . 'Doctor already register';
        } else {
            if ($db->register($name, $email, $user_type, $phone, $address, $specialists, $password, $created_at, $updated_at)) {
                $response['error'] = FALSE;
                $response['message'] = 'Doctor Registration successful';
                $response['user'] = $db->getUser($email, null);

                $db->imageInsert($photo_name, 'doctor', $response['user']['id'], $created_at, $updated_at);
                move_uploaded_file($_FILES['file']['tmp_name'], '../userview/uploads/' . $photo_name);

            } else {
                $response['error'] = TRUE;
                $response['message'] = 'Doctor Register failed, try again';
            }
        }
        echo json_encode($response);
    } else {
        $response['error'] = TRUE;
        $response['message'] = 'Something wrong, try again';
        echo json_encode($response);
    }
} else {
    $response['error'] = TRUE;
    $response['message'] = 'Wrong request method';
    echo json_encode($response);
}
