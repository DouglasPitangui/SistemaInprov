<?php

//Through wamp tray icon, open php.ini file and find
//error_reporting = E_ALL
//Replace w/
//error_reporting = E_ALL & ~E_NOTICE
//Then save file and restart wamp

session_start();
ob_start();
ini_set('default_charset', 'UTF-8');
date_default_timezone_set('Brazil/East');

//unset($_SESSION['matricula']);
//$_SESSION['matricula'] = "admin";

//error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ALL & ~E_NOTICE);

include_once './auto_load.php';
include_once './opembody.php';

if (!isset($_SESSION['matricula'])) {
    include_once './pages/login.php';
} else {
    include_once './pages/header.php';
    
    include_once './pages/body.php';

    include_once './pages/footer.php';
}

include_once './closebody.php';
?>