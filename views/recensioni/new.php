<div id="nuovaRecensione" class="modal" style="display: <?php echo (isSet($errori["recensione"]))?'block':'none' ?>">
    <article class="my-userForm w3-text-black">
        <header class="w3-container">
            <h2>Recensione</h2>
        </header>
        <p>
            <?php echo isSet($_POST["recensione"])?$_POST["votoRecensione"]:"" ?>
        </p>
        <form class="w3-container" action="#" method="post">
            <div class="stars">
                <label for="votoRecensione">Voto</label><br/>
                <input type="hidden" name="idItinerario" value="<?php echo $_POST["idItinerario"] ?>"/>
                <input class="star" id="star-5" value="5" type="radio" name="votoRecensione" checked="checked"/>
                <label class="star" for="star-5"></label>
                <input class="star" id="star-4" value="4" type="radio" name="votoRecensione"/>
                <label class="star" for="star-4"></label>
                <input class="star" id="star-3" value="3" type="radio" name="votoRecensione"/>
                <label class="star" for="star-3"></label>
                <input class="star" id="star-2" value="2" type="radio" name="votoRecensione"/>
                <label class="star" for="star-2"></label>
                <input class="star" id="star-1" value="1" type="radio" name="votoRecensione"/>
                <label class="star" for="star-1"></label>
            </div>
            <span class="my-input-error"><?php getError("recensione", "voto", $errori) ?></span>

            <label for="testoRecensione">Recensione</label>
            <textarea name="testoRecensione" id="testoRecensione" rows="4"
                class="w3-input w3-border"><?php getValueText("testoRecensione") ?>
            </textarea>

            <input type="submit" name="recensione" value="Conferma"
                class="w3-button w3-cyan w3-text-white w3-large w3-show-block" />
        </form>
    </article>
</div>

<script type="text/javascript">
    var modalNewRec = document.getElementById('nuovaRecensione');
    window.addEventListener("click", function(event) {
       if (event.target == modalNewRec) {
           modalNewRec.style.display = "none";
       }
   }, false);
</script>
