<?php
?>
    <!DOCTYPE html>
    <html lang='en'>
    <?php include('head.php'); ?>
    <?php $_SESSION['page'] = 'new-post' ?>
    <body>
    <?php include('header.php'); ?>
    </header>
    <main>
        <div class='column'>
            <div class='wrapper'>
                <?php if ($_SESSION['logged'] == 'false'): ?>
                    <?php include('login-required.php'); ?>
                <?php else: ?>
                    <h1>New Post</h1>
                    <form class="new-post">
                        <label for='title'>Title</label>
                        <input placeholder="Title" type='text' id='title' name='title'/>
                        <label for='writer'>Content</label>
                        <textarea id='writer'></textarea>
                        <button disabled class="submit">
                            <?php include('source/icons/arrow-up-solid.svg'); ?>
                        </button>
                    </form>

                <?php endif; ?>
            </div>
            <script>

                $('#title').on("keyup", function () {

                    if ($('#title').val() === '') {
                        $(".submit").prop('disabled', true);
                    } else {
                        $(".submit").prop('disabled', false);
                    }
                });


                $('form').submit(function (e) {
                    e.preventDefault();
                    $.ajax({

                        method: "POST",
                        url: "/query/login/register.php",
                        data: $('#registration_form').serialize(),
                        success: function (data) {
                            console.log(data);
                            let result = JSON.parse(data);
                            if (result['message'] === 'success') {
                                window.location.href = "login-page.php?section=login";
                                alert('Registration completed. Please login.');
                            } else {
                                alert(result['message']);
                                window.location.href = "login-page.php?section=register"
                            }


                        }

                    });


                });

                const editor = SUNEDITOR.create((document.getElementById('writer') || 'writer'), {
                    mode: 'classic',
                    rtl: false,
                    resizingBar: false,
                    resizeEnable: false,
                    formats: [
                        'p',
                        'blockquote',
                        'h2',
                        'h3',
                        'h4',
                        'h5',
                        'h6'
                    ],
                    imageResizing: false,
                    imageHeightShow: false,
                    imageAlignShow: false,
                    imageWidth: '100%',
                    imageMultipleFile: true,
                    videoResizing: false,
                    videoHeightShow: false,
                    videoAlignShow: false,
                    videoFileInput: false,
                    videoRatioShow: false,
                    youtubeQuery: 'autoplay=0',
                    audioUrlInput: false,
                    tabDisable: false,
                    lineHeights: [
                        {
                            text: 'Single',
                            value: 1
                        },
                        {
                            text: 'Double',
                            value: 2
                        }
                    ],
                    paragraphStyles: [
                        'spaced',
                        {
                            name: 'Box',
                            class: '__se__customClass'
                        }
                    ],
                    placeholder: 'Write your post',
                    mediaAutoSelect: false,
                    linkTargetNewWindow: true,
                    buttonList: [
                        [
                            'undo',
                            'redo',
                            'blockquote',
                            'bold',
                            'underline',
                            'italic',
                            'strike',
                            'subscript',
                            'superscript',
                            'removeFormat',
                            'outdent',
                            'indent',
                            'align',
                            'list',
                            'lineHeight',
                            'link',
                            'image',
                            'video'
                        ]
                    ]
                }, {});
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