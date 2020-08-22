<?php
require_once '../../config/init.php';

//Session Started Globally for the System
session_start();

if (!isset($_SESSION['authorized'])) {
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
}