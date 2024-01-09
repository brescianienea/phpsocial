<?php
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

    if (!empty($username) && !empty($password)) {

        $query = "SELECT username, password FROM " . tableName;
        $query .= " WHERE username = '$username' AND password = '$password'";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
            echo "success";
        } else {
            echo "Wrong username and password";
        }

    } else {
        echo "All Fields are required";
    }
}