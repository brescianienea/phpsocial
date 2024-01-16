<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}dbcon.php");
?>
<?php
require_once("user.php");
$db = $conn;
$userData = $_POST;
addToken($db, $userData);

function addToken($db, $userData) {
    $user_id = $userData['user_id'];
    $comment_id = $userData['post_id'];
    $content = $userData['content'];
    $response = [];

    try {
        if (!empty($user_id) && !empty($comment_id) && !empty($content)) {
            $query = "INSERT INTO `comments` (`user_id`, `comment_id`, `content`) VALUES ('$user_id', '$comment_id', `$content`)";
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