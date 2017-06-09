<?php include $_SERVER['DOCUMENT_ROOT']."/FindMyRoute/php/controllers.php" ?>
<!DOCTYPE html>
<html>
    <head>
        <title>FindMyRoute</title>
        <?php include_once ROOT_DIR."views/shared/head.php" ?>
    </head>

    <body>
        <?php include_once ROOT_DIR."views/shared/navbar.php" ?>

        <!-- Intestazione -->
        <header class="w3-container w3-cyan w3-center" style="padding:128px 16px">
            <h1 class="w3-margin w3-jumbo w3-text-white">
                FindMy <span class="my-nowrap">
                    <img src="/FindMyRoute/files/imgs/logo-white.svg"
                        alt="Logo FindMyRoute" style="height:1em;">oute
                    </span></h1>
            <p class="w3-xlarge w3-text-white">
                L'applicazione per la mappatura di itinerari in bicicletta <br/>
            </p>
        </header>

        <!-- Primo blocco -->
        <section class="w3-row-padding w3-padding-64 w3-container">
            <div class="w3-content w3-container" style="">
                <article class="w3-twothird w3-padding-large">
                    <h1>Che cosa offriamo?</h1>
                    <h5 class="w3-justify">
                        FindMyRoute è un'applicazione per la mappatura di percorsi per biciclette.
                        Con FindMyRoute sarà molto più facile trovare gli itinerari che desideri e
                        conoscere tutte le informazioni utili relative ad essi.
                    </h5>
                </article>
                <section class="w3-third w3-padding-large">
                    <h5 class="w3-justify">
                        Inizia subito ad utilizzare la nostra applicazione
                    </h5>
                    <a href="views/itinerari/show_all.php" class="w3-button w3-padding-large w3-xlarge
                        w3-deep-orange my-button">Scopri gli itinerari</a>
                </section>
            </div>
        </section>

        <!-- Secondo blocco -->
        <section class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
            <div class="w3-content">
                <div class="w3-third w3-center">
                    <i class="my-large-text fa fa-info-circle w3-padding-32 w3-text-cyan w3-margin-right"></i>
                </div>

                <article class="w3-twothird w3-padding-large">
                    <h1>A chi ci rivolgiamo?</h1>
                    <h5 class="w3-padding-32 w3-justify">
                        FindMyRoute è un'applicazione rivolta sia a ciclisti professionisti,
                        sia a ciclisti amatoriali. Raccoglie percorsi per ogni difficoltà ed
                        adatti a persone con livelli differenti di allenamento.

                    </h5>
                </article>
            </div>
        </section>

        <!-- Blocco con una citazione -->
        <blockquote class="w3-container w3-black w3-center w3-opacity w3-padding-64">
            <h1 class="w3-margin w3-xlarge">
                La vita è come andare in bicicletta. Per mantenere l’equilibrio
                devi muoverti.
            </h1>
            <footer>
            — <cite class="w3-large">Albert Einstein</cite>
            </footer>
        </blockquote>

        <!-- Footer -->
        <footer class="w3-container w3-padding-64 w3-center w3-opacity">
            <div class="w3-xlarge w3-padding-32">
                <!-- <i class="fa fa-facebook-official w3-hover-opacity"></i>
                <i class="fa fa-instagram w3-hover-opacity"></i>
                <i class="fa fa-snapchat w3-hover-opacity"></i>
                <i class="fa fa-pinterest-p w3-hover-opacity"></i>
                <i class="fa fa-twitter w3-hover-opacity"></i>
                <i class="fa fa-linkedin w3-hover-opacity"></i> -->
                <a href="https://github.com/masinag/FindMyRoute.git" class=" w3-button w3-hover-opacity">
                    Github
                    <i class="fa fa-github" ></i>
                </a>
            </div>
        </footer>
    </body>
</html>
