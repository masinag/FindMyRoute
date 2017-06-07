<?php include_once "stars.php" ?>
<div class="stars">
    <label for="votoRecensione">Voto</label><br/>
    <?php
    $nStars = getValueText("votoRecensione", $values);
    showStars($nStars==""?5:$nStars, true, "") ?>
</div>
<span class="my-input-error"><?php getError("recensione", "voto", $errori) ?></span>

<label for="testoRecensione">Recensione</label>
<textarea name="testoRecensione" id="testoRecensione" rows="4"
    class="w3-input w3-border"><?php printValueText("testoRecensione", $values) ?></textarea>
