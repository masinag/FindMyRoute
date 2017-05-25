<?php include ROOT_DIR."php/new_itinerario.php" ?>
<div id="nuovo" class="modal" style="display: <?php echo (isSet($itinerarioMessage))?'block':'none' ?>">
    <article class="my-userForm animate w3-text-black">
        <header class="w3-container">
            <h2>Nuovo itinerario</h2>
        </header>

        <p class="w3-text-red w3-padding-large">
        <?php
            echo isSet($itinerarioMessage)?$itinerarioMessage:"";
        ?>
        </p>
        <form class="w3-container" action="#" method="post" enctype="multipart/form-data">
            <label for="nomeItinerario">Nome</label>
            <input type="text" name="nomeItinerario" id="nomeItinerario"
                required="required" class="w3-input w3-border"/>

            <label for="descrizioneItinerario">Descrizione</label>
            <textarea name="descrizioneItinerario" id="descrizioneItinerario" rows="4"
                required="required" class="w3-input w3-border"></textarea>

            <label for="lunghezzaItinerario">Lunghezza (km)</label>
            <input type="number" name="lunghezzaItinerario" id="lunghezzaItinerario"
                required="required" class="w3-input w3-border" step="0.01" min="0"/>

            <label for="difficoltaItinerario">Difficolta</label>
            <select name="difficoltaItinerario" id="difficoltaItinerario" class="w3-margin-bottom">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            <!-- <br/> -->
            <label class="w3-large">Tempo di percorrenza</label><br/>
            <div class="w3-half" style="padding-right:10px">
                <label for="oreItinerario">Ore</label>
                <input type="number" name="oreItinerario" id="oreItinerario" min="0"
                    required="required"/>
            </div>
            <div class="w3-half" style="padding-left:10px">
                <label for="minutiItinerario">Minuti</label>
                <input type="number" name="minutiItinerario" id="minutiItinerario" min="0" max="59"
                    required="required"/>
            </div>

            <label for="infoUtiliItinerario">Informazioni utili</label>
            <textarea name="infoUtiliItinerario" id="infoUtiliItinerario" rows="4"
                class="w3-input w3-border"></textarea>

            <label for="tracciaItinerario">Traccia GPS</label>
            <input type="file" name="tracciaItinerario" id="tracciaItinerario" required="required"/>
            <span class="my-input-error"> <?php echo isSet($fileMessage)?$fileMessage:"" ?></span>


            <label for="puntoPartenzaItinerario">Punto di partenza</label>
            <!-- SCELTA DEL PUNTO DI PARTENZA -->
            <select name="puntoPartenzaItinerario" id="puntoPartenzaItinerario" class="my-select w3-margin-bottom"
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
            <div id="nuovoPuntoPartenza" style="display: <?php
               echo ($erroriNuovoPuntoPartenza > 0 || $erroriNuovaLocalitaPartenza>0)?'block':'none';
             ?>;">
                <hr/>
                <?php $tipoPunto = "Partenza"; ?>
                <?php include ROOT_DIR."views/puntiSignificativi/new.php" ?>
            </div>

            <!-- SCELTA DEL PUNTO DI ARRIVO -->
            <label for="puntoArrivoItinerario">Punto di arrivo</label>
            <select name="puntoArrivoItinerario" id="puntoArrivoItinerario" class="my-select w3-margin-bottom"
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
             <div id="nuovoPuntoArrivo" style="display: <?php
                echo ($erroriNuovoPuntoArrivo > 0 || $erroriNuovaLocalitaArrivo>0)?'block':'none';
              ?>;">
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
