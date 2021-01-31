<?php

require_once '../controller/db_functions.php';

class PostController extends DB_Functions
{
    private static function db()
    {
        return new DB_Functions();
    }

    public static function getSinglePostById($id)
    {
        $post_data = self::db()->getSinglePost($id);

        $response['post'] = $post_data;
        $response['post']['user'] = self::db()->getUser(null, $post_data['user_id']);
        $response['post']['doctor'] = self::db()->getUser(null, $post_data['doctor_id']);
        $response['post']['images'] = self::db()->getImages('post', $post_data['id']);

        $comments = self::db()->getAllPostComments($post_data['id']);

        for ($i = 0; $i < count($comments); $i++) {
            $response['post']['comments'][] = $comments[$i];
            $response['post']['comments'][$i]['user'] = self::db()->getUser(null, $comments[$i]['user_id']);

            $response['post']['comments'][$i]['replies'] = self::db()->getAllCommentReplies($comments[$i]['id']);

            for ($j = 0; $j < count($response['post']['comments'][$i]['replies']); $j++) {
                $response['post']['comments'][$i]['replies'][$j]['user'] = self::db()->getUser(null, $response['post']['comments'][$i]['replies'][$j]['user_id']);
            }
        }
        return $response;
    }
}