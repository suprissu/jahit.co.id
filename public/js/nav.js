const expandButton =
    '<button id="expand-button" class="btn btn-outline-light"><i class="fas fa-bars"></i></button>';
const navLinks =
    '<div class="navbar__links"><a href="">Beranda</a><a href="">Tentang Kami</a></div>';

if (window.innerWidth <= 768) {
    document.getElementById("expand-trigger").innerHTML = expandButton;
} else {
    document.getElementById("expand-trigger").innerHTML = navLinks;
}

let navExpand = false;
$("#expand-button").click(() => {
    navExpand = !navExpand;
    if (navExpand) {
        document.getElementById("expand-content-nav").innerHTML = navLinks;
        $("nav").addClass("scrolled");
    } else {
        document.getElementById("expand-content-nav").innerHTML = "";
    }
});

$(window).resize((e) => {
    if (window.innerWidth <= 768) {
        document.getElementById("expand-trigger").innerHTML = expandButton;
    } else {
        document.getElementById("expand-trigger").innerHTML = navLinks;
    }
});

$(window).scroll((e) => {
    const scrollPosition = $(document).scrollTop();
    if (scrollPosition >= 100) {
        $("nav").addClass("scrolled");
    } else {
        $("nav").removeClass("scrolled");
    }
});
