<?php
/**
 *
 *  * Copyright (c) 2020.
 *  * Created By RaithSphere
 *  * License: http://creativecommons.org/licenses/by/3.0/
 *
 */

include_once ("includes/config.inc.php");

$url_id = $_GET['url'];

$short->getURL($url_id);