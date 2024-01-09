<div class="login">
    <div class="container">
        <h1>Sign In</h1>
        <div id="form">
            <form id="login_form" novalidate>
                <div class="input-container input-value">
                    <input type="text" name="username" required/>
                    <label for="username">Username</label>
                </div>

                <div class="input-container input-value">
                    <input id="password" type="password" name="password" required/>
                    <label for="password">Password</label>
                    <button id="show-password">
                        <span class="not-toggled">
                            <?php include('source/icons/eye-slash-solid.svg') ?>
                        </span>
                        <span class="toggled">
                                <?php include('source/icons/eye-solid.svg') ?>
                        </span>
                    </button>
                </div>

                <?php /*
                <div class="checkbox">
                    <label for="check"> Stay signed in</label>
                    <input type="checkbox" class="checkbox-color" id="check" name="check" value="stay"/>
                </div> */ ?>

                <div class="button">
                    <button href="#" id="submit" type="submit"
                            class="btn"><?php include('source/icons/arrow-right-solid.svg') ?></button>
                </div>

                <div class="bottom-links">
                    <p><a href="/login-page.php?section=recover">Can't sign in?</a></p>
                    <p><a href="/login-page.php?section=register">Create account</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

    function doCheck() {
        var allFilled = true;
        $('input').each(function () {
            if ($(this).val() == '') {
                allFilled = false;
            }
        });

        $("#submit").prop('disabled', !allFilled);
        if (allFilled) {
            $("#submit").removeAttr('disabled');
        }
    }

    $(document).ready(function () {

        doCheck();
        $('input').keyup(doCheck);

        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                if (!$('#submit').attr('disabled'))
                    $('#submit').click();
                return false;

            }
        });

        //option A
        $("form").submit(function (e) {
            e.preventDefault(e);
            $.ajax({

                method: "POST",
                url: "/query/login/login.php",
                data: $(this).serialize(),
                success: function (data) {
                    console.log(data);
                    let result = JSON.parse(data);
                    if (result['message'] === 'success') {
                        window.location.href = "login-page.php";
                    } else {
                        alert(result['message']);
                    }


                }

            });

        });

        document.getElementById('show-password').addEventListener('click', event => {
            event.preventDefault();

            var password = document.getElementById('password');
            if (password.type === 'password') {
                password.type = 'text';
                document.getElementById('show-password').classList.add('toggled');
            } else {
                password.type = 'password';
                document.getElementById('show-password').classList.remove('toggled');
            }

        });

    });


</script>
