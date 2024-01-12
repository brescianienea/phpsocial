<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}dbcon.php");
?>
<?php
class Post
{
    $db;
    function __construct() {
        $db = $conn;
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

    function addPost($userData) {
        $member_id = $userData['member_id'];
        $content = $userData['content'];
        $datetime_posted = $userData['datetime_posted'];
        $tenor_tag = $userData['tenor_tag'];
        $game_tag = $userData['game_tag'];
        $response = [];

        try {
            if (!empty($member_id) || !empty($content) || !empty($datetime_posted)) {
                $date = $year . "-" . $month . "-" . $day;
                $dateTimeStamp = strtotime($date);
                $currentTimestamp = time();
    
                $query = "INSERT INTO `post` (`member_id`, `content`, `datetime_posted`, `tenor_tag`, `game_tag`) VALUES ('$member_id', '$content', " . date("Y-m-d") . ", '$tenor_tag', '$game_tag')";
                $db->query($query);
                $query = "SELECT user_id FROM " . tableName;
                $query .= " WHERE username = '$username'";
                $result = $db->query($query);
                $response['message'] = "success";
                //$response = array_merge($response, $result->fetch_array(MYSQLI_BOTH));
            } else {
                $response['message'] = "Some required fields are empty";
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        echo json_encode($response);
    }
}