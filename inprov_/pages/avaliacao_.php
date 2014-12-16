<?php
session_start();
include_once '../auto_load.php';
//var_dump($_REQUEST);
$avaliacao_id = (int) $_REQUEST['avaliacao_id'];

if ($avaliacao_id > 0) {
    $Avaliacao = ClsAvaliacao::selectAvaliacao(array(avaliacao_id => $avaliacao_id));
    $Avaliacao = $Avaliacao[0];
//    var_dump($Avaliacao);

    $btnAcao = "<input type='hidden' name='acao' value='alterarAvaliacao'>
    <input type='hidden' name='avaliacao_id' value='$avaliacao_id'>";
} else {
    $btnAcao = "<input type='hidden' name='acao' value='incluirAvaliacao'>";
}
?>

<div class="col-md-12">
    <h3 style="font-style:italic">AVALIAÇÃO</h3>
    <form action="action/cadastro.php" method="post" enctype="multipart/form-data" id="formavaliacao" onsubmit="fazSubmit(this, event);">
        <?= $btnAcao; ?>
        <!--Start dados questão-->
        <div class="col-md-6">
            <div class="form-group" style="padding-bottom:5px">
                <label for="">Disciplina</label>
                <script>
                    fazQuestaoAvaliacao('#formavaliacao');
                    function fazQuestaoAvaliacao(form, e) {
                        debugger;
                        if (e) e.preventDefault();

                        $.ajax({
                            type: $(form).attr('method'),
                            url: 'pages/avaliacaoquestao.php',
                            data: $(form).serialize(),
                            success: function(result) {
//                                debugger;
                                $('#lstQuestaoAvaliacao').html(result);
                            },
                            error: function(response) {
                                debugger;
                                console.log(response);
                                alertify.error('Infelizmente algo aconteceu,<br/> tente novamente.');
                            }
                            , dataType: 'html'
                        });
                    };
                </script>
                <select class='selectpicker z-index' name="disciplina_id" onchange="fazQuestaoAvaliacao(this.form, event);">
                    <?php
                    $Disciplinas = ClsDisciplina::selectDisciplina();
                    foreach ($Disciplinas as $key) {
//                        var_dump($key);
                        $selected = $Avaliacao->disciplina_id == $key->disciplina_id ? 'selected' : '';
                        echo "<option value='$key->disciplina_id' $selected> $key->nome</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group" style="padding-bottom:5px">
                <label for="">Professor: </label>
                <select class="selectpicker z-index" name="matricula">
                    <?php
                    $Professores = ClsProfessor::selectProfessor(array('matricula' => $_SESSION['matricula']));
                    foreach ($Professores as $key) {
//                        var_dump($key);
                        $selected = $Avaliacao->matricula == $key->matricula ? 'selected' : '';
                        echo "<option value='$key->matricula' $selected> $key->nome</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Nome: </label>
                    <input rows="4" class="form-control" required="" name="nome" placeholder="Nome" value="<?= $Avaliacao->nome; ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Data Inicial: </label>
                    <input class="form-control datepicker" required="" name="dataInicio" placeholder="Data Inicial" value="<?= $Avaliacao->dataInicio; ?>"/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Data Final: </label>
                    <input class="form-control datepicker" required="" name="dataFim" placeholder="Data Final" value="<?= $Avaliacao->dataFim; ?>"/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group hidden">
                    <label for="">Duração Máxima: </label>
                    <input class="form-control timepicker" required="" name="tempoMaximo" placeholder="Duração Máxima" value="<?= $Avaliacao->tempoMaximo?$Avaliacao->tempoMaximo:'01:40'; ?>"/>
                </div>
            </div>
        </div>
        <!--end dados questão-->
        <div class="col-md-12">
            <table class="table cart_tableS" style="height: 200px; display: block; overflow: auto;">
                <thead>
                    <tr style="background-color:rgb(249,249,249); border:medium 1px #CCCCCC;">
                        <th style="width: 8%;">ID</th>
                        <th>Disciplina</th>
                        <th style="width: 100%;">Descrição</th>
                        <th>Assunto</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="lstQuestaoAvaliacao">
                    <?php
//                    $QuestoesAlternativasArr = array();
//                    $Questoes = ClsQuestao::selectQuestao(array(disciplina_id => $Avaliacao->disciplina_id?$Avaliacao->disciplina_id:$Disciplinas[0]->disciplina_id));
//                    if ($avaliacao_id > 0) {
//                        $QuestoesAlternativas = ClsAvaliacao::selectAvaliacaoAlternativas(array(avaliacao_id => $avaliacao_id));
//                        foreach ($QuestoesAlternativas as $key) {
//                            $QuestoesAlternativasArr[] = $key->questao_id;
//                        }
//                    }
//                    foreach ($Questoes as $key) {
//                        $checked = in_array($key->questao_id, $QuestoesAlternativasArr) ? 'checked' : '';
//                        echo <<<html
//                        <tr>
//                            <td align="center"><span class="in-stock">$key->questao_id</span></td>
//                            <td align="center"><a>$key->nome</a></td>
//                            <td align="center"><span class="in-stock">$key->descricao</span></td>
//                            <td align="center"><span class="in-stock">$key->assunto</span></td>
//                            <td align="center"><span class="in-stock"><input type="checkbox" name="questao_id[]" value="$key->questao_id" $checked /></span></td>
//                        </tr>
//html;
//                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <div class="col-md-7">
                <div class="search-panel col-md-6" style="padding: 0;">
                    <div class="search-panel__inner" style="">
                        <div class="search-field col-md-10 col-sm-12 col-xs-12 widget-cart2" style="margin: 0;">
                            <input type="text" placeholder="Buscar questão" name="filtrar" value="<?= $filtrar; ?>" onkeyup="fazQuestaoAvaliacao(this.form, event);"/>
                            <div class="search-button__wrapper">
                                <button class="search-button" type="button" onclick="fazQuestaoAvaliacao(this.form, event);">
                                    <i class="search-button-icon"></i>
                                </button>
                            </div>
                        </div><!--search-fiel-->
                    </div><!--search-panel__inner-->
                </div><!--search-panel col-md-6-->
                <div class="form-group col-md-6 col-sm-11 col-xs-10">
                    <select class="selectpicker z-index dropup" name="assunto_id" onchange="fazQuestaoAvaliacao(this.form, event);">
                        <option value=''>Todos Assuntos</option>
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
                
            <div class="col-md-5 text-right">
                <?php if ($avaliacao_id > 0) { //this.form.submit();//
                    ?>
                    <!--<button class="btn btn-primary2" type="button" onclick="this.form.acao.value = 'removerAvaliacao'; fazSubmit(this.form, event); $.modal.close();">Remover</button>-->
                <?php } ?>
                <button class="btn btn-inverse-org" type="button" onclick="$('.simplemodal-close').click();">Fechar</button>
                <button class="btn btn-inverse" type="submit">Salvar</button>
            </div>
        </div>
    </form>
</div>