<?php

include "../controller/db_functions.php";
include "../post/PostController.php";

class DashboardValue extends DB_Functions
{
    public static function getUserValue()
    {
        return self::db()->getCountValue('user');
    }

    public static function getTotalDoctor()
    {
        return self::db()->getCountValue('doctor');
    }

    public static function getPostValue()
    {
        return self::db()->getCountPostValue();
    }

    public static function getNewPost()
    {
        return PostController::index(null);
    }

    public static function getAllDoctor()
    {
        return self::db()->getDoctors();
    }

    public static function getAllHospitalList()
    {
        return self::db()->getAllHospital();
    }

    public static function getDoctorImage($id)
    {
        $value = self::db()->getImages('doctor', $id);
        if (!empty($value)) {
            return $value[0]['url'];
        } else {
            return null;
        }

    }

    public static function getSingleDoctorDetails($id)
    {
        return self::db()->getDoctorDetails($id);
    }
}
