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
    function signUp($username, $email, $password, &$userLoggedIn, &$message){
        // mi connetto al db
        $conn = db_connect();
        // controllo se username o email sono già stati usati
        $query = "SELECT * FROM utenti WHERE username='$username' OR email='$email'";
        $res=mysql_query($query);
        if (mysql_num_rows($res) > 0) {
            // se esiste già un utente mostro un messaggio opportuno
            while ($row = mysql_fetch_array($res)) {
                if ($row["username"] == $username) {
                    $message.="L'username è stato già utilizzato<br/>";
                }
                if ($row["email"] == $email) {
                    $message.="L'email è stata già utilizzata<br/>";
                }
            }
        } else {
            // altrimento posso registrare il nuovo utente
            $query = "INSERT into utenti (username, email, password) VALUES
                     ('".$username."', '".$email."', '".password_hash($password, PASSWORD_DEFAULT)."')";
            mysql_query($query);
            $idPunto = mysql_insert_id();
            // e 'loggo' l'utente
            setCookie("userID", $idPunto, time() + (10 * 365 * 24 * 60 * 60), "/");
            $userLoggedIn = true;
        }
        mysql_close($conn);
        return $userLoggedIn;
    }
 ?>
