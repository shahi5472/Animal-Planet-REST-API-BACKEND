<?php

class DB_Functions
{
    private $conn;

    function __construct()
    {
        require_once 'connect.php';
        $db = new Connect();
        $this->conn = $db->connection();
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    public function checkUser($email)
    {
        $result = $this->conn->prepare("SELECT email FROM users WHERE email=? LIMIT 1");
        $result->bind_param("s", $email);//1s means 1value send, 2s means 2value send;
        $result->execute();
        $result->store_result();
        if ($result->num_rows > 0) {
            $result->close();
            return true;
        } else {
            $result->close();
            return false;
        }
    }

    function getUser($email)
    {
        $result = $this->conn->prepare("SELECT id, name, email,user_type, phone, address, specialists, created_at, updated_at FROM users WHERE email=? LIMIT 1");
        $result->bind_param("s", $email);//1s means 1value send, 2s means 2value send;
        $result->execute();
        $user = $result->get_result()->fetch_assoc();
        $result->close();
        return $user;
    }

    function login($password)
    {
        $hashPassword = hash("sha512", $password);
        $result = $this->conn->prepare("SELECT password FROM users WHERE password=? LIMIT 1");
        $result->bind_param("s", $hashPassword);//1s means 1value send, 2s means 2value send;
        $result->execute();
        $result->store_result();
        if ($result->num_rows > 0) {
            $result->close();
            return true;
        } else {
            $result->close();
            return false;
        }
    }

    function register($name, $email, $user_type, $phone, $address, $specialists, $password, $created_at, $updated_at)
    {
        $hashPassword = hash("sha512", $password);
        $result = $this->conn->prepare("INSERT INTO `users`( `name`, `email`, `user_type`, `phone`, `address`, `specialists`, `password`, `created_at`, `updated_at`) VALUES (?,?,?,?,?,?,?,?,?)");
        $result->bind_param("sssssssss", $name, $email, $user_type, $phone, $address, $specialists, $hashPassword, $created_at, $updated_at);
        $register = $result->execute();
        $result->close();
        if ($register) {
            return true;
        } else {
            return false;
        }
    }
}