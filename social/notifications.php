<script type="text/javascript">
    function loadDoc() {
  

        setInterval(function(){

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                    require_once(".." + DIRECTORY_SEPARATOR + "query" + DIRECTORY_SEPARATOR + "notification" + DIRECTORY_SEPARATOR + "notification.php");
                    document.getElementById("noti_number").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "data.php", true);
            xhttp.send();

        },1000);


    }
    loadDoc();
</script>
