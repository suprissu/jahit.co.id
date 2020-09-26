let passwordType = true;
$("#passwordHelp").click(() => {
    if (passwordType) {
        $("#passwordHelp").html('<i class="far fa-eye"></i>');
        $("#register-password").attr("type", "text");
    } else {
        $("#passwordHelp").html('<i class="far fa-eye-slash"></i>');
        $("#register-password").attr("type", "password");
    }
    passwordType = !passwordType;
});

let confirmationPasswordType = true;
$("#confirmationPasswordHelp").click(() => {
    if (confirmationPasswordType) {
        $("#confirmationPasswordHelp").html('<i class="far fa-eye"></i>');
        $("#register-confirmation-password").attr("type", "text");
    } else {
        $("#confirmationPasswordHelp").html('<i class="far fa-eye-slash"></i>');
        $("#register-confirmation-password").attr("type", "password");
    }
    confirmationPasswordType = !confirmationPasswordType;
});
