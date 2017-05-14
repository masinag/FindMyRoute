<!DOCTYPE html>
<html>
    <head>
        <title>FindMyRoute</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" type="text/css" href="css/reset.css" />
        <link rel="stylesheet" type="text/css" href="css/mystyle.css" />
        <link rel="stylesheet" type="text/css" href="css/w3.css" />
        <link rel="stylesheet" type="text/css" href="css/fonts.css" />
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
        <script type="text/javascript" src="js/myscript.js" defer="defer"> </script>
    </head>
    <?php
        $errorMessage = "";
        $user_logged_in = false;
        if (isSet($_POST["accedi"]) or isSet($_POST["registra"])) {
            // mi connetto al db
            $conn = mysql_connect("localhost", "root", "");
            mysql_select_db("itinerariInBicicletta", $conn);
            if (isSet($_POST["accedi"])) {
                // codice per l'accesso
                // controllo se l'utente esiste
                $query = "SELECT * FROM utenti WHERE username='".$_POST['username']."'";
                // $message = $query;
                $res=mysql_query($query);
                if(mysql_num_rows($res)==0){
                    // Messaggio di errore
                    $errorMessage = "Utente non trovato";
                } else {
                    // confronto le password
                    $pwd = mysql_query("SELECT ");
                    $row = mysql_fetch_array($res);
                    $errorMessage = "Password errata";
                    if (password_verify($_POST["password"],$row["password"])){
                        $errorMessage = "";
                        setCookie("username", $row["username"]);
                        $user_logged_in = true;
                    }
                }
            } else  if (isSet($_POST["registra"])) {
                // codice per la registrazione
            }
            mysql_close($conn);
        } else if (isSet($_POST["logout"])) {
            // cancello il cookie
            setCookie("username", "", time()-1);
            $user_logged_in = false;
        } else if (isSet($_COOKIE["username"])){
            $user_logged_in = true;
        }
     ?>


    <body>
        <!-- Barra di navigazione -->
        <div class="w3-top">
            <!-- Navbar su schermi larghi -->
            <nav class="w3-bar w3-cyan w3-card-2 w3-left-align w3-large w3-text-white ">
                <a class="w3-bar-item w3-button w3-hide-large
                    w3-right w3-padding-large w3-hover-white w3-large w3-cyan"
                    href="javascript:void(0);" onclick="toggleMenu()"
                    title="Toggle Navigation Menu">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="#" class="w3-bar-item w3-button w3-padding-large w3-white ">Home</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-padding-large w3-hover-white">Link 1</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-padding-large w3-hover-white">Link 2</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-padding-large w3-hover-white">Link 3</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-padding-large w3-hover-white">Link 4</a>
                <div class="my-float-right">
                    <?php
                        if (!$user_logged_in) {
                     ?>
                        <!-- Form per la registrazione -->
                        <?php include "registra_form.html"; ?>
                        <!-- Form per l'accesso -->
                        <?php include "accedi_form.php"; ?>
                        <!-- Pulsanti -->
                        <button class="w3-bar-item w3-button w3-hide-small w3-hide-medium
                            w3-padding-large w3-white w3-text-deep-orange"
                        onclick="document.getElementById('accedi').style.display='block';">
                            Accedi
                        </button>
                        <button class="w3-bar-item w3-button w3-hide-small w3-hide-medium
                            w3-padding-large w3-hover-deep-orange w3-hover-white w3-deep-orange"
                        onclick="document.getElementById('registra').style.display='block'">
                            Registrati</button>
                    <?php } else {
                    ?>
                        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium
                            w3-padding-large w3-white w3-text-deep-orange">Account</a>
                        <form action="#" method="post" class="my-display-inline">
                        <input type="submit" class="w3-bar-item w3-button w3-hide-small
                                w3-hide-medium w3-padding-large w3-hover-white w3-deep-orange"
                                name="logout" value="Logout"/>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </nav>

            <!-- Navbar su schermi piccoli -->
            <nav id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-large">
                <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
                <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
                <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
                <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 4</a>
                <?php
                    if (!$user_logged_in) {
                 ?>
                    <button class="w3-bar-item w3-button w3-padding-large w3-text-deep-orange"
                    onclick="toggleMenu();document.getElementById('registra').style.display='block'">
                        Registrati</button>
                    <button class="w3-bar-item w3-button w3-padding-large w3-text-deep-orange"
                    onclick="toggleMenu();document.getElementById('accedi').style.display='block'">
                        Accedi
                    </button>
                <?php } else {
                ?>
                    <a href="#" class="w3-bar-item w3-button w3-padding-large">
                        Account
                    </a>
                    <form action="#" method="post">
                        <input type="submit" class="w3-bar-item w3-button w3-padding-large
                            w3-text-deep-orange" name="logout" value="Logout"/>
                    </form>
                <?php
                }
                ?>
            </nav>
        </div>

        <!-- Intestazione -->
        <header class="w3-container w3-cyan w3-center" style="padding:128px 16px">
            <h1 class="w3-margin w3-jumbo w3-text-white">FindMyRoute</h1>
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
                    <a href="#" class="w3-button w3-padding-large w3-xlarge
                        w3-deep-orange">Scopri gli itinerari</a>
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
                <i class="fa fa-facebook-official w3-hover-opacity"></i>
                <i class="fa fa-instagram w3-hover-opacity"></i>
                <i class="fa fa-snapchat w3-hover-opacity"></i>
                <i class="fa fa-pinterest-p w3-hover-opacity"></i>
                <i class="fa fa-twitter w3-hover-opacity"></i>
                <i class="fa fa-linkedin w3-hover-opacity"></i>
            </div>
        </footer>

        <script>
            // Chiudo le finestre quando l'utente clicca fuori da esse
            var modalA = document.getElementById('accedi');
            var modalR = document.getElementById('registra');
            window.onclick = function(event) {
               if (event.target == modalA) {
                   modalA.style.display = "none";
                   console.log("Closing Access form");
               } else if (event.target == modalR) {
                   modalR.style.display = "none";
               }
            }
        </script>
    </body>
</html>
