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
addMessage($db, $userData);

function addMessage($db, $userData)
{
    $message_id = $_SESSION['message_id'];
    $sender_id = $userData['sender_id'];
    $receiver_id = $userData['receiver_id'];
    $content = $userData['content'];
    $datetime_sent = $userData['datetime_sent'];
    $response = [];

    try {
        if (!empty($message_id) && !empty($sender_id) && !empty($receiver_id) && !empty($content) && !empty($datetime_sent)) {
            $query = "INSERT INTO `comments` (`message_id`, `sender_id`, `receiver_id`, `content`, `datetime_sent`) VALUES ('$message_id', '$sender_id', '$receiver_id', '$content', '$datetime_sent')";
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