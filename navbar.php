<?php

$current_url = explode("?", $_SERVER['REQUEST_URI']);
$current_url = $current_url[0];

?>
<nav class="" role="navigation">
    <ul class="nav navbar-nav">
        <li><a href="home.php" class="<?php if ($_SESSION['page'] == 'feed'): ?> _selected <?php endif; ?>">
                <?php include('source/icons/newspaper-solid.svg'); ?>
                Feed</a></li>
        <li><a href="new-post.php" class="<?php if ($_SESSION['page'] == 'new-post'): ?> _selected <?php endif; ?>">
                <?php include('source/icons/square-plus-solid.svg'); ?>
                New Post</a></li>
        <li><a href="social.php" class="<?php if ($_SESSION['page'] == 'social'): ?> _selected <?php endif; ?>">
                <?php include('source/icons/comments-solid.svg'); ?>

                Social</a></li>
        <li><a href="profile-page.php" class="<?php if ($_SESSION['page'] == 'profile'): ?> _selected <?php endif; ?>">
                <?php include('source/icons/user-solid.svg'); ?>
                Profile</a></li>
    </ul>
</nav>
