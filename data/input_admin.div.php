<?php
include dirname(__FILE__) . "/../include-all.php";
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
