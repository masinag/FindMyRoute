<?php
    // require_once(ROOT_DIR."php/utils.php");
    require_once(ROOT_DIR . "php/localita/utils.php");
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
 ?>
