<?php
    require_once(ROOT_DIR."php/utils.php");

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
 ?>
