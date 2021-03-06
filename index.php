<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

date_default_timezone_set("America/Sao_Paulo");


define("APP_MODE", "development");
define("APP_NAME", "frontendus");

define("APP_HOME_EDITORIAL", 2);
define("APP_DEFAULT_EDITORIAL", 1);
define("APP_PLUS_EDT", 0);
define("APP_PLUS_FAQ", 0);
define("APP_PLUS_CAM", 0);
define("APP_CATS", 0);
define("APP_FALECONOSCO", 18);

define("APP_WEB_PREFIX", "/");
define("APP_JS_PREFIX", "/web/");
define("APP_JSON_PATH", "./web/json/");
define("APP_UPLOADS_PREFIX ", "uploads/");
define("APP_UPLOADS_PATH", "uploads/");

// Amazon S3 Configs
define("AMAZON_SAVE_THUMBS", false);


define("APP_PATH_PREFIX", "./");
require APP_PATH_PREFIX."/lib/Autoloader.class.php";

Autoloader::init();
Configurator::init();

define("APP_LANGUAGE", "pt");
require APP_PATH_PREFIX."/apps/".APP_NAME."/config/routes-pt.php";

Dispatcher::init();

?>
