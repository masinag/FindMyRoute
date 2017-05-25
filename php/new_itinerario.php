<?php
    /**
     * Verifica la validità del file da caricare. Accetta un parametro in input
     * che rappresenta il percorso in cui il file verrà caricato e, se esiste già
     * un file con lo stesso nome, verrà rinominato. Restituisce un valore booleano
     * che indica la validità del file.
     */
    function checkFile(&$uploadFile, &$fileMessage){
        $uploadOk = true;
        // percorso in cui caricarlo

        // se è già presente un file con lo stesso nome, lo rinomino
        $i=0;
        while (file_exists($uploadFile)) {
            $uploadFile .= $i;
            $i++;
        }
        // verifico che l'estensione sia gpx
        $fileType = pathinfo($uploadFile,PATHINFO_EXTENSION);
        if($fileType != "gpx") {
            $fileMessage = "Sono supportati solamente i file con estensione GPX";
            $uploadOk = false;
        }
        return $uploadOk;
    }



    // controllo se c'è un input da parte dell'utente
    if (isSet($_POST["nomeItinerario"])) {
        // controllo il file caricato
        $uploadFile = ROOT_DIR . "files/tracks/" . basename($_FILES["tracciaItinerario"]["name"]);
        $fileMessage = "";
        $uploadOk = checkFile($uploadFile, $fileMessage);
        


        // carico il file
        if ($uploadOk){
            if (!move_uploaded_file($_FILES["tracciaItinerario"]["tmp_name"], $uploadFile)) {
                $itinerarioMessage = "Errore durante il caricamento del file";
            }
        } else {
            $itinerarioMessage = "Il form contiene degli errori";
        }
    }
 ?>
