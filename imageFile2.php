<?php
ini_set("memory_limit", "4048M");
error_reporting(E_ALL);
ini_set('display_errors', '1');

date_default_timezone_set("America/Sao_Paulo");


define("APP_MODE", "development");
define("APP_NAME", "backend");
define("APP_LANGUAGE", "pt");
define("APP_DEFAULT_EDITORIAL", 1);

define("THUMB_TYPE", "THB");
//define("APP_SECURITY_MODE", "LOGIN");

define("APP_UPLOADS_PREFIX", "/");
define("APP_WEB_PREFIX", "/adm/");
define("APP_JS_PREFIX", "/web/");
define("APP_JSON_PATH", "./web/json/");
define("APP_UPLOADS_PATH", "./web/uploads/");

// Amazon S3 Configs
define("AMAZON_SAVE_THUMBS", false);


define("APP_PATH_PREFIX", "./");
require APP_PATH_PREFIX."/lib/Autoloader.class.php";

Autoloader::init();
Configurator::init();


require APP_PATH_PREFIX."/apps/".APP_NAME."/config/routes.php";

##Dispatcher::init();


$ids = (explode(",", $argv[1]));

foreach($ids as $id){
  $criteria = new FuriousSelectCriteria();
  $criteria->add("`cnt_arquivos`.`ARQ_ID`", addslashes($id), FuriousExpressionsDB::EQUAL);
  $criteria->add("`cnt_arquivos`.`ARQ_STS`", 1, FuriousExpressionsDB::EQUAL);
  $files = ArquivoModel::doSelect($criteria);
  if(!empty($files[0]))
  {
    echo($id. "WROTE:");
    $file = $files[0];
    $file->generateThumbs();
  }
}

?>
