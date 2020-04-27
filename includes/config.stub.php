<?php
/**
 *
 *  * Copyright (c) 2020.
 *  * Created By RaithSphere
 *  * License: http://creativecommons.org/licenses/by/3.0/
 *
 */

defined('ROOT_PATH') or
define('ROOT_PATH', realpath(dirname(__FILE__) . '/..'));

define('DB_HOST', '127.0.0.1');
define('DB_PORT', 3306);
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASSWORD', '');
define('DB_TABLE', '');
define('BASE_HREF', 'http://' . $_SERVER['HTTP_HOST'] . '/');
define('LIMIT_TO_IPS', [$_SERVER['REMOTE_ADDR']]);
define('TRACK', true);
define('REDIRECT_RESPONSE_CODE', '301 Moved Permanently');

ini_set('error_reporting', 'true');
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/shorten.class.php");

use shortner\short;
$short = new short();

$short->InitDB(DB_HOST,
    DB_USER,
    DB_PASSWORD,
    DB_NAME,
    DB_TABLE
);
