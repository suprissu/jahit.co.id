let registerChoice = "customer";

const choiceButton = document.querySelectorAll(".choicePage__choice");

function reset() {
    choiceButton.forEach(e => {
        if (e.id !== registerChoice) {
            e.classList.remove("active");
        } else {
            e.classList.add("active");
        }
    });
}

function selectFormOption() {
    if (registerChoice == "customer") {
        document.getElementById("role-option").value = "CUST";
    } else if (registerChoice == "partner") {
        document.getElementById("role-option").value = "PART";
    } else {
        window.location.href = window.location.href;
    }
}

choiceButton.forEach(btn => {
    btn.addEventListener("click", e => {
        console.log(e.target);
        registerChoice = e.currentTarget.getAttribute("id");
        selectFormOption();
        reset();
    });
});
