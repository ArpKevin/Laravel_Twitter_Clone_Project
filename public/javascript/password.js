window.addEventListener('load', function () {
    function togglePasswordVisibility(event, inputSelector) {
        const passwordInput = document.querySelector(inputSelector);
        if (event.type === "mousedown") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }

    const passwordButton = document.querySelector('.password-btn');
    const passwordConfirmationButton = document.querySelector('.password-confirmation-btn');

    if (passwordButton) {
        passwordButton.addEventListener('mousedown', (event) => togglePasswordVisibility(event, '.password-container input'));
        passwordButton.addEventListener('mouseup', (event) => togglePasswordVisibility(event, '.password-container input'));
    }
    
    if (passwordConfirmationButton) {
        passwordConfirmationButton.addEventListener('mousedown', (event) => togglePasswordVisibility(event, '.password-confirmation-container input'));
        passwordConfirmationButton.addEventListener('mouseup', (event) => togglePasswordVisibility(event, '.password-confirmation-container input'));
    }
});