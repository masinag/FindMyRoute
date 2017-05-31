<?php
    require_once("utils.php");
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
