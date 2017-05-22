<label for="nomeNuovoPunto">Nome punto di partenza</label>
<input type="text" id="nomeNuovoPunto" name="nomeNuovoPunto" />

<label for="tipoNuovoPunto">Tipo punto di partenza</label>
<select name="tipoNuovoPunto" class="w3-margin-bottom">
    <option value="interesse">Interesse</option>
    <option value="ristoro">Ristoro</option>
    <option value="altro">Altro</option>
</select> <br/>

<label for="sitoWebNuovoPunto">Sito WEB punto di partenza</label>
<input type="text" id="sitoWebNuovoPunto" name="sitoWebNuovoPunto" />

<label for="localitaNuovoPunto">Località punto di partenza</label>
<select name="localitaNuovoPunto" id="localitaNuovoPunto" class="my-select w3-margin-bottom" onchange="showSubDiv(this, 'nuovaLocalita')">
    <?php
        $conn = db_connect();
        $query = "
            SELECT l.nome, p.sigla
            FROM province as p, localita as l
            WHERE l.idProvincia = p.id
        ";
        $res = mysql_query($query);
        mysql_close($conn);
        $i = 0;
        while ($row = mysql_fetch_array($res)) {
     ?>
        <option value="<?php echo $row['id'] ?>"<?php echo ($i==0)?"selected='selected'":"" ?>>
            <?php echo $row["nome"].", ".$row["sigla"] ?>
        </option>
     <?php
        $i++;
    } ?>
    <option value="altro">Altro</option>
 </select>
<div id="nuovaLocalita" style="display: none;">
    <hr/>
    <?php include ROOT_DIR."views/localita/new.php" ?>
</div>
