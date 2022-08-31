<?php

include 'config.php';
global $div_to_file;

$div = "invalid_div";
if(array_key_exists('div', $_GET)) $div = $_GET['div'];

if( array_key_exists($div, $div_to_file) == FALSE) {
    echo $msg['INVALID_DIV'];
    exit(0);
}

readfile($div_to_file[$div])

?>