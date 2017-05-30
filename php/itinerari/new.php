<?php
    require_once("utils.php");
    /**
     * Inserisce una località nel database. Accetta un tipo (Partenza/Arrivo)
     * e un parametro opzionale che rappresenta l'id della località di partenza,
     * nel caso in cui sia stato chiesto di inserire un nuovo punto di arrivo
     * con la stessa località di quello di partenza. Restituisce l'id della
     * località inserita/trovata.
     */
    function insertLocalita($tipo, $idLocalitaPartenza=null){
        $idLocalita = 0;
        if ($_POST["punto".$tipo."Itinerario"] == "altro") {
            if ($_POST["localitaPunto$tipo"] == "altro") {
                // se devo inserire una nuova località
                $query = "
                    INSERT INTO localita (CAP, nome, idProvincia)
                        VALUES (".$_POST["capLocalita$tipo"].",
                                '".$_POST["nomeLocalita$tipo"]."',
                                ".$_POST["provinciaLocalita$tipo"].")";
                $res = mysql_query($query);
                $idLocalita= mysql_insert_id();
            } else if ($tipo == "Arrivo" && $_POST["localitaPuntoArrivo"] == "copiaLocalita") {
                // se come località utilizzo quella inserita per il punto di partenza
                $idLocalita = $idLocalitaPartenza;
            } else {
                // altrimenti era già una località presente nel db
                $idLocalita = $_POST["localitaPunto$tipo"];
            }
            return $idLocalita;
        }
    }
    /**
     * Inserisce un punto nel database. Accetta un tipo (Partenza/Arrivo)
     * e un parametro opzionale che rappresenta l'id del punto di partenza,
     * nel caso in cui sia stato chiesto di inserire un nuovo punto di arrivo
     * con uguale a quello di partenza. Restituisce l'id del punto inserito/trovato.
     */
    function insertPunto($tipoPunto, $idLocalita, $idPuntoPartenza=null){
        $idPunto = 0;
        if ($_POST["punto".$tipoPunto."Itinerario"] == "altro") {
            // se devo inserire un nuovo punto
            $query = "
                INSERT INTO puntiSignificativi (nome, sitoWeb, latitudine,
                longitudine, idUtente, idLocalita) VALUES

                ('".$_POST["nomePunto$tipoPunto"]."',
                 '".$_POST["sitoPunto$tipoPunto"]."',
                 ".$_POST["latitudinePunto$tipoPunto"].",
                 ".$_POST["longitudinePunto$tipoPunto"].",
                 ".$_COOKIE["userID"].", $idLocalita)";
             $res = mysql_query($query);
             $idPunto = mysql_insert_id();
        } else if ($tipoPunto == "Arrivo" && $_POST["puntoArrivoItinerario"] == "copiaPunto") {
            // se il punto di arrivo è lo stesso di quello nuovo inserito per la partenza
            $idPunto = $idPuntoPartenza;
        } else {
            $idPunto = $_POST["punto".$tipoPunto."Itinerario"];
        }
        return $idPunto;
    }
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
