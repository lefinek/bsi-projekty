<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require 'connect.php';

    $id = $_GET['id'];

    $sth = $conn->prepare("DELETE FROM student WHERE id = :id");
    $sth->bindParam(':id', $id);

    if ($sth->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Błąd podczas usuwania rekordu.";
    }
} else {
    echo "Nieprawidłowe żądanie.";
}
