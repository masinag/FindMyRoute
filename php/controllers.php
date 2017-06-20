<?php
    // definisco una costante per la root directory
    define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT']."/FindMyRoute/");
    $changed = false;
    include_once "utils.php";
    // includo i controller delle varie risorse
    include_once "utenti/controller.php";
    include_once "recensioni/controller.php";
    include_once "itinerari/controller.php";
    // aggiorno la pagina se sono state fatte delle modifiche (per evitare
    // di mandare nuove richieste post in caso di aggiornamento)
    if ($changed) {
        header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
        die;
    }
 ?>
