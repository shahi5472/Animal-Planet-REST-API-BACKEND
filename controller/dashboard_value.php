<?php

include "../controller/db_functions.php";

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


}
