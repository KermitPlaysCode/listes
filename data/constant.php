<?php

$cd = getcwd();

$div_to_file = array(
    'liste'         => $cd . '/data/liste.div.php',
    'input_admin'   => $cd . '/data/input_admin.div.php',
    'input_liste'   => $cd . '/data/input_liste.div.php',
    'input_acces'   => $cd . '/data/input_acces.div.php',
    'console'       => $cd . '/data/console.div.php'
);

$db_requests = array(
    // SQL request to create tables
    // Replace strings before running:
    // _USER_ => username
    // _PASS_ => password hash
    // _LIST_ => list name
    // _ITEM_ => item
    'deinit' => array(
        'DROP TABLE listes;',
        'DROP TABLE items;',
        'DROP TABLE acces;',
        'DROP TABLE users;'
        ),
    'init' => array(
        'CREATE TABLE listes (list_name text, author text);',
        'CREATE TABLE items (item_name text, list_name, author text);',
        'CREATE TABLE acces (user_name text, list_name text);',
        'CREATE TABLE users (user_name text, user_pass text);'
        ),
    'user_create' => "INSERT INTO users (user_name, user_pass) VALUES('_USER_', '_PASS_');",
    'user_delete' => "DELETE FROM users WHERE user_name='_USER_';",
    'user_password_change' => "UPDATE users set _PASS_ WHERE user_name='_USER_';",
    'user_password_get' => "SELECT user_pass FROM users WHERE user='_USER_';",
    'list_create' => "INSERT INTO listes (list_name, author) VALUES('_LIST_', '_USER_');",
    'list_delete' => "DELETE FROM listes WHERE list_name='_LIST_';",
    'list_check' => "SELECT list_name FROM listes WHERE list_name='_LIST_';",
    'list_list' => "SELECT list_name FROM listes;",
    'list_user_check' => "SELECT user_name FROM users WHERE user_name='_USER_';",
    'list_allow_user' => "INSERT INTO acces (user_name, list_name) VALUES('_USER_', '_LIST_');",
    'list_block_user' => "DELETE FROM access WHERE user_name='_USER_' AND list_name='_LIST_';"
    //'list_allow_all' => '',
    //'list_block_all' => ''
);
?>