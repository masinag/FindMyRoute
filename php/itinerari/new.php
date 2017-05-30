<?php
    require_once("utils.php");
    function insertLocalita($tipo){
        $idLocalita = 0;
        if ($_POST["localitaPunto$tipo"] == "altro") {
            $query = "
                INSERT INTO localita (CAP, nome, idProvincia)
                    VALUES (".$_POST["capLocalita$tipo"].",
                            '".$_POST["nomeLocalita$tipo"]."',
                            ".$_POST["provinciaLocalita$tipo"].")";
            $res = mysql_query($query);
            $idLocalita= mysql_insert_id();
        } else {
            $idLocalita = $_POST["localitaPunto$tipo"];
        }
        return $idLocalita;
    }

    function insertPunto($tipoPunto, $idLocalita){
        $idPunto = 0;
        if ($_POST["punto".$tipoPunto."Itinerario"] == "altro") {
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
        } else {
            $idPunto = $_POST["punto".$tipoPunto."Itinerario"];
        }
        return $idPunto;
    }

    function uploadFile(){

    }


    function insertItinerario($idPuntoPartenza, $idPuntoArrivo, $traccia){
        $tempoPercorrenza = $_POST["oreItinerario"] . ":" .
                                $_POST["minutiItinerario"] . ":00";
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
        checkItinerario($traccia, $errori);
        // se tutti i parametri sono validi procedo con l'inserimento
        if (!isSet($errori)) {
            $conn = db_connect();
            // inserisco eventuale località di partenza e arrivo
            $idLocalitaPartenza = insertLocalita("Partenza");
            $idLocalitaArrivo = insertLocalita("Arrivo");
            // inserisco eventuali punti di partenza e arrivo
            $idPuntoPartenza = insertPunto("Partenza", $idLocalitaPartenza);
            $idPuntoArrivo   = insertPunto("Arrivo", $idLocalitaArrivo);
            // quindi inserisco l'itinerario
            insertItinerario($idPuntoPartenza, $idPuntoArrivo, $traccia);
            mysql_close($conn);
        }

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
