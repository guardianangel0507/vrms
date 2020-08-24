<?php include SITE_ROOT . 'public/default/header.php'; ?>
CUSTOMER - <?php if (isset($userData)) {
    print_r($userData);
} ?>
<?php
if (isset($msgH)) {
    if (isset($errors)) {
        $msgH->displayErrors($errors);
    }
    $errors = null;
    if (isset($msgs)) {
        $msgH->displayMessages($msgs);
    }
    $msgs = null;
}
?>
<?php include SITE_ROOT . 'public/default/footer.php'; ?>
