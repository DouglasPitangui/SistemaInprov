<?php

class ClsGravaLog {

//===========================================================================
    /**
     * 
     * @param type $Qdados  [<i>Informções a serem gravadas</i>] 
     * @param type $Nome    [optional]     [<i>Nome do arquivo que sera gravado</i>] 
     * @param type $QOpt    [optional]   [<i>L = Gerar uma linha separadora </i>] 
     * 
     * <b>Aqui esta um exemplo de Utilizacao</b>
     * <pre><code>
     * <?php
     * GravaLogGrava("INFORMAÇÕES DIVERSAS __>>  " , "meuArquivo");
     * <b>Exemplo :</b> 
     * <i>gravando um arquivo de log com o nome fisico na pasata tmp = [meuarquivo] 
     * </i>
     * 
     * ?>
     * </code></pre>
     * 
     * 
     */
    function fazLog($Qdados, $Nome = "", $QOpt = "") {
        date_default_timezone_set("Brazil/East");

        $pi = pathinfo(__FILE__);
        $LocalDir = $pi['dirname'] . "/../logs";

        if ($Nome != "") {
            $NomeArq = $LocalDir . "/" . $Nome . ".txt";
        } else {
            $NomeArq = $LocalDir . "/LogsPHP.txt";
        }
        $novoarquivo = fopen($NomeArq, "a+");

        $dia_da_semana = array("domingo", "segunda", "terca", "quarta", "quinta", "sexta", "sabado");
        $num_dia = date('w');
        $dia_extenso = $dia_da_semana[$num_dia];

        $horaAtu = date("Y-m-d :-) H:i:s A");

        switch ($QOpt) {
            Case "L":
//			fwrite($novoarquivo, $dia_extenso . " " . $horaAtu . " : " .  $Qdados ."\n");
                fwrite($novoarquivo, str_repeat("-=", 50) . "\n");
                break;

            default:
                fwrite($novoarquivo, $dia_extenso . " " . $horaAtu . " : " . "\n\t" . $Qdados . "\n");
        }
        fclose($novoarquivo);
    }

}

?>
