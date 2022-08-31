<h2><?php echo $msg['TITLE_input_admin']; ?></h2>
<p>
<table>
    <tr><td>Utilisateur<td><input type="text" name="a_user_name" id="a_user_name"><br>
    <tr><td>Mot de passe<td><input type="password" name="a_user_pass" id="a_user_pass"><br>
</table>
</p>
<p class="ico_action">
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_ADDUSER']; ?>">
        <img src="images/add-user-64.png" onclick="get_admin('add')" />
    </span>
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_DELUSER']; ?>">
        <img src="images/remove-user-64.png" onclick="get_admin('del')" />
    </span>
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_CHGPWD']; ?>">
        <img src="images/edit-user-64.png" onclick="get_admin('pwd')" />
    </span>
</p>