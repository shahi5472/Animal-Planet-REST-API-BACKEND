<?php

class  DB_Functions
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

    public static function db()
    {
        return new DB_Functions();
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

//    function updateUser($id, $name, $user_type, $phone, $address, $specialists, $updated_at)
    function updateUser($id, $name, $phone, $address, $updated_at)
    {
        $result = $this->conn->prepare("UPDATE `users` SET `name`=?, `phone`=?,`address`=?, `updated_at`=? WHERE `id` = ?;");
        //$result = $this->conn->prepare("UPDATE users SET name=?, user_type =?, phone =?, address =?, specialists =?, updated_at=? WHERE id = ?");
//        $result->bind_param("ssssssi", $name, $user_type, $phone, $address, $specialists, $updated_at, $id);
        $result->bind_param("ssssi", $name, $phone, $address, $updated_at, $id);
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
        $result = $this->conn->prepare("SELECT hospitals.*, images.url as URL
FROM hospitals
INNER JOIN images ON hospitals.id=images.user_id
WHERE images.image_src = 'hospital'");
        $result->execute();
        $hospitals = $result->get_result()->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $hospitals;
    }

    function getAllPharmacy()
    {
        $result = $this->conn->prepare("SELECT pharmacys.*, images.url as URL
FROM pharmacys
INNER JOIN images ON pharmacys.id=images.user_id
WHERE images.image_src = 'pharmacy';");
        $result->execute();
        $pharmacy = $result->get_result()->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $pharmacy;
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

    function checkPharmacy($id)
    {
        $result = $this->conn->prepare("SELECT * FROM `pharmacys` WHERE id = ? LIMIT 1");
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
        $result->execute();
        $hospital = $result->insert_id;
        $result->close();
        if ($hospital) {
            return $hospital;
        } else {
            return false;
        }
    }

    function createPharmacy($name, $address, $contact, $created_at, $updated_at)
    {
        $result = $this->conn->prepare("INSERT INTO `pharmacys`(`name`, `address`, `contact`, `created_at`, `updated_at`) VALUES (?,?,?,?,?)");
        $result->bind_param("sssss", $name, $address, $contact, $created_at, $updated_at);
        $result->execute();
        $pharmacy = $result->insert_id;
        $result->close();
        if ($pharmacy) {
            return $pharmacy;
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

    function deletePharmacy($id)
    {
        $result = $this->conn->prepare("DELETE FROM `pharmacys` WHERE id =?");
        $result->bind_param("i", $id);
        $hospital = $result->execute();
        $result->close();
        if ($hospital) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * get all post with user information
     * Post create
     * post update
     * post doctor taken update
     * post view count
     * post delete by id
     *
     * delete comment
     * delete reply comment
     */

    function getAllPost()
    {
        $result = $this->conn->prepare("SELECT * FROM posts");
        $result->execute();
        $posts = $result->get_result()->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $posts;
    }

    function getSearchPost($value)
    {
//        $result = $this->conn->prepare("SELECT * FROM `posts` WHERE `title` LIKE ?");
//        $result->bind_param("s", $value);
//        $result->execute();
//        $posts = $result->get_result()->fetch_all(MYSQLI_ASSOC);
//        $result->close();
//        return $posts;

        $result = $this->conn->query("SELECT * FROM `posts` WHERE `title` LIKE '%$value%'");
        $posts = array();
        while ($item = mysqli_fetch_assoc($result)) {
            $posts[] = $item;
        }
        return $posts;
    }

    function getImages($image_src, $user_id)
    {
        $result = $this->conn->prepare("SELECT * FROM images WHERE image_src =? and user_id =? ORDER BY id DESC");
        $result->bind_param("ss", $image_src, $user_id);
        $result->execute();
        $images = $result->get_result()->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $images;
    }

    function getAllPostComments($post_id)
    {
        $result = $this->conn->prepare("SELECT * FROM comments WHERE post_id = ?");
        $result->bind_param("i", $post_id);
        $result->execute();
        $comments = $result->get_result()->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $comments;
    }

    function getAllCommentReplies($comment_id)
    {
        $result = $this->conn->prepare("SELECT * FROM comment_replies WHERE comment_id = ?");
        $result->bind_param("i", $comment_id);
        $result->execute();
        $replies = $result->get_result()->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $replies;
    }

    function getSinglePost($id)
    {
        $result = $this->conn->prepare("SELECT * FROM `posts` WHERE `id` = ?");
        $result->bind_param("i", $id);
        $result->execute();
        $singlePost = $result->get_result()->fetch_assoc();
        $result->close();
        return $singlePost;
    }

    function createPost($title, $description, $animalType, $userId, $created_at, $updated_at)
    {
        $result = $this->conn->prepare("INSERT INTO `posts`(`title`, `description`, `animal_type`, `user_id`,`created_at`, `updated_at`) VALUES (?,?,?,?,?,?);");
        $result->bind_param("sssiss", $title, $description, $animalType, $userId, $created_at, $updated_at);
        $result->execute();
        $post = $result->insert_id;
        $result->close();
        if ($post) {
            return $post;
        } else {
            return false;
        }
    }

    function imageInsert($url, $imageSrc, $userId, $created_at, $updated_at)
    {
        $result = $this->conn->prepare("INSERT INTO `images`(`url`, `image_src`, `user_id`, `created_at`, `updated_at`) VALUES (?,?,?,?,?);");
        $result->bind_param("ssiss", $url, $imageSrc, $userId, $created_at, $updated_at);
        $result->execute();
        $result->close();
    }

    function updateViewCount($lastNumber, $id)
    {
        $result = $this->conn->prepare("UPDATE `posts` SET `view_count`= ? WHERE `id` = ?");
        $result->bind_param("ii", $lastNumber, $id);
        $view = $result->execute();
        $result->close();
        if ($view) {
            return true;
        } else {
            return false;
        }
    }

    function updateDoctorTaken($doctorId, $postId, $ansIs = true)
    {
        $result = $this->conn->prepare("UPDATE `posts` SET `doctor_id`=?, `is_answered`=? WHERE `id` = ?");
        $result->bind_param("isi", $doctorId, $ansIs, $postId);
        $doctorTaken = $result->execute();
        $result->close();
        if ($doctorTaken) {
            return true;
        } else {
            return false;
        }
    }

    function deletePost($postId)
    {
        $result = $this->conn->prepare("DELETE FROM `posts` WHERE id =?");
        $result->bind_param("i", $postId);
        $post = $result->execute();
        $result->close();
        if ($post) {
            return true;
        } else {
            return false;
        }
    }

    function deleteComment($commentId)
    {
        $result = $this->conn->prepare("DELETE FROM `comments` WHERE `post_id` IN (?)");
        $result->bind_param("i", $commentId);
        $comment = $result->execute();
        $result->close();
        if ($comment) {
            return true;
        } else {
            return false;
        }
    }

    function deleteCommentById($id)
    {
        $result = $this->conn->prepare("DELETE FROM comments WHERE id = ?");
        $result->bind_param("i", $id);
        $delete = $result->execute();
        $result->close();
        if ($delete) {
            return true;
        } else {
            return false;
        }
    }

    function deleteCommentReply($commentReplyId)
    {
        $result = $this->conn->prepare("DELETE FROM `comment_replies` WHERE `comment_id` IN (?)");
        $result->bind_param("i", $commentReplyId);
        $commentReply = $result->execute();
        $result->close();
        if ($commentReply) {
            return true;
        } else {
            return false;
        }
    }

    function deleteCommentReplyById($id)
    {
        $result = $this->conn->prepare("DELETE FROM `comment_replies` WHERE `id` = ?");
        $result->bind_param("i", $id);
        $deleteReply = $result->execute();
        $result->close();
        if ($deleteReply) {
            return true;
        } else {
            return false;
        }
    }

    function insertComment($postId, $userId, $message, $createAt, $updateAt)
    {
        $result = $this->conn->prepare("INSERT INTO `comments`(`post_id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES (?,?,?,?,?);");
        $result->bind_param("iisss", $postId, $userId, $message, $createAt, $updateAt);
        $comment = $result->execute();
        $result->close();
        if ($comment) {
            return true;
        } else {
            return false;
        }
    }

    function insertReplyComment($commentId, $userId, $message, $createAt, $updateAt)
    {
        $result = $this->conn->prepare("INSERT INTO `comment_replies`(`comment_id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES (?,?,?,?,?);");
        $result->bind_param("iisss", $commentId, $userId, $message, $createAt, $updateAt);
        $replyComment = $result->execute();
        $result->close();
        if ($replyComment) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * notification
     * get all notification by user id
     * create notification
     * read notification
     */

    function getAllNotificationByUserId($userId)
    {
        $result = $this->conn->prepare("SELECT * FROM `notifications` WHERE `user_id` = ?");
        $result->bind_param("i", $userId);
        $result->execute();
        $notifications = $result->get_result()->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $notifications;
    }

    function createNotification($userId, $data, $commonId, $createAt, $updateAt)
    {
        $result = $this->conn->prepare("INSERT INTO `notifications`(`user_id`, `data`, `common_id`,`created_at`, `updated_at`) VALUES (?,?,?,?,?)");
        $result->bind_param("issss", $userId, $data, $commonId, $createAt, $updateAt);
        $notification = $result->execute();
        $result->close();
        if ($notification) {
            return true;
        } else {
            return false;
        }
    }

    function readNotification($notificationId, $userId, $dateTime)
    {
        $result = $this->conn->prepare("UPDATE `notifications` SET `read_at`= ? WHERE `user_id` = ? OR id IN (?)");
        $result->bind_param("sii", $dateTime, $userId, $notificationId);
        $notification = $result->execute();
        $result->close();
        if ($notification) {
            return true;
        } else {
            return false;
        }
    }

    function getCountValue($type)
    {
        $query = "SELECT * FROM `users` WHERE `user_type` = '$type';";
        $result = $this->conn->query($query) or die($this->conn->error . __LINE__);
        return $result->num_rows;
    }

    function getCountPostValue()
    {
        $query = "SELECT * FROM `posts`";
        $result = $this->conn->query($query) or die($this->conn->error . __LINE__);
        return $result->num_rows;
    }

    function getDoctorDetails($id)
    {
        $result = $this->conn->prepare("SELECT
  users.*,
  COUNT(posts.doctor_id) AS Total
FROM
  users 
LEFT JOIN posts ON users.id = posts.doctor_id
WHERE users.user_type = 'doctor' AND users.id = ?
GROUP BY users.id,users.name ORDER BY Total DESC;");
        $result->bind_param("i", $id);
        $result->execute();
        $doctor = $result->get_result()->fetch_assoc();
        $result->close();
        return $doctor;
    }

    function getDoctors()
    {
//        $query = "SELECT * FROM `users` WHERE `user_type` = 'doctor';";
        $query = "SELECT
  users.*,
  COUNT(posts.doctor_id) AS Total
FROM
  users 
LEFT JOIN posts ON users.id = posts.doctor_id
WHERE users.user_type = 'doctor'
GROUP BY users.id,users.name ORDER BY Total DESC;";
        $result = $this->conn->query($query) or die($this->conn->error . __LINE__);
        return $result;
    }

    function getDoctorAdmin()
    {
        $query = "SELECT `id`, `name` FROM `users` WHERE `user_type` = 'doctor' OR `user_type` = 'admin';";
        $result = $this->conn->query($query) or die($this->conn->error . __LINE__);
        return $result;
    }
}