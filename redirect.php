<?php

ini_set('display_errors', 0);

require_once 'config.php';

$url_id = $_GET['url'] ?? '';

$url = $pdo->query('SELECT `url` FROM ' . DB_TABLE . ' WHERE `id`=' . $pdo->quote($url_id))->fetchColumn();
if (empty($url)) {
    die('That short url does not exist '. $url_id );
}

if (TRACK) {
    $pdo->exec('UPDATE ' . DB_TABLE . ' SET `clicks`=`clicks`+1 WHERE `id`=' . $pdo->quote($url_id));
}

header('HTTP/1.1 ' . REDIRECT_RESPONSE_CODE);
header('Location: ' . $url);
exit;
