<?php
    /**
     * Controlla che i valori del form di una recensione siano corretti.
     */
    function checkRecensione(&$errori){
        // controllo che il campo voto sia settato
        checkNotEmpty(["voto"], "recensione", $errori);
    }
    /**
     * Inserisce una recensione nel database. Restituisce un valore booleano
     * che indica se l'inserimento è andato a buon fine.
     */
    function insertRecensione(){
        // inserisco la nuova recensione
        $conn = db_connect();
        $testo = mysql_real_escape_string($_POST["testoRecensione"]);
        $query = "
            INSERT INTO valutatiDa
                (voto, recensione, idUtente, idItinerario)
            VALUES
                ('".$_POST["votoRecensione"]."',
                 '$testo',
                 ".$_COOKIE["userID"].",
                 ".$_GET["idItinerario"].")";
        mysql_query($query);
        mysql_close($conn);
        return true;
    }
    /**
     * Modifica una recensione nel database. Restituisce un valore booleano
     * che indica se la modifica è andata a buon fine.
     */
    function editRecensione(){
        // modifico la recensione corrente
        $conn = db_connect();
        $testo = mysql_real_escape_string($_POST["testoRecensione"]);
        $query = "
            UPDATE valutatiDa
            SET recensione = '$testo',
                voto = '".$_POST["votoRecensione"]."'
            WHERE idItinerario = ".$_GET["idItinerario"]." AND
                  idUtente = ".$_COOKIE["userID"];
        mysql_query($query);
        mysql_close($conn);
        return true;
    }
    /**
     * Cancella una recensione dal database. Restituisce un valore booleano
     * che indica se l'eliminazione è andata a buon fine.
     */
    function deleteRecensione(){
        $query = "
            DELETE FROM valutatiDa
            WHERE idItinerario = ".$_GET["idItinerario"]." AND
                  idUtente = ".$_COOKIE["userID"];
        $conn = db_connect();
        mysql_query($query);
        mysql_close($conn);
        return true;
    }

 ?>
