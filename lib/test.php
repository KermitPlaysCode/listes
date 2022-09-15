<?php

include "../include-all.php";

$x = $_SERVER['PHP_SELF'];
$i = pathinfo($x);
echo $x . "\n";
echo $i['dirname']."\n";
echo $i['basename']."\n";
echo $i['extension']."\n";
echo $i['filename']."\n";


?>
