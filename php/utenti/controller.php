<?php
require_once("utils.php");

$userLoggedIn = false;
// a seconda della form compilata chiamo la funzione corrispondente
if (isSet($_POST["accedi"])) {
    $changed = logIn($userLoggedIn, $errori);
} else  if (isSet($_POST["registra"])) {
    $changed = signUp($userLoggedIn, $errori);
} else if (isSet($_POST["logout"])) {
    $changed = logOut($userLoggedIn);
} else if (isSet($_COOKIE["userID"])){
    $userLoggedIn = true;
}
// se l'utente ha effettuato accesso, registrazione o logout lo rimando alla home
if ($changed) {
    header('Location: /FindMyRoute/index.php');
    die;
}

?>
