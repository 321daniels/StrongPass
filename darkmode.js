document.addEventListener('DOMContentLoaded', function () {
    const toggleOptionsButton = document.getElementById('toggleOptions');
    const optionsPopout = document.getElementById('optionsPopout');
    const customColorInput = document.getElementById('customColor');
    const body = document.body;

    // Toggle Options Button
    toggleOptionsButton.addEventListener('click', function () {
        optionsPopout.classList.toggle('d-none');
    });

    // Set initial custom color from local storage
    const savedCustomColor = localStorage.getItem('customColor');
    if (savedCustomColor) {
        body.style.backgroundColor = savedCustomColor;
        customColorInput.value = savedCustomColor;
    }

    // Custom Color Change
    customColorInput.addEventListener('input', function () {
        console.log("Color Input Changed!");
        const newColor = customColorInput.value;
        console.log("New Color:", newColor);
        body.style.backgroundColor = newColor;
        localStorage.setItem('customColor', newColor);
    });

    console.log("DOM Loaded!");
});

