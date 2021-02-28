<?php
$config = array();
$config['title'] = "CMS - Container Digital";
$config['css']['view']['all'] = (constant('APP_JS_PREFIX')) . "css/master.css";

include(APP_PATH_PREFIX.'apps/frontend/config/file-formats.php');

$config['imageFormats']["50x50"] = array(50, 50);
$config['imageFormats']["60x60"] = array(60, 60);
$config['imageFormats']["100x100"] = array(100, 100);

$this->addViewConfig($config);

?>