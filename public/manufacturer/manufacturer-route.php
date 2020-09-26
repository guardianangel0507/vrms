<?php
require_once '../../config/init.php';
require_once '../../lib/utility/helpers.php';

$auth = new Authentication();
!$auth->isAuthorized('manufacturer') ? header("Location:" . SITE_URL . "public/default/home-route.php") : null;

$userDetail = isset($_SESSION['userDetail']) ? $_SESSION['userDetail'] : null;

$uri = getFinalUrl($_SERVER['REQUEST_URI']);

echo $uri;