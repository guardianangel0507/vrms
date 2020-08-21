<?php
// echo "ConfigFile";

// Database Parameters
define("DB_HOST", "127.0.0.1");
define("DB_USER", "amrameen769");
define("DB_PASS", "7025");
define("DB_NAME", "db_vrms");

//Site Details
define("SITE_TITLE", "V. R. M. S");
define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT'] . '/');
define("SITE_URL", $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/');

// Default Timezone
date_default_timezone_set("Asia/Kolkata");
