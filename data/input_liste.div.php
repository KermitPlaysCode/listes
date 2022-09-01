<?php
function get_list_of_list() {
    include "include-all.php";
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
?>

<h2><?php echo $msg['TITLE_input_liste']; ?></h2>
<p>
<table>
    <tr><td>Liste<td><select name="l_list_name" id="l_list_name">
    <?php
        // ici: requete DB pour avoir la liste des listes
        $nom_listes = get_list_of_list();
        foreach($nom_listes as $n)
        {
            echo "<option value='$n' id='$n'>$n</option>";
        }
    ?>
    </select>
    <tr><td colspan="2">
    <tr><td>Liste (nouvelle)<td><input type="text" id="l_list_name_new">
    </table>
</p>
<p class="ico_action">
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_ADDLIST']; ?>">
        <img src="images/plus-5-64.png" onclick="get_data('list_add')" />
    </span>
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_DELLIST']; ?>">
        <img src="images/minus-5-64.png" onclick="get_data('list_del')" />
    </span>
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_EDITLIST']; ?>">
        <img src="images/minus-5-64.png" onclick="get_data('list_edit')" />
    </span>
</p>