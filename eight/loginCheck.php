<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'connect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT salt, password_hash FROM user WHERE login = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $salt = $user['salt'];
        $stored_hash = $user['password_hash'];

        $bcrypt_salt = substr($salt, 0, 22);
        $options = [
            'cost' => 12,
            'salt' => $bcrypt_salt,
        ];

        $input_hash = password_hash($password, PASSWORD_BCRYPT, $options);

        if ($input_hash === $stored_hash) {
            session_start();
            $_SESSION['user_id'] = $username;
            $_SESSION['logged_in'] = true;

            header("Location: panel.php");
            exit();
        } else {
            echo $input_hash;
            echo '<br>';
            echo $stored_hash;
            // header("Location: login.php?error=3");
            // exit();
        }
    } else {
        header("Location: login.php?error=4");
        exit();
    }
} else {
    header("Location: login.php?error=5");
    exit();
}
