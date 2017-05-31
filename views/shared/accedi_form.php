<div id="accedi" class="modal" style="display: <?php echo (isSet($errori) && array_key_exists("accedi", $errori))?'block':'none' ?>">
    <article class="my-userForm w3-text-black">
        <header class="w3-container">
            <h2>Accedi</h2>
        </header>

        <form class="w3-container" action="#" method="post">
            <label for="usernameAccedi">Username*</label>
            <input type="text" name="usernameAccedi" id="usernameAccedi"
                class="w3-input w3-border" <?php getValue("usernameAccedi") ?>/>
            <span class="my-input-error"><?php getError("accedi", "username", $errori) ?></span>

            <label for="passwordAccediUtente">Password*</label>
            <input type="password" name="passwordAccedi" id="passwordAccedi"
                class="w3-input w3-border"/>
            <span class="my-input-error"><?php getError("accedi", "password", $errori) ?></span>

            <input class="w3-button w3-deep-orange w3-large w3-margin-top"
                type="submit" name="accedi" value="Conferma"/>
        </form>
    </article>
</div>
