<?php
include_once '../auto_load.php';
//var_dump($_REQUEST);
$questao_id = (int) $_REQUEST['questao_id'];

if ($questao_id > 0) {
    $Questao = ClsQuestao::selectQuestao(array(questao_id => $questao_id));
    $Questao = $Questao[0];

    $btnAcao = "<input type='hidden' name='acao' value='alterarQuestao'>
    <input type='hidden' name='questao_id' value='$Questao->questao_id'>";
} else {
    $btnAcao = "<input type='hidden' name='acao' value='incluirQuestao'>";
}
?>

<div class="col-md-12">
    <h3 style="font-style:italic">QUESTÃO</h3>
    <form action="action/cadastro.php" method="post" enctype="multipart/form-data" id="formquestao" onsubmit="fazSubmit(this, event);">
        <?= $btnAcao; ?>
        <!--Start dados questão-->
        <div class="col-md-6">
            <div class="form-group" style="padding-bottom:5px">
                <label for="">Disciplina</label>
                <?php
                $Disciplinas = ClsDisciplina::selectDisciplina();
                echo "<select class='selectpicker z-index' name=disciplina_id>";
                foreach ($Disciplinas as $key) {
//                    var_dump($key);
                    $selected = $Questao->disciplina_id == $key->disciplina_id ? 'selected' : '';
                    echo "<option value='$key->disciplina_id' $selected> $key->nome</option>";
                }
                echo "</select>";
                ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group" style="padding-bottom:5px">
                <label for="">Assunto: </label>
                <select class="selectpicker z-index" name="assunto">
                    <?php
                    $Assuntos = ClsAssunto::selectAssunto();
                    var_dump($key);
                    foreach ($Assuntos as $key) {
                        $selected = $Questao->assunto_id == $key->assunto_id ? 'selected' : '';
                        echo "<option value='$key->assunto_id' $selected> $key->assunto</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="">Descrição: </label>
                <textarea rows="4" class="form-control" required="" name="descricao" placeholder="Descrição da questão" required
                          ><?= $Questao->descricao; ?></textarea>
            </div>
            <?php
            if ($questao_id > 0) {
                $QuestaoAlternativa = ClsQuestao::selectQuestaoAlternativas(array(questao_id => $questao_id));
//                var_dump($QuestaoAlternativa);
                $tipoQuestaoDiscursiva = $QuestaoAlternativa[0]->respostaDoProfessor ? true : false;
//                var_dump($tipoQuestaoDiscursiva);
                if ($tipoQuestaoDiscursiva) {
                    $requiredDiscursiva = TRUE;
                } else {
                    $requiredObjetiva = TRUE;
                }
            }
            ?>
            <div class="col-md-12">
                <script>
                    function trocaTipoQuestao(el) {
//                        $('.tab-content.tipoQuestao').find('.active').removeClass('active').fadeOut('slow');
//                        $($(el).attr('data-target')).fadeIn('slow');

//                        $('.tab-content.tipoQuestao').find('.active').fadeOut('fast').delay(500).queue(function() {
//                            $(this).removeClass('active').dequeue();
//                        });
//                        $($(el).attr('data-target')).fadeIn('fast').delay(500).queue(function() {
//                            $(this).dequeue();
//                        }).addClass('active');

                        $('.tab-content.tipoQuestao').find('.active').fadeOut('fast').removeClass('active').find('textarea').removeAttr('required');
                        $($(el).attr('data-target')).fadeIn('fast').addClass('active').find('textarea').attr('required', true);
                    }
                </script>
                <label><input onchange="trocaTipoQuestao(this);" type="radio" required="" name="tipoQuestao" data-target="#questaoDiscursiva" <?= $tipoQuestaoDiscursiva ? 'checked' : ''; ?> <?= ($questao_id > 0) ? 'disabled' : '' ?> value="Discursiva"> Discursiva</label>
                <label><input onchange="trocaTipoQuestao(this);" type="radio" required="" name="tipoQuestao" data-target="#questaoObjetiva" <?= $tipoQuestaoDiscursiva ? '' : 'checked'; ?> <?= ($questao_id > 0) ? 'disabled' : '' ?> value="Objetiva"> Objetiva</label>
            </div>
            <!--            <button type="button" data-toggle="modal" data-target="#myModal">Launch modal</button>-->
            <ul class="nav nav-tabs" role="tablist">
            </ul>

            <!-- Tab panes -->
            <div class="tab-content tipoQuestao">
                <div class="tab-pane fade in <?= $tipoQuestaoDiscursiva ? 'active' : 'hid'; ?>" id="questaoDiscursiva">
                    <div class="form-group">
                        <label for="">Resposta: </label>
                        <textarea rows="4" class="form-control" name="respostaDoProfessor" placeholder="Resposta da questão" 
                                  <?= $requiredDiscursiva ? 'required' : '' ?>><?= $QuestaoAlternativa[0]->respostaDoProfessor; ?></textarea>
                    </div>
                </div>
                <div class="tab-pane fade in <?= $tipoQuestaoDiscursiva ? 'hid' : 'active'; ?>" id="questaoObjetiva">
                    <?php
                    if ($requiredObjetiva) {
                        ?> 
                        <input type="hidden" name="questaoObjetiva_id[0]" value="<?= $QuestaoAlternativa[0]->questaoObjetiva_id ?>">
                        <input type="hidden" name="questaoObjetiva_id[1]" value="<?= $QuestaoAlternativa[1]->questaoObjetiva_id ?>">
                        <input type="hidden" name="questaoObjetiva_id[2]" value="<?= $QuestaoAlternativa[2]->questaoObjetiva_id ?>">
                        <input type="hidden" name="questaoObjetiva_id[3]" value="<?= $QuestaoAlternativa[3]->questaoObjetiva_id ?>">
                        <input type="hidden" name="questaoObjetiva_id[4]" value="<?= $QuestaoAlternativa[4]->questaoObjetiva_id ?>">
                    <?php } ?> 
                    <div class="form-group">
                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td style="width: 20%;" align="center"><label><input type="radio" name="alternativaCorreta" <?= $QuestaoAlternativa[0]->alternativaCorreta ? 'checked' : ''; ?> value="0">Alternativa Correta</label></td>
                                    <td style="width: 80%;"><textarea rows="2" style="resize: none;" class="form-control" name="alternativas[0]" placeholder="Alternativa da questão" 
                                                                      <?= $requiredObjetiva ? 'required' : '' ?>><?= $QuestaoAlternativa[0]->alternativas; ?></textarea></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;" align="center"><label><input type="radio" name="alternativaCorreta" <?= $QuestaoAlternativa[1]->alternativaCorreta ? 'checked' : ''; ?> value="1">Alternativa Correta</label></td>
                                    <td style="width: 80%;"><textarea rows="2" style="resize: none;" class="form-control" name="alternativas[1]" placeholder="Alternativa da questão" 
                                                                      <?= $requiredObjetiva ? 'required' : '' ?>><?= $QuestaoAlternativa[1]->alternativas; ?></textarea></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;" align="center"><label><input type="radio" name="alternativaCorreta" <?= $QuestaoAlternativa[2]->alternativaCorreta ? 'checked' : ''; ?> value="2">Alternativa Correta</label></td>
                                    <td style="width: 80%;"><textarea rows="2" style="resize: none;" class="form-control" name="alternativas[2]" placeholder="Alternativa da questão" 
                                                                      <?= $requiredObjetiva ? 'required' : '' ?>><?= $QuestaoAlternativa[2]->alternativas; ?></textarea></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;" align="center"><label><input type="radio" name="alternativaCorreta" <?= $QuestaoAlternativa[3]->alternativaCorreta ? 'checked' : ''; ?> value="3">Alternativa Correta</label></td>
                                    <td style="width: 80%;"><textarea rows="2" style="resize: none;" class="form-control" name="alternativas[3]" placeholder="Alternativa da questão" 
                                                                      <?= $requiredObjetiva ? 'required' : '' ?>><?= $QuestaoAlternativa[3]->alternativas; ?></textarea></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;" align="center"><label><input type="radio" name="alternativaCorreta" <?= $QuestaoAlternativa[4]->alternativaCorreta ? 'checked' : ''; ?> value="4">Alternativa Correta</label></td>
                                    <td style="width: 80%;"><textarea rows="2" style="resize: none;" class="form-control" name="alternativas[4]" placeholder="Alternativa da questão" 
                                                                      <?= $requiredObjetiva ? 'required' : '' ?>><?= $QuestaoAlternativa[4]->alternativas; ?></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>   
        <!--end dados questão-->
        <div class="col-md-12 text-right">
            <div>
                <button class="btn btn-inverse-org" type="button" onclick="$('.simplemodal-close').click();">Fechar</button>
                <button class="btn btn-inverse" type="submit">Salvar</button>
            </div>
        </div>
    </form>
</div>