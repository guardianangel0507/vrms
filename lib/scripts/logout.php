<?php
require_once "../../config/init.php";

if (isset($_GET['id'])) {
    $userID = $_GET['id'];
    if ($userID == $_SESSION['userData']->userID) {
        $username = $_SESSION['userData']->username;
        $token = $_SESSION['userData']->token;
        $auth = new Authentication();
        if($auth->authLogout($userID, $username, $token)){
            session_unset();
            session_destroy();
        } else {
            $_SESSION['messages']['authErrors'] = array("Logout Error");
        }
    } else {
        $_SESSION['messages']['authErrors'] = array("You are not allowed to log out Another User!");
    }
    header('Location:'.SITE_URL.'public/default/home-route.php');
}