<?php
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
    }
    /**
     * Verifica la validità del file da caricare. Accetta un parametro in input
     * che rappresenta il percorso in cui il file verrà caricato e, se esiste già
     * un file con lo stesso nome, verrà rinominato.
     */
    function checkFile(&$uploadFile, &$errori){
        if ($_FILES['tracciaItinerario']['error'] != UPLOAD_ERR_NO_FILE) {
            // verifico che l'estensione sia gpx
            $fileType = pathinfo($uploadFile,PATHINFO_EXTENSION);
            if($fileType != "gpx") {
                $errori["itinerario"]["traccia"] = "Sono supportati solamente i file con estensione GPX";;
            } else {
                // se è già presente un file con lo stesso nome, lo rinomino
                while (file_exists($uploadFile)) {
                    $uploadFile = ROOT_DIR . "files/tracks/" . pathinfo($uploadFile, PATHINFO_FILENAME) .
                    "0.gpx";
                }
            }
        } else {
            $errori["itinerario"]["traccia"] = "Nessun file selezionato";
        }
    }
    /**
     * Controlla che i campi appartenenti ad una certa risorsa non siano vuoti.
     * Restituisce il numero di campi vuoti trovati.
     */
    function checkNotEmpty($fields, $resource, &$errori){
        // scorro la lista dei campi
        foreach ($fields as $f) {
            // se il campo è vuoto aggiungo un errore al vettore
            if (trim($_POST[$f.ucfirst($resource)]) == "") {
                $errori[$resource][$f] = "Il campo $f non può essere vuoto";
            }
        }
    }
    /**
     * Controlla la validità dei campi relativi ad una localita di 'Partenza' o
     * 'Arrivo'.
     */
    function checkLocalita($tipoPunto, &$errori){
        if ($_POST["localitaPunto$tipoPunto"] == "altro") {
            // controllo che non ci siano campi vuoti
            checkNotEmpty(["nome"], "localita$tipoPunto", $errori);
            // controllo che il CAP sia un numero positivo di 5 cifre
            $cap = trim($_POST["capLocalita$tipoPunto"]);
            if (strlen($cap) != 5 || !is_int($cap) || intval($cap)<0) {
                $errori["localita$tipoPunto"]["cap"] = "Il campo cap deve essere
                un numero intero positivo di 5 cifre.";
            }
        }
    }

    /**
     * Controlla la validità dei dati relativi ad un punto significativo. Accetta
     * un parametro che indica se il punto è di Partenza o di Arrivo. Restituisce
     * il numero totale di campi errati trovati.
     */
    function checkPunto($tipoPunto, &$errori){
        if ($_POST["punto".$tipoPunto."Itinerario"]=="altro") {
            // controllo che i campi non siano vuoti
            checkNotEmpty(["nome", "latitudine", "longitudine"], "punto$tipoPunto", $errori);

            // il sito web, se presente, deve essere un URL valido.
            if ((trim($_POST["sitoPunto$tipoPunto"])!= "") && !filter_var($_POST["sitoPunto$tipoPunto"], FILTER_VALIDATE_URL)) {
                $errori["punto$tipoPunto"]["sito"] = "L'URL del sito deve essere nel formato 'protocollo://nomeDominio'";
            }
            // controllo eventuali parametri di una nuova località di partenza inserita
            checkLocalita($tipoPunto, $errori);
        }
    }

    // controllo se c'è un input da parte dell'utente
    if (isSet($_POST["nomeItinerario"])) {
        // controllo il file caricato
        $uploadFile = ROOT_DIR . "files/tracks/" . basename($_FILES["tracciaItinerario"]["name"]);
        checkItinerario($errori);
        checkFile($uploadFile, $errori);

        // controllo eventuali parametri di un nuovo punto di partenza inserito
        checkPunto("Partenza", $errori);

        // controllo eventuali parametri di un nuovo punto di arrivo inserito
        checkPunto("Arrivo", $errori);

        console_log($errori);
        // carico il file
        // if ($uploadOk && ($erroriNuovoPuntoPartenza + $erroriNuovaLocalitaPartenza +
        // $erroriNuovoPuntoArrivo  + $erroriNuovaLocalitaArrivo == 0)){
        //     if (!move_uploaded_file($_FILES["tracciaItinerario"]["tmp_name"], $uploadFile)) {
        //         $itinerarioMessage = "Errore durante il caricamento del file";
        //     } else {
        //         // posso inserire i dati nel database
        //         $conn = db_connect();
        //         // inserisco eventualmente la località di partenza
        //         if ($_POST["localitaPuntoPartenza"] == "altro") {
        //             $query = "
        //                 INSERT into localita (nome, CAP, idProvincia)
        //                     VALUES ('".$_POST["nomeLocalitaPartenza"]."',
        //                         '".$_POST["capLocalitaPartenza"]."',
        //                         ".$_POST["provinciaLocalitaPartenza"].")
        //             ";
        //             console_log($query);
        //         }
        //     }
        // } else {
        //     $itinerarioMessage = "Il form contiene degli errori";
        // }
    }
 ?>
