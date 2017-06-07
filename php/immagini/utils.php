<?php
    require_once(ROOT_DIR . "php/utils.php");

    /**
     * Verifica che tutti i file caricati siano delle immagini
     */
    function checkImmagini(&$errori){
        // scorro tutti i campi di input per le immagini
        $i = 0;
        $finished = false;
        while (!$finished && $i < 5) {
            $image = $_FILES["immaginiItinerario"]["tmp_name"][$i];
            if ($image != false && !getimagesize($image)){
                $errori["itinerario"]["immagini"] = "Alcune delle immagini caricate non sono supportate";
                $finished = true;
            }
            $i++;
        }
    }
    /**
     * Carica le immagini sul server e restituisce un array contenente i nomi
     * delle immagini contenute.
     */
    function uploadImmagini(){
        $immagini = [];
        // per ogni campo di input delle immagini
        for ($i=0; $i < 5 ; $i++) {
            $img = basename($_FILES["immaginiItinerario"]["name"][$i]);
            // se è stata caricata un'immagine
            if ($img != ""){
                $img = ROOT_DIR . "files/imgs/" . $img;
                // se esiste già un'immagine con lo stesso nome la rinomino
                $ext = pathinfo($img, PATHINFO_EXTENSION);
                while (file_exists($img)) {
                    $img = ROOT_DIR . "files/imgs/" . pathinfo($img,
                        PATHINFO_FILENAME) ."0.$ext";
                }
                // infine la carico sul server
                move_uploaded_file($_FILES["immaginiItinerario"]["tmp_name"][$i], $img);
                array_push($immagini, basename($img, PATHINFO_FILENAME));
            }
        }
        return $immagini;
    }
    /**
     * Inserisce i percorsi delle immagini nel database. Riceve come parametro
     * l'id dell'itinerario a cui le immagini fanno riferimento.
     */
    function insertImmagini($idItinerario){
        // carico le immagini
        $immagini = uploadImmagini();
        if (!empty($immagini)) {
            // preparo la query
            $query = "INSERT into immagini (path, idItinerario) VALUES ";
            foreach ($immagini as $img) {
                $img = mysql_real_escape_string($img);
                $query .= "('$img', $idItinerario), ";
            }
            $query = substr($query, 0, -2) . ";";
            // e la eseguo
            $conn = db_connect();
            $res = mysql_query($query);
            mysql_close($conn);
        }
    }
 ?>
