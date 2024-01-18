<?php
class Notification {

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
                    //$result = $result->fetch_assoc();
                    $not = [];
                    $i = 0;
                    while ($i < $result->num_rows) {
                        $row = $result->fetch_assoc();
                        array_push($not, $row);
                        $i++;
                    }
                    return $not;
                } else {
                    return [];
                }
    
            } else {
                return [];
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
                    //$result = $result->fetch_assoc();
                    $not = [];
                    $i = 0;
                    while ($i < $result->num_rows) {
                        $row = $result->fetch_assoc();
                        array_push($not, $row);
                        $i++;
                    }
                    return $not;
                } else {
                    return [];
                }
    
            } else {
                return [];
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    static function addNotification($user_id, $friendreq_notification, $chat_notification, $reset = false) {
    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $ds = DIRECTORY_SEPARATOR;
        $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
        require("{$base_dir}dbcon.php");
        $db = $conn;
        $user_id = $user_id;
        $friendreq_notification = $friendreq_notification;
        $chat_notification = $chat_notification;
        $response = [];
        if (!empty($user_id) && !empty($friendreq_notification) && !empty($chat_notification)) {
            if(!$reset) {
                $query = "SELECT friendreq_notification, chat_notification FROM notifications";
                $query .= " WHERE user_id = " . $user_id;
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    $fr = $result['friendreq_notification'] + $friendreq_notification;
                    $cn = $result['chat_notification'] + $chat_notification;
                    $query = "INSERT INTO `notifications` (`user_id`, `friendreq_notification`, `chat_notification`) VALUES ('$user_id', '$fr', '$cn')";
                    $db->query($query);
                }
            } else {
                if($friendreq_notification == 1) {
                    $friendreq_notification = 0;
                    $query = "INSERT INTO `notifications` (`user_id`, `friendreq_notification`) VALUES ('$user_id', '$friendreq_notification')";
                    $db->query($query);
                }
                if($chat_notification == 1) {
                    $chat_notification = 0;
                    $query = "INSERT INTO `notifications` (`user_id`, `chat_notification`) VALUES ('$user_id', '$chat_notification')";
                    $db->query($query);
                }
                
            }
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
    }

    static function addChatNotification($receiver_id, $sender_id, $unread, $reset = false) {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $receiver_id = $receiver_id;
            $sender_id = $sender_id;
            $unread = $unread;
            $response = [];
            if (!empty($receiver_id) && !empty($sender_id) && !empty($unread)) {
                $query = "INSERT INTO `notifications` (`receiver_id`, `sender_id`, `unread`) VALUES ('$receiver_id', '$sender_id', '$unread')";
                $db->query($query);
                $response['message'] = "success";
            } else {
                $response['message'] = "Some required fields are empty";
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        echo json_encode($response);
    }
}