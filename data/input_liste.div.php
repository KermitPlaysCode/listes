<?php
include dirname(__FILE__) . "/../include-all.php";

$db = new SQLite3($config['db_file']);
?>

<h2><?php echo $msg['TITLE_input_liste']; ?></h2>
<!-- I put here a set of variables that i want to access via javascript
They appear early, So DOM has time to render them -->
<input type="hidden" id="e_list_name" value="" />
<input type='hidden' id='item_id' value='0' />
<!-- END of my variables storage -->
<p>
<table>
    <tr><td>Liste<td><select name="l_list_name" id="l_list_name">
    <?php
        // ici: requete DB pour avoir la liste des listes
        $nom_listes = get_list_of_lists($db);
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
        <img src="images/plus-5-64.png" onclick="do_action('list_add')" />
    </span>
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_DELLIST']; ?>">
        <img src="images/minus-5-64.png" onclick="do_action('list_del')" />
    </span>
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_EDITLIST']; ?>">
        <img src="images/edit-user-64.png" onclick="set_current_list()" />
    </span>
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_REFRESHLIST']; ?>">
        <img src="images/restart.png" onclick="update_data('list_refresh', 'input_liste')" />
    </span>
</p>

