<?php include $_SERVER['DOCUMENT_ROOT']."/FindMyRoute/php/controllers.php" ?>
<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <title>Itinerario</title>
        <?php include_once ROOT_DIR."views/shared/head.php" ?>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    </head>
    <body>
        <?php include_once ROOT_DIR."views/shared/navbar.php" ?>
        <?php if (!isSet($_GET["idItinerario"])){
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
                        itinerari.id = ".$_GET["idItinerario"]." and
                          p1.id = itinerari.idPuntoPartenza and
                          p2.id = itinerari.idPuntoArrivo";
            $res = mysql_query($query);
            $row = mysql_fetch_array($res);
            $traccia = $row["tracciaGPS"];
         ?>
         <header class="my-header w3-center">
             <h1 class="w3-xxxlarge"><?php echo $row["nome"] ?></h1>
         </header>
         <section class="w3-container w3-third w3-padding-large w3-justify">
             <header>
                 <h2 class="w3-margin-left">Itinerario</h2>
             </header>
             <ul class="w3-ul">
                 <li><h5 class='my-label'>Descrizione</h5>: <?php echo ($row["descrizione"]) ?></li>
                 <li><h5 class='my-label'>Punto di partenza</h5>: <?php echo $row["puntoPartenza"] ?></li>
                 <li><h5 class='my-label'>Punto di arrivo</h5>: <?php echo $row["puntoArrivo"] ?></li>
                 <li><h5 class='my-label'>Lunghezza</h5>: <?php echo $row["lunghezza"] ?></li>
                 <li><h5 class='my-label'>Tempo di percorrenza</h5>: <?php echo $row["tempoPercorrenza"] ?> ore</li>
                 <?php if ($row["infoUtili"] != "") { ?>
                 <li><h5 class='my-label'>informazioni utili</h5>: <?php echo $row["infoUtili"] ?></li>
                 <?php } ?>
             </ul>
         </section>
         <section class="w3-container w3-twothird w3-padding-large">
             <?php include_once "map.php" ?>
         </section>

         <section class="w3-container w3-padding-large">
             <hr/>
             <?php include_once ROOT_DIR . "views/recensioni/show_all.php" ?>
         </section>
         <?php } ?>
    </body>
</html>
