<label for="nomeNuovaLocalita">Nome nuova localita</label>
<input type="text" name="nomeNuovaLocalita" id="nomeNuovaLocalita" />

<label for="capNuovaLocalita">CAP nuova localita</label>
<input type="number" name="capNuovaLocalita" id="capNuovaLocalita" />

<label for="provinciaNuovaLocalita">Provincia nuova localita</label>
<select name="provinciaNuovaLocalita" id="provinciaNuovaLocalita">
    <?php
        $conn = db_connect();
        $query = "
            SELECT p.id, p.nome FROM province as p
        ";
        $res = mysql_query($query);
        mysql_close($conn);
        $i = 0;
        while ($row = mysql_fetch_array($res)){
    ?>
        <option value="<?php echo $row["id"] ?>" <?php echo ($i==0)?"selected='selected'":""; ?>>
            <?php echo $row["nome"] ?>
        </option>
    <?php
        $i++;
        }
     ?>
</select>
