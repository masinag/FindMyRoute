<div id="registra" class="modal" style="display: <?php echo (isSet($errori) && array_key_exists("registra", $errori))?'block':'none' ?>">
    <article class="my-userForm w3-text-black">
        <header class="w3-container">
            <h2>Registrati</h2>
        </header>

        <form class="w3-container" action="#" method="post">
            <label for="usernameRegistra">Username*</label>
            <input type="text" name="usernameRegistra" id="usernameRegistra"
                class="w3-input w3-border"/>
            <span class="my-input-error"><?php getError("utente", "usernameRegistra", $errori) ?></span>

            <label for="emailRegistra">Email*</label>
            <input type="email" name="emailRegistra" id="emailRegistra"
                class="w3-input w3-border"/>
            <span class="my-input-error"><?php getError("utente", "emailRegistra", $errori) ?></span>

            <label for="passwordRegistra">Password*</label>
            <input type="password" name="passwordRegistra" id="passwordRegistra"
                class="w3-input w3-border" onkeyup='checkPassword();'/>
            <span class="my-input-error"><?php getError("utente", "passwordRegistra", $errori) ?></span>

            <label for="confermaPasswordRegistra">Conferma password*</label>
            <input type="password" name="confermaPasswordRegistra" id="confermaPasswordRegistra"
                class="w3-input w3-border" onkeyup='checkPassword();'/>
            <span class="my-input-error"><?php getError("utente", "confermaPasswordRegistra", $errori) ?></span>

            <input class="w3-button w3-deep-orange w3-large w3-margin-top"
                type="submit" name="registra" value="Conferma"/>
        </form>

    </article>
</div>
