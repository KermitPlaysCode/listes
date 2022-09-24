<?php
include dirname(__FILE__) . "/../include-all.php";

// Checks if the given list name exists (returns True or False)
function is_list($db, $list_name) {
    global $db_requests;
    $ret_code = true; # bool to return
    $cpt_rows = 0;    # count of rows, value I test
    # $request = strtr($db_requests['list_check'], array("_LIST_" => $list_name));
    # $results = $db->query($request);
    $db_statement = $db->prepare($db_requests['list_check']);
    $results = $db_statement->bindValue(':list', $list_name, SQLITE3_TEXT);
    # if bindValue is OK, execute
    if ($results != False) $results = $db_statement->execute();
    # if execution is OK, parse the answer
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
    $ret_code = true; # bool to return
    $cpt_rows = 0;    # count of rows, value I test
    # $request = strtr($db_requests['user_check'], array("_USER_" => $user));
    # $results = $db->query($request);
    $db_statement = $db->prepare($db_requests['user_check']);
    $results = $db_statement->bindValue(':user', $user, SQLITE3_TEXT);
    # if bindValue is OK, execute
    if ($results != False) $results = $db_statement->execute();
    # if execution is OK, parse the answer
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
function get_list_of_lists($db) {
    // include $_SERVER['DOCUMENT_ROOT'] . '/' . "include-all.php";
    global $db_requests;
    $list_list = array();
    $cpt = 0;
    $request = $db_requests['list_list'];
    $results = $db->query($request);
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
    global $db_requests;
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
    global $db_requests;
    $list_items = array();
    $tmp_id_list = array();
    $cpt = 0;
    # $request = strtr($db_requests['edit_list_items'], array("_LIST_"=> $e_list_name) );
    # $results = $db->query($request);
    $db_statement = $db->prepare($db_requests['edit_list_items']);
    $results = $db_statement->bindValue(':list', $e_list_name, SQLITE3_TEXT);
    # if bindValue is OK, execute
    if ($results != False) $results = $db_statement->execute();
    else error_log("Echec bindValue");
    # if execution is OK, parse the answer
    if ($results != false) {
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            if (! in_array($row['item_id'], $tmp_id_list) ) {
                array_push($tmp_id_list, $row['item_id']);
                array_push($list_items, [$row['item_id'], $row['item_content']]);
            }
            $cpt += 1;
        }
    }
    else error_log("get_items(): failure DB request");
    return $list_items;
}

?>
