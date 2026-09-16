const closeButton = document.getElementById("closeNotification");

if(closeButton){
    closeButton.addEventListener("click", function () {
        document.getElementById("notificationBanner").style.display = "none";
    });
}