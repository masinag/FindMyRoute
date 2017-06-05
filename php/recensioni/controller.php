<?php
    require_once "utils.php";

    if (isSet($_POST["nuovaRecensione"])) {
        checkRecensione($errori);
        if(!isSet($errori)){
            insertRecensione();
        }
    } else if (isSet($_POST["modificaRecensione"])) {
        checkRecensione($errori);
        if(!isSet($errori)){
            editRecensione();
        }
    }
 ?>
