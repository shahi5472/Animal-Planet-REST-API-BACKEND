<?php


class Session
{

    public static function init()
    {
        session_start();
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function destroy()
    {
        session_destroy();
        unset($_SESSION["id"]);
        unset($_SESSION["name"]);
        unset($_SESSION["email"]);
        unset($_SESSION["user_type"]);
        unset($_SESSION["phone"]);
        unset($_SESSION["address"]);
        unset($_SESSION["specialists"]);
        unset($_SESSION["image"]);
        header("Location:login.php");
    }

}