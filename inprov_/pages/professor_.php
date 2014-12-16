<?php
include_once '../auto_load.php';
//var_dump($_REQUEST);
$matricula = (int) $_REQUEST['matricula'];
if ($matricula > 0) {
    $Professor = ClsProfessor::selectProfessor(array(matricula => $matricula));
    $Professor = $Professor[0];
//    var_dump($Professor);
    $btnAcao = "<input type='hidden' name='acao' value='alterarProfessor'>
                <input type='hidden' name='matricula' value='$Professor->matricula'>";
}else{
    $btnAcao = "<input type='hidden' name='acao' value='incluirProfessor'>";
}
?> 
<div class="col-md-12">
    <h3 style="font-style:italic">DADOS DO PROFESSOR</h3>
    <form action="action/cadastro.php" method="post" enctype="multipart/form-data" id="formprofessor" onsubmit="fazSubmit(this, event);">
        <?= $btnAcao; ?>
        <!--Start dados pessoa-->
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Matricula</label>
                <input type="text" class="form-control" required="" name="" disabled="" value="<?= $Professor->matricula; ?>">
            </div>
            <div class="form-group">
                <label for="">Nome</label>
                <input type="text" class="form-control" required="" name="nome" placeholder="Seu Nome" value="<?= $Professor->nome; ?>">
            </div>
            <div class="form-group">
                <label for="">CPF</label>
                <input type="text" class="form-control" required="" name="cpf" placeholder="123.456.789-00" value="<?= $Professor->cpf; ?>">
            </div>
            <div class="form-group">
                <label for="">Telefone</label>
                <input type="text" class="form-control" required="" name="telefone" placeholder="(27) 1234-5678" value="<?= $Professor->telefone; ?>">
            </div>
            <div class="form-group">
                <label for="">E-mail</label>
                <input type="text" class="form-control" required="" name="email" placeholder="seuemail@email.com.br" value="<?= $Professor->email; ?>">
            </div>
            <div class="form-group">
                <label for="">Data de Nascimento</label>
                <input type="text" class="form-control datepicker" required="" name="dataDeNascimento" placeholder="20/02/2000" value="<?= $Professor->dataDeNascimento; ?>">
            </div>
        </div>   
        <!--end dados pessoa-->
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Senha</label>
                <input type="password" class="form-control" name="senha" placeholder="*****" value="<?= $Professor->senha_; ?>">
            </div>
            
            <div class="form-group">
                <label for="">Formação</label>
                <input type="" class="form-control" required="" name="formacao" placeholder="Curso" value="<?= $Professor->formacao; ?>">
            </div>
            <div class="form-group" style="padding-bottom:5px">
                <label for="">Papel</label>
                <select class="selectpicker z-index" required="" name="papel">
                    <option value="1" <?= $Professor->funcao_id==1?"selected":""; ?>>Administrador</option>
                    <option value="2" <?= $Professor->funcao_id==2?"selected":""; ?>>Professor</option>
                </select>
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