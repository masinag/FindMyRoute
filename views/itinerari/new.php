<div id="nuovo" class="modal" style="display: none">
    <article class="my-userForm animate w3-text-black">
        <header class="w3-container">
            <h2>Nuovo itinerario</h2>
        </header>

        <p class="w3-text-red w3-padding-large">
        <?php
            // echo $routeMessage;
            // $routeMessage = null;
        ?>
        </p>
        <form class="w3-container" action="#" method="post">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome"
                required="required" class="w3-input w3-border"/>

                <!--
                tracciaGPS       varchar(250)                not null,
                idUtente         int unsigned,
                idPuntoPartenza  int unsigned                not null,
                idPuntoArrivo -->
            <label for="descrizione">Descrizione</label>
            <textarea name="descrizione" id="descrizione" rows="4"
                required="required" class="w3-input w3-border"></textarea>

            <label for="lunghezza">Lunghezza (km)</label>
            <input type="number" name="lunghezza" id="lunghezza"
                required="required" class="w3-input w3-border" step="0.01"/>
            <label for="difficolta">Difficolta</label>
            <select name="difficolta" id="difficolta" class="w3-margin-bottom">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            <br/>
            <label class="w3-large">Tempo di percorrenza</label><br/>
            <div class="w3-half" style="padding-right:10px">
                <label for="ore">Ore</label>
                <input type="number" name="ore" id="ore"/>
            </div>
            <div class="w3-half" style="padding-left:10px">
                <label for="minuti">Minuti</label>
                <input type="number" name="minuti" id="minuti"/>
            </div>

            <label for="infoUtili">Informazioni utili</label>
            <textarea name="infoUtili" id="infoUtili" rows="4"
                class="w3-input w3-border"></textarea>
            <!-- <input type="textarea" name="infoUtili" id="infoUtili" rows="4"
                class="w3-input w3-border"/> -->



            <input class="w3-button w3-deep-orange w3-large w3-margin-top"
                type="submit" name="nuovo" value="Conferma"/>
        </form>

    </article>
</div>

<script type="text/javascript" async defer>
    var modalNew = document.getElementById('nuovo');
    window.addEventListener("click", function(event) {
       if (event.target == modalNew) {
           modalNew.style.display = "none";
       }
   }, false);
</script>
