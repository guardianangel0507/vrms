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
                    <button id="signup" class="btn btn-outline-primary nav-button">Sign Up</button>
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
            $customerHomeIndex->authNav = '<div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-md-auto">
                <li class="nav-item">
                    <a href="' . SITE_URL . 'lib/scripts/logout.php?id=' . $userData->userID . '" class="btn btn-outline-primary nav-button">Logout</a>
                </li>
            </ul>
        </div>';
            echo $customerHomeIndex;
            break;
    }
}