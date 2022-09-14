<?php

include "include-all.php";

$list_existing = "";
$list_new = "";
$action = "";

if(array_key_exists('l_list_name', $_GET)) $list_existing = $_GET['l_list_name'];
if(array_key_exists('l_list_name_new', $_GET)) $list_new = $_GET['l_list_name_new'];
if(array_key_exists('act', $_GET)) $action = $_GET['act'];

$db = new SQLite3($config['db_file']);

if ($action == "list_add") {
    $res = is_list($db, $list_new);
    if ($list_new == "") echo $msg['LIST_NAME_MISSING'];
    elseif ($res) echo $msg['LIST_CREATE_FAIL_DUP']; // "Table already exits ($list_new)";
    else {
        $request = strtr($db_requests['list_create'], array("_LIST_" => $list_new));
        $results = $db->exec($request);
        if ($results == false) echo $msg['LIST_DELETE_FAIL_DB'];
        else echo $msg['LIST_CREATE_OK'];
    }
}
elseif ($action == "list_del") {
    if ($list_existing == "") {
        echo $msg['LIST_NAME_MISSING'];
    }
    $res = is_list($db, $list_existing);
    if ($res == true) {
        $request = strtr($db_requests['list_delete'], array("_LIST_" => $list_existing));
        $results = $db->query($request);
        if ($results == false) echo "Failed deletion $list_new";
        else echo "List $list_existing deleted ($request)";
    }
    else echo "List '$list_existing' doesn't exist";
}
elseif ($action == "list_edit") {
    echo "Edit $list_existing";
}

?>