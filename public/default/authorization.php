<?php

$formName = "signin";
$authData = array();

if (isset($_SESSION['formName'])) $formName = $_SESSION['formName'];
unset($_SESSION['formName']);

if (isset($_SESSION['authData'])) $authData = $_SESSION['authData'];
unset($_SESSION['authData']);

?>

<style>
    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .form-signup {
        padding: 15px;
    }

    .form-signup .form-control {
        margin: 5px;
    }

    .show-icon {
        margin: auto;
        cursor: hand;
    }
</style>
<div class="container text-center">
    <div id="signin-form"
         class=" animate__animated animate__fadeIn <?= $formName == 'signin' ? "d-block" : "d-none" ?> form-signin">
        <form action="<?= SITE_URL . 'lib/scripts/login.php' ?>" method="post">
            <img class="mb-4" src="<?= SITE_URL ?>assets/img/vrms_logo.png" alt="vrms-logo" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Sign In to Continue</h1>
            <label for="inputUsername" class="sr-only">Username</label>
            <input type="text" id="inputUsername" class="form-control" placeholder="Username" name="username" required
                   autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password"
                   required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign In</button>
        </form>
        <?php
        if ($formName == 'signin') {
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
        }
        ?>
        <button class="btn btn-outline-primary" id="signup-btn">No Account? Create one.</button>
    </div>
    <div id="signup-form"
         class=" animate__animated animate__fadeIn <?= $formName == 'signup' ? "d-block" : "d-none" ?> form-signup">
        <form action="<?= SITE_URL . 'lib/scripts/register.php' ?>" method="post" autocomplete="off">
            <img class="mb-4" src="<?= SITE_URL ?>assets/img/vrms_logo.png" alt="vrms-logo" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Sign Up to Continue</h1>
            <div class="d-flex flex-row">
                <label for="inputFullName" class="sr-only">Full Name</label>
                <input type="text" id="inputFullName" class="form-control" placeholder="Full Name" name="name"
                       required
                       autofocus="" value="<?php if (!empty($authData)) echo $authData['name'] ?>">
                <label for="inputEmail" class="sr-only">Email</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email"
                       name="email"
                       required value="<?php if (!empty($authData)) echo $authData['email'] ?>">
            </div>
            <div class="d-flex flex-row">
                <label for="inputPhone" class="sr-only">Phone Number</label>
                <input type="number" id="inputPhone" class="form-control" placeholder="Phone Number" name="phoneNo"
                       required
                       autofocus="" value="<?php if (!empty($authData)) echo $authData['phoneNo'] ?>">
            </div>
            <div class="d-flex flex-row">
                <label for="inputAddress" class="sr-only">Address</label>
                <input type="text" id="inputAddress" class="form-control" placeholder="Address"
                       name="address"
                       required value="<?php if (!empty($authData)) echo $authData['address'] ?>">
            </div>
            <div class="d-flex flex-row">
                <label for="inputUname" class="sr-only">Username</label>
                <input type="text" id="inputUname" class="form-control" placeholder="Username"
                       name="username"
                       required value="<?php if (!empty($authData)) echo $authData['username'] ?>">
                <label for="inputPass" class="sr-only">Password</label>
                <input type="password" id="inputPass" class="form-control" placeholder="Password"
                       name="password"
                       required value="<?php if (!empty($authData)) echo $authData['password'] ?>">
                <label for="inputCPassword" class="sr-only">Confirm Password</label>
                <input type="password" id="inputCPassword" class="form-control" placeholder="Confirm Password"
                       name="cPassword"
                       required>
                <button id="showPass" class="btn btn-outlined-primary show-icon"><i id="eyeicon" class="fa fa-eye"></i>
                </button>
            </div>
            <div class="d-flex flex-row">
                <div class="form-check form-control">
                    <input class="form-check-input" type="radio" name="userType" id="userType1" value="customer"
                        <?php
                        if (!empty($authData)) {
                            if ($authData['userType'] == 'customer') {
                                echo 'checked';
                            } else {
                                echo 'checked';
                            }
                        } else {
                            echo 'checked';
                        }
                        ?>
                    >
                    <label class="form-check-label" for="userType1">
                        Customer
                    </label>
                </div>
                <div class="form-check form-control">
                    <input class="form-check-input" type="radio" name="userType" id="userType2" value="manufacturer"
                        <?php
                        if (!empty($authData)) {
                            if ($authData['userType'] == 'manufacturer') {
                                echo 'checked';
                            }
                        }
                        ?>
                    >
                    <label class="form-check-label" for="userType2">
                        Manufacturer
                    </label>
                </div>
            </div>
            <button class="btn btn-lg btn-primary" type="submit" name="signup">Sign Up</button>
        </form>
        <?php
        if ($formName == 'signup') {
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
        }
        ?>
        <button class="btn btn-outline-primary" id="signin-btn">Already have an Account? Sign In.</button>
    </div>
</div>
<script>
    $(function () {
        switchAuth();
    });
</script>
