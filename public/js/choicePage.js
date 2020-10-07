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

function selectFormOption() {
    if (registerChoice == "customer") {
        $("#role-option").val("CUST");
    } else if (registerChoice == "partner") {
        $("#role-option").val("PART");
    } else {
        window.location.href=window.location.href;
    }
}

$(".choicePage__choice").click((e) => {
    registerChoice = e.currentTarget.id;
    selectFormOption();
    reset();
});
