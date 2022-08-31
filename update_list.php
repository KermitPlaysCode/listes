<?php

$list_existing = "";
$list_new = "";
$action = "";

if(array_key_exists('l_list_name', $_GET)) $list_existing = $_GET['l_list_name'];
if(array_key_exists('l_list_name_new', $_GET)) $list_new = $_GET['l_list_name_new'];
if(array_key_exists('act', $_GET)) $action = $_GET['act'];

if ($action == "list_add") {
    if ($list_new == "") echo "Missing new list name !";
    else echo "Add $list_new";
}
elseif ($action == "list_del") {
    echo "Del $list_existing";
}
elseif ($action == "list_edit") {
    echo "Edit $list_existing";
}

?>