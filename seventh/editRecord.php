<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require 'connect.php';

    $id = $_GET['id'];
    $nr_indeksu = $_GET['nr_indeksu_edit'];
    $imie = $_GET['imie_edit'];
    $nazwisko = $_GET['nazwisko_edit'];
    $wiek = $_GET['wiek_edit'];
    $ulica = $_GET['ulica_edit'];
    $kod_pocztowy = $_GET['kod_pocztowy_edit'];
    $miasto = $_GET['miasto_edit'];
    $plec = $_GET['plec_edit'];

    $sth = $conn->prepare("UPDATE student SET nr_indeksu = :nr_indeksu, imie = :imie, nazwisko = :nazwisko, wiek = :wiek, ulica = :ulica, kod_pocztowy = :kod_pocztowy, miasto = :miasto, plec = :plec WHERE id = :id");
    $sth->bindParam(':nr_indeksu', $nr_indeksu);
    $sth->bindParam(':imie', $imie);
    $sth->bindParam(':nazwisko', $nazwisko);
    $sth->bindParam(':wiek', $wiek);
    $sth->bindParam(':ulica', $ulica);
    $sth->bindParam(':kod_pocztowy', $kod_pocztowy);
    $sth->bindParam(':miasto', $miasto);
    $sth->bindParam(':plec', $plec);
    $sth->bindParam(':id', $id);

    if ($sth->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Błąd podczas edytowania rekordu.";
    }
} else {
    echo "Nieprawidłowe żądanie.";
}
