<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: panel.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
    <script src="scripts.js" defer></script>
</head>

<body onload="diplayErrorMessage(), handlePasswordStrength()">
    <div class="container">
        <div class="back-to-start">
            <p>Powrót</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#4b7eec" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
        </div>
        <div class="main">
            <form action="loginCheck.php" method="POST">
                <div class="form-group">
                    <div class="hero">
                        <h1>Zaloguj się</h1>
                    </div>
                    <div class="inputs">
                        <div class="username">
                            <input type="text" name="username" id="username" placeholder="Nazwa użytkownika" value="" required>
                        </div>
                        <div class="password">
                            <input type="password" name="password" id="password" value="qWE7!# aa" placeholder="Hasło" minlength="9" required>
                            <p class="password-hint">co najmniej <span class="small_letter">jedna mała litera</span>, <span class="two_capital_letters">dokładnie 2 duże litery</span>, <span class="contains_7">7</span>, <span class="contains_exclamation">!</span>, <span class="contains_hash">#</span>, <span class="contains_space">spacja</span>, <span class="minlength_9">minimum 9 znaków</span></p>
                            <p class="hidden login-error"></p>
                        </div>
                    </div>
                    <div class="register">
                        <p>Nie masz konta? <a href="register.html">Zarejestruj się tutaj!</a></p>
                    </div>
                    <input type="submit" value="Zaloguj się" class="submit-button">
                </div>
            </form>
        </div>
    </div>
</body>

</html>