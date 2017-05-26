<label for="nomeLocalita<?php echo $tipoPunto ?>">Nome nuova localita di <?php echo $tipoPunto ?>*</label>
<input type="text" name="nomeLocalita<?php echo $tipoPunto ?>"
    id="nomeLocalita<?php echo $tipoPunto ?>" <?php getValue("nomeLocalita$tipoPunto") ?>/>
<span class="my-input-error"><?php getError("localita$tipoPunto", "nome", $errori) ?></span>

<label for="capLocalita<?php echo $tipoPunto ?>">CAP nuova localita di <?php echo $tipoPunto ?>*</label>
<input type="number" name="capLocalita<?php echo $tipoPunto ?>"
    id="capLocalita<?php echo $tipoPunto ?>" <?php getValue("capLocalita$tipoPunto") ?>/>
<span class="my-input-error"><?php getError("localita$tipoPunto", "cap", $errori) ?></span>

<label for="provinciaLocalita<?php echo $tipoPunto ?>">Provincia nuova localita*</label>
<select name="provinciaLocalita<?php echo $tipoPunto ?>" id="provinciaLocalita<?php echo $tipoPunto ?>">
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
        <option value="<?php echo $row["id"] ?>"
            <?php selectValue("provinciaLocalita$tipoPunto", $row["id"], $i)?>>
            <?php echo $row["nome"] ?>
        </option>
    <?php
        $i++;
        }
     ?>
</select>
