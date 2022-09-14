<?php
include $_SERVER['DOCUMENT_ROOT'] . '/' . "include-all.php";

// Checks if the given list name exists (returns True or False)
function is_list($db, $list_name) {
    global $db_requests;
    $request = strtr($db_requests['list_check'], array("_LIST_" => $list_name));
    $results = $db->query($request);
    $ret_code = true;
    $cpt_rows = 0;
    if ($results != false) {
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $cpt_rows += 1;
        }
    }
    else error_log($request . " FAILED");
    if ($cpt_rows == 0) $ret_code = false;
    return $ret_code;
}

// Checks if the given user name exists (returns True or False)
function is_user($db, $user) {
    global $db_requests;
    $request = strtr($db_requests['user_check'], array("_USER_" => $user));
    $results = $db->query($request);
    $ret_code = true;
    $cpt_rows = 0;
    if ($results != false) {
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $cpt_rows += 1;
        }
    }
    else error_log($request . " FAILED");
    if ($cpt_rows == 0) $ret_code = false;
    return $ret_code;
}

// Retrieves a list of lists
function get_list_of_lists() {
    include $_SERVER['DOCUMENT_ROOT'] . '/' . "include-all.php";
    $db = new SQLite3($config['db_file']);
    $request = $db_requests['list_list'];
    $results = $db->query($request);
    $list_list = array();
    $cpt = 0;
    if ($results != false) {
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            // error_log("ROW ($cpt) ".print_r($row, true));
            if (! in_array($row['list_name'], $list_list) ) {
                array_push($list_list, $row['list_name']);
            }
            $cpt += 1;
        }
    }
    else error_log("Echec DB avec '$request'");
    return $list_list;
}

// Retrieves a list of users
function get_list_users($db) {
    include $_SERVER['DOCUMENT_ROOT'] . '/' . "include-all.php";
    # $db = new SQLite3($config['db_file']);
    $request = $db_requests['user_get_all'];
    $results = $db->query($request);
    $list_users = array();
    $cpt = 0;
    if ($results != false) {
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            // error_log("ROW ($cpt) ".print_r($row, true));
            if (! in_array($row['user_name'], $list_users) ) {
                array_push($list_users, $row['user_name']);
            }
            $cpt += 1;
        }
    }
    else error_log("Echec DB avec '$request'");
    return $list_users  ;
}

// Retrieves a list of items in a given list
function get_items($db, $e_list_name) {
    $request = strtr($db_requests['edit_list_items'], array("_LIST_"=> $e_list_name) );
    $results = $db->query($request);
    $list_items = array();
    $tmp_id_list = array();
    $cpt = 0;
    if ($results != false) {
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            if (! in_array($row['item_id'], $tmp_id_list) ) {
                array_push($tmp_id_list, $row['item_id']);
                array_push($list_items, [$row['item_id'], $row['item_content']]);
            }
            $cpt += 1;
        }
    }
    else error_log("Echec DB avec '$request'");
    return $list_items;
}

?>