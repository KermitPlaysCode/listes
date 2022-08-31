<?php

require_once('config.php');
require_once('data/messages_FR.php');
require_once('constant.php');
global $config;
global $div_to_file;
global $msg;
global $db_requests;

// Take care of first run : do we have a DB file ?
$run_init = FALSE;
if ( ! file_exists($config['db_file'])) $run_init = TRUE;
// Open the DB
$db = new SQLite3($config['db_file']);
// IF it didn't exist before, prepare it
if ($run_init) {
    foreach ($db_requests['init'] as $req) {
        $results = $db->query($req);
        if ($results == false) {
            header("Content-type: text/plain");
            echo "ERROR\n$req\n=> FAIL\n";
            exit(0);
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
    </body>
</html>