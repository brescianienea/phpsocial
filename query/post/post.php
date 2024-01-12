<?php

class Post
{
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
                $query = "SELECT post_id, content, datetime_posted, tenor_tag, game_tag FROM post";
                $query .= " WHERE member_id = " . $userID;
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

    static function getPostsByPostID($userData)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $postID = $userData;
            $response = [];
            if (!empty($userID)) {
                $query = "SELECT member_id, content, datetime_posted, tenor_tag, game_tag FROM post";
                $query .= " WHERE post_id = " . $userID;
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