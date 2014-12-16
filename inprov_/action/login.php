<?php

//use conn;

session_start();
ob_start();
ini_set('default_charset', 'UTF-8');

include_once '../auto_load.php';

//var_dump($_REQUEST);

$login = $_REQUEST['matricula'];
$pass = $_REQUEST['senha'];

$parr = array(
    login => $login,
    senha => $pass
);
$Pessoa = ClsPessoa::selectPessoa($parr);

if (count($Pessoa) == 1) {
    $parr = array(
        login => $login,
        senha => $pass
    );
    $Professor = ClsProfessor::selectProfessor($parr);
//    var_dump($Professor);
//    echo count($Professor);
    if (count($Professor) == 1) {
        $_SESSION['matricula'] = $login;
        $_SESSION['funcao_id'] = $Professor[0]->funcao_id;
        echo json_encode(array('resp' => 'OK'));
    }else{
        $parr = array(
            matricula => $login,
            senha => $pass
        );
        $Aluno = ClsAluno::selectAluno($parr);
//        var_dump($Aluno);
//        echo count($Aluno);
        $_SESSION['matricula'] = $login;
        echo json_encode(array('resp' => 'OK'));
    }
    
} else {
    echo json_encode(array('resp' => 'ERRO', msg => 'Credenciais Inválidas'));
    exit();
}






die();
$conn = ClsConn::getConn();
$rs = $conn->prepare("
SELECT
	pessoa.id,
	pessoa.nome,
	pessoa.cpf,
	pessoa.email,
	pessoa.matricula,
	pessoa.telefone,
	pessoa.dataDeNascimento,
	pessoa.senha,
	professor.pessoa_id,
	professor.papel_id,
	professor.formacao,
	aluno.pessoa_id,
	aluno.curso,
	aluno.`status`
FROM
	pessoa
LEFT JOIN professor ON professor.pessoa_id = pessoa.matricula
LEFT JOIN aluno ON aluno.pessoa_id = pessoa.matricula
WHERE
	(
		pessoa.matricula LIKE ?
		OR pessoa.nome LIKE ?
	)
        AND (pessoa.senha = ?) ");

$rs->bindParam(1, $login);
$rs->bindParam(2, $login);
$rs->bindParam(3, $pass);

//echo $rs->queryString;

if ($rs->execute()) {
    if ($rs->rowCount() > 0) {
        while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
//            var_dump($row);
//            echo "Bem vindo: " . $row->nome . "“<br />”";
            $_SESSION['matricula'] = $login;
            $_SESSION['tipo'] = "P";

            echo json_encode(array('resp' => 'OK'));
            exit();
        }
//        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
//            echo "Nome: {$linha['nome']} - Usuário: {$linha['usuario']}<br />";
//        }
//Read more: http://www.linhadecodigo.com.br/artigo/3638/php-pdo-como-se-conectar-ao-banco-de-dados.aspx#ixzz3BBAE44Vg
//PDO :: FETCH_ASSOC: Retorna uma matriz.
//PDO :: FETCH_BOTH: Retorna uma matriz, indexada pelo nome da coluna e 0-indexados.
//PDO :: FETCH_BOUND: Retorna TRUE e atribui os valores das colunas no seu conjunto de resultados para as variáveis ​​PHP que estavam amarradas.
//PDO :: FETCH_CLASS: Retorna uma nova instância da classe especificada.
//PDO :: FETCH_OBJ: Retorna um objeto anônimo, com nomes de propriedades que correspondem às colunas.
    } else {
        echo json_encode(array('resp' => 'ERRO', msg => 'Credenciais Inválidas'));
        exit();
//            echo "Nenhum usuario encontrado";
    }
} else {
    echo json_encode(array('resp' => 'ERRO'));
    exit();
}
?>