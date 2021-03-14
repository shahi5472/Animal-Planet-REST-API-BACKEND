<?php

require_once '../controller/db_functions.php';
require_once '../auth/Session.php';

Session::init();

$db = new DB_Functions();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id'])) {

        $id = $_POST['id'];
        $name = $_POST['name'] == null ? Session::get('name') : $_POST['name'];
        $email = Session::get('email');
        $user_type = Session::get('user_type');
        $phone = $_POST['phone'] == null ? Session::get('phone') : $_POST['phone'];
        $address = $_POST['address'] == null ? Session::get('address') : $_POST['address'];
        $updated_at = date("Y-m-d") . ' ' . date("h:i:s");

        if (!empty($_FILES['file']['name'])) {
            $photo = explode(".", $_FILES['file']['name']);
            $photo = end($photo);
            $photo_name = "IMG_" . rand(10000000000, 9999999999999) . "." . $photo;
            $db->imageInsert($photo_name, $user_type, $id, $updated_at, $updated_at);
            move_uploaded_file($_FILES['file']['tmp_name'], '../userview/uploads/' . $photo_name);
        }

        if ($db->checkUser(null, $id)) {
            if ($db->updateUser($id, $name, $phone, $address, $updated_at)) {
                $userData = $db->getUser(null, $id);

                Session::set("name", $userData['name']);
                Session::set("email", $userData['email']);
                Session::set("user_type", $userData['user_type']);
                Session::set("phone", $userData['phone']);
                Session::set("address", $userData['address']);
                Session::set("specialists", $userData['specialists']);
                Session::set("image", $db->getImages(Session::get('user_type'), $userData['id'])[0]['url']);

                $response['error'] = FALSE;
                $response['message'] = 'Update successful';
                $response['user'] = $userData;
                $response['user']['image'] = $db->getImages('user', $_POST['id'])[0]['url'];
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