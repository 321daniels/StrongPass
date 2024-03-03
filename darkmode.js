document.addEventListener('DOMContentLoaded', function () {
    const toggleOptionsButton = document.getElementById('toggleOptions');
    const optionsPopout = document.getElementById('optionsPopout');
    const darkModeToggle = document.getElementById('darkModeToggle');
    const customColorInput = document.getElementById('customColor');
    const body = document.body;

    // Check if dark mode preference is stored in local storage
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    setDarkMode(isDarkMode);

    // Set initial custom color from local storage
    const savedCustomColor = localStorage.getItem('customColor');
    if (savedCustomColor) {
        body.style.backgroundColor = savedCustomColor;
        customColorInput.value = savedCustomColor;
    }

    // Dark Mode Toggle
    darkModeToggle.checked = isDarkMode; // Set initial state
    darkModeToggle.addEventListener('change', function () {
        const newDarkMode = darkModeToggle.checked;
        setDarkMode(newDarkMode);
        localStorage.setItem('darkMode', newDarkMode);
    });

    // Custom Color Change
    customColorInput.addEventListener('input', function () {
        const newColor = customColorInput.value;
        body.style.backgroundColor = newColor;
        localStorage.setItem('customColor', newColor);
    });

    // Toggle Options Button
    toggleOptionsButton.addEventListener('click', function () {
        optionsPopout.style.display = optionsPopout.style.display === 'none' ? 'block' : 'none';
    });

    function setDarkMode(isDark) {
        if (isDark) {
            body.classList.add('dark-mode');
        } else {
            body.classList.remove('dark-mode');
        }
    }
});
