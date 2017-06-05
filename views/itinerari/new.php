<label for="nomeItinerario">Nome*</label>
<input type="text" name="nomeItinerario" id="nomeItinerario" class="w3-input w3-border"
    <?php getValue("nomeItinerario") ?> />
<span class="my-input-error"><?php getError("itinerario", "nome", $errori) ?></span>

<label for="descrizioneItinerario">Descrizione*</label>
<textarea name="descrizioneItinerario" id="descrizioneItinerario" rows="4"
    class="w3-input w3-border"><?php printValueText("descrizioneItinerario", $values) ?>
</textarea>
<span class="my-input-error"><?php getError("itinerario", "descrizione", $errori) ?></span>

<label for="lunghezzaItinerario">Lunghezza (km)*</label>
<input type="text" name="lunghezzaItinerario" id="lunghezzaItinerario"
    class="w3-input w3-border" <?php getValue("lunghezzaItinerario") ?>/>
<span class="my-input-error"><?php getError("itinerario", "lunghezza", $errori) ?></span>


<label for="difficoltaItinerario">Difficolta*</label>
<select name="difficoltaItinerario" id="difficoltaItinerario" class="w3-margin-bottom">
    <option <?php selectValue("difficoltaItinerario", "1", 0) ?> value="1">1</option>
    <option <?php selectValue("difficoltaItinerario", "2", 1) ?> value="2">2</option>
    <option <?php selectValue("difficoltaItinerario", "3", 2) ?> value="3">3</option>
    <option <?php selectValue("difficoltaItinerario", "4", 3) ?> value="4">4</option>
    <option <?php selectValue("difficoltaItinerario", "5", 4) ?> value="5">5</option>
</select>

<br/>
<label class="w3-large">Tempo di percorrenza*</label><br/>
<div class="w3-half" style="padding-right:10px">
    <label for="oreItinerario">Ore*</label>
    <input type="text" name="oreItinerario" id="oreItinerario"
        <?php getValue("oreItinerario") ?>/>
    <span class="my-input-error"><?php getError("itinerario", "ore", $errori) ?></span>
</div>
<div class="w3-half" style="padding-left:10px">
    <label for="minutiItinerario">Minuti*</label>
    <input type="text" name="minutiItinerario" id="minutiItinerario"
        <?php getValue("minutiItinerario") ?>/>
    <span class="my-input-error"><?php getError("itinerario", "minuti", $errori) ?></span>
    <br/>
    <br/>
</div>

<label for="infoUtiliItinerario">Informazioni utili</label>
<textarea name="infoUtiliItinerario" id="infoUtiliItinerario" rows="4"
    class="w3-input w3-border"><?php printValueText("infoUtiliItinerario", $values) ?></textarea>

<label for="tracciaItinerario">Traccia GPS (formato .gpx)*</label>
<input type="file" name="tracciaItinerario" id="tracciaItinerario"/>
<span class="my-input-error"><?php getError("itinerario", "traccia", $errori) ?></span>
