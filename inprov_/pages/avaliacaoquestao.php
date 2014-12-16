<?php

include_once '../auto_load.php';

//echo "<div style='width: 500px;'>";
//var_dump($_REQUEST);
//echo "</div>";

$avaliacao_id = $_REQUEST['avaliacao_id'];
$disciplina_id = $_REQUEST['disciplina_id'];
$filtrar = $_REQUEST['filtrar'];
$assunto_id = $_REQUEST['assunto_id'];

$Questoes = ClsQuestao::selectQuestao(array(disciplina_id => $disciplina_id, filtrar => $filtrar, assunto_id => $assunto_id));

$QuestoesAlternativasArr = array();
if ($avaliacao_id > 0) {
    $QuestoesAlternativas = ClsAvaliacao::selectAvaliacaoAlternativas(array(avaliacao_id => $avaliacao_id));
    foreach ($QuestoesAlternativas as $key) {
        $QuestoesAlternativasArr[] = $key->questao_id;
    }
}
//var_dump($QuestoesAlternativas);
foreach ($Questoes as $key) {
//    var_dump($key);
    $checked = in_array($key->questao_id, $QuestoesAlternativasArr) ? 'checked' : '';
    echo <<<html
        <tr>
            <td align="center"><span class="in-stock">$key->questao_id</span></td>
            <!--<td align="center"><a>$key->tipoQuestao</a></td>-->
            <td align="center"><span class="in-stock">$key->tipoQuestao</span></td>
            <td align="center"><span class="in-stock">$key->descricao</span></td>
            <td align="center"><span class="in-stock">$key->assunto</span></td>
            <td align="center"><span class="in-stock"><input type="checkbox" name="questao_id[]" value="$key->questao_id" $checked /></span></td>
        </tr>
html;
}
if (count($Questoes) < 1) {
    echo <<<html
        <tr>
            <td colspan='5'>Nenhuma questão encontrada!</td>
        </tr>
html;
}