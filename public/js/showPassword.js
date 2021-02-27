let passwordType = true;
document.querySelector(".passwordHelp").addEventListener("click", () => {
    if (passwordType) {
        document.querySelector(".passwordHelp").innerHTML =
            '<i class="far fa-eye"></i>';
        document.querySelector(".password").setAttribute("type", "text");
    } else {
        document.querySelector(".passwordHelp").innerHTML =
            '<i class="far fa-eye-slash"></i>';
        document.querySelector(".password").setAttribute("type", "password");
    }
    passwordType = !passwordType;
});
