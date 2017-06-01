<?php include_once "stars.php" ?>
<div id="nuovaRecensione" class="modal" style="display: <?php echo (isSet($errori["recensione"]))?'block':'none' ?>">
    <article class="my-userForm w3-text-black">
        <header class="w3-container">
            <h2>Recensione</h2>
        </header>

        <form class="w3-container" action="#" method="post">
            <div class="stars">
                <label for="votoRecensione">Voto</label><br/>
                <input type="hidden" name="idItinerario" value="<?php echo $_POST["idItinerario"] ?>"/>
                <?php showStars(5, true, "") ?>
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
