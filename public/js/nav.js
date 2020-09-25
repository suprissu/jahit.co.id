const expandButton =
    '<button id="expand-button" class="btn btn-outline-light"><i class="fas fa-bars"></i></button>';
const navLinks =
    '<div class="navbar__links"><a href="/">Beranda</a><a href="/about">Tentang Kami</a></div>';

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

$(".navbar__links a").each((e, val) => {
    console.log(val.getAttribute("href"));
    console.log("test", window.location.pathname);
    if (window.location.pathname === val.getAttribute("href")) {
        val.classList.add("active");
    } else {
        val.classList.remove("active");
    }
});
