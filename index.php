<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['logged'])) {
    $_SESSION['logged'] = 'false';
}
if ($_SESSION['logged'] === 'true') {
    header("Location: /home.php?section=friends");
}

if ($_SESSION['logged'] === 'false') {
    header("Location: /home.php?section=discover");
}
die(); ?>

<?php /*
<?php include('index_header.php'); ?>
			<?php include('dbcon.php'); ?>
    <body>
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">
                <div class="clr"><div class="title">Flappy Book</div></div>
            </div><!--/ Codrops top bar -->
            <section>				
			
                <div id="container_demo" >
				
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
								<?php include('login_form.php'); ?>
                        </div>
                        <div id="register" class="animate form">
								<?php include('sign_up_form.php'); ?>
                        </div>
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html> */ ?>