<?php

date_default_timezone_set("Asia/Dhaka");

require_once '../controller/db_functions.php';

class NotificationController extends DB_Functions
{
    public static function create($userId, $data, $postId)
    {
        $created_at = date("Y-m-d  h:i:s");
        $updated_at = date("Y-m-d  h:i:s");

        return self::db()->createNotification($userId, $data, $postId, $created_at, $updated_at);
    }

    public static function getNotification($userId)
    {
        return self::db()->getAllNotificationByUserId($userId);
    }

    public static function createDoctorAdminNotification($data, $postId)
    {
        $created_at = date("Y-m-d  h:i:s");
        $updated_at = date("Y-m-d  h:i:s");

        $result = self::db()->getDoctorAdmin();
        foreach ($result as $item) {
            self::db()->createNotification($item['id'], $data, $postId, $created_at, $updated_at);
        }
        return true;
    }
}