<?php
require_once '../../config/init.php';

//Session Started Globally for the System
session_start();

$auth = new Authentication();

if(!isset($_SESSION['authorized'])){
    $defaultHomeIndex = new Template(SITE_ROOT . "public/default/default-home.php");
    $defaultHomeIndex->title = "VRMS Home";
    echo $defaultHomeIndex;
}