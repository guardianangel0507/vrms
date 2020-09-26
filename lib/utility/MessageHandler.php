<?php

require_once "helpers.php";

class MessageHandler
{
    public function __construct()
    {
        consoleLogger("Message Handler Initialized");
    }

    public function displayErrors()
    {
        $errors = isset($_SESSION['messages']['authErrors']) ? $_SESSION['messages']['authErrors'] : null;
        unset($_SESSION['messages']['authErrors']);
        if (!empty($errors)) : ?>
            <?php foreach ($errors as $error) : ?>
                <div class='animate__animated animate__fadeIn alert alert-danger'
                     role='alert'><?= $error ?></div>
            <?php endforeach; ?>
        <?php endif;
    }

    public function displayMessages()
    {
        $msgs = isset($_SESSION['messages']['authSuccess']) ? $_SESSION['messages']['authSuccess'] : null;
        unset($_SESSION['messages']['authSuccess']);
        if (!empty($msgs)) : ?>
            <?php foreach ($msgs as $msg) : ?>
                <div class='animate__animated animate__fadeIn alert alert-success'
                     role='alert'><?= $msg ?></div>
            <?php endforeach; ?>
        <?php endif;
    }
}