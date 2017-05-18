<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Itinerario</title>
        <?php include "head.php" ?>
    </head>
    <body>
        <?php include ROOT_DIR."views/navbar.php" ?>
        <?php
            $conn = db_connect();
            $query = "SELECT itinerari.*, immagini.path, p1.nome as puntoPartenza,
                        p2.nome as puntoArrivo
                    from itinerari, immagini, puntiSignificativi as p1,
                        puntiSignificativi as p2
                    where
                        itinerari.id = ".$_POST["idItinerario"]." and
                        immagini.idItinerario = itinerari.id and
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
                 <li><h5 class='my-label'>informazioni utili: </h5>: <?php echo $row["infoUtili"] ?></li>

             </ul>
         </section>
         <section class="w3-container w3-twothird">
             <?php include "prova_mappe.php" ?>
         </section>
    </body>
</html>
