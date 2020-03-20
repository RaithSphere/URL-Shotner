<?php

// db options
define('DB_HOST', '127.0.0.1');
define('DB_PORT', 3306);
define('DB_NAME', 'XXXXXX');
define('DB_USER', 'XXXXXX');
define('DB_PASSWORD', 'XXXXXXXXX');
define('DB_TABLE', 'urls');

// connect to database
try {
    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    die('DB connection failed.');
}

// base location of script (include trailing slash)
define('BASE_HREF', 'http://' . $_SERVER['HTTP_HOST'] . '/');

// define the redirect response code
define('REDIRECT_RESPONSE_CODE', '301 Moved Permanently');

// limit short url creation to defined IPs
define('LIMIT_TO_IPS', [$_SERVER['REMOTE_ADDR']]);

// track clicks
define('TRACK', true);

// length of the shortened URL ID
define('URL_ID_LENGTH', 4);

// shortened URL allowed characters
define('ALLOWED_CHARS', '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
