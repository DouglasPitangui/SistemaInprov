<?php
include_once '../auto_load.php';
//var_dump($_REQUEST);
$disciplina_id = (int) $_REQUEST['disciplina_id'];
if ($disciplina_id > 0) {
    $Disciplina = ClsDisciplina::selectDisciplina(array(disciplina_id => $disciplina_id));
    $Disciplina = $Disciplina[0];
//    var_dump($Disciplina);
    $btnAcao = "<input type='hidden' name='acao' value='alterarDisciplina'>
                <input type='hidden' name='disciplina_id' value='$Disciplina->disciplina_id'>";
}else{
    $btnAcao = "<input type='hidden' name='acao' value='incluirDisciplina'>";
}
?> 
<div class="col-md-12">
    <h3 style="font-style:italic">DADOS DA DISCIPLINA</h3>
    <form action="action/cadastro.php" method="post" enctype="multipart/form-data" id="formdisciplina" onsubmit="fazSubmit(this, event);">
        <?= $btnAcao; ?>
        <!--Start dados pessoa-->
        <div class="col-md-12">
            <div class="form-group">
                <label for="">ID</label>
                <input type="text" class="form-control" name="" disabled="" value="<?= $Disciplina->disciplina_id; ?>">
            </div>
            <div class="form-group">
                <label for="">Nome</label>
                <input type="text" class="form-control" required="" name="nome" placeholder="Seu Nome" value="<?= $Disciplina->nome; ?>">
            </div>
            
            <div class="form-group quantity">
                <label for="">Carga Horária</label>
                <input type="text" class="form-control" required="" name="cargaHoraria" placeholder="123.456.789-00" value="<?= $Disciplina->cargaHoraria; ?>">
            </div>
            
            <div class="col-md-12 text-right">
                <div>
                    <button class="btn btn-inverse-org" type="button" onclick="$('.simplemodal-close').click();">Fechar</button>
                    <button class="btn btn-inverse" type="submit">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>