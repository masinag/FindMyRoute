<div id="registra" class="modal" style="display: <?php echo ($signupMessage==null)?'none':'block' ?>">
    <article class="my-userForm animate w3-text-black">
        <header class="w3-container">
            <h2>Registrati</h2>
        </header>

        <p class="w3-text-red w3-padding-large">
        <?php
            echo $signupMessage;
            $signupMessage = null;
        ?>
        </p>
        <form class="w3-container" action="#" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username"
                required="required" class="w3-input w3-border"/>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required="required"
                class="w3-input w3-border"/>

            <label for="password">Password</label>
            <input type="password" name="password" id="password"
                required="required" class="w3-input w3-border" onkeyup='checkPassword();'/>

            <label for="password_c">Conferma password</label>
            <input type="password" name="password_c" id="password_c"
                required="required" class="w3-input w3-border" onkeyup='checkPassword();'/>
            <!-- <label for="password_c" id="errMessage"></label> -->

            <input class="w3-button w3-deep-orange w3-large w3-margin-top"
                type="submit" name="registra" value="Conferma"/>
        </form>

    </article>
</div>
