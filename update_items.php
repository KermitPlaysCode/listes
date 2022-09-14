<?php
include $_SERVER['DOCUMENT_ROOT'] . '/' . "include-all.php";

$user = "";
$content = "";
$list = "";
$action = "";

if(array_key_exists('act', $_GET)) $action = $_GET['act'];
if(array_key_exists('e_user_name', $_GET)) $user = $_GET['e_user_name'];
if(array_key_exists('e_new_content', $_GET)) $content = $_GET['e_new_content'];
if(array_key_exists('e_list_name', $_GET)) $list = $_GET['e_list_name'];

$db = new SQLite3($config['db_file']);

if ($action == "item_add") {
    $can_proceed = true;
    if ( $user == "") { echo "mq user"; $can_proceed = False; }
    if ( $content == "") { echo "mq content"; $can_proceed = False; }
    if ( $list == "" ) { echo "mq list"; $can_proceed = False; }
    if ( ! is_list($db, $list)) { echo "mq list"; $can_proceed = False; }
    $request = strtr($db_requests['edit_item_add'], array('_ITEM_' => $content, '_LIST_' => $list, '_AUTHOR_' => $user));
    echo "REQ='$request'";
    if ($can_proceed) {
        $results = $db->query($request);
        if ($results == false) echo "Failed add item $content";
        else echo "Success add item $content";
    }
}
elseif ($action == "item_delete") {
    echo "del";
}
elseif ($action == "item_update") {
    echo "upd";
}
elseif ($action == "item_refresh") {
    if ($list == "") echo "Mq list";
    else {
        $request = strtr($db_requests['edit_list_items'], array('_LIST_' => $list));
        $results = $db->query($request);
        if ($results == false) echo "Failed refresh item $list";
        else echo "Success refresh item $list";
    }
}

?>