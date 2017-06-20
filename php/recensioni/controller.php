<?php
    require_once("utils.php");
    // a seconda della form compilata, controllo eventuali campi e chiamo la
    // funzione corrispondente 
    if (isSet($_POST["nuovaRecensione"])) {
        checkRecensione($errori);
        if(!isSet($errori)){
            $changed = insertRecensione();
        }
    } else if (isSet($_POST["modificaRecensione"])) {
        checkRecensione($errori);
        if(!isSet($errori)){
            $changed = editRecensione();
        }
    } else if (isSet($_POST["eliminaRecensione"])) {
        $changed = deleteRecensione();
    }

 ?>
