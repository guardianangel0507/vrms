<?php

$errors = array();
$errH = new ErrorHandler();

if (isset($_SESSION['authorized']) and $_SESSION['authorized'] === false) {
    $errors = isset($_SESSION['errors']['authErrors']) ? $_SESSION['errors']['authErrors'] : null;
}
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

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>
<div class="container text-center">
    <form id="signin-form" class="animate__animated animate__fadeIn d-block form-signin"
          action="<?= SITE_URL . 'lib/scripts/login.php' ?>" method="post">
        <img class="mb-4" src="<?= SITE_URL ?>assets/img/vrms_logo.png" alt="vrms-logo" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Log In to Continue</h1>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" class="form-control" placeholder="Username" name="username" required
               autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
        <?php $errH->displayErrors($errors); ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
    </form>

    <form id="signup-form" class="d-none">
        Signup
    </form>
</div>
<script>
    $(function () {
        switchAuth();
    });
</script>
