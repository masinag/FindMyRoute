<div id="nuovoItinerario" class="modal" style="display: <?php echo (isSet($errori))?'block':'none' ?>">
    <article class="my-userForm w3-text-black">
        <header class="w3-container">
            <h2>Nuovo itinerario</h2>
        </header>

        <form class="w3-container" action="#" method="post" enctype="multipart/form-data" >
            <section class="nuovoItinerario" id="datiItinerario">
                <p class="w3-text-red my-formAlign">
                <?php
                    echo isSet($errori)?"Il form contiene degli errori":"";
                ?>
                </p>
                <?php include_once "new.php" ?>
                <button class="w3-button w3-deep-orange w3-large w3-margin-top my-formAlign"
                     type="button" onclick="showDiv('datiPuntoPartenza', mapPartenza);">
                    Avanti
                </button>
            </section>

            <section class="nuovoItinerario" id="datiPuntoPartenza" style="display:none">
                <label for="puntoPartenzaItinerario">Punto di partenza</label>
                <!-- SCELTA DEL PUNTO DI PARTENZA -->
                <select name="puntoPartenzaItinerario" id="puntoPartenzaItinerario"
                    class="my-select w3-margin-bottom"
                    onchange="showSubDiv(this, 'nuovoPuntoPartenza', mapPartenza);
                                showSubDiv(this, 'copiaPunto');"
                    onload  ="showSubDiv(this, 'nuovoPuntoPartenza', mapPartenza);
                                showSubDiv(this, 'copiaPunto');">
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
                            <?php echo $row["sigla"].", ".$row["nomeLoc"].", ".$row["nomePunto"] ?>
                        </option>
                        <?php
                        $i++;
                    }
                ?>
                    <option <?php selectValue("puntoPartenzaItinerario", "altro", $i) ?>
                    value="altro" class="w3-text-cyan">Altro</option>
                </select>
                <!-- CAMPI PER INSERIRE UN NUOVO PUNTO DI PARTENZA -->
                <div id="nuovoPuntoPartenza" style="display: <?php getDisplay('puntoPartenzaItinerario') ?>;">
                    <hr/>
                    <?php $tipoPunto = "Partenza"; ?>
                    <?php include ROOT_DIR."views/puntiSignificativi/new.php" ?>
                </div>
                <button class="w3-button w3-deep-orange w3-large w3-margin-top my-formAlign"
                     type="button" onclick="showDiv('datiItinerario');">Indietro</button>
                <button class="w3-button w3-deep-orange w3-large w3-margin-top my-formAlign"
                     type="button" onclick="showDiv('datiPuntoArrivo', mapArrivo);">Avanti</button>
            </section>


            <section class="nuovoItinerario" id="datiPuntoArrivo" style="display:none">
                <!-- SCELTA DEL PUNTO DI ARRIVO -->
                <label for="puntoArrivoItinerario">Punto di arrivo</label>
                <select name="puntoArrivoItinerario" id="puntoArrivoItinerario" class="my-select w3-margin-bottom"
                    onchange="showSubDiv(this, 'nuovoPuntoArrivo', mapArrivo);"
                    onload  ="showSubDiv(this, 'nuovoPuntoArrivo', mapArrivo);">
                <?php
                    $conn = db_connect();
                    $res = mysql_query($queryItinerari);
                    mysql_close($conn);
                    $i = 0;
                    while ($row = mysql_fetch_array($res)) {
                        ?>
                        <option value="<?php echo $row['id'] ?>"<?php echo ($i==0)?" selected='selected'":"" ?>>
                            <?php echo $row["sigla"].", ".$row["nomeLoc"].", ".$row["nomePunto"] ?>
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
                <div id="nuovoPuntoArrivo" style="display: <?php getDisplay('puntoArrivoItinerario') ?>">
                    <hr/>
                    <?php $tipoPunto = "Arrivo"; ?>
                    <?php include ROOT_DIR."views/puntiSignificativi/new.php" ?>
                </div>

                <button class="w3-button w3-deep-orange w3-large w3-margin-top my-formAlign"
                     type="button" onclick="showDiv('datiPuntoPartenza', mapPartenza);">Indietro</button>
                <input class="w3-button w3-cyan w3-text-white w3-large my-buttonAlign"
                    type="submit" name="nuovo" value="Conferma"/>


            </section>
        </form>
    </article>
</div>

<script type="text/javascript">
    addModalListener('nuovoItinerario');
</script>

<script>
    var mapPartenza, mapArrivo, markerPartenza, markerArrivo;
    /**
     * Visualizza le mappe per selezionare il punto di partenza e arrivo.
     */
    function initMaps() {
        // mappa punto di partenza
        mapPartenza = new google.maps.Map(document.getElementById('mapPartenza'), {
            center: {lat: 47, lng: 2},
            zoom:5
        });
        // quando clicco sulla mappa viene mostrato un marker
        mapPartenza.addListener('click', function(e) {
            markerPartenza = placeMarker(e.latLng, mapPartenza, markerPartenza, 'Partenza');
        });
        mapArrivo = new google.maps.Map(document.getElementById('mapArrivo'), {
            center: {lat: 47, lng: 2},
            zoom:5
        });
        mapArrivo.addListener('click', function(e) {
            markerArrivo = placeMarker(e.latLng, mapArrivo, markerArrivo, 'Arrivo');
        });
    }
    /**
     * Mostra un marker sulla mappa e stampa le coordinate ai rispettivi
     * campi.
     */
    function placeMarker(position, map, marker, type) {
        if (marker == null){
            marker = new google.maps.Marker({
                position: position,
                map: map
            });
        } else {
            marker.setPosition(position);
        }
        document.getElementById('latitudinePunto' + type).value=position.lat();
        document.getElementById('longitudinePunto' + type).value=position.lng();

        return marker;
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxNPdObgBGVgg7PJPj3KihhwnMr30kSzA&callback=initMaps"
    async defer></script>
