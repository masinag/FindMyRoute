<?php
    define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT']."/FindMyRoute/");
    $changed = false;
    include_once "utils.php";
    include_once "utenti/user_status.php";
    include_once "recensioni/controller.php";
    include_once "itinerari/controller.php";
    if ($changed) {
        header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
        die;
    }
 ?>
