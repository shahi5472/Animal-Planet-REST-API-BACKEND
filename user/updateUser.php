<?php

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id'])) {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $user_type = $_POST['user_type'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $specialists = $_POST['specialists'];
        $updated_at = date("Y-m-d") . ' ' . date("h:i:s");

        if ($db->checkUser(null, $id)) {
            if ($db->updateUser($id, $name, $email, $user_type, $phone, $address, $specialists, $updated_at)) {
                $response['error'] = FALSE;
                $response['message'] = 'Update successful';
                $response['user'] = $db->getUser(null, $id);
                Session::set("name", $response['name']);
                Session::set("email", $response['email']);
                Session::set("user_type", $response['user_type']);
                Session::set("phone", $response['phone']);
                Session::set("address", $response['address']);
                Session::set("specialists", $response['specialists']);
            } else {
                $response['error'] = TRUE;
                $response['message'] = 'Update failed';
            }
        } else {
            $response['error'] = TRUE;
            $response['message'] = 'User not found';
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