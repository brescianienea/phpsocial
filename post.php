<?php
include('query/user/user.php');
include('query/post/post.php');
include('query/comment/comment.php');
$post = Post::getPostsByPostID($_GET['post_id'])[0];
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
                <div class="popup">
                    <div class="heading">
                        <span>Share Modal</span>
                        <div class="close"><?php include('source/icons/xmark-solid.svg') ?></i></div>
                    </div>
                    <div class="content">
                        <p>Share this link via</p>
                        <ul class="icons">
                            <li>
                                <a class="share-facebook"
                                   url="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>"
                                   href=""><?php include('source/icons/facebook.svg') ?></a>
                            </li>
                            <li>
                                <a class="share-twitter"
                                   url="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>"
                                   href="#"><?php include('source/icons/x-twitter.svg') ?></i></a>
                            </li>
                            <li>
                                <a class="share-whatsapp"
                                   url="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>"
                                   href="#"><?php include('source/icons/whatsapp.svg') ?></i></a>
                            </li>
                            <li>
                                <a class="share-telegram"
                                   url="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>"
                                   href="#"><?php include('source/icons/telegram.svg') ?></a>
                            </li>
                        </ul>
                        <p>Or copy link</p>
                        <div class="field">
                            <?php include('source/icons/link-solid.svg') ?>
                            <input type="text" readonly
                                   value="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
                            <button>Copy</button>
                        </div>
                    </div>
                </div>

                <span>Posted by <a
                            href="/user.php?user_id=<?= $post['member_id'] ?>"><?= User::getUsernameByID($post['member_id'])['username'] ?> </a></span>
                <h1><?= $post['title'] ?></h1>
                <div class="tags">
                    <div class="game-icon <?= $post['game_tag'] ?>">
                        <?php include('source/icons/' . $post['game_tag'] . '.svg') ?>
                    </div>
                    <span class="topic"><?= $post['tenor_tag'] ?></span>
                    <button id="share"><?php include('source/icons/share-nodes-solid.svg') ?></button>
                </div>
                <textarea id="reader"></textarea>
                <section class="comments">
                    <h2>Comments</h2>
                    <form class="new-comment">
                        <label for="comment"></label>
                        <textarea id="comment" name="comment" placeholder="Write your comment..."></textarea>
                        <label for="post_id"></label>
                        <input type="text" id="post_id" name="post_id" content="<?= $_GET['post_id'] ?>"
                               hidden="hidden">
                        <button class="submit"><?php include('source/icons/arrow-up-solid.svg') ?></button>
                    </form>
                    <div class="comment-list">
                        <?php
                        $comments = Comment::getCommentsByPost($_GET['post_id']);
                        ?>
                        <?php if (is_array($comments)): ?>
                            <?php foreach ($comments as $comment): ?>
                                <section class="comment">
                                    <span><a href="/user.php?user_id=<?= $comment['user_id'] ?> "><?= User::getUsernameByID($comment['user_id'])['username'] ?></a></span>
                                    <span><?= $comment['content'] ?></span>
                                </section>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span>No comments yet...</span>
                        <?php endif; ?>

                    </div>
                </section>

            </div>

            <script>

                document.getElementById("post_id").value = "<?= $_GET['post_id'] ?>";


                $(document).ready(function () {
                    $('.se-wrapper-code').attr('name', 'content');
                    editor.setContents('<?= $post['content'] ?>');
                    editor.readOnly(true);
                    editor.disable();
                });

                $('#title').on("keyup", function () {

                    if ($('#title').val() === '' || $('#game_tag').val() === '' || $('#tenor_tag').val() === '') {
                        $(".submit").prop('disabled', true);
                    } else {
                        $(".submit").prop('disabled', false);
                    }
                });

                $('#game_tag').on("change", function () {

                    if ($('#title').val() === '' || $('#game_tag').val() === '' || $('#tenor_tag').val() === '') {
                        $(".submit").prop('disabled', true);
                    } else {
                        $(".submit").prop('disabled', false);
                    }
                })
                ;

                $('#tenor_tag').on("change", function () {

                    if ($('#title').val() === '' || $('#game').val() === '' || $('#tenor_tag').val() === '') {
                        $(".submit").prop('disabled', true);
                    } else {
                        $(".submit").prop('disabled', false);
                    }
                });


                $('form').submit(function (e) {
                    e.preventDefault();
                    $('.se-wrapper-code').val(editor.getContents());
                    $.ajax({

                        method: "POST",
                        url: "/query/comment/addComment.php",
                        data: $('form').serialize(),
                        success: function (data) {
                            console.log(data);
                            let result = JSON.parse(data);
                            if (result['message'] === 'success') {
                                window.location.href = "post.php?post_id=<?= $_GET['post_id'] ?>";
                            } else {
                                alert(result['message']);
                            }


                        }

                    });


                });

                const editor = SUNEDITOR.create((document.getElementById('reader') || 'reader'), {});

                const viewBtn = document.querySelector("#share"),
                    popup = document.querySelector(".popup"),
                    close = popup.querySelector(".close"),
                    field = popup.querySelector(".field"),
                    input = field.querySelector("input"),
                    copy = field.querySelector("button");

                viewBtn.onclick = () => {
                    popup.classList.toggle("show");
                }
                close.onclick = () => {
                    viewBtn.click();
                }

                copy.onclick = () => {
                    input.select(); //select input value
                    if (document.execCommand("copy")) { //if the selected text is copied
                        field.classList.add("active");
                        copy.innerText = "Copied";
                        setTimeout(() => {
                            window.getSelection().removeAllRanges(); //remove selection from page
                            field.classList.remove("active");
                            copy.innerText = "Copy";
                        }, 3000);
                    }
                }

                $('.share-facebook').on('click', function () {
                    let currentURL = $(this).attr('url');
                    window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(currentURL), 'facebook-share');

                });

                $('.share-whatsapp').on('click', function () {
                    let currentURL = $(this).attr('url');
                    let encodedURL = encodeURIComponent(currentURL);

                    let whatsappURL = "https://wa.me/?text=Check out this page: " + encodedURL;

                    window.open(whatsappURL);

                });

                $('.share-telegram').on('click', function () {
                    var currentURL = $(this).attr('url');
                    var encodedURL = encodeURIComponent(currentURL);

                    var telegramURL = "tg://msg?text=Check out this page: " + encodedURL;

                    window.open(telegramURL);

                });

                $('.share-twitter').on('click', function () {
                    const currentURL = $(this).attr('url');

                    window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(currentURL), 'twitter-share');
                })


            </script>

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