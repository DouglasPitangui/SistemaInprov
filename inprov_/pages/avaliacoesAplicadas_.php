<?php
session_start();
include_once '../auto_load.php';
//var_dump($_REQUEST);
//var_dump($_SESSION);
$matricula = (int) ($_REQUEST['matricula'])?$_REQUEST['matricula']:$_SESSION['matricula'];
$avaliacao_id = (int) $_REQUEST['avaliacao_id'];
if (($matricula > 0) and ($avaliacao_id > 0)) {
//var_dump($_SESSION);
    $Avaliacao = ClsAvaliacao::selectAvaliacaoAlternativas(array(avaliacao_id => $avaliacao_id));
//    var_dump($Avaliacao);

    $btnAcao = "<input type='hidden' name='acao' value='corrigirAvaliacao'>
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
                <label for="">Aluno</label>
                <input type="text" class="form-control" name="" disabled="" value="<?= ClsAluno::selectAluno(array(matricula => $matricula))[0]->nome; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="">Disciplina</label>
                <input type="text" class="form-control" name="" disabled="" value="<?= ClsDisciplina::selectDisciplina(array(disciplina_id => $Avaliacao[0]->disciplina_id))[0]->nome ?>">
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
//                $nota = ($resposta->respostaAlunoNota)?$resposta->respostaAlunoNota:rand(0, 100);
                if ($resposta->respostaAlunoNota) {
                    $nota = $resposta->respostaAlunoNota;
                }
                /**
                 * CÓDIGO PARA 'CORRIGIR' QUESTÃO DISCURSIVA
                 */

                echo "<div class='col-md-12 lquestao'>";
                echo "<label>Questão:</label><textarea rows='2' style='resize: vertical; margin-bottom: 5px;' class='form-control' 
                       name='alternativas[0]' disabled='' placeholder='Alternativa da questão' 
                       >$key->descricao</textarea>";
                if ($key->questaoDiscursiva) {
                    $QuestaoAlternativa = ClsQuestao::selectQuestaoAlternativas(array(questao_id => $key->questao_id));
                    $QuestaoAlternativa = $QuestaoAlternativa[0];
                    
                    if (!$resposta->respostaAlunoNota) {
                        $nota = ClsAvaliacao::corrigirQuestao($QuestaoAlternativa->respostaDoProfessor, $resposta->respostaAluno);
                    }
                    
                    echo "<label>Resposta Base:</label><textarea rows='2' style='resize: vertical; margin-bottom: 5px;' class='form-control' 
                           name='alternativas[0]' disabled='' placeholder='Resposta da questão' 
                           >$QuestaoAlternativa->respostaDoProfessor</textarea>";

                    echo "<label>Resposta Aluno:</label><textarea rows='2' style='resize: vertical; margin-bottom: 5px;' class='form-control' 
                           name='alternativas[0]' disabled='' placeholder='Resposta da questão' 
                           >$resposta->respostaAluno</textarea>";
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
                                $checked = $resposta->respostaAluno == $QuestaoAlternativa[$i]->questaoObjetiva_id ? 'checked' : '';
                                $alternativas = $QuestaoAlternativa[$i]->alternativas;
                                echo
                                <<<html
                                <tr style="$c">
                                    <td style="width: 3%;" align="center"><label><input type="radio" name="" disabled="" value="0" $checked></label></td>
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
                ?> 
                <div class="form-group col-md-12 text-right">
                    <div class="col-md-8 text-right">
                        <label>Nota da questão</label>
                    </div>
                        <?php 
                        $qtt = ($_SESSION['funcao_id'])?"col-md-6 quantity decimals":"";
                        $disabled = ($_SESSION['funcao_id'])?'':'disabled';
                        ?>
                    <div class="text-right <?= $qtt; ?>">
                        <input <?= $disabled; ?> type="text" class="form-control" name="nota[<?= $key->questao_id ?>]" value="<?= $nota; ?>" placeholder="Nota" style="width: 100px;">
                    </div>
                </div>

                <?php
                echo "</div>";
            }
            ?>
        </div>
        <div class="col-md-12 text-right">
            <div>
                <button class="btn btn-inverse-org" type="button" onclick="$('.simplemodal-close').click();">Fechar</button>
                <?php if ($_SESSION['funcao_id']) { ?>
                    <button class="btn btn-inverse" type="submit">Salvar</button>
                <?php } ?>
            </div>
        </div>
    </form>
</div>
<style>
    body {
        overflow: hidden;
    }
    .lquestao {
        border-top: 1px solid #00824C;
    }
</style>