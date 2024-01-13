<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}dbcon.php");
?>
<?php
$db = $conn;
$userData = $_POST;
addFriendRequest($db, $userData);

function addFriendRequest($db, $userData) {
    $sender = $userData['sender'];
    $receiver = $userData['receiver'];
    $response = [];

    try {
        if (!empty($sender) && !empty($content)) {
            $query = "SELECT sender FROM friend_requests";
            $query .= " WHERE receiver = '$sender'";
            $result = $db->query($query);
            if ($result->num_rows > 0) {
                $response['message'] = "Friend request already sent by receiver.";
            } else {
                $query = "INSERT INTO `friend_requests` (`sender`, `receiver`) VALUES ('$sender', '$receiver')";
                $db->query($query);
                $response['message'] = "success";
                //$response = array_merge($response, $result->fetch_array(MYSQLI_BOTH));
            }
        } else {
            $response['message'] = "Some required fields are empty";
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
    echo json_encode($response);
}