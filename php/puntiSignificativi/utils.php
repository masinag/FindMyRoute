<?php
    require_once(ROOT_DIR."php/utils.php");
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
 ?>
