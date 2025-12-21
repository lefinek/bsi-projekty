<?php
header("Access-Control-Allow-Origin: *");

!empty($_GET['url']) ? $url = $_GET['url'] : die("Brak parametru URL");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0');

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Błąd: ' . curl_error($ch);
} else {
    echo $response;
}
