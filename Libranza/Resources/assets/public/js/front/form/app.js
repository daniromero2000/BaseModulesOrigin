function validateEmails() {
    var email = document.getElementById("email").value;
    var emailConfirm = document.getElementById("emailConfirm").value;
    if (email != emailConfirm) {
        document.getElementById("invalid").classList.add("show");
        document.getElementById("emailConfirm").classList.remove("input-is-valid");
        document.getElementById("emailConfirm").classList.add("input-is-invalid")
        return false;
    } else {
        document.getElementById("emailConfirm").classList.remove("input-is-invalid");
        document.getElementById("emailConfirm").classList.add("input-is-valid")
        document.getElementById("invalid").classList.remove("show");
        document.getElementById("valid").classList.remove("hide");
        document.getElementById("form-libranza").submit()
        return false;
    }
}