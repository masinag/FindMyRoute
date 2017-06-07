<?php
    // require_once("utils.php");
    require_once("utils.php");

    /**
     * Inserisce un itinerario. Accetta come parametri gli id dei punti di
     * partenza e arrivo e il nome del file da caricare.
     */
    function insertItinerario($idPuntoPartenza, $idPuntoArrivo){
        $tempoPercorrenza = $_POST["oreItinerario"] . ":" .
                                $_POST["minutiItinerario"] . ":00";
        // carico il file
        $traccia = uploadTrack();
        $query = "
            INSERT INTO itinerari (nome, descrizione, lunghezza,
                tempoPercorrenza, difficolta, infoUtili, tracciaGPS,
                idUtente, idPuntoPartenza, idPuntoArrivo)
            VALUES
                ('".$_POST["nomeItinerario"]."',
                '".$_POST["descrizioneItinerario"]."',
                ".$_POST["lunghezzaItinerario"].",
                 '$tempoPercorrenza',
                ".$_POST["difficoltaItinerario"].",
                '".$_POST["infoUtiliItinerario"]."',
                '$traccia',
                ".$_COOKIE["userID"].",
                $idPuntoPartenza,
                $idPuntoArrivo
                )
        ";
        $res = mysql_query($query);
        insertImmagini(mysql_insert_id());
    }

    // controllo se c'è un input da parte dell'utente
    if (isSet($_POST["nomeItinerario"])) {
        // controllo che i parametri siano validi
        checkItinerario($errori);
        // se tutti i parametri sono validi procedo con l'inserimento
        if (!isSet($errori)) {
            $conn = db_connect();
            // inserisco eventuale località di partenza e arrivo
            $idLocalitaPartenza = insertLocalita("Partenza");
            $idLocalitaArrivo = insertLocalita("Arrivo", $idLocalitaPartenza);
            // inserisco eventuali punti di partenza e arrivo
            $idPuntoPartenza = insertPunto("Partenza", $idLocalitaPartenza);
            $idPuntoArrivo   = insertPunto("Arrivo", $idLocalitaArrivo, $idPuntoPartenza);
            // quindi inserisco l'itinerario
            insertItinerario($idPuntoPartenza, $idPuntoArrivo);
            mysql_close($conn);
        }
    }
 ?>
