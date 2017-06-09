<?php include $_SERVER['DOCUMENT_ROOT']."/FindMyRoute/php/controllers.php" ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Itinerari</title>
        <?php include_once ROOT_DIR."views/shared/head.php" ?>
    </head>
    <body>
        <?php include_once ROOT_DIR."views/shared/navbar.php" ?>
        <?php include_once  "new_form.php" ?>
        <header class="my-header w3-center">
            <h1 class="w3-xxxlarge">Itinerari</h1>
        </header>
        <section class='w3-container'>
        <?php
            $conn = db_connect();
            $query = "SELECT itinerari.*, immagini.path, p1.nome as puntoPartenza, p2.nome as puntoArrivo
                    from itinerari LEFT JOIN immagini ON itinerari.id = immagini.idItinerario,
                        puntiSignificativi as p1, puntiSignificativi as p2
                    -- from itinerari, immagini, puntiSignificativi as p1, puntiSignificativi as p2
                    where
                        -- immagini.idItinerario = itinerari.id and
                          p1.id = itinerari.idPuntoPartenza and
                          p2.id = itinerari.idPuntoArrivo
                    group by itinerari.id";
            $res = mysql_query($query);
            mysql_close($conn);
            $i = 0;
            while ($row = mysql_fetch_array($res)) {
                if ($i%3 == 0) {
                    if ($i != 0) {
                        echo "\t\t\t</section>\n";
                    }
                    echo "\t\t\t<section class='w3-row-padding'>\n";
                }
                $imagePath = "/FindMyRoute/files/imgs/";
                $imagePath .= is_null($row["path"])?"default.png":$row["path"];
                echo "<div class='w3-third'>
                        <article class='w3-card-2 w3-margin'>
                            <header class='w3-container w3-cyan w3-text-white'>
                                <h3 class='my-two-lines'>".$row["nome"]."</h3>
                            </header>
                            <div class='my-card-image'
                                style='background-image:url(\"$imagePath\")'></div>
                            <article class='w3-container'>
                                <ul class='w3-ul my-list'>
                                    <li><h5 class='my-label'>Punto di partenza</h5>: ".$row["puntoPartenza"]."</li>
                                    <li><h5 class='my-label'>Punto di arrivo</h5>: ".$row["puntoArrivo"]."</li>
                                    <li><h5 class='my-label'>Lunghezza</h5>: ".$row["lunghezza"]." km</li>
                                    <li><h5 class='my-label'>Tempo di percorrenza</h5>: ".$row["tempoPercorrenza"]." ore</li>
                                </ul>
                            </article>
                            <footer>
                                <a href='show.php?idItinerario=".$row["id"]."' class='w3-button w3-block w3-deep-orange'>
                                    Maggiori informazioni
                                </a>
                            </footer>
                        </article>
                    </div>";
                $i++;
            }
         ?>
            <?php if ($userLoggedIn){ ?>
                 <button type="button" name="new" class="w3-button w3-circle w3-xlarge w3-deep-orange my-fixed"
                    onclick="document.getElementById('nuovoItinerario').style.display='block';">
                     <i class="fa fa-plus"></i></button>
             <?php } ?>
            </section>
        </section>
    </body>
</html>
