<div class="login">
    <div class="container">
        <h1>Recover Your Account</h1>
        <div id="form">
            <form id="recover_password_form" novalidate>
                <div class="input-container input-value">
                    <input type="text" name="username" required/>
                    <label for="username">Username</label>
                </div>

                <div class="button">
                    <button href="#" id="submit" type="submit"
                            class="btn"><?php include('source/icons/arrow-right-solid.svg') ?></button>
                </div>

                <div class="bottom-links">
                    <p><a class="switch" href="#">Forgot username?</a></p>
                    <p><a href="/login-page.php?section=login">Login</a></p>
                </div>
            </form>

            <form id="recover_username_form" novalidate hidden>
                <div class="input-container input-value">
                    <input id="mail" type="text" name="mail" required/>
                    <label for="mail">Email</label>
                </div>

                <div class="button">
                    <button href="#" id="submit" type="submit"
                            class="btn"><?php include('source/icons/arrow-right-solid.svg') ?></button>
                </div>

                <div class="bottom-links">
                    <p><a class="switch" href="#">Forgot Password?</a></p>
                    <p><a href="/login-page.php?section=login">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function doCheckForm(form) {
        var allFilled = true;
        form.find('input').each(function () {
            if ($(this).val() == '') {
                allFilled = false;
            }
        });

        form.find(".btn").prop('disabled', !allFilled);
        if (allFilled) {
            form.find(".btn").removeAttr('disabled');
        }
    }


    $(document).ready(function () {

        $('input').keyup(function () {

            var currentForm = $(this).closest('form');
            console.log(currentForm.attr('id'))
            if (currentForm.attr('id') === 'recover_password_form') {
                doCheckForm(currentForm);
            } else if (currentForm.attr('id') === 'recover_username_form') {
                doCheckForm(currentForm);
            }
        });

        doCheckForm($('#recover_password_form'));
        doCheckForm($('#recover_username_form'));

        //option A
        $("form").submit(function (e) {
            alert('submit intercepted');
            e.preventDefault(e);
        });

        $('.switch').click(function () {
            console.log($('#recover_password_form').attr('hidden'));
            if ($('#recover_password_form').attr('hidden')) {
                $('#recover_password_form').attr('hidden', false);
                $('#recover_username_form').attr('hidden', true);
            } else {
                $('#recover_password_form').attr('hidden', true);
                $('#recover_username_form').attr('hidden', false);
            }
        })

    });

</script>
