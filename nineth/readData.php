<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$filename = 'data.txt';

if (file_exists($filename)) {
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $articles = [];

    foreach ($lines as $line) {
        $parts = explode(';', $line);
        if (count($parts) >= 3) {
            $articles[] = [
                'title' => $parts[0],
                'date' => $parts[1],
                'summary' => $parts[2]
            ];
        }
    }

    echo json_encode(['success' => true, 'articles' => $articles]);
} else {
    echo json_encode(['success' => false, 'message' => 'No data file found.']);
}
