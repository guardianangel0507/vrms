<?php
require_once '../../config/init.php';
require_once '../../lib/utility/helpers.php';

if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] === false) {
    $defaultHomeIndex = new Template(SITE_ROOT . "public/default/default-home.php");
    $defaultHomeIndex->title = "VRMS Home";
    $defaultHomeIndex->authNav = '<div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-md-auto">
                <li class="nav-item">
                    <button id="signin" class="btn btn-primary nav-button">Sign In<span class="sr-only">(current)</span>
                    </button>
                </li>
                <li class="nav-item">
                    <button id="signup" class="btn btn-primary nav-button">Sign Up</button>
                </li>
            </ul>
        </div>';
    echo $defaultHomeIndex;
} else {
    $userData = $_SESSION['userData'];
    $userType = $userData->userType;
    switch ($userType) {
        case "customer" :
            $customerHomeIndex = new Template(SITE_ROOT . "public/customer/customer-home.php");
            $customerHomeIndex->title = "VRMS Customer's Home";
            $customerHomeIndex->userData = $userData;
//            $customerHomeIndex->authNav = '<div class="collapse navbar-collapse" id="navbarCollapse">
//            <ul class="navbar-nav ml-md-auto">
//                <li class="nav-item">
//                    <a href="' . SITE_URL . 'lib/scripts/logout.php?id=' . $userData->userID . '" class="btn btn-primary nav-button">Logout</a>
//                </li>
//            </ul>
//        </div>';
            $customerHomeIndex->authNav = '<li class="nav-item">
                    <a href="#"
                       class="nav-link">Test Link 1</a>
                </li>
                <li class="nav-item">
                    <a href="#"
                       class="nav-link">Test Link 2</a>
                </li><li class="nav-item">
                    <a href="#"
                       class="nav-link">Test Link 3</a>
                </li><li class="nav-item">
                    <a href="#"
                       class="nav-link">Test Link 4</a>
                </li>';
            echo $customerHomeIndex;
            break;
        case "manufacturer" :
            $manufacturerHomeIndex = new Template(SITE_ROOT . "public/manufacturer/manufacturer-home.php");
            $manufacturerHomeIndex->title = "VRMS Manufacturer's Home";
            $manufacturerHomeIndex->userData = $userData;
//            $manufacturerHomeIndex->authNav = '<div class="collapse navbar-collapse" id="navbarCollapse">
//            <ul class="navbar-nav ml-md-auto">
//                <li class="nav-item">
//                    <a href="' . SITE_URL . 'lib/scripts/logout.php?id=' . $userData->userID . '" class="btn btn-primary nav-button">Logout</a>
//                </li>
//            </ul>
//        </div>';
            $manufacturerHomeIndex->authNav = '<li class="nav-item">
                    <a href="#"
                       class="nav-link">Test Link 1</a>
                </li>
                <li class="nav-item">
                    <a href="#"
                       class="nav-link">Test Link 2</a>
                </li><li class="nav-item">
                    <a href="#"
                       class="nav-link">Test Link 3</a>
                </li><li class="nav-item">
                    <a href="#"
                       class="nav-link">Test Link 4</a>
                </li>';
            echo $manufacturerHomeIndex;
            break;
        case "dealer" :
            $dealerHomeIndex = new Template(SITE_ROOT . "public/dealer/dealer-home.php");
            $dealerHomeIndex->title = "VRMS Dealer's Home";
            $dealerHomeIndex->userData = $userData;
//            $dealerHomeIndex->authNav = '<div class="collapse navbar-collapse" id="navbarCollapse">
//            <ul class="navbar-nav ml-md-auto">
//                <li class="nav-item">
//                    <a href="' . SITE_URL . 'lib/scripts/logout.php?id=' . $userData->userID . '" class="btn btn-primary nav-button">Logout</a>
//                </li>
//            </ul>
//        </div>';
            $dealerHomeIndex->authNav = '<li class="nav-item">
                    <a href="#"
                       class="nav-link">Test Link 1</a>
                </li>
                <li class="nav-item">
                    <a href="#"
                       class="nav-link">Test Link 2</a>
                </li><li class="nav-item">
                    <a href="#"
                       class="nav-link">Test Link 3</a>
                </li><li class="nav-item">
                    <a href="#"
                       class="nav-link">Test Link 4</a>
                </li>';
            echo $dealerHomeIndex;
            break;
        case "admin" :
            $adminHomeIndex = new Template(SITE_ROOT . "public/admin/admin-home.php");
            $adminHomeIndex->title = "VRMS Admin's Home";
            $adminHomeIndex->userData = $userData;
//            $adminHomeIndex->authNav = '<div class="collapse navbar-collapse" id="navbarCollapse">
//            <ul class="navbar-nav ml-md-auto">
//                <li class="nav-item">
//                    <a href="' . SITE_URL . 'lib/scripts/logout.php?id=' . $userData->userID . '" class="btn btn-primary nav-button">Logout</a>
//                </li>
//            </ul>
//        </div>';
            $adminHomeIndex->authNav = '<li class="nav-item">
                    <a href="'. SITE_URL .'public/admin"
                       class="nav-link">Admin Panel</a>
                </li>';
            echo $adminHomeIndex;
            break;
    }
}