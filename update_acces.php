<?php

include "include-all.php";

$user = "";
$list = "";
$action = "";

if(array_key_exists('c_list_name', $_GET)) $user = $_GET['c_list_name'];
if(array_key_exists('c_user_name', $_GET)) $list = $_GET['c_user_name'];
if(array_key_exists('act', $_GET)) $action = $_GET['act'];

echo "Action = '$action'<br>";
echo "User = '$user'<br>";
echo "Liste = '$list'<br>"

?>