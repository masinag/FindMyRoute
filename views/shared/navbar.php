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
        <?php $page = basename($_SERVER['PHP_SELF'])?>
        <a href="/FindMyRoute/index.php" class="w3-bar-item w3-button w3-padding-large
        <?php echo $page=='index.php'?'w3-white':'w3-hover-white' ?> ">Home</a>
        <a href="/FindMyRoute/views/itinerari/show_all.php" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-padding-large
        <?php echo ($page!='index.php')?'w3-white':'w3-hover-white' ?>">Itinerari</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-padding-large w3-hover-white">Link 2</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-padding-large w3-hover-white">Link 3</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-padding-large w3-hover-white">Link 4</a>
        <div class="my-float-right">
            <?php
                if (!$user_logged_in) {
             ?>
                <!-- Form per la registrazione -->
                <?php include ROOT_DIR."views/shared/registra_form.php"; ?>
                <!-- Form per l'accesso -->
                <?php include ROOT_DIR."views/shared/accedi_form.php"; ?>
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
        <a href="/FindMyRoute/index.php" class="w3-bar-item w3-button w3-padding-large">Home</a>
        <a href="/FindMyRoute/views/itinerari/show_all.php" class="w3-bar-item w3-button w3-padding-large">Itinerari</a>
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

<script type="text/javascript" async defer>

    // Chiudo le finestre quando l'utente clicca fuori da esse
    var modalA = document.getElementById('accedi');
    var modalR = document.getElementById('registra');
    window.onclick = function(event) {
       if (event.target == modalA) {
           modalA.style.display = "none";
       } else if (event.target == modalR) {
           modalR.style.display = "none";
       }
    }
</script>
