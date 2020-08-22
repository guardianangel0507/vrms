<?php
require_once "../../config/init.php";

if (isset($_GET['id'])) {
    $userID = $_GET['id'];
    if ($userID == $_SESSION['userData']->userID) {
        $username = $_SESSION['userData']->username;
        $token = $_SESSION['userData']->token;
        $auth = new Authentication();
        $auth->authLogout($userID, $username, $token);
        session_destroy();
        header('Location:'.SITE_URL);
    } else {
        echo "You are not allowed!";
    }
}