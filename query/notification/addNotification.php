<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}dbcon.php");
?>
<?php
require_once("../user/user.php");
$db = $conn;
$userData = $_POST;
addNotification($db, $userData);

function addNotification($db, $userData)
{
    $user_id = $_SESSION['user_id'];
    $friendreq_notification = $userData['friendreq_notification'];
    $chat_notification = $userData['chat_notification'];
    $response = [];

    try {
        if (!empty($user_id) && !empty($friendreq_notification) && !empty($chat_notification)) {
            $query = "INSERT INTO `notifications` (`user_id`, `friendreq_notification`, `chat_notification`) VALUES ('$user_id', '$friendreq_notification', '$chat_notification')";
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