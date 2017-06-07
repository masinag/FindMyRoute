<?php
require_once("utils.php");

$userLoggedIn = false;

if (isSet($_POST["accedi"])) {
    $changed = logIn($userLoggedIn, $errori);
} else  if (isSet($_POST["registra"])) {
    $changed = signUp($userLoggedIn, $errori);
} else if (isSet($_POST["logout"])) {
    $changed = logOut($userLoggedIn);
} else if (isSet($_COOKIE["userID"])){
    $userLoggedIn = true;
}

?>
