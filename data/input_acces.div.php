<h2><?php echo $msg['TITLE_input_acces']; ?></h2>
<p>
<table>
    <tr><td>Liste<td><input type="string" name="c_list_name" id="c_list_name"><br>
    <tr><td>Utilisateur<td><input type="test" name="c_user_name" id="c_user_name"><br>
</table>
</p>
<p class="ico_action">
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_ACCES_ALLOWONE']; ?>">
        <img src="images/plus-5-64.png" onclick="do_action('allow_one')" />
    </span>
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_ACCES_DENYONE']; ?>">
        <img src="images/minus-5-64.png" onclick="do_action('deny_one')" />
    </span>
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_ACCES_ALLOWALL']; ?>">
        <img src="images/add-user-64.png" onclick="do_action('allow_all')" />
    </span>
    <span class="hint--rounded" aria-label="<?php echo $msg['TT_ACCES_DENYALL']; ?>">
        <img src="images/add-user-64.png" onclick="do_action('deny_all')" />
    </span>
</p>
