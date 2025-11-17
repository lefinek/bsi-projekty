<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dane z formularza</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>
    <div class="container">
        <div class="back">
            <p>Powrót</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#4b7eec" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
        </div>
        <div class="main">
            <div class="hero">
                <h1>Dane pobrane z formularza</h1>
            </div>
            <div class="content">
                <?php
                $is = false;
                if (!empty($_POST['fname'])) {
                    $is = true;
                    $fname = $_POST['fname'];
                    echo "<div class='row'>
                            <h2>Imię:</h2>
                            <p>$fname</p>
                        </div>";
                }
                if (!empty($_POST['lname'])) {
                    $is = true;
                    $lname = $_POST['lname'];
                    echo "<div class='row'>
                            <h2>Nazwisko:</h2>
                            <p>$lname</p>
                        </div>";
                }
                if (!empty($_POST['bdate'])) {
                    $is = true;
                    $bdate = $_POST['bdate'];
                    echo "<div class='row'>
                            <h2>Data urodzenia:</h2>
                            <p>$bdate</p>
                        </div>";
                }
                if (!empty($_POST['email'])) {
                    $is = true;
                    $email = $_POST['email'];
                    echo "<div class='row'>
                            <h2>Adres e-mail:</h2>
                            <p>$email</p>
                        </div>";
                }
                if (!empty($_POST['tnumber'])) {
                    $is = true;
                    $tnumber = $_POST['tnumber'];
                    echo "<div class='row'>
                            <h2>Numer telefonu:</h2>
                            <p>$tnumber</p>
                        </div>";
                }
                if (!empty($_POST['address'])) {
                    $is = true;
                    $address = $_POST['address'];
                    echo "<div class='row'>
                            <h2>Adres zamieszkania:</h2>
                            <p>$address</p>
                        </div>";
                }
                if (!empty($_POST['city'])) {
                    $is = true;
                    $city = $_POST['city'];
                    echo "<div class='row'>
                            <h2>Miasto:</h2>
                            <p>$city</p>
                        </div>";
                }
                if (!empty($_POST['postal'])) {
                    $is = true;
                    $postal = $_POST['postal'];
                    echo "<div class='row'>
                            <h2>Kod pocztowy:</h2>
                            <p>$postal</p>
                        </div>";
                }
                if (!empty($_POST['region'])) {
                    $is = true;
                    $region = $_POST['region'];
                    echo "<div class='row'>
                            <h2>Województwo:</h2>
                            <p>$region</p>
                        </div>";
                }
                if (!empty($_POST['password'])) {
                    $is = true;
                    $password = $_POST['password'];
                    echo "<div class='row'>
                            <h2>Hasło:</h2>
                            <p>$password</p>
                        </div>";
                }
                if (!empty($_POST['gender'])) {
                    $is = true;
                    $gender = $_POST['gender'] == "male" ? "Mężczyzna" : "Kobieta";
                    echo "<div class='row'>
                            <h2>Płeć:</h2>
                            <p>$gender</p>
                        </div>";
                }
                if (isset($_POST['dlicense'])) {
                    $is = true;
                    $dlicense = isset($_POST['dlicense']) ? 'Tak' : 'Nie';
                    echo "<div class='row'>
                            <h2>Prawo jazdy:</h2>
                            <p>$dlicense</p>
                        </div>";
                }
                if (!empty($_POST['extra'])) {
                    $is = true;
                    $extra = $_POST['extra'];
                    echo "<div class='row'>
                            <h2>Dodatkowe informacje:</h2>
                            <p>$extra</p>
                        </div>";
                }
                if (!$is) {
                    echo "<p class='error'>Formularz nie został wypełniony. Proszę wypełnić wszystkie pola formularza!</p>";
                }
                ?>
                <a href="#" onclick="window.open('index.txt', '_blank');">Zobacz kod źródłowy</a>
                <a href="index.txt" download>Pobierz kod źródłowy</a>
            </div>
            <div class="about">
                <h2>Jakub Strzelczak</h2>
                <p>Numer albumu: 227684</p>
                <h4>październik 2025</h4>
            </div>
        </div>
    </div>
</body>

</html>