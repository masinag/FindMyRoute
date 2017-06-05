<?php require_once("stars.php") ?>
<section class='w3-card-4 w3-margin-top'>
         <header class='w3-padding-left w3-cyan w3-bar'>
             <span class='w3-text-white w3-bar-item w3-large w3-margin-left'><?php echo $values["usernameRecensione"] ?></span>
             <!-- Se la recensione è quella dell'utente corrente mostro i pulsanti
                    per modifica e eliminazione -->
             <?php if ($i==0){ ?>
             <form action="#" method="post" class="w3-right">
                 <button type="button" name="button" class="w3-bar-item w3-button w3-xlarge
                 fa fa-edit w3-padding-large w3-text-white"
                 onclick="document.getElementById('modificaRecensione').style.display='block';"></button>
                 <input type="submit" name="eliminaRecensione" value="&#xf1f8;"
                    class="w3-bar-item w3-button w3-xlarge fa fa-trash w3-padding-large w3-text-white"/>
             </div>
             <?php } ?>
        </header>

         <div class='stars w3-padding'>
             <?php showStars($values["votoRecensione"], false, $i) ?>
         </div>
         <div class='w3-containter w3-padding-large'>
             <p><?php echo $values["testoRecensione"]  ?></p>
         </div>
 </section>
 <?php if ($i==0) include ROOT_DIR."views/recensioni/edit.php"; ?>
