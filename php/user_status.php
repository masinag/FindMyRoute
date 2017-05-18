<?php
function db_connect(){
    $conn = mysql_connect("localhost", "root", "");
    mysql_select_db("itinerariInBicicletta", $conn);
    mysql_query ("set character_set_client='utf8'");
    mysql_query ("set character_set_results='utf8'"); 

    mysql_query ("set collation_connection='utf8_general_ci'");
    return $conn;
}
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
           setCookie("username", $row["username"]);
           $user_logged_in = true;
       }
   }
}
function log_out(&$user_logged_in){
    setCookie("username", "", time()-1);
    $user_logged_in = false;
}
function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
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
        setCookie("username", $row["username"]);
        $user_logged_in = true;
    }
    mysql_close($conn);
}

$loginMessage = "";
$signupMessage = "";
$user_logged_in = false;
if (isSet($_POST["accedi"]) or isSet($_POST["registra"])) {
    if (isSet($_POST["accedi"])) {
        log_in($_POST["username"], $_POST["password"], $user_logged_in, $loginMessage);
    } else  if (isSet($_POST["registra"])) {
        sign_up($_POST["username"], $_POST["email"], $_POST["password"], $user_logged_in, $signupMessage);
    }
} else if (isSet($_POST["logout"])) {
    log_out($user_logged_in);
} else if (isSet($_COOKIE["username"])){
    $user_logged_in = true;
}
?>
