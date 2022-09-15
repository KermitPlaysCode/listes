<?php
include "include-all.php";

$action = "";
$user = "";
$content = "";
$list = "";
$item_id = 0;

if(array_key_exists('act', $_GET)) $action = urldecode($_GET['act']);
if(array_key_exists('e_user_name', $_GET)) $user = urldecode($_GET['e_user_name']);
if(array_key_exists('e_new_content', $_GET)) $content = urldecode($_GET['e_new_content']);
if(array_key_exists('e_list_name', $_GET)) $list = urldecode($_GET['e_list_name']);
if(array_key_exists('item_id', $_GET)) $item_id = urldecode($_GET['item_id']);

$db = new SQLite3($config['db_file']);

if ($action == "item_add") {
    $can_proceed = true;
    if ( $user == "") { echo "mq user"; $can_proceed = False; }
    if ( $content == "") { echo "mq content"; $can_proceed = False; }
    if ( $list == "" ) { echo "mq list"; $can_proceed = False; }
    if ( ! is_list($db, $list)) { echo "mq list"; $can_proceed = False; }
    if ($can_proceed) {
        #$request = strtr($db_requests['edit_item_add'], array('_ITEM_' => $content, '_LIST_' => $list, '_AUTHOR_' => $user));
        # $results = $db->query($request);
        $db_statement = $db->prepare($db_requests['edit_item_add']);
        $results = $results | $db_statement->bindValue(':item', $content, SQLITE3_TEXT);
        $results = $results | $db_statement->bindValue(':list', $list, SQLITE3_TEXT);
        $results = $results | $db_statement->bindValue(':author', $user, SQLITE3_TEXT);
        $results = $results | $db_statement->execute();
        if ($results == false) echo "Failed add item $content";
        else echo "Success add item $content";
    }
}
elseif ($action == "item_del") {
    $can_proceed = True;
    if ( $list == "" ) { echo "mq list"; $can_proceed = False; }
    if ( ! is_list($db, $list)) { echo "mq list"; $can_proceed = False; }
    if ( $item_id == 0) { echo "mq item_id"; $can_proceed = False; }
    if ($can_proceed) {
        # $results = $db->query($request);
        # $request = strtr($db_requests['edit_item_del'], array('_ITEMID_' => $item_id, '_LIST_' => $list));
        $db_statement = $db->prepare($db_requests['edit_item_del']);
        $results = $db_statement->bindValue(':list', $list, SQLITE3_TEXT);
        $results = $results | $db_statement->bindValue(':itemid', $item_id, SQLITE3_TEXT);
        $results = $results | $db_statement->execute();
        echo "del: $item_id => $request";
        if ($results == false) echo "Failed del item $content";
        else echo "Success del item $content";
    }
}
elseif ($action == "item_update") {
    echo "upd";
}
elseif ($action == "item_refresh") {
    if ($list == "") echo "Mq list";
    else {
        # $request = strtr($db_requests['edit_list_items'], array('_LIST_' => $list));
        # $results = $db->query($request);
        $db_statement = $db->prepare($db_requests['edit_list_items']);
        $results = $db_statement->bindValue(':list', $list, SQLITE3_TEXT);
	// BindValue OK ?
	if ($results != false) $results = $db_statement->execute();
	// Exec query OK ?
        if ($results == false) echo "Failed refresh item $list";
        else echo "Success refresh item $list";
    }
}

?>
