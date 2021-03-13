const pathNavAllowed = ["/", "/about"];
if (pathNavAllowed.includes(window.location.pathname)) {
    document.querySelector("nav").classList.remove("invert");
} else {
    document.querySelector("nav").classList.add("invert");
}

document.querySelectorAll(".navbar__links a").forEach(e => {
    if (window.location.pathname === e.getAttribute("href")) {
        e.classList.add("active");
    } else {
        e.classList.remove("active");
    }
});

document.querySelectorAll(".bottom-navigation a").forEach(e => {
    if (window.location.pathname === e.getAttribute("href")) {
        e.classList.add("active");
    } else {
        e.classList.remove("active");
    }
});

let navExpand = false;
document.getElementById("expand-button").addEventListener("click", () => {
    navExpand = !navExpand;
    if (navExpand) {
        document.getElementById("expand-content-nav").innerHTML =
            '<div class="navbar__links"><a href="/">Beranda</a><a href="/about">Tentang Kami</a></div>';
        document.querySelector("nav").style.boxShadow =
            "0 0 6px rgba(0,0,0,0.2)";
        document.querySelector("nav").classList.add("scrolled");
    } else {
        document.getElementById("expand-content-nav").innerHTML = "";
        document.querySelector("nav").style.boxShadow = "";
        if (pathNavAllowed.includes(window.location.pathname)) {
            document.querySelector("nav").classList.remove("scrolled");
        }
    }
});

profileExpand = false;
const dropdownMenu = document.getElementById("dropdownMenuLink");
if (dropdownMenu) {
    dropdownMenu.addEventListener("click", () => {
        profileExpand = !profileExpand;
        const dropdown = document.getElementById("dropdown");
        if (profileExpand) {
            dropdown.style.display = "block";
        } else {
            dropdown.style.display = "none";
        }
    });
}

window.addEventListener("resize", e => {
    if (e.target.innerWidth > 768) {
        navExpand = false;
        profileExpand = false;
        dropdown.style.display = "none";
        document.getElementById("expand-content-nav").innerHTML = "";
        document.querySelector("nav").style.boxShadow = "";
        if (pathNavAllowed.includes(window.location.pathname)) {
            document.querySelector("nav").classList.remove("scrolled");
        }
    }
});

window.addEventListener("scroll", () => {
    if (
        document.body.scrollTop >= 50 ||
        document.documentElement.scrollTop >= 50 ||
        (window.location.pathname !== "/" &&
            window.location.pathname !== "/about")
    ) {
        document.querySelector("nav").classList.add("scrolled");
    } else {
        document.querySelector("nav").classList.remove("scrolled");
    }
});
