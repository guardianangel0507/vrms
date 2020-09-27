<?php
include_once '../../config/init.php';

!isset($_SESSION['userData']) || $_SESSION['userData']->userType !== 'manufacturer' ? header("Location:" . SITE_URL . "public/default/home-route.php") : null;

$authErrors = array();
$authSuccess = array();
$authData = array(
    'vehicleName' => '',
    'vehicleModel' => '',
    'vehicleCategory' => '',
    'vehicleClass' => '',
    'onRoadPrice' => '',
    'fuelType' => '',
    'engineCC' => '',
    'mileage' => '',
    'emiAvailable' => '',
    'power' => '',
    'fuelTankCapacity' => '',
    'seatingCapacity' => '',
    'insurance' => '',
    'maintenanceCost' => '',
    'transmissionType' => '',
	'manufacturerID' => $_SESSION['userData']->userID
);

if(isset($_POST)){
	if(empty($_POST['insurance'])){
		$authData['insurance'] = 0;
	}
	if(empty($_POST['emiAvailable'])){
		$authData['emiAvailable'] = 0;
	}
    foreach ($_POST as $key => $value){
    	$authData[$key] = $value;
    }
	$dbo = new Database();
    $dbo->query("INSERT INTO tb_vehicles SET manufacturerID = :manufacturerID, vehicleName = :vehicleName, vehicleModel = :vehicleModel, vehicleCategory = :vehicleCategory, vehicleClass = :vehicleClass, onRoadPrice = :onRoadPrice, fuelType = :fuelType, engineCC = :engineCC, mileage = :mileage, emiAvailable = :emiAvailable, power = :power, fuelTankCapacity = :fuelTankCapacity, seatingCapacity = :seatingCapacity, insurance = :insurance, maintenanceCost = :maintenanceCost, transmissionType = :transmissionType");
    foreach ( $authData as $key => $value){
    	$dbo->bind(":$key", $value);
	}
    if($dbo->execute()){
    	array_push($authSuccess, "Vehicle Added");
	} else {
		array_push($authErrors, "Vehicle Adding Failed");
	}
}



$_SESSION['messages']['authErrors'] = isset($_SESSION['messages']['authErrors']) ? array_merge($_SESSION['messages']['authErrors'], $authErrors) : $authErrors;
$_SESSION['messages']['authSuccess'] = $authSuccess;
$_SESSION['authData'] = $authData;

header('Location:' . SITE_URL . 'public/manufacturer/add-vehicles');