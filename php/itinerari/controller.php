<?php
    // require_once("utils.php");
    require_once("utils.php");

    // controllo se c'è un input da parte dell'utente
    if (isSet($_POST["nuovoItinerario"])) {
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
            $changed = insertItinerario($idPuntoPartenza, $idPuntoArrivo);
            mysql_close($conn);
        }
    }
 ?>
