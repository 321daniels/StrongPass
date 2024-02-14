function copyToClipboard() {
    // Get input field
    var passwordField = document.getElementById("generatedPassword");
    passwordField.select();

    // Copy the  text to the clipboard
    document.execCommand("copy");

    // Alert the user that the password has been copied
    alert("Password copied to clipboard!");
}
