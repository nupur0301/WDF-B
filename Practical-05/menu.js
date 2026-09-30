function setDrawerPosition() {

    const header = document.querySelector("header");
    const menu = document.getElementById("navLinks");

    if(header && menu){

        const headerHeight = header.offsetHeight;

        menu.style.top = headerHeight + "px";
        menu.style.height = "calc(100% - " + headerHeight + "px)";
    }
}

function toggleMenu() {
    document.getElementById("navLinks").classList.toggle("show");
}

// Close when clicking outside
document.addEventListener("click", function(event){

    const menu = document.getElementById("navLinks");
    const icon = document.querySelector(".menu-icon");

    if(menu && icon &&
       !menu.contains(event.target) &&
       !icon.contains(event.target)){

        menu.classList.remove("show");
    }
});

// Close when scrolling
window.addEventListener("scroll", function(){

    document.getElementById("navLinks").classList.remove("show");

});

// Close when resizing
window.addEventListener("resize", function(){

    setDrawerPosition();
    document.getElementById("navLinks").classList.remove("show");

});

// Run when page loads
window.addEventListener("load", setDrawerPosition);