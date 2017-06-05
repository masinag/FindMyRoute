<?php
    require_once(ROOT_DIR . "php/utils.php");

    function checkRecensione(&$errori){
        // controllo che il campo voto sia settato
        checkNotEmpty(["voto"], "recensione", $errori);
    }

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
                 ".$_POST["idItinerario"].")";
        mysql_query($query);
        mysql_close($conn);
    }

    function editRecensione(){
        // modifico la recensione corrente
        $conn = db_connect();
        $testo = mysql_real_escape_string($_POST["testoRecensione"]);
        $query = "
            UPDATE valutatiDa
            SET recensione = '$testo',
                voto = '".$_POST["votoRecensione"]."'
            WHERE idItinerario = ".$_POST["idItinerario"]." AND
                  idUtente = ".$_COOKIE["userID"];
        mysql_query($query);
        mysql_close($conn);
    }

    function deleteRecensione(){
        $query = "
            DELETE FROM valutatiDa
            WHERE idItinerario = ".$_POST["idItinerario"]." AND
                  idUtente = ".$_COOKIE["userID"];
        $conn = db_connect();
        mysql_query($query);
        mysql_close($conn);
    }

 ?>
