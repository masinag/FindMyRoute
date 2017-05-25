<?php include ROOT_DIR."php/new_itinerario.php" ?>
<div id="nuovo" class="modal" style="display: <?php echo (isSet($itinerarioMessage))?'block':'none' ?>">
    <article class="my-userForm animate w3-text-black">
        <header class="w3-container">
            <h2>Nuovo itinerario</h2>
        </header>

        <form class="w3-container" action="#" method="post" enctype="multipart/form-data" >
            <section class="nuovoItinerario" id="datiItinerario">
                <p class="w3-text-red my-formAlign">
                <?php
                    echo isSet($itinerarioMessage)?$itinerarioMessage:"";
                ?>
                </p>
                <?php include "new.php" ?>
            </section>

            <section class="nuovoItinerario" id="datiPuntoPartenza" style="display:none">
                <label for="puntoPartenzaItinerario">Punto di partenza</label>
                <!-- SCELTA DEL PUNTO DI PARTENZA -->
                <select name="puntoPartenzaItinerario" id="puntoPartenzaItinerario" class="my-select w3-margin-bottom"
                    onchange="showSubDiv(this, 'nuovoPuntoPartenza');showSubDiv(this, 'copiaPunto')"
                    onload  ="showSubDiv(this, 'nuovoPuntoPartenza');showSubDiv(this, 'copiaPunto')">
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
                        <option <?php selectValue("puntoPartenzaItinerario", $row['id'], $i) ?>
                            value="<?php echo $row['id'] ?>">
                            <?php echo $row["nomePunto"].", ".$row["nomeLoc"].", ".$row["sigla"] ?>
                        </option>
                        <?php
                        $i++;
                    }
                ?>
                    <option <?php selectValue("puntoPartenzaItinerario", "altro", $i) ?>
                    value="altro" class="w3-text-cyan">Altro</option>
                </select>
                <!-- CAMPI PER INSERIRE UN NUOVO PUNTO DI PARTENZA -->
                <div id="nuovoPuntoPartenza" style="display: <?php
                    echo ($erroriNuovoPuntoPartenza > 0 || $erroriNuovaLocalitaPartenza>0)?'block':'none';
                    ?>;">
                    <hr/>
                    <?php $tipoPunto = "Partenza"; ?>
                    <?php include ROOT_DIR."views/puntiSignificativi/new.php" ?>
                </div>
                <button class="w3-button w3-deep-orange w3-large w3-margin-top my-formAlign"
                     type="button" onclick="openDiv('datiItinerario')">Indietro</button>
                <button class="w3-button w3-deep-orange w3-large w3-margin-top my-formAlign"
                     type="button" onclick="openDiv('datiPuntoArrivo')">Avanti</button>
            </section>


            <section class="nuovoItinerario" id="datiPuntoArrivo" style="display:none">
                <!-- SCELTA DEL PUNTO DI ARRIVO -->
                <label for="puntoArrivoItinerario">Punto di arrivo</label>
                <select name="puntoArrivoItinerario" id="puntoArrivoItinerario" class="my-select w3-margin-bottom"
                    onchange="showSubDiv(this, 'nuovoPuntoArrivo');"
                    onload  ="showSubDiv(this, 'nuovoPuntoArrivo');">
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
                    }
                ?>
                    <option value="altro" class="w3-text-cyan"
                        <?php selectValue("puntoArrivoItinerario", "altro", $i++) ?>>Altro</option>
                    <option value="copiaPunto" class="w3-text-deep-orange"
                        <?php selectValue("puntoArrivoItinerario", "copiaPunto", $i) ?>
                        id="copiaPunto" style="display: none">Stesso punto di quello di partenza</option>
                </select>
                <!-- CAMPI PER INSERIRE UN NUOVO PUNTO DI ARRIVO -->
                <div id="nuovoPuntoArrivo" style="display: <?php
                    echo ($erroriNuovoPuntoArrivo > 0 || $erroriNuovaLocalitaArrivo>0)?'block':'none';
                    ?>;">
                    <hr/>
                    <?php $tipoPunto = "Arrivo"; ?>
                    <?php include ROOT_DIR."views/puntiSignificativi/new.php" ?>
                </div>
                <button class="w3-button w3-deep-orange w3-large w3-margin-top my-formAlign"
                     type="button" onclick="openDiv('datiPuntoPartenza')">Indietro</button>
                <button class="w3-button w3-cyan w3-text-white w3-large w3-margin-top my-bottom"
                type="submit" name="nuovo" value="Conferma" onclick="openDiv('datiItinerario')">Conferma </button>
            </section>
        </form>
    </article>
</div>


<script type="text/javascript">
    var modalNew = document.getElementById('nuovo');
    window.addEventListener("click", function(event) {
       if (event.target == modalNew) {
           modalNew.style.display = "none";
       }
   }, false);
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxNPdObgBGVgg7PJPj3KihhwnMr30kSzA&callback=initMap"
    async defer></script>
