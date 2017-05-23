<div id="nuovo" class="modal" style="display: none">
    <article class="my-userForm animate w3-text-black">
        <header class="w3-container">
            <h2>Nuovo itinerario</h2>
        </header>

        <p class="w3-text-red w3-padding-large">
        <?php
            // echo $routeMessage;
            // $routeMessage = null;
        ?>
        </p>
        <form class="w3-container" action="#" method="post" enctype="multipart/form-data">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome"
                required="required" class="w3-input w3-border"/>

                <!--
                tracciaGPS       varchar(250)                not null,
                idUtente         int unsigned,
                idPuntoPartenza  int unsigned                not null,
                idPuntoArrivo -->
            <label for="descrizione">Descrizione</label>
            <textarea name="descrizione" id="descrizione" rows="4"
                required="required" class="w3-input w3-border"></textarea>

            <label for="lunghezza">Lunghezza (km)</label>
            <input type="number" name="lunghezza" id="lunghezza"
                required="required" class="w3-input w3-border" step="0.01"/>
            <label for="difficolta">Difficolta</label>
            <select name="difficolta" id="difficolta" class="w3-margin-bottom">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            <br/>
            <label class="w3-large">Tempo di percorrenza</label><br/>
            <div class="w3-half" style="padding-right:10px">
                <label for="ore">Ore</label>
                <input type="number" name="ore" id="ore"/>
            </div>
            <div class="w3-half" style="padding-left:10px">
                <label for="minuti">Minuti</label>
                <input type="number" name="minuti" id="minuti"/>
            </div>

            <label for="infoUtili">Informazioni utili</label>
            <textarea name="infoUtili" id="infoUtili" rows="4"
                class="w3-input w3-border"></textarea>

            <label for="traccia">Traccia GPS</label>
            <input type="file" name="traccia" id="traccia" required="required"/>
            <label for="puntoPartenza">Punto di partenza</label>
            <!-- SCELTA DEL PUNTO DI PARTENZA -->
            <select name="puntoPartenza" id="puntoPartenza" class="my-select w3-margin-bottom"
                onchange="showSubDiv(this, 'nuovoPuntoPartenza');showSubDiv(this, 'copiaPunto')">
            <?php
                $conn = db_connect();
                $queryItinerari = "
                    SELECT ps.id, ps.nome as nomePunto, l.nome as nomeLoc, p.sigla
                    FROM puntiSignificativi as ps, province as p, localita as l
                    WHERE ps.idLocalita = l.id AND
                          l.idProvincia = p.id
                    ORDER BY p.sigla, l.nome
                ";
                $res = mysql_query($queryItinerari);
                mysql_close($conn);
                $i = 0;
                while ($row = mysql_fetch_array($res)) {
             ?>
                <option value="<?php echo $row['id'] ?>"<?php echo ($i==0)?" selected='selected'":"" ?>><?php echo $row["nomePunto"].", ".$row["nomeLoc"].", ".$row["sigla"] ?></option>
             <?php
                    $i++;
                } ?>
                <option value="altro" class="w3-text-cyan">Altro</option>
             </select>
             <!-- CAMPI PER INSERIRE UN NUOVO PUNTO DI PARTENZA -->
            <div id="nuovoPuntoPartenza" style="display: none;">
                <hr/>
                <?php $tipoPunto = "Partenza"; ?>
                <?php include ROOT_DIR."views/puntiSignificativi/new.php" ?>
            </div>

            <!-- SCELTA DEL PUNTO DI ARRIVO -->
            <label for="puntoArrivo">Punto di arrivo</label>
            <select name="puntoArrivo" id="puntoArrivo" class="my-select w3-margin-bottom"
                onchange="showSubDiv(this, 'nuovoPuntoArrivo');">
            <?php
                $conn = db_connect();
                $res = mysql_query($queryItinerari);
                mysql_close($conn);
                $i = 0;
                while ($row = mysql_fetch_array($res)) {
             ?>
                <option value="<?php echo $row['id'] ?>"<?php echo ($i==0)?" selected='selected'":"" ?>>
                    <?php echo $row["nomePunto"].", ".$row["nomeLoc"].", ".$row["sigla"] ?>
                </option>
             <?php
                    $i++;
                } ?>
                <option value="altro" class="w3-text-cyan">Altro</option>
                <option value="copiaPunto" class="w3-text-deep-orange" id="copiaPunto" style="display: none">Stesso punto di quello di partenza</option>
             </select>
             <!-- CAMPI PER INSERIRE UN NUOVO PUNTO DI ARRIVO -->
             <div id="nuovoPuntoArrivo" style="display: none;">
                 <hr/>
                 <?php $tipoPunto = "Arrivo"; ?>
                 <?php include ROOT_DIR."views/puntiSignificativi/new.php" ?>
             </div>

            <input class="w3-button w3-deep-orange w3-large w3-margin-top"
                type="submit" name="nuovo" value="Conferma"/>
        </form>

    </article>
</div>


<script type="text/javascript" async defer>
    var modalNew = document.getElementById('nuovo');
    window.addEventListener("click", function(event) {
       if (event.target == modalNew) {
           modalNew.style.display = "none";
       }
   }, false);
</script>
