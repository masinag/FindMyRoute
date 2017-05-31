<?php
    require_once(ROOT_DIR . "php/utils.php");

    /**
     * Effettua il login.
     */
    function logIn(&$userLoggedIn, &$errori){
        // controllo che i campi username e password non siano vuoti
        checkNotEmpty(["username", "password"], "accedi", $errori);
        if (!isSet($errori)) {
            // controllo se l'utente esiste
            $conn = db_connect();
            $query = "SELECT * FROM utenti WHERE username='".$_POST["usernameAccedi"]."'";
            $res=mysql_query($query);
            mysql_close($conn);
            // Se l'utente non esiste
            if (mysql_num_rows($res)==0) {
                $errori["accedi"]["username"] = "Utente non trovato";
            } else {
               // se esiste confronto le password
               $row = mysql_fetch_array($res);
               if (password_verify($_POST["passwordAccedi"], $row["password"])){
                   setCookie("userID", $row["id"], time() + (10 * 365 * 24 * 60 * 60), "/");
                   $userLoggedIn = true;
               } else {
                   $errori["accedi"]["password"] = "Password errata";
               }
           }
        }
        return $userLoggedIn;
    }
    /**
     * Effettua il logout.
     */
    function logOut(&$userLoggedIn){
        setCookie("userID", "", time()-1, "/");
        $userLoggedIn = false;
        return !$userLoggedIn;
    }
    /**
     * Registra un utente.
     */
    function signUp(&$userLoggedIn, &$errori) {
        // controllo se ci sono campi vuoti
        checkNotEmpty(["username", "email", "password"], "registra", $errori);

        if (!isSet($errori)) {
            $username = $_POST["usernameRegistra"];
            $email = $_POST["emailRegistra"];
            $password = $_POST["passwordRegistra"];
            $conferma = $_POST["confermaPasswordRegistra"];

            // controllo se username o password sono già stati utilizzati
            $conn = db_connect();
            $query = "SELECT * FROM utenti WHERE username='$username'
                OR email='$email'";
            $res=mysql_query($query);
            // se esistono utenti con le stesse credenziali
            if (mysql_num_rows($res) > 0) {
                // se esiste già un utente mostro un messaggio opportuno
                while ($row = mysql_fetch_array($res)) {
                    if ($row["username"] == $username) {
                        $errori["registra"]["username"] = "L'username è stato già utilizzato";
                    }
                    if ($row["email"] == $email) {
                        $errori["registra"]["email"] ="L'email è stata già utilizzata";
                    }
                }
            } else {
                // controllo che l'email sia valida
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errori["registra"]["email"] = "Indirizzo email non valido";
                }
                //controllo che password e conferma corrispondano
                if ($password != $conferma) {
                    $errori["registra"]["confermaPassword"] = "Password e conferma password devono corrispondere";
                }

                if(!isSet($errori)){
                    // se non ci sono errori posso registrare il nuovo utente
                    $query = "INSERT into utenti (username, email, password) VALUES
                        ('".$username."', '".$email."', '".password_hash($password, PASSWORD_DEFAULT)."')";
                    mysql_query($query);
                    $idPunto = mysql_insert_id();
                    // e 'loggo' l'utente
                    setCookie("userID", $idPunto, time() + (10 * 365 * 24 * 60 * 60), "/");
                    $userLoggedIn = true;
                }
           }
           mysql_close($conn);
        }
        return $userLoggedIn;
    }



 ?>
