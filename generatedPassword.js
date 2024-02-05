function generatePassword() {
    // Define character sets for password generation
    const lowercaseChars = 'abcdefghijklmnopqrstuvwxyz';
    const uppercaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const numberChars = '0123456789';
    const symbolChars = '!@#$%^&*()_-+=<>?';

    // Get user input values
    const passwordLength = document.getElementById('passwordLength').value;
    const includeUppercase = document.getElementById('includeUppercase').checked;
    const includeNumbers = document.getElementById('includeNumbers').checked;
    const includeSymbols = document.getElementById('includeSymbols').checked;

    // Combine character sets based on user preferences
    let allChars = lowercaseChars;
    if (includeUppercase) allChars += uppercaseChars;
    if (includeNumbers) allChars += numberChars;
    if (includeSymbols) allChars += symbolChars;

    // Ensure at least one character set is selected
    if (!includeUppercase && !includeNumbers && !includeSymbols) {
      alert('Please select at least one option (Uppercase, Numbers, or Symbols).');
      return;
    }

    // Generate random password
    let generatedPassword = '';
    for (let i = 0; i < passwordLength; i++) {
      const randomIndex = Math.floor(Math.random() * allChars.length);
      generatedPassword += allChars.charAt(randomIndex);
    }

    // Update the value of the "generatedPassword" input field
    document.getElementById('generatedPassword').value = generatedPassword;
      }