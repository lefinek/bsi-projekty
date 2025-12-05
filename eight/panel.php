<?php
session_start();
if ($_SESSION['logged_in'] !== true) {
    header("Location: login.php?error=6");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tajny panel</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>
    <div class="container">
        <div class="main">
            <div class="hero">
                <h1>Bardzo tajny panel</h1>
            </div>
            <div class="content">
                <?php
                require_once 'connect.php';
                $username = $_SESSION['user_id'];
                $stmt = $conn->prepare("SELECT * FROM user WHERE login = :username");
                $stmt->bindParam(':username', $username);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    $preferences = $user['preference'];
                    $gender = $user['gender'];
                    $salt = $user['salt'];
                }
                ?>

                <div class="hero">
                    <h1>Witaj, <?php echo ($user['name']); ?>!</h1>
                </div>
                <div class="data">
                    <p><strong>Imię:</strong> <?php echo ($user['name']); ?></p>
                    <p><strong>Nazwisko:</strong> <?php echo ($user['last_name']); ?></p>
                    <p><strong>Płeć:</strong> <?php echo $gender ?></p>
                    <p><strong>Preferencje:</strong> <?php echo $preferences; ?></p>
                    <p><strong>Login:</strong> <?php echo ($user['login']); ?></p>
                    <!-- <p><strong>Sól haszowania hasła:</strong> ></p> -->
                </div>
                <div class="logout">
                    <input type="submit" class="logout-button" value="Wyloguj się" onclick="location.href='logout.php'">
                </div>
            </div>
            <div class="about">
                <h2>Jakub Strzelczak</h2>
                <p>Numer albumu: 227684</p>
                <h4>grudzień 2025</h4>
            </div>
        </div>
</body>

</html>