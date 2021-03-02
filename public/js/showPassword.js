let passwordType = true;
const passwordHelp = document.querySelectorAll(".passwordHelp");
const passwordInput = document.querySelectorAll(".password");
passwordHelp.forEach(btn => {
    btn.addEventListener("click", () => {
        if (passwordType) {
            passwordHelp.forEach(
                e => (e.innerHTML = '<i class="far fa-eye"></i>')
            );
            passwordInput.forEach(e => e.setAttribute("type", "text"));
        } else {
            passwordHelp.forEach(
                e => (e.innerHTML = '<i class="far fa-eye-slash"></i>')
            );
            passwordInput.forEach(e => e.setAttribute("type", "password"));
        }
        passwordType = !passwordType;
    });
});
