<?php

require_once '../controller/db_functions.php';

class CommentsController extends DB_Functions
{
    public static function deleteCommentsByPostId($postId)
    {
        return parent::db()->deleteComment($postId);
    }

    public static function deleteCommentReplyByCommentId($commentId)
    {
        return parent::db()->deleteCommentReply($commentId);
    }

    public static function deleteCommentsById($id)
    {
        return parent::db()->deleteCommentById($id);
    }

    public static function deleteCommentRepliesById($id)
    {
        return parent::db()->deleteCommentReplyById($id);
    }
}

