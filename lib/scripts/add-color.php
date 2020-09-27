<?php
include_once '../../config/init.php';

$authErrors = array();
$authSuccess = array();

if (isset($_POST)) {

	$color = $_POST['vehicleColor'];
	$vehicleID = $_POST['vehicleID'];


	$dbC = new Database();
	$dbC->query("SELECT COUNT(color) as colorcount FROM tb_colors WHERE color LIKE '$color'");
	if (!$dbC->fetchSingleResult()->colorcount > 0) {
		$dbC->query("INSERT INTO tb_colors SET color = :color");
		$dbC->bind(':color', $color);
		if ($colorID = $dbC->executeWithReturnID()) {
			$dbC->query("INSERT INTO tbr_colorVariants SET colorID = :colorID, vehicleID = :vehicleID");
			$dbC->bind(':colorID', $colorID);
			$dbC->bind(':vehicleID', $vehicleID);
			if ($dbC->execute()) {
				array_push($authSuccess, "Color Added");
			} else {
				array_push($authErrors, "Color Adding Failed");
			}
		} else {
			array_push($authErrors, "Color Adding Failed");
		}
	}
}

$_SESSION['messages']['authErrors'] = isset($_SESSION['messages']['authErrors']) ? array_merge($_SESSION['messages']['authErrors'], $authErrors) : $authErrors;
$_SESSION['messages']['authSuccess'] = $authSuccess;

header('Location:' . SITE_URL . 'public/manufacturer/add-vehicles');