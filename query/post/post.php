<?php
class Post {

    static function getPostsByID($userData, $tenorTag = null, $gameTag = null, $sorting = null)
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
                $query = "";
                if($sorting == null) {
                    $query = "SELECT * FROM post";
                    $query .= " WHERE member_id = " . $userID;
                } else if($sorting == "popularity") {
                    $query = "SELECT post.* FROM post LEFT JOIN likes ON post.post_id=likes.post_id";
                    $query .= " WHERE member_id = " . $userID;
                }
                if($tenorTag != null) {
                    $query .= " AND WHERE tenor_tag = " . $tenorTag;
                }
                if($gameTag != null) {
                    $query .= " AND WHERE game_tag = " . $gameTag;
                }
                if($sorting == "popularity") {
                    $query .= " GROUP BY post.post_id ORDER BY likes."
                }
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    //$result = $result->fetch_assoc();
                    $posts = [];
                    $i = 0;
                    while ($i < $result->num_rows) {
                        $row = $result->fetch_assoc();
                        array_push($posts, $row);
                        $i++;
                    }

                    return $posts;
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

    static function getPostsByMultipleIDs($userData, $tenorTag = null, $gameTag = null, $sorting = null)
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
                $posts = [];
                $users = "";
                foreach($userID as $ID) {
                    if($users == "") {
                        $users = " WHERE member_id = " . $ID;
                    } else {
                        $users .= " OR member_id = " . $ID;
                    }
                }
                if ($users != "") {
                    $query = "";
                    if($sorting == null) {
                        $query = "SELECT * FROM post";
                        $query .= " WHERE member_id = " . $userID;
                    } else if($sorting == "popularity") {
                        $query = "SELECT post.* FROM post LEFT JOIN likes ON post.post_id=likes.post_id";
                        $query .= " WHERE member_id = " . $userID;
                    }
                    if($tenorTag != null) {
                        $query .= " AND WHERE tenor_tag = " . $tenorTag;
                    }
                    if($gameTag != null) {
                        $query .= " AND WHERE game_tag = " . $gameTag;
                    }
                    if($sorting == "popularity") {
                        $query .= " GROUP BY post.post_id ORDER BY likes."
                    }
                    $result = $db->query($query);
                    if ($result->num_rows > 0) {
                        //$result = $result->fetch_assoc();
                        $i = 0;
                        while ($i < $result->num_rows) {
                            $row = $result->fetch_assoc();
                            array_push($posts, $row);
                            $i++;
                        }
                    }
                }
                return $posts;
            } else {
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getPostsByPostID($userData, $tenorTag = null, $gameTag = null, $sorting = null)
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
            if (!empty($postID)) {
                $query = "";
                if($sorting == null) {
                    $query = "SELECT * FROM post";
                    $query .= " WHERE post_id = " . $postID;
                } else if($sorting == "popularity") {
                    $query = "SELECT post.*, COUNT(like FROM post LEFT JOIN likes ON post.post_id=likes.post_id";
                    $query .= " WHERE post_id = " . $postID;
                }
                if($tenorTag != null) {
                    $query .= " AND WHERE tenor_tag = " . $tenorTag;
                }
                if($gameTag != null) {
                    $query .= " AND WHERE game_tag = " . $gameTag;
                }
                if($sorting == "popularity") {
                    $query .= " GROUP BY post.post_id ORDER BY likes."
                }
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

    static function getAllPosts($tenorTag = null, $gameTag = null, $sorting = null)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $response = [];
            $query = "";
                if($sorting == null) {
                    $query = "SELECT * FROM post";
                } else if($sorting == "popularity") {
                    $query = "SELECT post.* FROM post LEFT JOIN likes ON post.post_id=likes.post_id";
                }
                if($tenorTag != null) {
                    $query .= " AND WHERE tenor_tag = " . $tenorTag;
                }
                if($gameTag != null) {
                    $query .= " AND WHERE game_tag = " . $gameTag;
                }
                if($sorting == "popularity") {
                    $query .= " GROUP BY post.post_id ORDER BY likes."
                }
            $result = $db->query($query);
            if ($result->num_rows > 0) {
                $result = $result->fetch_assoc();
                return $result;
            } else {
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }
}