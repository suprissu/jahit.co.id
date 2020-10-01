const expandButton =
    '<button id="expand-button" class="btn btn-outline-light"><i class="fas fa-bars"></i></button>';
const navLinks =
    '<div class="navbar__links"><a href="/">Beranda</a><a href="/about">Tentang Kami</a></div>';

if (window.innerWidth <= 768) {
    document.getElementById("expand-trigger").innerHTML = expandButton;
} else {
    document.getElementById("expand-trigger").innerHTML = navLinks;
}

const pathNavAllowed = ["/", "/about"];
if (pathNavAllowed.includes(window.location.pathname)) {
    $("nav").removeClass("invert");
} else {
    $("nav").addClass("invert");
}

$(".navbar__links a").each((e, val) => {
    console.log("masuk");
    if (window.location.pathname === val.getAttribute("href")) {
        val.classList.add("active");
    } else {
        val.classList.remove("active");
    }
});

let navExpand = false;
$("#expand-button").click(() => {
    navExpand = !navExpand;
    if (navExpand) {
        document.getElementById("expand-content-nav").innerHTML = navLinks;
        $("nav").css("box-shadow", "0 0 6px rgba(0,0,0,0.2)");
        $("nav").addClass("scrolled");
    } else {
        document.getElementById("expand-content-nav").innerHTML = "";
        $("nav").css("box-shadow", "");
        if (pathNavAllowed.includes(window.location.pathname)) {
            $("nav").removeClass("scrolled");
        }
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
    if (
        scrollPosition >= 100 ||
        (window.location.pathname !== "/" &&
            window.location.pathname !== "/about")
    ) {
        $("nav").addClass("scrolled");
    } else {
        $("nav").removeClass("scrolled");
    }
});
