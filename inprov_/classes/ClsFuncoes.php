<?php

//include_once '../GravaLog.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Clsfuncoes
 *
 * @author Construa Fácil-1
 */
class ClsFuncoes {

    function fezErrado($err = "", $msg = "") {
        static $i = 0;
        if ($i==0) {
            echo "Houve um problema ao realizar essa operação, o administrador do sistema foi notificado.<br/> Tente novamente!";
        }
        $i++;
        include_once 'ClsGravaLog.php';
        $gravalog = new ClsGravaLog;
        $gravalog->fazLog("$err, $msg", "ERROS_SISTEMA");
    }
}
