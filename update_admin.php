<?php

include "include-all.php";

$user = "";
$pass = "";
$action = "";

if(array_key_exists('a_user_name', $_GET)) $user = $_GET['a_user_name'];
if(array_key_exists('a_user_pass', $_GET)) $pass = $_GET['a_user_pass'];
if(array_key_exists('act', $_GET)) $action = $_GET['act'];

$pwd_hash = hash($config['password_hash'], $pass);

echo "Action = '$action'<br>";
echo "User/Hash = '$user/$pwd_hash'<br>";

$db = new SQLite3($config['db_file']);

// Add a user
if ($action == "adm_add") {
    if ($user == "") {
        echo $msg['ADM_MISSING_USER'];
    }
    elseif (is_user($db, $user)) {
        echo "User $user already exists";
    }
    elseif ($pass == "") {
        echo $msg['ADM_MISSING_PASS'];
    }
    else {
    $request = strtr($db_requests['user_create'], array("_USER_" => $user, "_PASS_" => $pwd_hash));
    $results = $db->query($request);
    if ($results == false) echo "Failed create user $user pass $pwd_hash";
    else echo "User $user created";
    }
}
// Delete a user
elseif ($action == "adm_del") {
    if ($user == "") {
        echo $msg['ADM_MISSING_USER'];
    }
    elseif ( ! is_user($db, $user)) {
        echo "User $user does not exist";
    }    else {
    $request = strtr($db_requests['user_delete'], array("_USER_" => $user));
    $results = $db->query($request);
    if ($results == false) echo "Failed delete user $user";
    else echo "User $user deleted";
    }
}
// Change user password
elseif ($action == "adm_pwd") {
    if ($user == "") {
        echo $msg['ADM_MISSING_USER'];
    }
    elseif (! is_user($db, $user)) {
        echo "User $user does not exist";
    }
    elseif ($pass == "") {
        echo $msg['ADM_MISSING_PASS'];
    }
    else {
        $request = strtr($db_requests['user_password_change'], array("_USER_" => $user, "_PASS_" => $pwd_hash));
        $results = $db->query($request);
        if ($results == false) echo "Failed update password for user $user";
        else echo "Password update for user $user";
    }
}

?>