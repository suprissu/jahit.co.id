let registerChoice = "customer";

function reset() {
    $(".choicePage__choice").each((e, el) => {
        if (el.id !== registerChoice) {
            el.classList.remove("active");
        } else {
            el.classList.add("active");
        }
    });
}

$(".choicePage__choice").click((e) => {
    registerChoice = e.currentTarget.id;
    reset();
});

$(".choicePage__submit").click(() => {
    window.location.href = `/user/${registerChoice}/register`;
});
