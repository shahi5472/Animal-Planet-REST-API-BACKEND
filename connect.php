<?php

class Connect
{
    private $connect;

    public function connection()
    {
        require_once 'config.php';
        $this->connect = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        return $this->connect;
    }
}