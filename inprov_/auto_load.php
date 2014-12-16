<?php
function __autoload($class_name) {
    try {
        $pi = pathinfo(__FILE__);
        $LocalDir = $pi['dirname']."/classes/";
//        var_dump($pi);
//        echo 'DIRETORIO BASICO = '  . $class_name . "  - " .  $LocalDir;
//        die();
//        
        if (file_exists($LocalDir . $class_name . '.php')) {
            require_once ($LocalDir . $class_name . '.php');
        }
//        if (file_exists('Classes/' . $class_name . '.php')) {
//            require_once ('Classes/' . $class_name . '.php');
//        }
    } catch (ErrorException $e) {
        echo $e->getTraceAsString();    
    }
}
?>
