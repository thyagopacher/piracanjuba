<?php
$config = array();
$config['title'] = "Piracanjuba";
$config['keywords'] = "marcelo, rezende, corta, para, mim, r7, marcelo rezende, corta para mim";
$config['description'] = "Site de Marcelo Rezende.";
$config['css']['view']['all'] = APP_JS_PREFIX . "css/style.css";
$config['scripts'][] =  "http://code.jquery.com/jquery.min.js";
$config['scripts'][] = APP_JS_PREFIX . "js/funcs2.js";


include('file-formats.php');

$this->addViewConfig($config);

?>