<!DOCTYPE html>
<html>
    <head>
        <title>Itinerari</title>
        <?php include "head.php" ?>
    </head>
    <body>
        <?php include ROOT_DIR."views/navbar.php" ?>

        <header class="my-header w3-center">
            <h1>Itinerari</h1>
        </header>
        <section class='w3-container'>
        <?php
            $conn = db_connect();
            $query = "SELECT * from itinerari";
            $res = mysql_query($query);
            $i = 0;
            while ($row = mysql_fetch_array($res)) {
                if ($i%3 == 0) {
                    if ($i != 0) {
                        echo "\t\t\t</section>\n";
                    }
                    echo "\t\t\t<section class='w3-row-padding'>\n";
                }
                echo "\t\t\t\t<div class='w3-third'>\n";
                echo "<article class='w3-card-2 w3-margin'>";
                echo "<header class='w3-container w3-cyan w3-text-white'><h1>".$row["nome"]."</h1></header>\n";
                echo "<article class='w3-container'>
                        <p>Lunghezza: ".$row["lunghezza"]." km</p>
                        <p>Tempo di percorrenza: ".$row["tempoPercorrenza"]." ore</p>
                      </article>";
                echo "</article>";
                echo "\t\t\t\t</div>\n";
                $i++;
            }

         ?>
            </section>
        </section>
    </body>
</html>
