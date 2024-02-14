function copyToClipboard() {
    var passwordField = document.getElementById("generatedPassword");

    // Check if there is a password in the password field
    if (passwordField.value.trim() === "") {
        alert("No password to copy. Generate a password first.");
    } else {
        passwordField.select();
        passwordField.setSelectionRange(0, 99999); // For mobile devices

        // Copy the password to the clipboard
        document.execCommand("copy");

        // Alert that the password has been copied
        alert("Password copied to clipboard!");
    }
}
