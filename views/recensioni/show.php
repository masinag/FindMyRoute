<h2 class="">Recensioni</h2>
<?php
    $conn = db_connect();
    // tutte le recensioni per questo itinerario
    $query1 = "
        SELECT vd.voto, vd.recensione, u.username
        FROM valutatiDa as vd, utenti as u
        WHERE vd.idItinerario = ".$_POST["idItinerario"]." AND
              vd.idUtente = u.id";
    $res1 = mysql_query($query1);
    // recensione fatta dall'utente corrente per questo itinerario
    $query2 = $query1 . " AND idUtente = " . $_COOKIE["userID"];
    $res2 = mysql_query($query2);
    mysql_close($conn);
    if (mysql_num_rows($res2)==0) {
        // se l'utente non ha ancora effettuato una recensione per questo itinerario,
        // mostro un pulsante per effettuare una nuova recensione
        include ROOT_DIR."views/recensioni/new.php";
        ?>
        <button type="button" name="nuovaRecensione" class="w3-button w3-deep-orange w3-large"
           onclick="document.getElementById('nuovaRecensione').style.display='block';">
            Aggiungi una recensione
        </button>
        <br/>
        <?php
    }
    if (mysql_num_rows($res1)==0) {
        ?>
        <p class="w3-margin-top">
            Non ci sono recensioni per questo itinerario
        </p>

        <?php
    } else {
        echo "<ul class='w3-ul'>";
        while ($row = mysql_fetch_array($res1)) {
            echo "<li><b>Voto</b>: ".$row["voto"]."<br/>
                      ".$row["recensione"]."</li>";
        }
        echo "</ul>";
    }


 ?>
