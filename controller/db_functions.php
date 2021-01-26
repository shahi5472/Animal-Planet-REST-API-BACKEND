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

    function checkUser($email, $id)
    {
        $result = $this->conn->prepare("SELECT email FROM users WHERE email=? OR id = ? LIMIT 1");
        $result->bind_param("si", $email, $id);//1s means 1value send, 2s means 2value send;
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

    /*
     * User CRUD
     * getUser by email
     * update user
     * delete user
     */
    function getUser($email, $id)
    {
        $result = $this->conn->prepare("SELECT id, name, email,user_type, phone, address, specialists, created_at, updated_at FROM users WHERE email=? OR id = ? LIMIT 1");
        $result->bind_param("si", $email, $id);//1s means 1value send, 2s means 2value send;
        $result->execute();
        $user = $result->get_result()->fetch_assoc();
        $result->close();
        return $user;
    }

    function updateUser($id, $name, $email, $user_type, $phone, $address, $specialists, $updated_at)
    {
        $result = $this->conn->prepare("UPDATE users SET name=?, email =?, user_type =?, phone =?, address =?, specialists =?, updated_at=? WHERE id = ?");
        $result->bind_param("sssssssi", $name, $email, $user_type, $phone, $address, $specialists, $updated_at, $id);
        $user = $result->execute();
        $result->close();
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    function deleteUser($id)
    {
        $result = $this->conn->prepare("DELETE FROM users WHERE id =?");
        $result->bind_param("i", $id);
        $user = $result->execute();
        $result->close();
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Hospital CRUD start
     * getAllHospital
     * create a new hospital
     * update hospital where id = id
     * delete hospital where id = id
     * get Single hospital where id = id
     * check hospital for delete, view hospital and update
     */

    function getAllHospital()
    {
        $result = $this->conn->prepare("SELECT * FROM hospitals");
        $result->execute();
        $hospitals = $result->get_result()->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $hospitals;
    }

    function getHospitalById($id)
    {
        $result = $this->conn->prepare("SELECT * FROM `hospitals` WHERE id=?");
        $result->bind_param("i", $id);
        $result->execute();
        $hospitals = $result->get_result()->fetch_assoc();
        $result->close();
        return $hospitals;
    }

    function checkHospital($id)
    {
        $result = $this->conn->prepare("SELECT * FROM `hospitals` WHERE id = ? LIMIT 1");
        $result->bind_param("i", $id);//1s means 1value send, 2s means 2value send;
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

    function createHospital($name, $address, $contact, $created_at, $updated_at)
    {
        $result = $this->conn->prepare("INSERT INTO `hospitals`(`name`, `address`, `contact`, `created_at`, `updated_at`) VALUES (?,?,?,?,?)");
        $result->bind_param("sssss", $name, $address, $contact, $created_at, $updated_at);
        $hospital = $result->execute();
        $result->close();
        if ($hospital) {
            return true;
        } else {
            return false;
        }
    }

    function updateHospital($id, $name, $address, $contact, $updated_at)
    {
        $result = $this->conn->prepare("UPDATE `hospitals` SET `name`=?,`address`=?,`contact`=?,`updated_at`=? WHERE id =?");
        $result->bind_param("ssssi", $name, $address, $contact, $updated_at, $id);
        $hospital = $result->execute();
        $result->close();
        if ($hospital) {
            return true;
        } else {
            return false;
        }
    }

    function deleteHospital($id)
    {
        $result = $this->conn->prepare("DELETE FROM `hospitals` WHERE id =?");
        $result->bind_param("i", $id);
        $hospital = $result->execute();
        $result->close();
        if ($hospital) {
            return true;
        } else {
            return false;
        }
    }
}