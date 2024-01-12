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
                $query = "SELECT message_id, content, datetime_posted FROM messages";
                $query .= " WHERE sender_id = " . $senderID . " AND";
                $query .= " WHERE receiver_id = " . $receiverID;
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