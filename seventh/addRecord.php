<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'connect.php';

    $nr_indeksu = $_POST['nr_indeksu'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $wiek = $_POST['wiek'];
    $ulica = $_POST['ulica'];
    $kod_pocztowy = $_POST['kod_pocztowy'];
    $miasto = $_POST['miasto'];
    $plec = $_POST['plec'];

    $sth = $conn->prepare("INSERT INTO student (nr_indeksu, imie, nazwisko, wiek, ulica, kod_pocztowy, miasto, plec) VALUES (:nr_indeksu, :imie, :nazwisko, :wiek, :ulica, :kod_pocztowy, :miasto, :plec)");
    $sth->bindParam(':nr_indeksu', $nr_indeksu);
    $sth->bindParam(':imie', $imie);
    $sth->bindParam(':nazwisko', $nazwisko);
    $sth->bindParam(':wiek', $wiek);
    $sth->bindParam(':ulica', $ulica);
    $sth->bindParam(':kod_pocztowy', $kod_pocztowy);
    $sth->bindParam(':miasto', $miasto);
    $sth->bindParam(':plec', $plec);

    if ($sth->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Błąd podczas dodawania rekordu.";
    }
} else {
    echo "Nieprawidłowe żądanie.";
}
