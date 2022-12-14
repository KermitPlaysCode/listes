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
        'CREATE TABLE listes (list_name text PRIMARY KEY, author text);',
        'CREATE TABLE items (item_id integer NOT NULL PRIMARY KEY, item_content text, list_name, author text);',
        'CREATE TABLE acces (user_name text PRIMARY KEY, list_name text);',
        'CREATE TABLE users (user_name text PRIMARY KEY, user_pass text);'
        ),
    'user_create' => "INSERT INTO users (user_name, user_pass) VALUES(:user, :pass);",
    'user_delete' => "DELETE FROM users WHERE user_name=:user ;",
    'user_password_change' => "UPDATE users set user_pass=:pass WHERE user_name=:user ;",
    'user_password_get' => "SELECT user_pass FROM users WHERE user=:user ;",
    'user_check' => "SELECT user_name FROM users WHERE user_name=:user ;",
    'user_get_all' => "SELECT user_name FROM users;",
    'list_create' => "INSERT INTO listes (list_name, author) VALUES(:list, :user);",
    'list_delete' => "DELETE FROM listes WHERE list_name=:list ;",
    'list_check' => "SELECT list_name FROM listes WHERE list_name=:list ;",
    'list_list' => "SELECT list_name FROM listes ;",
    'list_user_check' => "SELECT user_name FROM users WHERE user_name=:user ;",
    'list_allow_user' => "INSERT INTO acces (user_name, list_name) VALUES(:user, :list);",
    'list_block_user' => "DELETE FROM access WHERE user_name=:user AND list_name=:list ;",
    'edit_list_items' => "SELECT * FROM items WHERE list_name=:list ;",
    'edit_item_add' => "INSERT INTO items (item_content, list_name, author) VALUES(:item, :list, :author);",
    'edit_item_del' => "DELETE FROM items WHERE item_id=:itemid and list_name=:list ;",
    'edit_item_chg' => "UPDATE items set item_content=:item WHERE item_id=:itemid ;",
);
?>