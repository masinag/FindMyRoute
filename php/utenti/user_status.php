<?php
define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT']."/FindMyRoute/");
require_once("utils.php");

$loginMessage = "";
$signupMessage = "";
$user_logged_in = false;
$changed = false;
$debug="";
if (isSet($_POST["accedi"]) or isSet($_POST["registra"])) {
    $debug="accedi o registra settato";
    if (isSet($_POST["accedi"])) {
        $debug="accedi settato";
        $changed = log_in($_POST["username"], $_POST["password"], $user_logged_in, $loginMessage);
    } else  if (isSet($_POST["registra"])) {
        $debug="registra settato";
        $changed = sign_up($_POST["username"], $_POST["email"], $_POST["password"], $user_logged_in, $signupMessage);
    }
} else if (isSet($_POST["logout"])) {
    $debug="logout settato";
    $changed = log_out($user_logged_in);
} else if (isSet($_COOKIE["userID"])){
    $debug="cookie user settato";
    $user_logged_in = true;
} else {
    $debug = "nulla";
}
if ($changed) {
    header('Location: /FindMyRoute/index.php');
    exit();
}

?>
