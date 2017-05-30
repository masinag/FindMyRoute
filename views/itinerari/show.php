<?php include $_SERVER['DOCUMENT_ROOT']."/FindMyRoute/php/utenti/user_status.php" ?>
<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <title>Itinerario</title>
        <?php include ROOT_DIR."views/shared/head.php" ?>
    </head>
    <body>
        <?php include ROOT_DIR."views/shared/navbar.php" ?>
        <?php if (!isSet($_POST["idItinerario"])){
            echo "<header class='my-header'>
            <h1 class='w3-xxxlarge'>Torna alla pagina precedente per scegliere
                un itinerario</h1>
            </header>";
        } else {
        ?>
        <?php
            $conn = db_connect();
            $query = "SELECT itinerari.*, immagini.path, p1.nome as puntoPartenza,
                        p2.nome as puntoArrivo
                    from itinerari LEFT JOIN immagini ON itinerari.id = immagini.idItinerario,
                        puntiSignificativi as p1,
                        puntiSignificativi as p2
                    where
                        itinerari.id = ".$_POST["idItinerario"]." and
                          p1.id = itinerari.idPuntoPartenza and
                          p2.id = itinerari.idPuntoArrivo";
            $res = mysql_query($query);
            $row = mysql_fetch_array($res);
            $traccia = $row["tracciaGPS"];
         ?>
         <header class="my-header w3-center">
             <h1 class="w3-xxxlarge"><?php echo $row["nome"] ?></h1>
         </header>
         <section class="w3-container w3-third">
             <ul class="w3-ul">
                 <li><h5 class='my-label'>Descrizione</h5>: <?php echo addslashes($row["descrizione"]) ?></li>
                 <li><h5 class='my-label'>Punto di partenza</h5>: <?php echo $row["puntoPartenza"] ?></li>
                 <li><h5 class='my-label'>Punto di arrivo</h5>: <?php echo $row["puntoArrivo"] ?></li>
                 <li><h5 class='my-label'>Lunghezza</h5>: <?php echo $row["lunghezza"] ?></li>
                 <li><h5 class='my-label'>Tempo di percorrenza</h5>: <?php echo $row["tempoPercorrenza"] ?> ore</li>
                 <li><h5 class='my-label'>informazioni utili</h5>: <?php echo $row["infoUtili"] ?></li>

             </ul>
         </section>
         <section class="w3-container w3-twothird">
             <?php include "map.php" ?>
         </section>
         <?php } ?>
    </body>
</html>
