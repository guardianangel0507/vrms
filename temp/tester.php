<?php

// session_start();
// print_r($GLOBALS);
// echo "<br>";
// print_r($_GET);
// echo "<br>";
// print_r($_POST);
// echo "<br>";
//print_r($_SERVER);
// echo "<br>";
// print_r($_REQUEST);
// echo "<br>";
// print_r($_COOKIE);
// echo "<br>";
// print_r($_SESSION);

// session_unset();
// session_destroy();


// Authentication Class Testing
$auth = new Authentication();
$user = $auth->authLogin("guardianangel0507", "0507");

$auth->authLogout($user->userID, $user->username, $user->token);

echo "Logged in UserID: <br>";
print_r($user);
// DataUtility Class Testing
$userTypeData = $auth->getUserTypes();
echo "<br> Before extraction: <br>";
print_r($userTypeData);
$dtu = new DataUtility();
$userTypes = $dtu->extractData($userTypeData, "userType");
echo "<br> After extraction: <br>";
print_r($userTypes);

//$authData = array(
//    'username' => "guardianangel0507",
//    'password' => "0507",
//    'name' => 'Richard Brooks',
//    'email' => "guardianangel0507@gmail.com",
//    'phoneNo' => 8943199646
//);
//$auth->authRegister($authData);
