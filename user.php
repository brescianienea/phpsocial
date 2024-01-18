<?php
include('query/user/user.php');
include('query/post/post.php');
$userInfo = User::getUserInfoByID($_GET['user_id']);
if (isset($_SESSION['user_id']) && $_GET['user_id'] == $_SESSION['user_id']) {
    header("Location: /profile-page.php?profile");
    exit();
}
?>
    <!DOCTYPE html>
    <html lang='en'>
    <?php include('head.php'); ?>
    <body>
    <?php include('header.php'); ?>
    </header>
    <main>
        <div class='column'>
            <div class='wrapper post'>
                <div class="profile">
                    <div class="popup">
                        <div class="heading">
                            <span>Share Modal</span>
                            <div class="close"><?php include('source/icons/xmark-solid.svg') ?></i></div>
                        </div>
                        <div class="content">
                            <p>Share this link via</p>
                            <ul class="icons">
                                <li>
                                    <a href="#"><?php include('source/icons/facebook.svg') ?></a>
                                </li>
                                <li>
                                    <a href="#"><?php include('source/icons/x-twitter.svg') ?></i></a>
                                </li>
                                <li>
                                    <a href="#"><?php include('source/icons/whatsapp.svg') ?></i></a>
                                </li>
                                <li>
                                    <a href="#"><?php include('source/icons/telegram.svg') ?></a>
                                </li>
                            </ul>
                            <p>Or copy link</p>
                            <div class="field">
                                <?php include('source/icons/link-solid.svg') ?>
                                <input type="text" readonly value="https://codepen.io/coding_dev_">
                                <button>Copy</button>
                            </div>
                        </div>
                    </div>

                    <section class="profile-title">
                        <img alt="Profile Image" src="source/images/profile/placeholder.webp">
                        <div>
                            <h1><?= User::getUsernameByID($_GET['user_id'])['username'] ?></h1>

                        </div>
                        <a id="share-profile">
                            <?php include('source/icons/share-nodes-solid.svg') ?>
                        </a>
                        <div class="actions">
                            <button>Message</button>
                            <?php if (in_array($_GET['user_id'], User::getFriendsByID($_SESSION['user_id']))): ?>
                                <form hidden="hidden">
                                    <input name="user_id" id="user_id" value="<?= $_GET['user_id'] ?>">
                                </form>
                                <button id="revoke_friendship">Remove Friend</button>

                            <?php elseif (in_array($_GET['user_id'], User::getFriendRequestSent($_SESSION['user_id']))): ?>
                                <form hidden="hidden">
                                    <input name="user_id" id="user_id" value="<?= $_GET['user_id'] ?>">
                                </form>
                                <button id="revoke_request">Request Sent</button>

                            <?php else: ?>
                                <form hidden="hidden">
                                    <input name="user_id" id="user_id" value="<?= $_GET['user_id'] ?>">
                                </form>
                                <button id="send_request">Send Request</button>

                            <?php endif; ?>
                        </div>
                    </section>
                    <section class="post-wrapper">
                        <?php $postList = Post::getPostsByID($_GET['user_id']); ?>

                        <?php if (is_array($postList)): ?>
                            <ul class="post-list">
                                <?php foreach ($postList as $post): ?>
                                    <li onclick="location.href = '../post.php?post_id=<?= $post['post_id'] ?>'">

                                        <section
                                        >
                                            <div class="game-icon <?= $post['game_tag'] ?>">
                                                <?php include('source/icons/' . $post['game_tag'] . '.svg') ?>
                                            </div>

                                            <span>Posted by <a><?= User::getUsernameByID($post['member_id'])['username'] ?> </a></span>
                                            <span class="topic"><?= $post['tenor_tag'] ?></span>
                                        </section>
                                        <h2><?= $post['title'] ?></h2>

                                    </li>
                                <?php endforeach; ?>
                            </ul>

                        <?php else: ?>
                            <article class="centered">
                                <?php include('source/icons/photo-film-solid.svg') ?>
                                <span>You haven't posted anything yet.</span>
                                <a href="new-post.php">Post Now</a>
                            </article>

                        <?php endif; ?>
                    </section>


                </div>


                <script type="text/javascript" src="js/user.js"></script>

            </div>

        </div>
        <?php include('navbar.php'); ?>
    </main>

    </body>
    <?php include('footer.php'); ?>


    </html>
<?php /*
<?php include('head.php'); ?>
<?php include('session.php'); ?>
    <body>
	<?php include('navbar.php'); ?>
			<div id='masthead'>
				<div class='container'>
					<?php include('heading.php'); ?>
				</div><!-- /cont -->
				<div class='container'>
					<div class='row'>
					<div class='col-md-12'>
						<div class='top-spacer'> </div>
					</div>
					</div>
				</div><!-- /cont -->
			</div>
<div class='container'>
  <div class='row'>
    <div class='col-md-12'>
      <div class='panel'>
        <div class='panel-body'>
          <!--/stories-->
          <div class='row'>
            <br>
				<?php
	$query = $conn->query('select * from post LEFT JOIN members on members.member_id = post.member_id order by post_id DESC');
	while($row = $query->fetch()){
	$posted_by = $row['firstname'].' '.$row['lastname'];
	$posted_image = $row['image'];
	$id = $row['post_id'];
	?>
            <div class='col-md-2 col-sm-3 text-center'>
             <img  src='<?php echo $posted_image; ?>' style='width:100px;height:100px' class='img-circle'></a>
            </div>
            <div class='col-md-10 col-sm-9'>
             	<div class='alert'><?php echo $row['content']; ?></div>
              <div class='row'>
                <div class='col-xs-9'>
                  <h4><span class='label label-info'> <?php echo $row['date_posted']; ?></span></h4><h4>
                  <small style='font-family:courier,'new courier';' class='text-muted'>Posted By:<a href='#' class='text-muted'><?php echo $posted_by; ?></a></small>
                  </h4></div>
                <div class='col-xs-3'><a href='delete_post.php<?php echo '?id='.$id; ?>' class='btn btn-danger'><i class='icon-trash'></i> Delete</a></div>
              </div>
              <br><br>
            </div>
	<?php } ?>
          </div>
          <hr>
        </div>
      </div>



   	</div><!--/col-12-->
  </div>
</div>


<?php include('footer.php'); ?>

    </body>
</html> */ ?>