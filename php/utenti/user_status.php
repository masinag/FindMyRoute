<?php
define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT']."/FindMyRoute/");
require_once("utils.php");

$loginMessage = "";
$signupMessage = "";
$user_logged_in = false;
$changed = false;

if (isSet($_POST["accedi"])) {
    $changed = log_in($_POST["username"], $_POST["password"], $user_logged_in, $loginMessage);
} else  if (isSet($_POST["registra"])) {
    $changed = sign_up($_POST["username"], $_POST["email"], $_POST["password"], $user_logged_in, $signupMessage);
} else if (isSet($_POST["logout"])) {
    $changed = log_out($user_logged_in);
} else if (isSet($_COOKIE["userID"])){
    $user_logged_in = true;
}

if ($changed) {
    header('Location: /FindMyRoute/index.php');
    exit();
}

?>
