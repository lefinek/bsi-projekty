<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");

!empty($_GET['url']) ? $url = $_GET['url'] : die("Brak parametru URL");

error_log("getData.php: Fetching URL: " . $url);

// Opcje dla file_get_contents
$opts = array(
    'http' => array(
        'method' => "GET",
        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\r\n" .
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n" .
            "Accept-Language: pl-PL,pl;q=0.9,en-US;q=0.8,en;q=0.7\r\n",
        'timeout' => 30,
        'follow_location' => 1,
        'max_redirects' => 5
    ),
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
    )
);

$context = stream_context_create($opts);
$response = @file_get_contents($url, false, $context);

if ($response === false) {
    http_response_code(500);
    $error = error_get_last();
    error_log("getData.php: Error: " . ($error['message'] ?? 'Unknown error'));
    echo 'Błąd pobierania: ' . ($error['message'] ?? 'Unknown error');
} else {
    error_log("getData.php: Success, response length: " . strlen($response));
    echo $response;
}
