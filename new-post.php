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
                        <section class="tags">
                            <h2 hidden = "hidden">Tags:</h2>
                            <div class="select">
                                <label for="game_tag">Game: </label>
                                <select id="game_tag" name="game_tag">
                                    <option value="" selected disabled>-- Game --</option>
                                    <option value="lol">League of Legends</option>
                                    <option value="tft">Teamfight Tactics</option>
                                    <option value="wildrift">Wild Rift</option>
                                    <option value="valorant">VALORANT</option>
                                    <option value="lor">Legends of Runeterra</option>
                                </select>

                            </div>
                            <div class="select">
                                <label for="tenor_tag">Topic: </label>
                                <select id="tenor_tag" name="tenor_tag">
                                    <option value="" selected disabled>-- Topic --</option>
                                    <option value="meme">Meme</option>
                                    <option value="question">Question</option>
                                    <option value="discussion">Discussion</option>
                                    <option value="theory">Theory & Lore</option>
                                    <option value="guides">Guides & Tips</option>
                                    <option value="cosplay">Cosplay</option>
                                    <option value="fanart">Fan Art</option>
                                    <option value="news">News</option>
                                </select>

                            </div>


                        </section>
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
            <script src="js/new-post.js"></script>
        </div>
        <?php include('navbar.php'); ?>
    </main>

    </body>
    <?php include('footer.php'); ?>


    </html>