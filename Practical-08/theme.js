const themeSwitch = document.getElementById("themeSwitch");

if (localStorage.getItem("theme") === "dark") {
    document.body.classList.add("dark-mode");
    themeSwitch.checked = true;
}

themeSwitch.addEventListener("change", function () {

    if (this.checked) {

        document.body.classList.add("dark-mode");
        localStorage.setItem("theme", "dark");

    } else {

        document.body.classList.remove("dark-mode");
        localStorage.setItem("theme", "light");

    }

});