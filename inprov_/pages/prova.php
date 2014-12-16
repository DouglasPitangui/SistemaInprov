<?php
session_start();
include_once '../auto_load.php';
//var_dump($_REQUEST);
$matricula = (int) $_REQUEST['matricula'];
$matricula = (int) $_SESSION['matricula'];
$avaliacao_id = (int) $_REQUEST['avaliacao_id'];
if ($matricula > 0 and $avaliacao_id > 0) {
    $Avaliacao = ClsAvaliacao::selectAvaliacaoAlternativas(array(avaliacao_id => $avaliacao_id));
//    var_dump($Avaliacao);

    $btnAcao = "<input type='hidden' name='acao' value='realizarAvaliacao'>
                <input type='hidden' name='avaliacao_id' value='$avaliacao_id'>
                <input type='hidden' name='matricula' value='$matricula'>";
}
?> 
<div class="col-md-12">
    <h3 style="font-style:italic">Avaliação</h3>
    <form action="action/cadastro.php" method="post" enctype="multipart/form-data" id="formavaliacao" onsubmit="fazSubmit(this, event);">
        <?= $btnAcao; ?>

        <div class="col-md-12">
            <div class="form-group col-md-6">
                <label for="">Professor</label>
                <input type="text" class="form-control" name="" disabled="" value="<?= ClsProfessor::selectProfessor(array(matricula => $Avaliacao[0]->matricula))[0]->nome; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="">Disciplina</label>
                <input type="text" class="form-control" name="" disabled="" value="<?= ClsDisciplina::selectDisciplina(array(disciplina_id => $Avaliacao->disciplina_id))[0]->nome ?>">
            </div>

            <div class="form-group col-md-3">
                <label for="">Prova</label>
                <input type="text" class="form-control" disabled="" name="" value="<?= $Avaliacao[0]->nome; ?>">
            </div>
        </div>

        <div class="col-md-12">
            <?php
            foreach ($Avaliacao as $key) {
//                var_dump($key);
//                echo "avaliacao_id => $avaliacao_id, matricula => $matricula, questao_id => $key->questao_id";

                $resposta = ClsAvaliacao::selectAvaliacaoRespostas(array(avaliacao_id => $avaliacao_id, matricula => $matricula, questao_id => $key->questao_id));
//                var_dump($resposta);
                $resposta = $resposta[0];
                /**
                 * CÓDIGO PARA 'CORRIGIR' QUESTÃO DISCURSIVA
                 */
                $nota = rand(0, 100);

                echo "<div class='col-md-12 lquestao'>";
                echo "<label>Questão:</label><textarea rows='2' style='resize: vertical; margin-bottom: 5px;' class='form-control' 
                       name='alternativas[0]' disabled='' placeholder='Alternativa da questão' 
                       >$key->descricao</textarea>";
                if ($key->questaoDiscursiva) {
                    echo "<label>Resposta:</label><textarea rows='2' style='resize: vertical; margin-bottom: 5px;' class='form-control' 
                           name='questao[$key->questao_id]' required='' placeholder='Resposta da questão' 
                           ></textarea>";
                } else {
                    $nota = 0;
                    $QuestaoAlternativa = ClsQuestao::selectQuestaoAlternativas(array(questao_id => $key->questao_id));
                    ?> 
                    <table style="width: 100%; margin-bottom: 5px;">
                        <tbody>
                            <?php
                            $len = count($QuestaoAlternativa);
                            for ($i = 0; $i < $len; $i++) {
                                if ($QuestaoAlternativa[$i]->alternativaCorreta) {
                                    $nota = $resposta->respostaAluno == $QuestaoAlternativa[$i]->questaoObjetiva_id ? '1' : '0';
                                }
                                $c = $QuestaoAlternativa[$i]->alternativaCorreta ? 'border: 1px solid #00824C;' : '';
                                $c = '';
                                $alternativas = $QuestaoAlternativa[$i]->alternativas;
                                echo
                                <<<html
                                <tr style="$c">
                                    <td style="width: 3%;" align="center"><label><input type="radio" name="questao[$key->questao_id]" required="" value="{$QuestaoAlternativa[$i]->questaoObjetiva_id}"></label></td>
                                    <td style="width: 80%;">
                                        <textarea rows="2" style="resize: vertical;" class="form-control" name="alternativas[$i]" disabled="" placeholder="Alternativa da questão" 
                                            >$alternativas</textarea>
                                    </td>
                                </tr>
html;
                            }
                            ?>
                        </tbody>
                    </table>
                    <!--html;-->
                    <?php
                }
                
                echo "</div>";
            }
            ?>
        </div>
        <div class="col-md-12 text-right">
            <div>
                <button class="btn btn-inverse-org" type="button" onclick="$('.simplemodal-close').click(); //if (confirm('Tem certesa?\nApós fechar não poderá voltar a realizar essa avaliação!')) {$('.simplemodal-close').click();}">Fechar</button>
                <button class="btn btn-inverse" type="submit">Salvar</button>
            </div>
        </div>
    </form>
</div>
<style>
    .modalCloseImg {
        display: none !important;
    }
    body {
        overflow: hidden;
    }
    .lquestao {
        border-top: 1px solid #00824C;
    }
</style>
<script>
    $('#simplemodal-overlay').unbind('click');
//    $('#simplemodal-overlay').on('click', function (e){
    $('#simplemodal-overlay').click(function (e){
        debugger;
        e.preventDefault();
        e.stopPropagation();
        return false;
    })
</script>