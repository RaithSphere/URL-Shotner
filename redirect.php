<?php
include_once ("includes/config.inc.php");

$url_id = $_GET['url'] ?? '';

$short->getURL($url_id);