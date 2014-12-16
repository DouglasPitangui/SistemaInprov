<?php

session_start();
ob_start();
include_once '../auto_load.php';
ini_set('default_charset', 'UTF-8');
date_default_timezone_set('Brazil/East');

$gravalog = new ClsGravaLog;
foreach ($_REQUEST as $key => $value) {
//    $gravalog->fazLog(__FILE__ . " Linha: " . __LINE__ . " " . __FUNCTION__ . " $key => $value", basename(__FILE__));
//    if (!is_array($value)) {
//        $_REQUEST[$key] = utf8_decode($value);
//    }
    $$key = $value;
}

var_dump($_REQUEST);

ob_end_clean();

switch ($acao) {
    case 'incluirAluno':
        $usuario = new ClsAluno($matricula, $nome, $email, $cpf, $telefone, $dataDeNascimento, $senha, $curso, $status);
        if ($usuario->insertAluno()) {
            echo json_encode(array(resp => 'OK', mensagem => 'Aluno cadastrado com sucesso! <br/> Matricula: '.$usuario->getMatricula()));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao cadastrar aluno!'));
        }
        break;
    case 'alterarAluno':
        $usuario = new ClsAluno($matricula, $nome, $email, $cpf, $telefone, $dataDeNascimento, $senha, $curso, $status);
        if ($usuario->updateAluno()) {
            if (isset($senha) and !empty($senha)) {
                if ($usuario->updateSenha($senha)) {
                    echo json_encode(array(resp => 'OK', mensagem => 'Dados alterados com sucesso!'));
                }else{
                    echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao alterar senha!'));
                }
            }else{
                echo json_encode(array(resp => 'OK', mensagem => 'Dados alterados com sucesso!'));
            }
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao alterar dados!'));
        }
        break;
    case 'incluirAlunoDisciplina':
        $usuario = new ClsAluno($matricula);
        if ($usuario->insertDisciplina($disciplina_id)) {
            echo json_encode(array(resp => 'OK', mensagem => 'Disciplinas cadastradas com sucesso!'));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao cadastrar disciplinas!'));
        }
        break;

    case 'incluirProfessor':
        $usuario = new ClsProfessor($matricula, $nome, $email, $cpf, $telefone, $dataDeNascimento, $senha, $papel, $formacao);
        if ($usuario->insertProfessor()) {
            echo json_encode(array(resp => 'OK', mensagem => 'Professor cadastrado com sucesso! <br/> Matricula: '.$usuario->getMatricula()));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao cadastrar professor!'));
        }
        break;
    case 'alterarProfessor':
        $usuario = new ClsProfessor($matricula, $nome, $email, $cpf, $telefone, $dataDeNascimento, $senha, $papel, $formacao);
        if ($usuario->updateProfessor()) {
            if (isset($senha) and !empty($senha)) {
                if ($usuario->updateSenha($senha)) {
                    echo json_encode(array(resp => 'OK', mensagem => 'Dados alterados com sucesso!'));
                }else{
                    echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao alterar senha!'));
                }
            }else{
                echo json_encode(array(resp => 'OK', mensagem => 'Dados alterados com sucesso!'));
            }
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao alterar dados!'));
        }
        break;
    case 'incluirProfessorDisciplina':
        $usuario = new ClsProfessor($matricula);
        if ($usuario->insertDisciplina($disciplina_id)) {
            echo json_encode(array(resp => 'OK', mensagem => 'Disciplinas cadastradas com sucesso!'));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao cadastrar disciplinas!'));
        }
        break;

    case 'incluirDisciplina':
        $disciplina = new ClsDisciplina(null, $nome, $cargaHoraria);
        if ($disciplina->insertDisciplina()) {
            echo json_encode(array(resp => 'OK', mensagem => 'Disciplina cadastrada com sucesso!'));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao cadastrar disciplina!'));
        }
        break;
    case 'alterarDisciplina':
        $disciplina = new ClsDisciplina($disciplina_id, $nome, $cargaHoraria);
        if ($disciplina->updateDisciplina()) {
            echo json_encode(array(resp => 'OK', mensagem => 'Disciplina alterada com sucesso!'));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao alterar disciplina!'));
        }
        break;

    case 'incluirQuestao':
        $questao = new ClsQuestao(null, $disciplina_id, $descricao, $assunto, $respostaDoProfessor, $alternativas, $alternativaCorreta, $questaoObjetiva_id);
        if ($questao->insertQuestao()) {
            echo json_encode(array(resp => 'OK', mensagem => 'Questão cadastrada com sucesso!'));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao cadastrar questão!'));
        }
        break;
    case 'alterarQuestao':
        $questao = new ClsQuestao($questao_id, $disciplina_id, $descricao, $assunto, $respostaDoProfessor, $alternativas, $alternativaCorreta, $questaoObjetiva_id);
        if ($questao->updateQuestao()) {
            echo json_encode(array(resp => 'OK', mensagem => 'Questão alterada com sucesso!'));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao alterar questão!'));
        }
        break;

    case 'incluirAvaliacao':
        $avaliacao = new ClsAvaliacao($avaliacao_id, $matricula, $disciplina_id, $nome, $dataInicio, $dataFim, $tempoMaximo, $questao_id);
        if ($avaliacao->insertAvaliacao()) {
            echo json_encode(array(resp => 'OK', mensagem => 'Avaliação cadastrada com sucesso!'));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao cadastrar avaliação!'));
        }
        break;
    case 'alterarAvaliacao':
        $avaliacao = new ClsAvaliacao($avaliacao_id, $matricula, $disciplina_id, $nome, $dataInicio, $dataFim, $tempoMaximo, $questao_id);
        if ($avaliacao->updateAvaliacao()) {
            echo json_encode(array(resp => 'OK', mensagem => 'Avaliação alterada com sucesso!'));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao alterar avaliação!'));
        }
        break;
    case 'removerAvaliacao':
        $avaliacao = new ClsAvaliacao($avaliacao_id, $matricula, $disciplina_id, $nome, $dataInicio, $dataFim, $tempoMaximo, $questao_id);
        if ($avaliacao->deleteAvaliacao()) {
            echo json_encode(array(resp => 'OK', mensagem => 'Avaliação removida com sucesso!'));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao remover avaliação!'));
        }
        break;

    case 'incluirAssunto':
        $assunto = new ClsAssunto($assunto_id, $assunto);
        if ($assunto->insertAssunto()) {
            echo json_encode(array(resp => 'OK', mensagem => 'Assunto cadastrado com sucesso!'));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao cadastrar assunto!'));
        }
        break;
    case 'alterarAssunto':
        $assunto = new ClsAssunto($assunto_id, $assunto);
        if ($assunto->updateAssunto()) {
            echo json_encode(array(resp => 'OK', mensagem => 'Assunto alterado com sucesso!'));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao alterar assunto!'));
        }
        break;

    case 'corrigirAvaliacao':
        if (ClsAvaliacao::corrigirAvaliacao($matricula, $avaliacao_id, $nota)) {
            echo json_encode(array(resp => 'OK', mensagem => 'Respostas salvas com sucesso!'));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao salvar respostas!'));
        }
        break;
    case 'realizarAvaliacao':
        if (ClsAvaliacao::realizarAvaliacao($matricula, $avaliacao_id, $questao)) {
            echo json_encode(array(resp => 'OK', mensagem => 'Respostas salvas com sucesso!'));
        }else{
            echo json_encode(array(resp => 'ERRO', mensagem => 'Erro ao salvar respostas!'));
        }
        break;

    default:
        break;
}