<?php

include "include-all.php";

$user = "";
$pass = "";
$action = "";

if(array_key_exists('a_user_name', $_GET)) $user = $_GET['a_user_name'];
if(array_key_exists('a_user_pass', $_GET)) $pass = $_GET['a_user_pass'];
if(array_key_exists('act', $_GET)) $action = $_GET['act'];

echo "Action = '$action'<br>";
echo "User = '$user'<br>";
echo "Hash du password = '" . hash($config['password_hash'], $pass) . "'<br>";
// echo "Password = '$pass'<br>";


?>