let passwordType = true;
$("#passwordHelp").click(() => {
    if (passwordType) {
        $("#passwordHelp").html('<i class="far fa-eye"></i>');
        $("#login-password").attr("type", "text");
    } else {
        $("#passwordHelp").html('<i class="far fa-eye-slash"></i>');
        $("#login-password").attr("type", "password");
    }
    passwordType = !passwordType;
});
