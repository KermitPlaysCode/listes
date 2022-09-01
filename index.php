<?php

// Introduction
include "include-all.php";

// Take care of first run : do we have a DB file ?
$run_init = FALSE;
if ( ! file_exists($config['db_file'])) $run_init = TRUE;
// Open the DB
$db = new SQLite3($config['db_file']);
$msg['RUNTIME_INIT_STATE'] = "";
// IF it didn't exist before, prepare it
if ($run_init) {
    foreach ($db_requests['init'] as $req) {
        $results = $db->query($req);
        if ($results == false) {
            $msg['RUNTIME_INIT_STATE'] = $msg['INIT_FAILED'];
        }
    }
}
?>
<!DOCTYPE html>

<html>
    <head>
        <title>php-listes</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/hint.css">
        <!-- hint.css is from : https://github.com/chinchang/hint.css -->
        <script type='text/javascript' src='js/scripts.js'></script>
    </head>
    <body>
        <div class="cssgrid">
            <div class="bigtitle"><?php echo $msg['BIGTITLE']; ?></div>
            <div class="input_acces" id="input_acces"><?php include $div_to_file['input_acces']; ?></div>
            <div class="input_liste" id="input_liste"><?php include $div_to_file['input_liste']; ?></div>
            <div class="liste" id="liste"><?php include $div_to_file['liste']; ?></div>
            <div class="input_admin" id="input_admin"><?php include $div_to_file['input_admin']; ?></div>
            <div class="console" id="_console"><?php include $div_to_file['console']; ?></div>
        </div>
    <script type='text/javascript'>update_div('console', <?php echo $msg['RUNTIME_INIT_STATE']; ?>);</script>
    </body>
</html>