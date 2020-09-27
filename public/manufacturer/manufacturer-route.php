<?php
require_once '../../config/init.php';
require_once '../../lib/utility/helpers.php';

$auth = new Authentication();
$dbo = new Database();
!$auth->isAuthorized('manufacturer') ? header("Location:" . SITE_URL . "public/default/home-route.php") : $userData = $_SESSION['userData'];

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
    case "add-dealers":
        $addDealerIndex = new Template(SITE_ROOT . "public/manufacturer/add-dealers.php");
        $addDealerIndex->title = "Add Dealers";
        $addDealerIndex->userData = isset($userData) ? $userData : null;
        $addDealerIndex->userDetail = $userDetail;
        $dbo->query("SELECT userA.userID, userA.name, userA.username, userA.email, userA.phoneNo, userA.address, userA.userType FROM tb_users as userA INNER JOIN tb_dealers on userA.userID = tb_dealers.dealerID WHERE userA.userType = 'dealer' AND tb_dealers.manufacturerID = :manufacturerID");
        $dbo->bind(':manufacturerID', $userData->userID);
        $addDealerIndex->dealResults = $dbo->fetchMultipleResults();
        $addDealerIndex->authNav = '<li class="nav-item">
                    <a href="' . SITE_URL . 'public/manufacturer"
                       class="nav-link">Manufacturer Panel</a>
                </li>';
        echo $addDealerIndex;
        break;
    case "add-vehicles":
        $addVehicleIndex = new Template(SITE_ROOT . "public/manufacturer/add-vehicles.php");
        $addVehicleIndex->title = "Add Vehicles";
        $addVehicleIndex->userData = isset($userData) ? $userData : null;
        $addVehicleIndex->userDetail = $userDetail;
        $dbo->query("SELECT tb_users.name as manufacturerName, vehicleName, vehicleModel, onRoadPrice, mileage FROM tb_vehicles INNER JOIN tb_users ON tb_vehicles.manufacturerID = tb_users.userID WHERE manufacturerID = :manufacturerID");
        $dbo->bind(":manufacturerID", $userData -> userID);
        $addVehicleIndex->vehicleResults = $dbo->fetchMultipleResults();
        $addVehicleIndex->authNav = '<li class="nav-item">
                    <a href="' . SITE_URL . 'public/manufacturer"
                       class="nav-link">Manufacturer Panel</a>
                </li>';
        echo $addVehicleIndex;
        break;
    default:
        $notFoundIndex = new Template(SITE_ROOT . "public/default/404-error.php");
        $notFoundIndex-> title = "Error 404";
        echo $notFoundIndex;
}