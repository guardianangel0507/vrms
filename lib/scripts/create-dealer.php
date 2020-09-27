<?php
require_once "../../config/init.php";
!isset($_SESSION['userData']) || $_SESSION['userData']->userType !== 'manufacturer' ? header("Location:" . SITE_URL . "public/default/home-route.php") : null;

$authErrors = array();
$authSuccess = array();
$authData = array(
	'name' => '',
	'email' => '',
	'username' => '',
	'password' => '',
	'phoneNo' => '',
	'address' => '',
	'userType' => 'dealer',
	'manufacturerID' => $_SESSION['userData']->userID
);

if (isset($_POST['add_dealer'])) {
	$dealerAuth = new Authentication();
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
	if (empty($authErrors)) {
		if ($dealerAuth->addUser($authData)) {
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

header('Location:' . SITE_URL . 'public/manufacturer/add-dealers');