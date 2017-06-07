<article class='w3-third w3-padding-large'>
    <h2 class="">Recensioni</h2>
<?php
    $conn = db_connect();
    // tutte le recensioni per questo itinerario
    $query1 = "
        SELECT vd.voto, vd.recensione, u.username, u.id
        FROM valutatiDa as vd, utenti as u
        WHERE vd.idItinerario = ".$_GET["idItinerario"]." AND
              vd.idUtente = u.id";
    // se l'utente è loggato
    if ($userLoggedIn){
        //  prendo la recensione fatta dall'utente corrente
        $query2 = $query1 . " AND idUtente = " . $_COOKIE["userID"];
        $res2 = mysql_query($query2);
        // e quelle fatte dagli altri utenti
        $query1 .= " AND vd.idUtente != ".$_COOKIE["userID"];
        $res1 = mysql_query($query1);
        mysql_close($conn);
        // se l'utente non ha ancora fatto recensioni mostro il pulsante per aggiungerne una
        if (mysql_num_rows($res2)==0){
            include ROOT_DIR."views/recensioni/new.php";
            ?>
            <button type="button" name="nuovaRecensione" class="w3-button w3-deep-orange w3-large"
               onclick="document.getElementById('nuovaRecensione').style.display='block';">
                Aggiungi una recensione
            </button>
            <br/>
            <?php
        } else {
            $row = mysql_fetch_array($res2);
            $values["usernameRecensione"] = $row["username"];
            $values["votoRecensione"] = $row["voto"];
            $values["testoRecensione"] = $row["recensione"];
            $i = 0;
            include ROOT_DIR."views/recensioni/show.php";
        }
    }

    // quindi mostro le altre recensioni (se ci sono)
    if (mysql_num_rows($res1)==0 && (!isSet($res2) || mysql_num_rows($res2)==0)) {
        ?>
        <p class="w3-margin-top">
            Non ci sono recensioni per questo itinerario
        </p>
        <?php
    } else {
        $i = 1;
        while ($row = mysql_fetch_array($res1)) {
            $values["usernameRecensione"] = $row["username"];
            $values["votoRecensione"] = $row["voto"];
            $values["testoRecensione"] = $row["recensione"];
            include ROOT_DIR."views/recensioni/show.php";
            $i++;
        }
    }
 ?>
 </article>
