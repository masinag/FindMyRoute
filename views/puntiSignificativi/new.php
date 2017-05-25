<label for="nomePunto<?php echo $tipoPunto ?>">Nome punto di <?php echo $tipoPunto ?></label>
<input type="text" id="nomePunto<?php echo $tipoPunto ?>"
    name="nomePunto<?php echo $tipoPunto ?>"/>
<span class="my-input-error">
    <?php
        if ($tipoPunto == "Partenza") {
            echo isSet($nomePuntoPartenzaMessage)?$nomePuntoPartenzaMessage:"";
        } else {
            echo isSet($nomePuntoArrivoMessage)?$nomePuntoArrivoMessage:"" ;
        }
    ?>
</span>

<label for="tipoPunto<?php echo $tipoPunto ?>">Tipo punto di <?php echo $tipoPunto ?></label>
<select name="tipoPunto<?php echo $tipoPunto ?>" class="w3-margin-bottom">
    <option value="interesse">Interesse</option>
    <option value="ristoro">Ristoro</option>
    <option value="altro">Altro</option>
</select> <br/>

<label for="sitoWebPunto<?php echo $tipoPunto ?>">Sito WEB punto di <?php echo $tipoPunto ?></label>
<input type="text" id="sitoWebPunto<?php echo $tipoPunto ?>"
    name="sitoWebPunto<?php echo $tipoPunto ?>" />
<span class="my-input-error">
    <?php
        if ($tipoPunto == "Partenza") {
            echo isSet($sitoPuntoPartenzaMessage)?$sitoPuntoPartenzaMessage:"";
        } else {
            echo isSet($sitoPuntoArrivoMessage)?$sitoPuntoArrivoMessage:"" ;
        }
    ?>
</span>

<label for="localitaPunto<?php echo $tipoPunto ?>">Località punto di <?php echo $tipoPunto ?></label>
<select name="localitaPunto<?php echo $tipoPunto ?>"
    id="localitaPunto<?php echo $tipoPunto ?>" class="my-select w3-margin-bottom"
    onchange="showSubDiv(this, 'nuovaLocalita<?php echo $tipoPunto ?>');
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
        <option value="<?php echo $row['id'] ?>"<?php echo ($i==0)?" selected='selected'":"" ?>>
            <?php echo $row["nome"].", ".$row["sigla"] ?>
        </option>
     <?php
        $i++;
    } ?>
    <?php if ($tipoPunto == "Arrivo") { ?>
        <option value="copia" id="copiaLocalita" class="w3-text-cyan" style="display: none">
            Stessa località di quella del punto di partenza</option>
    <?php } ?>
    <option value="altro" class="w3-text-deep-orange">Altro</option>
 </select>
<div id="nuovaLocalita<?php echo $tipoPunto ?>" style="display: none;">
    <hr/>
    <?php include ROOT_DIR."views/localita/new.php" ?>
</div>
