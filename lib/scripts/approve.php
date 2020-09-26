<?php
require_once "../../config/init.php";
require_once '../utility/helpers.php';

if (isset($_SESSION['approve_uri'])) {
    $action_string = $_SESSION['approve_uri'];
    $split_action = explode("-", $action_string);

    $dbo = new Database();
    if ($split_action[0] === "approve") {
        $userID = number_format($split_action[2]);
        $userType = $split_action[1];
        if ($userType === "manufacturer") {
            $dbo->query("UPDATE tb_users SET activeStatus = true WHERE userID = :userID AND userType = :userType AND activeStatus = false");
            $dbo->bind(":userID", $userID);
            $dbo->bind(":userType", $userType);
            if ($dbo->execute()) {
                header("Location:" . SITE_URL . 'public/admin/approve-users');
            } else {
                header("Location:" . SITE_URL . 'public/admin/error');
            }
        } else if ($userType === "dealer") {
            $dbo->query("UPDATE tb_users SET activeStatus = true WHERE userID = :userID AND userType = :userType AND activeStatus = false");
            $dbo->bind(":userID", $userID);
            $dbo->bind(":userType", $userType);
            if ($dbo->execute()) {
                header("Location:" . SITE_URL . 'public/admin/approve-users');
            } else {
                header("Location:" . SITE_URL . 'public/admin/error');
            }
        }
    }
}