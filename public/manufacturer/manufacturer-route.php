<?php
require_once '../../config/init.php';
require_once '../../lib/utility/helpers.php';

$auth = new Authentication();
!$auth->isAuthorized('manufacturer') ? header("Location:" . SITE_URL . "public/default/home-route.php") : null;

$userDetail = isset($_SESSION['userDetail']) ? $_SESSION['userDetail'] : null;

$uri = getFinalUrl($_SERVER['REQUEST_URI']);

echo $uri;

switch ($uri) {
    case "manufacturer":
        $manufacPanelIndex = new Template(SITE_ROOT . "public/manufacturer/manufac-panel.php");
        $manufacPanelIndex->title = "Manufacturer Panel";
        $manufacPanelIndex->userData = isset($userData) ? $userData : null;
        $manufacPanelIndex->userDetail = $userDetail;
        $manufacPanelIndex->authNav = '<li class="nav-item">
                    <a href="' . SITE_URL . 'public/manufacturer"
                       class="nav-link">Manufacturer Panel</a>
                </li>';
        echo $manufacPanelIndex;
        break;
    default:
        null;
}