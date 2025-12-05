<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'connect.php';

    $name = $_POST['fname'];
    $lastname = $_POST['lname'];
    $gender = $_POST['gender'];
    $preferences = $_POST['preferences'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // $number = random_bytes(16);
    $salt = base64_encode($number);
    // $bcrypt_salt = substr($salt, 0, 22);
    // $options = [
    //     'cost' => 12,
    //     'salt' => $bcrypt_salt,
    // ];
    // $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $chck = $conn->prepare("SELECT COUNT(*) FROM user WHERE login = :username");
    $chck->bindParam(':username', $username);
    $chck->execute();
    $count = $chck->fetchColumn();
    if ($count > 0) {
        header("Location: register.html?error=2");
        exit();
    }

    $repass = $_POST['confirm_password'];
    if ($password !== $repass) {
        header("Location: register.html?error=3");
        exit();
    }

    $smallLetter = preg_match('/[a-z]/', $password);
    $twoCapitalLetters = preg_match('/^(?:[^A-Z]*[A-Z]){2}[^A-Z]*$/', $password);
    $contains7 = preg_match('/7/', $password);
    $containsExclamation = preg_match('/!/', $password);
    $containsHash = preg_match('/#/', $password);
    $containsSpace = preg_match('/\s/', $password);
    $minLength = strlen($password) >= 9;

    if (!$smallLetter || !$twoCapitalLetters || !$contains7 || !$containsExclamation || !$containsHash || $containsSpace || !$minLength) {
        // header("Location: register.html?error=4");
        // exit();
        echo $smallLetter;
        echo '<br>';
        echo $twoCapitalLetters;
        echo '<br>';
        echo $contains7;
        echo '<br>';
        echo $containsExclamation;
        echo '<br>';
        echo $containsHash;
        echo '<br>';
        echo $containsSpace;
        echo '<br>';
        echo $minLength;
        echo '<br>';
    }

    $stmt = $conn->prepare("INSERT into user (name, last_name, salt, password_hash, login, gender, preference) VALUES (:name, :lastname, :salt, :password_hash, :username, :gender, :preferences)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':salt', $salt);
    $stmt->bindParam(':password_hash', $password_hash);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':preferences', $preferences);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        header("Location: register.html?error=1");
        echo $name . ' ';
        echo $lastname . ' ';
        echo $gender . ' ';
        echo $preferences . ' ';
        echo $username . ' ';
        echo $password . ' ';
        echo $salt . ' ';
        echo 'a to jest hasz: ';
        echo $password_hash . ' ';
        exit();
    }
} else {
    header("Location: register.html?error=0");
    exit();
}
