<?php
require_once "../../config/init.php";

if (isset($_POST['signup'])) {
    $_SESSION['messages']['authErrors'] = array();
    $_SESSION['messages']['authSuccess'] = array();
    $logAuth = new Authentication();
    $authData = array();
    if (isset($_POST['name'])) $authData['name'] = $_POST['name'];
    if (isset($_POST['email'])) $authData['email'] = $_POST['email'];
    if (isset($_POST['phoneNo'])) $authData['phoneNo'] = $_POST['phoneNo'];
    if (isset($_POST['address'])) $authData['address'] = $_POST['address'];
    if (isset($_POST['username'])) $authData['username'] = $_POST['username'];
    if (isset($_POST['password']) && isset($_POST['cPassword']) && $_POST['cPassword'] === $_POST['password']) {
        $authData['password'] = $_POST['password'];
    } else {
        array_push($_SESSION['messages']['authErrors'], "Passwords do not match");
    }
    if (isset($_POST['userType'])) {
        $userType = $_POST['userType'];
        $userTypes = array("manufacturer", "customer");
        if (in_array($userType, $userTypes)) {
            $authData['userType'] = $userType;
        } else {
            array_push($_SESSION['messages']['authErrors'], "Invalid User Type");
        }
    }
    if ($logAuth->authRegister($authData)) {
        array_push($_SESSION['messages']['authSuccess'], "Registration Success");
    } else {
        array_push($_SESSION['messages']['authErrors'], "Registration Error");
    }
}

$_SESSION['formName'] = "signup";

header('Location:' . SITE_URL . 'public/default/home-route.php');