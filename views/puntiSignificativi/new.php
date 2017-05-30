<label for="nomePunto<?php echo $tipoPunto ?>">Nome punto di <?php echo $tipoPunto ?></label>
<input type="text" id="nomePunto<?php echo $tipoPunto ?>"
    name="nomePunto<?php echo $tipoPunto ?>" <?php getValue("nomePunto$tipoPunto") ?>/>
<span class="my-input-error"><?php getError("punto$tipoPunto", "nome", $errori) ?></span>

<label for="tipoPunto<?php echo $tipoPunto ?>">Tipo punto di <?php echo $tipoPunto ?>*</label>
<select name="tipoPunto<?php echo $tipoPunto ?>" class="w3-margin-bottom" id="tipoPunto<?php echo $tipoPunto ?>">
    <option <?php selectValue("tipoPunto$tipoPunto", "interesse", 0) ?> value="interesse">Interesse</option>
    <option <?php selectValue("tipoPunto$tipoPunto", "ristoro", 1) ?> value="ristoro">Ristoro</option>
    <option <?php selectValue("tipoPunto$tipoPunto", "altro", 2) ?> value="altro">Altro</option>
</select> <br/>

<label for="sitoPunto<?php echo $tipoPunto ?>">Sito WEB punto di <?php echo $tipoPunto ?></label>
<input type="text" id="sitoPunto<?php echo $tipoPunto ?>"
    name="sitoPunto<?php echo $tipoPunto ?>" <?php getValue("sitoPunto$tipoPunto")?>/>
<span class="my-input-error"><?php getError("punto$tipoPunto", "sito", $errori) ?></span>


<!-- MAPPA PER SCEGLIERE LE COORDINATE -->
<label>Seleziona sulla mappa il punto di <?php echo $tipoPunto ?>*</label>

<div id="map<?php echo $tipoPunto ?>" class="my-map my-formAlign w3-margin-bottom"></div>

<!-- COORDINATE -->
<div class="w3-half" style="padding-right:10px">
    <label for="latitudinePunto<?php echo $tipoPunto ?>">Latitudine</label>
    <input type="number" id="latitudinePunto<?php echo $tipoPunto ?>"
        name="latitudinePunto<?php echo $tipoPunto ?>" <?php getValue("latitudinePunto$tipoPunto")?>
        readonly="readonly"/>
</div>
<div class="w3-half" style="padding-left:10px">
    <label for="longitudinePunto<?php echo $tipoPunto ?>">Longitudine</label>
    <input type="number" id="longitudinePunto<?php echo $tipoPunto ?>"
        name="longitudinePunto<?php echo $tipoPunto ?>" <?php getValue("longitudinePunto$tipoPunto")?>
        readonly="readonly"/>
</div>
<span class="my-input-error"><?php getError("punto$tipoPunto", "latitudine", $errori) ?></span>
<span class="my-input-error"><?php getError("punto$tipoPunto", "longitudine", $errori) ?></span>


<label for="localitaPunto<?php echo $tipoPunto ?>">Località punto di <?php echo $tipoPunto ?>*</label>
<select name="localitaPunto<?php echo $tipoPunto ?>"
    id="localitaPunto<?php echo $tipoPunto ?>" class="my-select w3-margin-bottom"
    onchange="showSubDiv(this, 'nuovaLocalita<?php echo $tipoPunto ?>');
    <?php if ($tipoPunto=='Partenza'){ ?> showSubDiv(this, 'copiaLocalita') <?php } ?>"
    onload="showSubDiv(this, 'nuovaLocalita<?php echo $tipoPunto ?>');
    <?php if ($tipoPunto=='Partenza'){ ?> showSubDiv(this, 'copiaLocalita') <?php } ?>">


    <?php
        $conn = db_connect();
        $query = "
            SELECT l.id, l.nome, p.sigla
            FROM province as p, localita as l
            WHERE l.idProvincia = p.id
        ";
        $res = mysql_query($query);
        mysql_close($conn);
        $i = 0;
        while ($row = mysql_fetch_array($res)) {
     ?>
        <option value="<?php echo $row['id'] ?>" <?php selectValue("localitaPunto$tipoPunto", $row['id'], $i) ?>>
            <?php echo $row["nome"].", ".$row["sigla"] ?>
        </option>
     <?php
        $i++;
    } ?>
    <?php if ($tipoPunto == "Arrivo") { ?>
        <option value="copiaLocalita" id="copiaLocalita" class="w3-text-cyan" style="display: none"
            <?php selectValue("localitaPunto$tipoPunto", "copiaLocalita", $i++)?>>
            Stessa località di quella del punto di partenza</option>
    <?php } ?>
    <option value="altro" class="w3-text-deep-orange"
        <?php selectValue("localitaPunto$tipoPunto", "altro", $i)?>>Altro</option>
 </select>

<div id="nuovaLocalita<?php echo $tipoPunto ?>"
    style='display: <?php getDisplay("localitaPunto$tipoPunto");?>'>
    <hr/>
    <?php include ROOT_DIR."views/localita/new.php" ?>
</div>
