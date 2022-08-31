<?php

require_once('config.php');
require_once('messages_FR.php')
global $config;
global $msg;

header("Content-type: text/plain");

$db = new SQLite3($config['db']);

$test_table_php_pad = "SELECT name from sqlite_master WHERE type='table' AND name='php-pad-infos';";
res = $db->exec($test_table_php_pad);
if (res == 0) {
    echo $msg['INIT_ALREADY_DONE'];
    exit(0);
}
echo $msg['INIT_START'];
echo $msg['INIT_TBL_LISTS'];
$create_tbl_lists = "CREATE TABLE 'Listes'(
    ID INT PRIMARY KEY NOT NULL,
    Nom_Liste TEXT NOT NULL,
    Nom_item TEXT NOT NULL
);";
$db->exec($create_tbl_lists);
echo $msg["OK"];

echo $msg['INIT_TBL_USERS'];
$create_tbl_users = "CREATE TABLE 'Utilisateurs'(
    ID INT PRIMARY KEY NOT NULL,
    Utilisateur TEXT NOT NULL,
    MotDePasse TEXT NOT NULL,
    ListesAutorisees TEXT NOT NULL
);";
$db->exec($create_tbl_users);
echo $msg["OK"];

echo $msg['INIT_TBL_INIT'];
$create_tbl_phppad = "CREATE TABLE 'php-pad'(
    ID INT PRIMARY KEY NOT NULL,
    FAKE TEXT NOT NULL
);";
$db->exec($create_tbl_phppad);
echo $msg["OK"];

echo $msg['INIT_SUCCESS']
?>