<?php
include $_SERVER['DOCUMENT_ROOT'] . '/' . "include-all.php";

$db = new SQLite3($config['db_file']);

$list = "" ;
$items = array();

if(array_key_exists('e_list_name', $_GET)) $list = $_GET['e_list_name'];
$flag_continue = True;
if (! is_list($db, $list)) {
    # Leave empty and leave if no list provided
    echo "<h2>" . $msg['CHOOSE_LIST'] . "</h2>\n";
    $flag_continue = False;
}
else {
    # Get items
    $items = get_items($db, $list);
}

echo "<h2>" . $list . "</h2>\n";
echo '<input type="hidden" id="e_user_name" value="'. 'FAKE_USER' .'" />';

if ( $flag_continue ) {
    echo "<table>";
    echo "<thead><th>".$msg['EDIT_H_ACTIONS']."<th>".$msg['EDIT_H_ID']."<th>".$msg['EDIT_H_CONTENT']."</thead>";

    foreach ($items as $i) {
        $item_id = $i[0];
        $item_content = $i[1];
        echo '<tr><td><span class="ico_action">';
        echo '<span class="hint--rounded" aria-label="' . $msg["TT_EDITITEM"] . '">';
        echo '<img src="images/edit-user-64.png" onclick="do_action(\'item_edit\')" />';
        echo '</span><span class="hint--rounded" aria-label="' . $msg["TT_DELITEM"] . '">';
        echo '<img src="images/minus-5-64.png" onclick="set_item_id(\''.$item_id.'\'); do_action(\'item_del\');" />';
        echo '</span></span>';
        echo "<td align='center'>$item_id<td>$item_content</tr>";
    }
    echo '<tr><td><span class="ico_action">';
    echo '<span class="hint--rounded" aria-label="'.$msg["TT_ADDITEM"].'">';
    echo '<img src="images/plus-5-64.png" onclick="do_action(\'item_add\')" />';
    echo '</span></span>';
    echo '<td>(new)<td><input type="text" id="e_new_content"></tr>';
    echo '</table>';

}