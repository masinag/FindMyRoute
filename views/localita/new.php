<label for="nomeNuovaLocalita<?php echo $tipoPunto ?>">Nome nuova localita di <?php echo $tipoPunto ?></label>
<input type="text" name="nomeNuovaLocalita<?php echo $tipoPunto ?>" id="nomeNuovaLocalita<?php echo $tipoPunto ?>" />

<label for="capNuovaLocalita<?php echo $tipoPunto ?>">CAP nuova localita di <?php echo $tipoPunto ?></label>
<input type="number" name="capNuovaLocalita<?php echo $tipoPunto ?>" id="capNuovaLocalita<?php echo $tipoPunto ?>" />

<label for="provinciaNuovaLocalita<?php echo $tipoPunto ?>">Provincia nuova localita</label>
<select name="provinciaNuovaLocalita<?php echo $tipoPunto ?>" id="provinciaNuovaLocalita<?php echo $tipoPunto ?>">
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
        <option value="<?php echo $row["id"] ?>" <?php echo ($i==0)?" selected='selected'":""; ?>>
            <?php echo $row["nome"] ?>
        </option>
    <?php
        $i++;
        }
     ?>
</select>
