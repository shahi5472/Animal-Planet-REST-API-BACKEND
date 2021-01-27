<?php

require_once '../controller/db_functions.php';

$db = new DB_Functions();

$response = array();

$item = array();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $response['error'] = FALSE;
    $response['message'] = 'All Posts';

    $posts = $db->getAllPost();

    for ($i = 0; $i < count($posts); $i++) {
        $response = $posts[$i];
        $response['user'] = $db->getUser(null, $posts[$i]['user_id']);
        $response['doctor'] = $db->getUser(null, $posts[$i]['doctor_id']);
        $response['images'] = $db->getImages('post', $posts[$i]['id']);

        $comments = $db->getAllPostComments($posts[$i]['id']);

        for ($k = 0; $k < count($comments); $k++) {
            $response['comments'][] = $comments[$k];
            $response['comments'][$k]['user'] = $db->getUser(null, $comments[$k]['user_id']);

            $response['comments'][$k]['replies'] = $db->getAllCommentReplies($comments[$k]['id']);

            for ($l = 0; $l < count($response['comments'][$k]['replies']); $l++) {
                $response['comments'][$k]['replies'][$l]['user'] = $db->getUser(null, $response['comments'][$k]['replies'][$l]['user_id']);
            }

        }

        $item[] = $response;
    }

    echo json_encode($item);

} else {
    $response['error'] = TRUE;
    $response['message'] = 'Wrong request method';
    echo json_encode($response);
}