<?php

// $pathinfo = pathinfo(__FILE__);
// $base_directory = $pathinfo['dirname'];
$base_directory = dirname(__FILE__);
global $base_directory;

include $base_directory . '/' . "config.php";
global $config;

include $base_directory . '/' . "data/constant.php";
global $db_requests;
global $div_to_file;

include $base_directory . '/' . "messages/FR.php";
global $msg;

require_once($base_directory . '/' . "lib/functions-db.php");

?>
