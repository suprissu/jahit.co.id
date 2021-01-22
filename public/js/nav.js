const pathNavAllowed = ["/", "/about"];
if (pathNavAllowed.includes(window.location.pathname)) {
    $("nav").removeClass("invert");
} else {
    $("nav").addClass("invert");
}

$(".navbar__links a").each((e, val) => {
    if (window.location.pathname === val.getAttribute("href")) {
        val.classList.add("active");
    } else {
        val.classList.remove("active");
    }
});

$(".bottom-navigation a").each((e, val) => {
    if (window.location.pathname === val.getAttribute("href")) {
        val.classList.add("active");
    } else {
        val.classList.remove("active");
    }
});

let navExpand = false;
$("#expand-button").on("click", () => {
    navExpand = !navExpand;
    if (navExpand) {
        document.getElementById("expand-content-nav").innerHTML =
            '<div class="navbar__links"><a href="/">Beranda</a><a href="/about">Tentang Kami</a></div>';
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

$(window).on("scroll", (e) => {
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
