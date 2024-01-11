<?php
class InfoGetter {
    static function getUserInfoByID($userData)
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
                $query = "SELECT email, image, birthdate, status FROM members";
                $query .= " WHERE member_id = " . $userID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong userID");
                    return null;
                }
    
            } else {
                echo("Empty userID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getUsernameByID($userData)
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
                $query = "SELECT username FROM users";
                $query .= " WHERE user_id = " . $userID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong userID");
                    return null;
                }
    
            } else {
                echo("Empty userID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getIGNsByID($userData)
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
                $query = "SELECT ign FROM igns";
                $query .= " WHERE user_id = " . $userID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong userID");
                    return null;
                }
    
            } else {
                echo("Empty userID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getIDByIGN($userData)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $ign = $userData;
            $response = [];
            if (!empty($ign)) {
                $query = "SELECT user_id FROM igns";
                $query .= " WHERE ign = " . $ign;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong IGN");
                    return null;
                }
    
            } else {
                echo("Empty IGN");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getFriendsByID($userData)
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
                $query = "SELECT friends_id FROM friends";
                $query .= " WHERE my_id = " . $userID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong userID");
                    return null;
                }
    
            } else {
                echo("Empty userID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getIDByUsername($userData)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $username = $userData;
            $response = [];
            if (!empty($username)) {
                $query = "SELECT user_id FROM users";
                $query .= " WHERE username = " . $username;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong username");
                    return null;
                }
    
            } else {
                echo("Empty username");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getIDByEmail($userData)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $email = $userData;
            $response = [];
            if (!empty($email)) {
                $query = "SELECT user_id FROM members";
                $query .= " WHERE email = " . $email;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong email");
                    return null;
                }
    
            } else {
                echo("Empty email");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

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
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong userID");
                    return null;
                }
    
            } else {
                echo("Empty userID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getIDByPost($userData)
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
                $query = "SELECT user_id FROM posts";
                $query .= " WHERE post_id = " . $postID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong postID");
                    return null;
                }
    
            } else {
                echo("Empty postID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getMessagesSent($receiver, $sender)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $receiverID = $receiver;
            $senderID = $sender;
            $response = [];
            if (!empty($senderID) && !empty($receiverID)) {
                $query = "SELECT message_id, content, datetime_posted FROM messages";
                $query .= " WHERE sender_id = " . $senderID . " AND";
                $query .= " WHERE receiver_id = " . $receiverID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong ID");
                    return null;
                }
    
            } else {
                echo("Empty ID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getNotificationsByID($userData)
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
                $query = "SELECT friendreq_notification, chat_notification FROM notifications";
                $query .= " WHERE user_id = " . $userID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong userID");
                    return null;
                }
    
            } else {
                echo("Empty userID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getReactionsToComment($userData)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $commentID = $userData;
            $response = [];
            if (!empty($commentID)) {
                $query = "SELECT user_id FROM reaction";
                $query .= " WHERE comment_id = " . $commentID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong commentID");
                    return null;
                }
    
            } else {
                echo("Empty commentID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getReactionsByUser($userData)
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
                $query = "SELECT comment_id FROM reaction";
                $query .= " WHERE user_id = " . $userID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong userID");
                    return null;
                }
    
            } else {
                echo("Empty userID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getLikesByID($userData)
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
                $query = "SELECT post_id FROM likes";
                $query .= " WHERE user_id = " . $userID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong userID");
                    return null;
                }
    
            } else {
                echo("Empty userID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getIDsByLikes($userData)
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
                $query = "SELECT user_id FROM likes";
                $query .= " WHERE post_id = " . $postID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong postID");
                    return null;
                }
    
            } else {
                echo("Empty postID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getSpecificFriendRequest($receiver, $sender)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $receiverID = $receiver;
            $senderID = $sender;
            $response = [];
            if (!empty($senderID) && !empty($receiverID)) {
                $query = "SELECT sender, receiver FROM friend_requests";
                $query .= " WHERE sender = " . $senderID . " AND";
                $query .= " WHERE receiver = " . $receiverID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong ID");
                    return null;
                }
    
            } else {
                echo("Empty ID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getFriendRequestSent($userData)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $sender = $userData;
            $response = [];
            if (!empty($sender)) {
                $query = "SELECT receiver FROM friend_requests";
                $query .= " WHERE sender = " . $sender;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong senderID");
                    return null;
                }
    
            } else {
                echo("Empty senderID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getFriendRequestReceived($userData)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $receiver = $userData;
            $response = [];
            if (!empty($receiver)) {
                $query = "SELECT sender FROM friend_requests";
                $query .= " WHERE receiver = " . $receiver;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong receiverID");
                    return null;
                }
    
            } else {
                echo("Empty receiverID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getCommentsByPost($userData)
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
                $query = "SELECT id, user_id, content FROM comments";
                $query .= " WHERE comment_id = " . $postID; //comment_id è l'id del post lol
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong postID");
                    return null;
                }
    
            } else {
                echo("Empty postID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getCommentsByUser($userData)
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
                $query = "SELECT id, comment_id, content FROM comments"; //comment_id è l'id del post lol
                $query .= " WHERE user_id = " . $userID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong userID");
                    return null;
                }
    
            } else {
                echo("Empty userID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getCommentsByID($userData)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $commentID = $userData;
            $response = [];
            if (!empty($postID)) {
                $query = "SELECT user_id, comment_id, content FROM comments";
                $query .= " WHERE id = " . $commentID;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong commentID");
                    return null;
                }
    
            } else {
                echo("Empty commentID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getChatNotificationReceived($userData)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $receiver = $userData;
            $response = [];
            if (!empty($postID)) {
                $query = "SELECT sender_id, unread FROM chat_notifications";
                $query .= " WHERE receiver_id = " . $receiver;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong receiverID");
                    return null;
                }
    
            } else {
                echo("Empty receiverID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function getChatNotificationSent($userData)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $sender = $userData;
            $response = [];
            if (!empty($postID)) {
                $query = "SELECT receiver_id, unread FROM chat_notifications";
                $query .= " WHERE sender_id = " . $sender;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $result = $result->fetch_array(MYSQLI_BOTH);
                    return $result;
                } else {
                    echo("Wrong senderID");
                    return null;
                }
    
            } else {
                echo("Empty senderID");
                return null;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }
}