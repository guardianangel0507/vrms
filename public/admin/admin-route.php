<?php
require_once '../../config/init.php';
require_once '../../lib/utility/helpers.php';

$auth = new Authentication();
$dbo = new Database();
!$auth->isAuthorized("admin") ? header("Location:" . SITE_URL . "public/default/home-route.php") : $userData = $_SESSION['userData'];

$userDetail = isset($_SESSION['userDetail']) ? $_SESSION['userDetail'] : null;

$uri = getFinalUrl($_SERVER['REQUEST_URI']);

if (preg_match("/^approve-(manufacturer|dealer)-[0-9]/", $uri)) {
    $_SESSION['approve_uri'] = $uri;
    header('Location:' . SITE_URL . 'lib/scripts/approve.php');
}

switch ($uri) {
    case "admin":
        $adminPanelIndex = new Template(SITE_ROOT . "public/admin/admin-panel.php");
        $adminPanelIndex->title = "Admin Panel";
        $adminPanelIndex->userData = isset($userData) ? $userData : null;
        $adminPanelIndex->userDetail = $userDetail;
        $adminPanelIndex->authNav = '<li class="nav-item">
                    <a href="' . SITE_URL . 'public/admin"
                       class="nav-link">Admin Panel</a>
                </li>';
        echo $adminPanelIndex;
        break;
    case "manage-finance":
        $manageFinanceIndex = new Template(SITE_ROOT . "public/admin/manage-finance.php");
        $manageFinanceIndex->title = "Admin Panel - Manage Finances";
        $manageFinanceIndex->userData = isset($userData) ? $userData : null;
        $manageFinanceIndex->userDetail = $userDetail;
        $manageFinanceIndex->authNav = '<li class="nav-item">
                    <a href="' . SITE_URL . 'public/admin"
                       class="nav-link">Admin Panel</a>
                </li>';
        echo $manageFinanceIndex;
        break;
    case "approve-users":
        $verificationsIndex = new Template(SITE_ROOT . "public/admin/approve-users.php");
        $verificationsIndex->title = "Admin Panel - Manage Verifications";
        $dbo->query("SELECT userID, name, username, email, phoneNo, address, userType FROM tb_users WHERE userType = 'manufacturer' AND activeStatus = false");
        $verificationsIndex->manResults = $dbo->fetchMultipleResults();
        $dbo->query("SELECT userA.userID, userA.name, userB.name as manufacturer, userA.username, userA.email, userA.phoneNo, userA.address, userA.userType, tb_dealers.manufacturerID FROM tb_users as userA INNER JOIN tb_dealers on userA.userID = tb_dealers.dealerID INNER JOIN tb_manufacturers as tm on tb_dealers.manufacturerID = tm.manufacturerID INNER JOIN tb_users userB on userB.userID = tm.manufacturerID WHERE userA.userType = 'dealer' AND userA.activeStatus = false");
        $verificationsIndex->dealResults = $dbo->fetchMultipleResults();
        $verificationsIndex->userData = isset($userData) ? $userData : null;
        $verificationsIndex->userDetail = $userDetail;
        $verificationsIndex->authNav = '<li class="nav-item">
                    <a href="' . SITE_URL . 'public/admin"
                       class="nav-link">Admin Panel</a>
                </li>';
        echo $verificationsIndex;
        break;
    default:
        $notFoundIndex = new Template(SITE_ROOT . "public/default/404-error.php");
        $notFoundIndex-> title = "Error 404";
        echo $notFoundIndex;
}