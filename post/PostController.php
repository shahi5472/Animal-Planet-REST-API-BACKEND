<?php

require_once '../controller/db_functions.php';

class PostController extends DB_Functions
{
    public static function index()
    {
        $posts = self::db()->getAllPost();

        for ($i = 0; $i < count($posts); $i++) {
            $response = $posts[$i];
            $response['user'] = self::db()->getUser(null, $posts[$i]['user_id']);
            $response['doctor'] = self::db()->getUser(null, $posts[$i]['doctor_id']);
            $response['images'] = self::db()->getImages('post', $posts[$i]['id']);

            $comments = self::db()->getAllPostComments($posts[$i]['id']);

            for ($k = 0; $k < count($comments); $k++) {
                $response['comments'][] = $comments[$k];
                $response['comments'][$k]['user'] = self::db()->getUser(null, $comments[$k]['user_id']);

                $response['comments'][$k]['replies'] = self::db()->getAllCommentReplies($comments[$k]['id']);

                for ($l = 0; $l < count($response['comments'][$k]['replies']); $l++) {
                    $response['comments'][$k]['replies'][$l]['user'] = self::db()->getUser(null, $response['comments'][$k]['replies'][$l]['user_id']);
                }

            }

            $item[] = $response;
        }
        return $item;
    }

    public static function getSinglePostById($id)
    {
        $post_data = self::db()->getSinglePost($id);

        self::viewCountUpdate($post_data['view_count'], $id);

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

    public static function viewCountUpdate($lastNumber, $id)
    {
        self::db()->updateViewCount(($lastNumber + 1), $id);
    }
}