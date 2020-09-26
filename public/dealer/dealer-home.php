<?php include SITE_ROOT . 'public/default/header.php'; ?>
<?php
$_SESSION['userDetail'] = $userDetail = $auth->findUserByID($userData->userID);
if (isset($msgH)) {
    $msgH->displayErrors();
    $msgH->displayMessages();
}
?>
<?php include SITE_ROOT . 'public/dealer/dealer-lander.php'; ?>
<?php include SITE_ROOT . 'public/default/footer.php'; ?>
