<?php
include('query/user/user.php');
include('query/post/post.php');
$friedsIDs = User::getFriendsByID($_SESSION['user_id']);
?>


<section class="post-wrapper">
    <?php $postList = Post::getAllPosts(); ?>

    <?php if (is_array($postList)): ?>
        <ul class="post-list">
            <?php foreach ($postList as $post): ?>
                <li>
                    <section>
                        <span>Posted by <a><?= User::getUsernameByID($post['member_id'])['username'] ?> </a></span>
                    </section>
                    <h2><?= $post['title'] ?></h2>
                    <button><?php include('source/icons/share-nodes-solid.svg') ?></button>

                </li>
            <?php endforeach; ?>
        </ul>

    <?php else: ?>
        <article class="centered">
            <?php include('source/icons/photo-film-solid.svg') ?>
            <span>You haven't posted anything yet.</span>
            <a href="../new-post.php">Post Now</a>
        </article>

    <?php endif; ?>
</section>

