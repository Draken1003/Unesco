const navbar = document.getElementById("menu-header");
const mcn = document.getElementById("mcn");
const mcnStyle = document.getElementById("mcn").style.filter;


window.addEventListener("scroll", (event) => {
    if (window.scrollY > 0) {
        navbar.style.animation="navbar-bg 0.5s linear";
        navbar.style.backgroundColor = "var(--black-color)";
        mcn.style.filter = "invert(0)"

    } else {
        navbar.style.animation="navbar-bg-transparent 0.5s linear";
        navbar.style.backgroundColor = "transparent";
        mcn.style.filter = mcnStyle;
    }
    
});
