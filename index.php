<?php
include_once "config/init.php";

// echo SITE_ADDR;

// Index Template Rendering
//$indexTemplate = new Template("temp/index.html");
$indexTemplate = new Template(SITE_ROOT."public/lander.html");
//$indexTemplate = new Template("temp/tester.php");

$indexTemplate->title = "VRMS - Manage Your Whole Ride With Us!";

echo $indexTemplate;

