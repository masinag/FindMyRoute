<!DOCTYPE html>
<html>
    <head>
        <title>Itinerari In Bicicletta</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" type="text/css" href="css/reset.css" />
        <link rel="stylesheet" type="text/css" href="css/mystyle.css" />
        <link rel="stylesheet" type="text/css" href="css/w3.css" />
        <link rel="stylesheet" type="text/css" href="css/fonts.css" />
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
        <script type="text/javascript" src="js/popup.js" defer></script>
    </head>


    <body>

        <!-- Navbar -->
        <div class="w3-top">
            <nav class="w3-bar w3-cyan w3-card-2 w3-left-align w3-large w3-text-white ">
                <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-cyan" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
                <a href="#" class="w3-bar-item w3-button w3-padding-large w3-white ">Home</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 1</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 2</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 3</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 4</a>
            </nav>

            <!-- Navbar on small screens -->
            <nav id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
                <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
                <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
                <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
                <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 4</a>
            </nav>
        </div>

        <!-- Header -->
        <header class="w3-container w3-cyan w3-center" style="padding:128px 16px">
            <h1 class="w3-margin w3-jumbo w3-text-white">Itinerari in bicicletta</h1>
            <p class="w3-xlarge w3-text-white">### Sottotitolo ###</p>
        </header>

        <!-- First Grid -->
        <div class="w3-row-padding w3-padding-64 w3-container">
            <div class="w3-content">
                <div class="w3-twothird w3-padding-large">
                    <h1>Che cosa offriamo?</h1>
                    <h5>
                        IIB è un'applicazione per la mappatura di percorsi per biciclette. Grazie a IIB sarà molto più facile trovare gli itinerari che desideri e conoscere tutte le informazioni utili relative ad essi.
                    </h5>
                </div>

                <div class="w3-third w3-padding-large">
                    <!-- <i class="fa fa-anchor w3-padding-64 w3-text-red"></i> -->
                    <h5 class="w3-margin-left">
                        Per condividere i tuoi itinerari entra a far parte della community.
                    </h5>
                    <div class=" w3-center">
                        <?php include "registra_form.html" ?>
                        <?php include "accedi_form.html" ?>
                        <button class="w3-button w3-deep-orange w3-padding-large w3-xlarge w3-margin-top my-button"
                        onclick="document.getElementById('registra').style.display='block'">
                            Registrati</button>
                        <button class="w3-button w3-deep-orange w3-padding-large w3-xlarge w3-margin-top my-button"
                        onclick="document.getElementById('accedi').style.display='block'">
                            Accedi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Grid -->
        <div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
            <div class="w3-content">
                <div class="w3-third w3-center">

                    <i class="my-large-text fa fa-info-circle w3-padding-32 w3-text-cyan w3-margin-right"></i>
                </div>

                <div class="w3-twothird w3-padding-large">
                    <h1>A chi ci rivolgiamo?</h1>
                    <h5 class="w3-padding-32">
                        IIB è un'applicazione rivolta sia a ciclisti professionisti, sia a ciclisti amatoriali. Raccoglie percorsi per ogni difficoltà ed adatti a persone con livelli differenti di allenamento.
                    </h5>
                </div>
            </div>
        </div>

        <div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
            <h1 class="w3-margin w3-xlarge">Quote of the day: live life</h1>
        </div>

        <!-- Footer -->
        <footer class="w3-container w3-padding-64 w3-center w3-opacity">
            <div class="w3-xlarge w3-padding-32">
                <i class="fa fa-facebook-official w3-hover-opacity"></i>
                <i class="fa fa-instagram w3-hover-opacity"></i>
                <i class="fa fa-snapchat w3-hover-opacity"></i>
                <i class="fa fa-pinterest-p w3-hover-opacity"></i>
                <i class="fa fa-twitter w3-hover-opacity"></i>
                <i class="fa fa-linkedin w3-hover-opacity"></i>
            </div>
        </footer>

        <script>
            // Used to toggle the menu on small screens when clicking on the menu button
            function myFunction() {
                var x = document.getElementById("navDemo");
                if (x.className.indexOf("w3-show") == -1) {
                    x.className += " w3-show";
                } else {
                    x.className = x.className.replace(" w3-show", "");
                }
            }

            // Get the modal
            var modalA = document.getElementById('accedi');
            var modalR = document.getElementById('registra');

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
               if (event.target == modalA) {
                   modalA.style.display = "none";
               } else if (event.target == modalR) {
                   modalR.style.display = "none";
               }
            }
        </script>


    </body>

</html>
