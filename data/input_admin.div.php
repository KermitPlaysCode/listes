<?php
include $_SERVER['DOCUMENT_ROOT'] . '/' . "include-all.php";


function get_list_users($db) {
    include $_SERVER['DOCUMENT_ROOT'] . '/' . "include-all.php";
    $db = new SQLite3($config['db_file']);
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
?>

<h2><?php echo $msg['TITLE_input_admin']; ?></h2>
<p>
<table>
    <tr><td>Utilisateur<td><input type="text" name="a_user_name" id="a_user_name"><br>
    <tr><td><td><select id="a_users" onchange="update_text('a_users', 'a_user_name')">
        <?php
        $db = new SQLite3($config['db_file']);
        $nom_users = get_list_users($db);
        echo "<option value='' id='-'>-</option>";
        foreach($nom_users as $n)
        {
            echo "<option value='$n' id='$n'>$n</option>";
        }
        ?></select>
    <tr><td>Mot de passe<td><input type="password" name="a_user_pass" id="a_user_pass"><br>
</table>
</p>
<p class="ico_action">
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_ADDUSER']; ?>">
        <img src="images/add-user-64.png" onclick="do_action('adm_add')" />
    </span>
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_DELUSER']; ?>">
        <img src="images/remove-user-64.png" onclick="do_action('adm_del')" />
    </span>
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_CHGPWD']; ?>">
        <img src="images/edit-user-64.png" onclick="do_action('adm_pwd')" />
    </span>
</p>