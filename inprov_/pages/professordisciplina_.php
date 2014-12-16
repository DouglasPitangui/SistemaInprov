<?php
include_once '../auto_load.php';
//var_dump($_REQUEST);
$matricula = (int)$_REQUEST['matricula'];
if ($matricula > 0) {
    $Professor = ClsProfessor::selectProfessor(array(matricula => $matricula));
    $Professor = $Professor[0];
//    var_dump($Aluno);
    $btnAcao = "<input type='hidden' name='acao' value='incluirProfessorDisciplina'>
                <input type='hidden' name='matricula' value='$Professor->matricula'>";
}
?> 
<div class="col-md-12">
    <h3 style="font-style:italic">PROFESSOR DISCIPLINA</h3>
    <form action="action/cadastro.php" method="post" enctype="multipart/form-data" id="formassunto" onsubmit="fazSubmit(this, event);">
        <?= $btnAcao; ?>
        
        <div class="col-md-12">
            <div class="form-group col-md-6">
                <label for="">Matricula</label>
                <input type="text" class="form-control" name="" disabled="" value="<?= $Professor->matricula; ?>">
            </div>
            
            <div class="form-group col-md-6">
                <label for="">Nome</label>
                <input type="text" class="form-control" disabled="" name="" value="<?= $Professor->nome; ?>">
            </div>
        </div>
            
        <div class="col-md-12">
            <table class="table cart_tableS" style="height: 200px; display: block; overflow: auto;">
                <thead>
                    <tr style="background-color:rgb(249,249,249); border:medium 1px #CCCCCC;">
                        <th style="width: 8%;">ID</th>
                        <th style="width: 77%;">Disciplina</th>
                        <th style="width: 17%;">Carga Horária</th>
                        <!--<th>Semestre</th>-->
                        <th></th>
                    </tr>
                </thead>
                <tbody id="lstQuestaoAvaliacao">
                    <?php
                    $ProfessorDisciplinaArr = array();
                    $ProfessorDisciplina = ClsProfessor::selectDisciplina(array(matricula => $matricula));
//                    var_dump($ProfessorDisciplina);
                    foreach ($ProfessorDisciplina as $key) {
                        $ProfessorDisciplinaArr[] = $key->disciplina_id;
                    }
                    
                    $Disciplinas = ClsDisciplina::selectDisciplina();
//                    var_dump($Disciplinas);
                    foreach ($Disciplinas as $key) {
                        $checked = in_array($key->disciplina_id, $ProfessorDisciplinaArr) ? 'checked' : '';
//                        $checked = $key->matricula ? 'checked' : '';
                        echo <<<html
                        <tr>
                            <td align="center"><span class="in-stock">$key->disciplina_id</span></td>
                            <td align="center"><span>$key->nome</span></td>
                            <td align="center"><span class="in-stock">$key->cargaHoraria</span></td>
                            <!--<td align="center"><span class="in-stock">$key->dataCursadaF</span></td>-->
                            <td align="center"><span class="in-stock"><input type="checkbox" name="disciplina_id[]" value="$key->disciplina_id" $checked /></span></td>
                        </tr>
html;
                    }
                    ?>
                </tbody>
            </table>
        </div>
            <div class="col-md-12 text-right">
                <div>
                    <button class="btn btn-inverse-org" type="button" onclick="$('.simplemodal-close').click();">Fechar</button>
                    <button class="btn btn-inverse" type="submit">Salvar</button>
                </div>
            </div>
    </form>
</div>