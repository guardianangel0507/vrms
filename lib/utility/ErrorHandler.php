<?php

require_once "helpers.php";

class ErrorHandler
{
    public function __construct()
    {
        consoleLogger("Error Handler Initialized");
    }

    public function displayErrors($errors)
    {
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='animate__animated animate__fadeIn alert alert-danger' role='alert'>$error</div>";
            }
        }
    }
}