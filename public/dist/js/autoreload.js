$(document).ready(function () {
    setInterval(function () {
        $.ajax({
            url: "/getStatus.php"
        }).done(function (result) {
            if (parseInt(result) == 0) {
                document.getElementById("image").src = "/ressourcen/traffic-semaphore-silhouette-red.png";
            }
            else {
                document.getElementById("image").src = "/ressourcen/traffic-semaphore-silhouette-green.png";
            }
        });
    }, 1000);
});