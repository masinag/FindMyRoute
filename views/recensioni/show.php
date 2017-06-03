<?php require_once("stars.php") ?>
<section class='w3-card-4 w3-margin-top'>
         <header class='w3-container w3-cyan'>
         <h5 class='w3-text-white'><?php echo $username ?></h5>
         </header>

         <div class='stars w3-padding'>
             <?php showStars($voto, false, $i) ?>
         </div>
         <div class='w3-containter w3-padding-large'>
             <p><?php echo $recensione  ?></p>
         </div>
 </section>
