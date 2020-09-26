<?php include SITE_ROOT . 'public/default/header.php'; ?>
<?php
if (isset($auth) && isset($userData)) {
    $_SESSION['userDetail'] = $userDetail = $auth->findUserByID($userData->userID);
}
?>
<?php include SITE_ROOT . 'public/admin/admin-lander.php'; ?>
<?php include SITE_ROOT . 'public/default/footer.php'; ?>
