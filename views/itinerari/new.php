<label for="nomeItinerario">Nome</label>
<input type="text" name="nomeItinerario" id="nomeItinerario"
    required="required" class="w3-input w3-border" <?php getValue("nomeItinerario") ?> />

<label for="descrizioneItinerario">Descrizione</label>
<textarea name="descrizioneItinerario" id="descrizioneItinerario" rows="4"
    required="required" class="w3-input w3-border"><?php getValueText("descrizioneItinerario") ?>
</textarea>

<label for="lunghezzaItinerario">Lunghezza (km)</label>
<input type="number" name="lunghezzaItinerario" id="lunghezzaItinerario"
    required="required" class="w3-input w3-border" step="0.01" min="0" <?php getValue("lunghezzaItinerario") ?>/>

<label for="difficoltaItinerario">Difficolta</label>
<select name="difficoltaItinerario" id="difficoltaItinerario" class="w3-margin-bottom">
    <option <?php selectValue("difficoltaItinerario", "1", 0) ?> value="1">1</option>
    <option <?php selectValue("difficoltaItinerario", "2", 1) ?> value="2">2</option>
    <option <?php selectValue("difficoltaItinerario", "3", 2) ?> value="3">3</option>
    <option <?php selectValue("difficoltaItinerario", "4", 3) ?> value="4">4</option>
    <option <?php selectValue("difficoltaItinerario", "5", 4) ?> value="5">5</option>
</select>

<br/>
<label class="w3-large">Tempo di percorrenza</label><br/>
<div class="w3-half" style="padding-right:10px">
    <label for="oreItinerario">Ore</label>
    <input type="number" name="oreItinerario" id="oreItinerario" min="0"
    required="required" <?php getValue("oreItinerario") ?>/>
</div>
<div class="w3-half" style="padding-left:10px">
    <label for="minutiItinerario">Minuti</label>
    <input type="number" name="minutiItinerario" id="minutiItinerario" min="0" max="59"
    required="required" <?php getValue("minutiItinerario") ?>/>
</div>

<label for="infoUtiliItinerario">Informazioni utili</label>
<textarea name="infoUtiliItinerario" id="infoUtiliItinerario" rows="4"
    class="w3-input w3-border"><?php getValueText("infoUtiliItinerario") ?></textarea>

<label for="tracciaItinerario">Traccia GPS</label>
<input type="file" name="tracciaItinerario" id="tracciaItinerario" required="required"/>
<span class="my-input-error"> <?php echo isSet($fileMessage)?$fileMessage:"" ?></span>
