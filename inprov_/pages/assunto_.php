<?php
include_once '../auto_load.php';
//var_dump($_REQUEST);
$assunto_id = (int) $_REQUEST['assunto_id'];
//var_dump($assunto_id);
if ($assunto_id > 0) {
    $Assunto = ClsAssunto::selectAssunto(array(assunto_id => $assunto_id));
    $Assunto = $Assunto[0];
//    var_dump($Assunto);
    $btnAcao = "<input type='hidden' name='acao' value='alterarAssunto'>
                <input type='hidden' name='assunto_id' value='$Assunto->assunto_id'>";
}else{
    $btnAcao = "<input type='hidden' name='acao' value='incluirAssunto'>";
}
?> 
<div class="col-md-12">
    <h3 style="font-style:italic">ASSUNTO</h3>
    <form action="action/cadastro.php" method="post" enctype="multipart/form-data" id="formassunto" onsubmit="fazSubmit(this, event);">
        <?= $btnAcao; ?>
        
        <div class="col-md-12">
            <div class="form-group">
                <label for="">ID</label>
                <input type="text" class="form-control" name="" disabled="" value="<?= $Assunto->assunto_id; ?>">
            </div>
            
            <div class="form-group">
                <label for="">Nome</label>
                <input type="text" class="form-control" required="" name="assunto" placeholder="Assuno da questão" value="<?= $Assunto->assunto; ?>">
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