<?php
    // require_once(ROOT_DIR."php/utils.php");

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
            if (strlen($cap) != 5 || !ctype_digit($cap) || intval($cap)<0) {
                $errori["localita$tipoPunto"]["cap"] = "Il campo cap deve essere
                un numero intero positivo di 5 cifre.";
            }
        }
    }

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
 ?>
