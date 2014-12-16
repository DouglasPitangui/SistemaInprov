<?php 
include_once '../auto_load.php';
//var_dump($_REQUEST);
$matricula = (int)$_REQUEST['matricula'];
if ($matricula > 0) {
    $Aluno = ClsAluno::selectAluno(array(matricula => $matricula));
    $Aluno = $Aluno[0];
//    var_dump($Aluno);
    $btnAcao = "<input type='hidden' name='acao' value='alterarAluno'>
                <input type='hidden' name='matricula' value='$Aluno->matricula'>";
}else{
    $btnAcao = "<input type='hidden' name='acao' value='incluirAluno'>";
}
?> 
<div class="col-md-12">
    <h3 style="font-style:italic">DADOS DO ALUNO</h3>
    <form action="action/cadastro.php" method="post" enctype="multipart/form-data" id="formaluno" onsubmit="fazSubmit(this, event);">
        <?= $btnAcao; ?>
        <!--Start dados pessoa-->
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Matricula</label>
                <input type="text" class="form-control" name="" disabled="" value="<?= $Aluno->matricula; ?>">
            </div>
            <div class="form-group">
                <label for="">Nome</label>
                <input type="text" class="form-control" required="" name="nome" placeholder="Seu Nome" value="<?= $Aluno->nome; ?>">
            </div>
            <div class="form-group">
                <label for="">CPF</label>
                <input type="text" class="form-control" required="" name="cpf" placeholder="123.456.789-00" value="<?= $Aluno->cpf; ?>">
            </div>
            <div class="form-group">
                <label for="">Telefone</label>
                <input type="text" class="form-control" required="" name="telefone" placeholder="(27) 1234-5678" value="<?= $Aluno->telefone; ?>">
            </div>
            <div class="form-group">
                <label for="">E-mail</label>
                <input type="text" class="form-control" required="" name="email" placeholder="seuemail@email.com.br" value="<?= $Aluno->email; ?>">
            </div>
            <div class="form-group">
                <label for="">Data de Nascimento</label>
                <input type="text" class="form-control datepicker" required="" name="dataDeNascimento" placeholder="20/02/2000" value="<?= $Aluno->dataDeNascimento; ?>">
            </div>
        </div>   
        <!--end dados pessoa-->
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Senha</label>
                <input type="password" class="form-control" name="senha" placeholder="*****" value="<?= $Aluno->senha_; ?>">
            </div>

            <div class="form-group">
                <label for="">Curso</label>
                <input type="" class="form-control" required="" name="curso" placeholder="Curso" value="<?= $Aluno->curso; ?>">
            </div>
            <div class="form-group" style="padding-bottom:5px">
                <input type="hidden" name="status" value="1"><!--cursando-->
                <label for="">Situação</label>
                <select class="selectpicker z-index" required="" name="status">
                    <option value="0" <?= $Aluno->status==0?"selected":""; ?>>Trancado</option>
                    <option value="1" <?= $Aluno->status==1?"selected":""; ?>>Cursando</option>
                    <option value="2" <?= $Aluno->status==2?"selected":""; ?>>Concluído</option>
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