<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
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