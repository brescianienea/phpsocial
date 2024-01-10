<ul class="setting-list">
    <li>
        <a href="#" id="logout">
            <?php include('source/icons/arrow-right-from-bracket-solid.svg') ?>
            <span>Log out</span>
        </a>
    </li>
</ul>


<script>
    $(document).ready(function () {
        $('#logout').click(function () {
            $.ajax({
                method: "POST",
                url: "/query/profile/logout.php",
                success: function (data) {
                    if (data === 'success') {
                        window.location.href = "index.php";
                    }


                }

            });
        });
    });


</script>