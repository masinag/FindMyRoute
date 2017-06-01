<?php
    require_once ROOT_DIR."php/utils.php";
    if (isSet($_POST["recensione"])) {
        // controllo che il campo voto sia settato
        checkNotEmpty(["voto"], "recensione", $errori);
        if(!isSet($errori)){
            // inserisco la nuova recensione
            $testo = mysql_real_escape_string($_POST["testoRecensione"]);
            $query = "
                INSERT INTO valutatiDa
                    (voto, recensione, idUtente, idItinerario)
                VALUES
                    ('".$_POST["votoRecensione"]."',
                     '$testo',
                     ".$_COOKIE["userID"].",
                     ".$_POST["idItinerario"].")";
            $conn = db_connect();
            mysql_query($query);
            mysql_close($conn);
        }
    }
 ?>
