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
const tableName = 'users';
$userData = $_POST;
loginUser($db, $userData);
function loginUser($db, $userData)
{

    $username = $userData['username'];
    $password = $userData['password'];
    $response = [];
    if (!empty($username) && !empty($password)) {

        $query = "SELECT username, password FROM " . tableName;
        $query .= " WHERE username = '$username' AND password = '$password'";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
            $response['message'] = "success";
            $response = array_merge($response, $result->fetch_array(MYSQLI_BOTH));
            $_SESSION['logged'] = 'true';
            $_SESSION['User'] = $response['username'];
        } else {
            $response['message'] = "Wrong username and password";

        }

    } else {
        $response['message'] = "All Fields are required";
    }

    echo json_encode($response);
}