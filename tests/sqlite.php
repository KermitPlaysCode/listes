<?php

header("Content-type: text/plain");

$db_settings = array(
    // File for sqlite DB
    'file' => 'db.sqlite'
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
    'list_user_check' => "SELECT user_name FROM users WHERE user_name='_USER_';",
    'list_allow_user' => "INSERT INTO acces (user_name, list_name) VALUES('_USER_', '_LIST_');",
    'list_block_user' => "DELETE FROM access WHERE user_name='_USER_' AND list_name='_LIST_';"
    //'list_allow_all' => '',
    //'list_block_all' => ''
);

// Take care of first run
run_init = FALSE;
if ( ! file_exists($db_settings['file'])) run_init = TRUE;
$db = new SQLite3($db_settings['file']);
if (run_init) {
    foreach ($db_requests['init'] as $req) {
        $results = $db->query($req);
        if ($results != false) echo "$req\n\t => FAIL";
        else echo "$res\n\t => OK";
    }
}

$test_script = array(
    'user_create',
    'list_create',
    'list_allow_user',
    'list_user_check',
    'user_delete',
    'list_delete'
);

foreach ($test_script as $req) {
    $r = $db_requests[$req];
    if (is_string($r)) {
        $r = strtr($r, array(
            '_USER_' => 'oliv',
            '_PASS_' => 'test',
            '_LIST_' => 'liste_1',
            '_ITEM_' => 'item_A'
            )
        );
        echo "=========\nRequest = ".$r."\n";
        $results = $db->query($r);
        if ($results != false) {
            while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
                echo "*** Reply\n";
                var_dump($row);
            }
        }
        else echo "failure";
    }
    if (is_array($r)) {
        foreach ($r as $p) {
            $p = strtr($p, array(
                '_USER_' => 'oliv',
                '_PASS_' => 'test',
                '_LIST_' => 'liste_1',
                '_ITEM_' => 'item_A'
                )
            );            echo "=========\nRequest = ".$p."\n";
            $results = $db->query($p);
            if ($results != false) {
                while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
                    echo "*** Reply\n";
                    var_dump($row);
                }
            }
            else echo "failure";
        }
    }
    
}
?>