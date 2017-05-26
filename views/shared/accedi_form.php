<div id="accedi" class="modal" style="display: <?php echo ($loginMessage==null)?'none':'block' ?>">
    <article class="my-userForm w3-text-black">
        <header class="w3-container">
            <h2>Accedi</h2>
        </header>

        <p class="w3-text-red w3-padding-large">
        <?php
            echo $loginMessage;
            $loginMessage = null;
        ?>
        </p>
        <form class="w3-container" action="#" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username"
                required="required" class="w3-input w3-border"/>

            <label for="password">Password</label>
            <input type="password" name="password" id="password"
                required="required" class="w3-input w3-border"/>

            <input class="w3-button w3-deep-orange w3-large w3-margin-top"
                type="submit" name="accedi" value="Conferma"/>
        </form>
    </article>
</div>
