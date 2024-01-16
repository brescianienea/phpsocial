<?php
class Message {
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
                $query = "SELECT message_id, sender_id, content, datetime_posted FROM messages";
                $query .= " WHERE sender_id = " . $senderID . " AND";
                $query .= " receiver_id = " . $receiverID;
                $query .= " OR sender_id = " . $receiverID;
                $query .= " AND receiver_id = " . $senderID;
                $query .= " ORDER BY datetime_sent DESC";
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    //$result = $result->fetch_assoc();
                    $mex = [];
                    $i = 0;
                    while ($i < $result->num_rows) {
                        $row = $result->fetch_assoc();
                        array_push($mex, $row);
                        $i++;
                    }
                    return $mex;
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

    static function getAllChats($user_id)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
            require("{$base_dir}dbcon.php");
            $db = $conn;
            $user_id = $user_id;
            $response = [];
            if (!empty($user_id)) {
                $query = "SELECT DISTINCT sender_id, receiver_id FROM messages";
                $query .= " WHERE sender_id = " . $senderID . " AND";
                $query .= " receiver_id = " . $receiverID;
                $query .= " OR sender_id = " . $receiverID;
                $query .= " AND receiver_id = " . $senderID;
                $result = $db->query($query);
                $result = array_reverse($result);
                if ($result->num_rows > 0) {
                    //$result = $result->fetch_assoc();
                    $mex = [];
                    $i = 0;
                    while ($i < $result->num_rows) {
                        $row = $result->fetch_assoc();
                        array_push($mex, $row);
                        $i++;
                    }
                    return $mex;
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
}