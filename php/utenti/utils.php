<?php
    require_once(ROOT_DIR . "php/utils.php");

    /**
     * Prova ad effettuare il login.
     */
    function log_in($username, $password, &$user_logged_in, &$message){
        // mi connetto al db
        $conn = db_connect();
        // controllo se l'utente esiste
        $query = "SELECT * FROM utenti WHERE username='$username'";
        $res=mysql_query($query);
        mysql_close($conn);
        // Se l'utente non esiste
        if(mysql_num_rows($res)==0){
            $message = "Utente non trovato";
        } else {
           // confronto le password
           $row = mysql_fetch_array($res);
           $message = "Password errata";
           if (password_verify($password, $row["password"])){
               $message = "";
               setCookie("userID", $row["id"]);
               $user_logged_in = true;
           }
       }
       return $user_logged_in;
    }
    /**
     * Effettua il logout.
     */
    function log_out(&$user_logged_in){
        setCookie("userID", "", time()-1);
        $user_logged_in = false;
        return !$user_logged_in;
    }

    /**
     * Registra un utente.
     */
    function sign_up($username, $email, $password, &$user_logged_in, &$message){
        // mi connetto al db
        $conn = mysql_connect("localhost", "root", "");
        mysql_select_db("itinerariInBicicletta", $conn);
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
            // e 'loggo' l'utente
            setCookie("userID", $row["id"]);
            $user_logged_in = true;
        }
        mysql_close($conn);
        return $user_logged_in;
    }
 ?>
