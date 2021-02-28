<?php
/*
$configs['database']['development']['host'] = "belina1.ir7.com.br";
$configs['database']['development']['user'] = "usr_mrezende";
$configs['database']['development']['pass'] = 'EKUpPsBY5sctmYn';
$configs['database']['development']['dbname'] = "mrezende";
$configs['database']['development']['driver'] = 'mysqli';


$configs['database']['development']['host'] = "192.168.0.162";
$configs['database']['development']['user'] = "root";
$configs['database']['development']['pass'] = 'f-117s';
$configs['database']['development']['dbname'] = "piracanjuba";
$configs['database']['development']['driver'] = 'mysqli';


*//*
$configs['database']['development']['host'] = "127.0.0.1";
$configs['database']['development']['user'] = "root";
$configs['database']['development']['pass'] = 'f-117s';
$configs['database']['development']['dbname'] = "piraus";
$configs['database']['development']['driver'] = 'mysqli';

$configs['database']['development']['host'] = "piracont.cenbd5rhhlg3.us-east-1.rds.amazonaws.com";
$configs['database']['development']['user'] = "root";
$configs['database']['development']['pass'] = 'f-15ceagle';
$configs['database']['development']['dbname'] = "piracont";
$configs['database']['development']['driver'] = 'mysqli';
*/
$configs['database']['development']['host'] = "piracont.mysql.dbaas.com.br";
$configs['database']['development']['user'] = "piracont";
$configs['database']['development']['pass'] = 'f-15ceagle';
$configs['database']['development']['dbname'] = "piracont";
$configs['database']['development']['driver'] = 'mysqli';

/**/
//$configs['database']['development']['host'] = "127.0.0.1";
//$configs['database']['development']['user'] = "root";
//$configs['database']['development']['pass'] = 'f-117s';
//$configs['database']['development']['dbname'] = "marcelo_rezende";
//$configs['database']['development']['driver'] = 'mysqli';

$configs['backend']['security']['development']['isSecure'] = TRUE;
$configs['backend']['security']['development']['loginController'] = "login";
$configs['backend']['security']['development']['loginMethod'] = "login";

$configs['preview']['security']['development']['isSecure'] = TRUE;
$configs['preview']['security']['development']['loginController'] = "login";
$configs['preview']['security']['development']['loginMethod'] = "login";

$configs['frontend']['security']['development']['isSecure'] = FALSE;
$configs['frontend']['security']['production']['isSecure'] = FALSE;

$configs['frontendes']['security']['development']['isSecure'] = FALSE;
$configs['frontendes']['security']['production']['isSecure'] = FALSE;

$configs['frontendus']['security']['development']['isSecure'] = FALSE;
$configs['frontendus']['security']['production']['isSecure'] = FALSE;


$configs['cache']['development'] = false;

$this->addIniConfig($configs);

?>
