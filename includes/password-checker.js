
document.getElementById("confirmPassword").addEventListener("input",checkPasswordMatch);

// function to check if password in both password and confirm-password field are same
function checkPasswordMatch() {
    const password = document.getElementById("password");
    const confirm_password = document.getElementById("confirmPassword");

    if (password.value !== confirm_password.value) {
        confirm_password.setCustomValidity("Passwords do not match");

    } else {
        confirm_password.setCustomValidity("");
    }
}