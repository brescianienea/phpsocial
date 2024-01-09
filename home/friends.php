<?php
ob_start();
include (__DIR__ . "/../Database.php");
include (__DIR__ . "/../Friend.php");
$data = ob_get_clean();
$asd = $Friend->getFriends("5");
while ($row = mysqli_fetch_assoc($result)) {
	echo $row['user_id'];
}
?>