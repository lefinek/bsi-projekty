<?php
$json = file_get_contents('php://input');
$decoded = json_decode($json, true);

if (isset($decoded['clear']) && $decoded['clear'] === true) {
    file_put_contents('data.txt', '');
    exit;
}

$data = $decoded['data'] ?? null;

if ($data && isset($data['title'], $data['date'], $data['summary'])) {
    $title = $data['title'];
    $date = $data['date'];
    $summary = $data['summary'];

    $toWrite = $title . ";" . $date . ";" . $summary . "\n";

    $file = fopen('data.txt', 'a');
    if ($file) {
        fwrite($file, $toWrite);
        fclose($file);
    }
}
