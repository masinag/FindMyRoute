<?php
    // require_once(ROOT_DIR . "php/utils.php");
    require_once(ROOT_DIR . "php/puntiSignificativi/utils.php");
    require_once(ROOT_DIR . "php/immagini/utils.php");
    /**
     * Verifica la validità dei campi relativi ad un itinerario.
     */
    function checkItinerario(&$errori){
        // nome descrizione lunghezza ore e minuti devono essere presenti
        checkNotEmpty(["nome", "descrizione"], "itinerario", $errori);
        // lunghezza float > 0
        $lunghezza = $_POST["lunghezzaItinerario"];
        if (!is_numeric($lunghezza) || floatval($lunghezza)<0) {
            $errori["itinerario"]["lunghezza"] = "La lunghezza deve essere un numero reale non negativo.";
        }

        $ore = $_POST["oreItinerario"];
        if (!is_numeric($ore) || intval($ore)<0) {
            $errori["itinerario"]["ore"] = "Il numero di ore deve essere un numero intero positivo";
        }

        $minuti = $_POST["minutiItinerario"];
        if (!is_numeric($minuti) || intval($minuti)<0 || intval($minuti)>59) {
            $errori["itinerario"]["minuti"] = "Il numero di minuti deve essere un numero intero
                compreso tra 0 e 59";
        }

        // controllo la traccia gps
        checkTrack($errori);
        // controllo le immagini caricate
        checkImmagini($errori);
        // controllo eventuali parametri di un nuovo punto di partenza inserito
        checkPunto("Partenza", $errori);
        // controllo eventuali parametri di un nuovo punto di arrivo inserito
        checkPunto("Arrivo", $errori);
    }
    /**
     * Verifica la validità del file da caricare. Accetta un parametro in input
     * che rappresenta il percorso in cui il file verrà caricato e, se esiste già
     * un file con lo stesso nome, verrà rinominato.
     */
    function checkTrack(&$errori){
        if ($_FILES['tracciaItinerario']['error'] != UPLOAD_ERR_NO_FILE) {
            $uploadFile = ROOT_DIR . "files/tracks/" . basename($_FILES["tracciaItinerario"]["name"]);
            // verifico che l'estensione sia gpx
            $fileType = pathinfo($uploadFile,PATHINFO_EXTENSION);
            if($fileType != "gpx") {
                $errori["itinerario"]["traccia"] = "Sono supportati solamente i file con estensione GPX";
            }
        } else {
            $errori["itinerario"]["traccia"] = "Nessun file selezionato";
        }
    }

    /**
     * Carica il file nella cartella files/tracks. Restituisce il nome del
     * file sul server.
     */
    function uploadTrack(){
        $traccia = ROOT_DIR . "files/tracks/" . basename($_FILES["tracciaItinerario"]["name"]);
        // se è già presente un file con lo stesso nome, lo rinomino
        while (file_exists($traccia)) {
            $traccia = ROOT_DIR . "files/tracks/" . pathinfo($traccia, PATHINFO_FILENAME) .
                "0.gpx";
        }
        move_uploaded_file($_FILES["tracciaItinerario"]["tmp_name"], $traccia);
        return basename($traccia);
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
        insertImmagini(mysql_insert_id());
        return true;
    }
 ?>
