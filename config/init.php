<?php
// echo "InitFile";

// Config
require_once "config.php";

// Add Reusable Directory Autoloader
// Autoloader will detect all the subdirectories and add the class files followed.


function requireClass($classFile, $className)
{
    if (!class_exists($className) && $className === basename($classFile, ".php")) require_once $classFile;
}

function retrieveDir($dirs, $currentPath, $className)
{
    foreach ($dirs as $dir) {
        if ($dir == ".." || $dir == ".") {
            continue;
        }
        $newPath = $currentPath . '/' . $dir;
        if (is_dir($newPath)) {
            $subdirs = scandir($newPath);
            retrieveDir($subdirs, $newPath, $className);
        } else {
            requireClass($newPath, $className);
        }
    }
}

if (!function_exists('autoClassLoader')) {
    function autoClassLoader($className)
    {
        $subdirs = scandir($_SERVER['DOCUMENT_ROOT'] . '/lib');
        retrieveDir($subdirs, $_SERVER['DOCUMENT_ROOT'] . '/lib', $className);
    }
}

spl_autoload_register('autoClassLoader');
