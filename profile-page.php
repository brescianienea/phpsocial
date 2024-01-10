<?php
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include('head.php'); ?>
    <?php $_SESSION['page'] = 'profile' ?>
    <?php if ($_SESSION['logged'] == 'false'): ?>
        <?php if (!$_GET['section']) {
            header("Location: /login-page.php?section=login");
            exit();
        } ?>
    <?php else: ?>
        <?php if (!$_GET['section']) {
            header("Location: /profile-page.php?section=profile");
            exit();
        } ?>
    <?php endif; ?>
    <body>
    <?php include('header.php'); ?>
    </header>
    <main>
        <div class="column">
            <div class="wrapper">
                <section class="section-selection">
                    <ul>
                        <li class="<?php if ($_GET['section'] == "profile"): ?> _selected <?php endif; ?>">
                            <a href="/profile-page.php?section=profile">Your Profile</a>
                        </li>
                        <li class="<?php if ($_GET['section'] == "friends"): ?> _selected <?php endif; ?>">
                            <a href="/profile-page.php?section=friends">Your Friends</a>
                        </li>
                        <li class="<?php if ($_GET['section'] == "settings"): ?> _selected <?php endif; ?>">
                            <a href="/profile-page.php?section=settings">Settings</a>
                        </li>
                    </ul>
                </section>
                <?php if ($_GET['section'] == "profile"): ?>
                    <?php include('profile/profile.php'); ?>
                <?php elseif ($_GET['section'] == "friends"): ?>
                    <?php include('profile/friends.php'); ?>
                <?php elseif ($_GET['section'] == "settings"): ?>
                    <?php include('profile/setting.php'); ?>
                <?php endif; ?>
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
			<div id="masthead">
				<div class="container">
					<?php include('heading.php'); ?>
				</div><!-- /cont -->
				<div class="container">
					<div class="row">
					<div class="col-md-12">
						<div class="top-spacer"> </div>
					</div>
					</div>
				</div><!-- /cont -->
			</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-body">
          <!--/stories-->
          <div class="row">
            <br>
				<?php
	$query = $conn->query("select * from post LEFT JOIN members on members.member_id = post.member_id order by post_id DESC");
	while($row = $query->fetch()){
	$posted_by = $row['firstname']." ".$row['lastname'];
	$posted_image = $row['image'];
	$id = $row['post_id'];
	?>
            <div class="col-md-2 col-sm-3 text-center">
             <img  src="<?php echo $posted_image; ?>" style="width:100px;height:100px" class="img-circle"></a>
            </div>
            <div class="col-md-10 col-sm-9">
             	<div class="alert"><?php echo $row['content']; ?></div>
              <div class="row">
                <div class="col-xs-9">
                  <h4><span class="label label-info"> <?php echo $row['date_posted']; ?></span></h4><h4>
                  <small style="font-family:courier,'new courier';" class="text-muted">Posted By:<a href="#" class="text-muted"><?php echo $posted_by; ?></a></small>
                  </h4></div>
                <div class="col-xs-3"><a href="delete_post.php<?php echo '?id='.$id; ?>" class="btn btn-danger"><i class="icon-trash"></i> Delete</a></div>
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