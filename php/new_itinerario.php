<?php
    /**
     * Verifica la validità del file da caricare. Accetta un parametro in input
     * che rappresenta il percorso in cui il file verrà caricato e, se esiste già
     * un file con lo stesso nome, verrà rinominato. Restituisce un valore booleano
     * che indica la validità del file.
     */
    function checkFile(&$uploadFile, &$fileMessage){
        $uploadOk = true;
        // verifico che l'estensione sia gpx
        $fileType = pathinfo($uploadFile,PATHINFO_EXTENSION);
        if($fileType != "gpx") {
            $fileMessage = "Sono supportati solamente i file con estensione GPX";
            $uploadOk = false;
        }
        // se è già presente un file con lo stesso nome, lo rinomino
        while (file_exists($uploadFile)) {
            $uploadFile = ROOT_DIR . "files/tracks/" . pathinfo($uploadFile, PATHINFO_FILENAME) .
            "0.gpx";
        }
        return $uploadOk;
    }

    function checkPunto($tipoPunto, &$erroriNuovoPunto, &$erroriNuovaLocalita, &$nomePuntoMessage,
        &$sitoPuntoMessage, &$nomeLocalitaMessage){
        if ($_POST["punto".$tipoPunto."Itinerario"]=="altro") {
            // il nome non deve essere una stringa vuota
            if (trim($_POST["nomePunto$tipoPunto"]) == "") {
                $nomePuntoMessage = "Il campo nome non può essere vuoto";
                $erroriNuovoPunto++;
            }
            // il sito web, se presente, deve essere un URL valido.
            if ((trim($_POST["sitoPunto$tipoPunto"])!= "") && !filter_var($_POST["sitoPunto$tipoPunto"], FILTER_VALIDATE_URL)) {
              $sitoPuntoMessage = "L'URL del sito deve essere nel formato 'protocollo://nomeDominio'";
              $erroriNuovoPunto++;
            }
            // controllo eventuali parametri di una nuova località di partenza inserita
            if ($_POST["localitaPunto$tipoPunto"] == "altro") {
                // il nome non deve essere una stringa vuota
                if (trim($_POST["nomeLocalita$tipoPunto"]) == "") {
                    $nomeLocalitaMessage = "Il campo nome non può essere vuoto";
                    $erroriNuovaLocalita++;
                }
            }
        }
    }


    $erroriNuovoPuntoPartenza = $erroriNuovaLocalitaPartenza =
    $erroriNuovoPuntoArrivo   = $erroriNuovaLocalitaArrivo = 0;
    // controllo se c'è un input da parte dell'utente
    if (isSet($_POST["nomeItinerario"])) {
        // controllo il file caricato
        $uploadFile = ROOT_DIR . "files/tracks/" . basename($_FILES["tracciaItinerario"]["name"]);
        $uploadOk = checkFile($uploadFile, $fileMessage);

        // controllo eventuali parametri di un nuovo punto di partenza inserito
        checkPunto("Partenza", $erroriNuovoPuntoPartenza, $erroriNuovaLocalitaPartenza,
        $nomePuntoPartenzaMessage, $sitoPuntoPartenzaMessage, $nomeLocalitaPartenzaMessage);

        // controllo eventuali parametri di un nuovo punto di arrivo inserito
        checkPunto("Arrivo", $erroriNuovoPuntoArrivo, $erroriNuovaLocalitaArrivo,
        $nomePuntoArrivoMessage, $sitoPuntoArrivoMessage, $nomeLocalitaArrivoMessage);

        // carico il file
        if ($uploadOk && ($erroriNuovoPuntoPartenza + $erroriNuovaLocalitaPartenza +
        $erroriNuovoPuntoArrivo  + $erroriNuovaLocalitaArrivo == 0)){
            if (!move_uploaded_file($_FILES["tracciaItinerario"]["tmp_name"], $uploadFile)) {
                $itinerarioMessage = "Errore durante il caricamento del file";
            } else {
                // posso inserire i dati nel database
                $conn = db_connect();
                // inserisco eventualmente la località di partenza
                if ($_POST["localitaPuntoPartenza"] == "altro") {
                    $query = "
                        INSERT into localita (nome, CAP, idProvincia)
                            VALUES ('".$_POST["nomeLocalitaPartenza"]."',
                                '".$_POST["capLocalitaPartenza"]."',
                                ".$_POST["provinciaLocalitaPartenza"].")
                    ";
                    console_log($query);
                }
            }
        } else {
            $itinerarioMessage = "Il form contiene degli errori";
        }
    }
 ?>
