<?php
require_once "../../config/init.php";

$authErrors = array();
$authSuccess = array();
$authData = array(
    'name' => '',
    'email' => '',
    'username' => '',
    'password' => '',
    'phoneNo' => '',
    'address' => '',
    'userType' => ''
);

if (isset($_POST['signup'])) {
    $logAuth = new Authentication();
    if (isset($_POST['name'])) $authData['name'] = $_POST['name'];
    if (isset($_POST['email'])) $authData['email'] = $_POST['email'];
    if (isset($_POST['phoneNo'])) $authData['phoneNo'] = $_POST['phoneNo'];
    if (isset($_POST['address'])) $authData['address'] = $_POST['address'];
    if (isset($_POST['username'])) $authData['username'] = $_POST['username'];
    // Password Checking
    if (isset($_POST['password']) && isset($_POST['cPassword']) && $_POST['cPassword'] === $_POST['password']) {
        $authData['password'] = $_POST['password'];
    } else {
        array_push($authErrors, "Passwords do not match");
    }
    if (isset($_POST['userType'])) {
        $userType = $_POST['userType'];
        $validUserTypes = array("manufacturer", "customer");
        if (in_array($userType, $validUserTypes)) {
            $authData['userType'] = $userType;
        } else {
            array_push($authErrors, "Invalid User Type");
        }
    }
    if (empty($authErrors)) {
        if ($logAuth->authRegister($authData)) {
            array_push($authSuccess, "Registration Success");
            $authData = null;
        } else {
            array_push($authErrors, "Registration Error");
        }
    }
}

$_SESSION['messages']['authErrors'] = isset($_SESSION['messages']['authErrors']) ? array_merge($_SESSION['messages']['authErrors'], $authErrors) : $authErrors;
$_SESSION['messages']['authSuccess'] = $authSuccess;
$_SESSION['authData'] = $authData;

$_SESSION['formName'] = "signup";

header('Location:' . SITE_URL . 'public/default/home-route.php');