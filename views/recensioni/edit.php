<div id="modificaRecensione" class="modal" style="display: none">
    <article class="my-userForm w3-text-black">
        <header class="w3-container">
            <h2>Modifica</h2>
        </header>

        <form class="w3-container" action="#" method="post">
            <?php include ROOT_DIR."views/recensioni/_form.php" ?>

            <input type="submit" name="modificaRecensione" value="Conferma"
                class="w3-button w3-cyan w3-text-white w3-large w3-show-block" />
        </form>
    </article>

</div>
<script type="text/javascript">
    var modalEditRec = document.getElementById('modificaRecensione');
    window.addEventListener("click", function(event) {
       if (event.target == modalEditRec) {
           modalEditRec.style.display = "none";
       }
   }, false);
</script>
