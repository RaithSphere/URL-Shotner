<?php
/**
 *
 *  * Copyright (c) 2020.
 *  * Created By RaithSphere
 *  * License: http://creativecommons.org/licenses/by/3.0/
 *
 */

include_once ("includes/config.inc.php");

$url_to_shorten = stripslashes(trim($_REQUEST['url']));

// Make sure we have a valid URL
if (empty($url_to_shorten) || !preg_match('|^https?://|', $url_to_shorten)) {
    die('Invalid URL '. $url_to_shorten);
}

// Check if the client IP is allowed to shorten
if (!in_array($_SERVER['REMOTE_ADDR'], LIMIT_TO_IPS, true)) {
    die('You are not allowed to shorten URLs with this service.');
}

$short->RegisterURL($url_to_shorten);