<h2><?php echo $msg['TITLE_input_liste']; ?></h2>
<p>
<select name="l_list_name" id="l_list_name">
<?php
    // ici: requete DB pour avoir la liste des listes
    $nom_listes = array("liste_1", "liste_2");
    foreach($nom_listes as $n)
    {
        echo "<option value='$n' id='$n'>$n</option>";
    }
?>
</select></p>
<p class="ico_action">
<span class="hint--rounded" aria-label="<?php echo $msg['TT_ADDLIST']; ?>">
    <img src="images/plus-5-64.png" class="ico_action">
</span>
<span class="hint--rounded" aria-label="<?php echo $msg['TT_DELLIST']; ?>">
    <img src="images/minus-5-64.png" class="ico_action">
</span>
<span class="hint--rounded" aria-label="<?php echo $msg['TT_EDITLIST']; ?>">
    <img src="images/minus-5-64.png" class="ico_action">
</span>
</p>
