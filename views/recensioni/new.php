<div id="nuovaRecensione" class="modal" style="display: <?php echo (isSet($errori["recensione"]))?'block':'none' ?>">
    <article class="my-userForm w3-text-black">
        <header class="w3-container">
            <h2>Recensione</h2>
        </header>

        <form class="w3-container" action="#" method="post" enctype="multipart/form-data" >
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
