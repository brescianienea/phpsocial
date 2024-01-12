<?php
class Post {
    static function getPostsByID($userData)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $userID = $userData;
            $response = [];
            if (!empty($userID)) {
                $query = "SELECT post_id, content, datetime_posted FROM posts";
                $query .= " WHERE user_id = " . $userID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_assoc();
                    return $result;
                } else {
                    return null;
                }
    
            } else {
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    
}