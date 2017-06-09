<div id="modificaRecensione" class="modal" style="display: none">
    <article class="my-userForm w3-text-black">
        <header class="w3-container">
            <h2>Modifica</h2>
        </header>

        <form class="w3-container" action="show.php?idItinerario="<?php echo $_GET["idItinerario"] ?> method="post">
            <?php include ROOT_DIR."views/recensioni/_form.php" ?>

            <input type="submit" name="modificaRecensione" value="Conferma"
                class="w3-button w3-cyan w3-text-white w3-large w3-show-block" />
        </form>
    </article>

</div>
<script type="text/javascript">
    addModalListener('modificaRecensione');
</script>
