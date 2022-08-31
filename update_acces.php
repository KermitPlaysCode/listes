<?php

$user = "";
$list = "";
$action = "";

if(array_key_exists('list_name', $_GET)) $user = $_GET['list_name'];
if(array_key_exists('user_name', $_GET)) $list = $_GET['user_name'];
if(array_key_exists('act', $_GET)) $action = $_GET['act'];

echo "Action = '$action'<br>";
echo "User = '$user'<br>";
echo "Liste = '$list'<br>"

?>