<?php
$authNav = '<div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-md-auto">
                <li class="nav-item">
                    <button id="signin" class="btn btn-primary nav-button">Sign In<span class="sr-only">(current)</span>
                    </button>
                </li>
                <li class="nav-item">
                    <button id="signup" class="btn btn-outline-primary nav-button">Sign Up</button>
                </li>
            </ul>
        </div>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= SITE_URL ?>assets/css/raleway.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>assets/css/common.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>assets/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= SITE_URL ?>assets/icons/css/all.min.css">
    <link rel="icon" href="<?= SITE_URL ?>assets/img/vrms_logo.png">
    <script defer src="<?= SITE_URL ?>assets/icons/js/all.min.js"></script>
    <script src="<?= SITE_URL ?>assets/bootstrap/js/jquery-3.5.1.slim.min.js"></script>
    <script src="<?= SITE_URL ?>assets/js/common.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
        <a class="navbar-brand mr-0 mr-md-2" href="<?=SITE_URL?>">
            <img src="<?= SITE_URL ?>assets/img/vrms_logo.png" width="30" height="30"
                 class="d-inline-block align-top" alt="vrms-logo">
            VRMS
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?= $authNav ?>
    </nav>
</header>