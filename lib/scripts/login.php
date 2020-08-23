<?php
require_once "../../config/init.php";

if (isset($_POST['login'])) {
    $logAuth = new Authentication();
    if ($user = $logAuth->authLogin($_POST['username'], $_POST['password'])) {
        $_SESSION['authorized'] = true;
        $_SESSION['userData'] = $user;
    } else {
        $_SESSION['authorized'] = false;
    }
}

$_SESSION['formName'] = "signin";

header('Location:' . SITE_URL . 'public/default/home-route.php');