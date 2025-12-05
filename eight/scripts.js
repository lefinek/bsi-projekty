var backButton = document.querySelector('.back');
var backToStartButton = document.querySelector('.back-to-start');

if (backButton) {
    backButton.addEventListener('click', ()=>{
        back();
    });
}

if (backToStartButton) {
    backToStartButton.addEventListener('click', ()=>{
        backToStart();
    });
}

function back() {
    window.location.href = 'login.php';
}

function backToStart() {
    window.location.href = '../index.html';
}

function VerifyPassword() {
    var pw = document.getElementById("password").value;
    var cpw = document.getElementById("confirm_password").value;
    var passwordError = document.querySelector('.password-error');
    var button = document.querySelector('.submit-button');
    if (pw.length == 0 || cpw.length == 0) {
        passwordError.classList.add('hidden');
        return false;
    }
    if (pw != cpw) {
        passwordError.classList.remove('hidden');
        button.disabled = true;
        return false;
    }
    else {
        passwordError.classList.add('hidden');
        button.disabled = false;
        return true;
    }
}

function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null, ''])[1].replace(/\+/g, '%20')) || null;
}

function diplayErrorMessage() {
    var errorMessage = getURLParameter('error');
if (errorMessage) {
    var errorElementRegister = document.querySelector('.error');
    var errorElementLogin = document.querySelector('.login-error');
    if(errorElementLogin){
        if (errorMessage == '3'){
            errorMessage = 'Błąd!\nPodane hasło nie jest poprawne. Spróbuj ponownie.';
        } else if (errorMessage == '4') {
            errorMessage = 'Błąd!\nNieprawidłowa nazwa użytkownika. Spróbuj ponownie.';
        } else if (errorMessage == '5') {
            errorMessage = 'Wystąpił nieznany błąd. Spróbuj ponownie.';
        } else if (errorMessage == '6') {
            errorMessage = 'Dostęp zabroniony. Zaloguj się, aby uzyskać dostęp do panelu.';
        }
        errorElementLogin.textContent = errorMessage;
        errorElementLogin.classList.remove('hidden');
    }
    if(errorElementRegister){
        if (errorMessage == '1'){
            errorMessage = 'Błąd!\nNie udało się zarejestrować użytkownika. Spróbuj ponownie.';
        } else if (errorMessage == '2') {
            errorMessage = 'Błąd!\nNazwa użytkownika jest już zajęta. Wybierz inną.';
        } else if (errorMessage == '0') {
            errorMessage = 'Wystąpił nieznany błąd. Spróbuj ponownie.';
        } else if (errorMessage == '3') {
            errorMessage = 'Błąd!\n Podane hasła nie są identyczne. Spróbuj ponownie.';
        } else if (errorMessage == '4') {
            errorMessage = 'Błąd!\n Hasło nie spełnia wymagań bezpieczeństwa. Spróbuj ponownie.';
        }
        errorElementRegister.textContent = errorMessage;
        errorElementRegister.classList.remove('hidden');
    }
    
}
}

function isPasswordStrong(password) {
    var smallLetter = /[a-z]/;
    var twoCapitalLetters = /^(?:[^A-Z]*[A-Z]){2}[^A-Z]*$/;
    var contains7 = /7/;
    var containsExclamation = /!/;
    var containsHash = /#/;
    var containsSpace = / /;
    var minLength = /.{9,}/;

    var smallLetterSpan = document.querySelector('.password-hint .small_letter');
    var twoCapitalLettersSpan = document.querySelector('.password-hint .two_capital_letters');
    var contains7Span = document.querySelector('.password-hint .contains_7');
    var containsExclamationSpan = document.querySelector('.password-hint .contains_exclamation');
    var containsHashSpan = document.querySelector('.password-hint .contains_hash');
    var containsSpaceSpan = document.querySelector('.password-hint .contains_space');
    var minLengthSpan = document.querySelector('.password-hint .minlength_9');

    if (smallLetter.test(password)) {
        smallLetterSpan.style.color = 'green';
    } else {
        smallLetterSpan.style.color = 'rgba(75, 126, 236, 0.7)';
    }

    if (twoCapitalLetters.test(password)) {
        twoCapitalLettersSpan.style.color = 'green';
    } else {
        twoCapitalLettersSpan.style.color = 'rgba(75, 126, 236, 0.7)';
    }

    if (contains7.test(password)) {
        contains7Span.style.color = 'green';
    } else {
        contains7Span.style.color = 'rgba(75, 126, 236, 0.7)';
    }

    if (containsExclamation.test(password)) {
        containsExclamationSpan.style.color = 'green';
    } else {
        containsExclamationSpan.style.color = 'rgba(75, 126, 236, 0.7)';
    }

    if (containsHash.test(password)) {
        containsHashSpan.style.color = 'green';
    } else {
        containsHashSpan.style.color = 'rgba(75, 126, 236, 0.7)';
    }

    if (containsSpace.test(password)) {
        containsSpaceSpan.style.color = 'green';
    } else {
        containsSpaceSpan.style.color = 'rgba(75, 126, 236, 0.7)';
    }

    if (minLength.test(password)) {
        minLengthSpan.style.color = 'green';
    } else {
        minLengthSpan.style.color = 'rgba(75, 126, 236, 0.7)';
    }   

    return smallLetter.test(password) &&
           twoCapitalLetters.test(password) &&
           contains7.test(password) &&
           containsExclamation.test(password) &&
           containsHash.test(password) &&
           containsSpace.test(password) &&
           minLength.test(password);
}

function handlePasswordStrength() {
    var passwordInput = document.getElementById("password");
    var passwordHint = document.querySelector('.password-hint');
    var button = document.querySelector('.submit-button');
    if (passwordInput.value.length == 0) {
        passwordHint.classList.add('hidden');
        button.disabled = true;
        return;
    }
    if (isPasswordStrong(passwordInput.value)) {
        passwordHint.classList.add('hidden');
        button.disabled = false;
    } else {
        passwordHint.classList.remove('hidden');
        button.disabled = true;
    }
}

var passwordInput = document.querySelector("#password");
passwordInput.addEventListener('input', handlePasswordStrength);

var passwordInputs = document.querySelectorAll('#password, #confirm_password');
passwordInputs.forEach(input => {
    input.addEventListener('change', VerifyPassword);
});