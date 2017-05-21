<?php include $_SERVER['DOCUMENT_ROOT']."/FindMyRoute/php/user_status.php" ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Itinerari</title>
        <?php include ROOT_DIR."views/shared/head.php" ?>
    </head>
    <body>
        <?php include ROOT_DIR."views/shared/navbar.php" ?>
        <header class="my-header w3-center">
            <h1 class="w3-xxxlarge">Itinerari</h1>
        </header>
        <section class='w3-container'>
        <?php
            $conn = db_connect();
            $query = "SELECT itinerari.*, immagini.path, p1.nome as puntoPartenza, p2.nome as puntoArrivo
                    from itinerari, immagini, puntiSignificativi as p1, puntiSignificativi as p2
                    where immagini.idItinerario = itinerari.id and
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
                echo "<div class='w3-third'>
                        <article class='w3-card-2 w3-margin'>
                            <header class='w3-container w3-cyan w3-text-white'>
                                <h3 class='my-two-lines'>".$row["nome"]."</h3>
                            </header>
                            <div class='my-card-image'
                                style='background-image:url(/FindMyRoute/files/imgs/".$row["path"].")'></div>
                            <article class='w3-container'>
                                <ul class='w3-ul my-list'>
                                    <li><h5 class='my-label'>Punto di partenza</h5>: ".$row["puntoPartenza"]."</li>
                                    <li><h5 class='my-label'>Punto di arrivo</h5>: ".$row["puntoArrivo"]."</li>
                                    <li><h5 class='my-label'>Lunghezza</h5>: ".$row["lunghezza"]." km</li>
                                    <li><h5 class='my-label'>Tempo di percorrenza</h5>: ".$row["tempoPercorrenza"]." ore</li>
                                </ul>
                            </article>
                            <footer>
                                <form action='show.php' method='post'>
                                <input type='hidden' name='idItinerario' value='".$row["id"]."'/>
                                <input type='submit' name='submit' value='Maggiori informazioni' class='w3-button w3-block w3-deep-orange'/>
                                </form>
                            </footer>
                        </article>
                    </div>";
                $i++;
            }
         ?>
            </section>
    </body>
</html>
