function generatePassword() {
  console.log("Generating password...");

  // Define character sets for password generation
  const lowercaseChars = 'abcdefghijklmnopqrstuvwxyz';
  const uppercaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  const numberChars = '0123456789';
  const symbolChars = '!@#$%^&*()_-+=<>?';

  // Get user input values
  const passwordLength = parseInt(document.getElementById('passwordLength').value);
  const includeUppercase = document.getElementById('includeUppercase').checked;
  const includeNumbers = document.getElementById('includeNumbers').checked;
  const includeSymbols = document.getElementById('includeSymbols').checked;

  console.log("Password Length:", passwordLength);
  console.log("Include Uppercase:", includeUppercase);
  console.log("Include Numbers:", includeNumbers);
  console.log("Include Symbols:", includeSymbols);

  // Ensure input validation
  if (isNaN(passwordLength) || passwordLength <= 0) {
    alert('Please enter a valid password length.');
    return;
  }

  // Combine character sets based on user preferences
  let allChars = [lowercaseChars];
  if (includeUppercase) allChars.push(uppercaseChars);
  if (includeNumbers) allChars.push(numberChars);
  if (includeSymbols) allChars.push(symbolChars);

  allChars = allChars.join('');

  console.log("Combined Character Sets:", allChars);

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

  console.log("Generated Password:", generatedPassword);

  // Update the value of the "generatedPassword" input field
  document.getElementById('generatedPassword').value = generatedPassword;
}
