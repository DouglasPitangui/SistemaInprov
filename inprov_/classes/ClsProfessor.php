<?php

@include_once '../auto_load.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClsAluno
 *
 * @author JoãoAndré
 */
class ClsProfessor extends ClsPessoa {

    private $funcao;
    private $formacao;

    function __construct($matricula = "", $nome = "", $email = "", $cpf = "", $telefone = "", $dataDeNascimento = "", $senha = "", $funcao = "", $formacao = "") {
        parent::__construct($matricula, $nome, $email, $cpf, $telefone, $dataDeNascimento, $senha);
        $this->funcao = $funcao;
        $this->formacao = $formacao;
    }

    public function getFuncao() {
        return $this->funcao;
    }

    public function getFormacao() {
        return $this->formacao;
    }

    public function setFuncao($funcao) {
        $this->funcao = $funcao;
    }

    public function setFormacao($formacao) {
        $this->formacao = $formacao;
    }

    public function __toString() {
        $v = parent::__toString();
        foreach ($this as $key => $value) {
            $v .= "$key => $value,<br/>";
        }
        return $v;
    }

    function insertProfessor() {
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();
            $myId = parent::insertPessoa($conn);
//            echo "myId: $myId";

            $sql = "\n INSERT INTO professor(matricula,funcao_id,formacao)";
            $sql .= "\n VALUES";
            $sql .= "\n      (:matricula,:funcao_id,:formacao)";

            $rs = $conn->prepare($sql);
            $parr = array(
                ':matricula' => $myId,
                ':funcao_id' => $this->funcao,
                ':formacao' => $this->formacao
            );
//            echo $rs->debugDumpParams()."<br/>";
            try {
                $rs->execute($parr);
                $conn->commit();
            } catch (Exception $ex) {
                $conn->rollback();
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return FALSE;
            } catch (PDOExecption $e) {
                $conn->rollback();
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($e->getMessage(), "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return FALSE;
            }
        } catch (Exception $ex) {
            $conn->rollBack();
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        } catch (PDOExecption $e) {
            $conn->rollBack();
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($e->getMessage(), "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        }
        return TRUE;
    }

    function updateProfessor() {
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();
            if (!parent::updatePessoa($conn)) return FALSE;

            $sql = "\n UPDATE professor";
            $sql .= "\n SET funcao_id = :funcao_id,formacao = :formacao";
            $sql .= "\n WHERE matricula = :matricula";

            $rs = $conn->prepare($sql);
            $parr = array(
                ':matricula' => parent::getMatricula(),
                ':funcao_id' => $this->funcao,
                ':formacao' => $this->formacao
            );
//            echo $rs->debugDumpParams()."<br/>";
            try {
                $rs->execute($parr);
                $conn->commit();
            } catch (Exception $ex) {
                $conn->rollback();
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return FALSE;
            } catch (PDOExecption $e) {
                $conn->rollback();
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($e->getMessage(), "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
//                print "Error!: " . $e->getMessage() . "</br>";
                return FALSE;
            }
        } catch (Exception $ex) {
            $conn->rollBack();
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        } catch (PDOExecption $e) {
            $conn->rollBack();
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($e->getMessage(), "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);

//            print "Error!: " . $e->getMessage() . "</br>";
            return FALSE;
        }
        return TRUE;
    }
    
    static function selectProfessor($param = array()) {
//        var_dump($param);
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        try {
            $conn = ClsConn::getConn();

            $sql = "\n SELECT";
            $sql .= "\n      pessoa.matricula,";
            $sql .= "\n      pessoa.nome,";
            $sql .= "\n      pessoa.cpf,";
            $sql .= "\n      pessoa.email,";
            $sql .= "\n      pessoa.telefone,";
            $sql .= "\n      DATE_FORMAT(pessoa.dataDeNascimento,'%d/%m/%Y') as dataDeNascimento,";
            $sql .= "\n      pessoa.senha,";
            $sql .= "\n      professor.funcao_id,";
            $sql .= "\n      professor.formacao";
            $sql .= "\n      ,funcao.funcao";
            $sql .= "\n FROM";
            $sql .= "\n      pessoa";
            $sql .= "\n INNER JOIN professor ON professor.matricula = pessoa.matricula";
            $sql .= "\n INNER JOIN funcao ON professor.funcao_id = funcao.funcao_id";
            $sql .= "\n WHERE";
            $sql .= "\n      pessoa.matricula";
            if ($matricula) {
                $parr[':matricula'] = $matricula;
                $sql .= "\n AND pessoa.matricula = :matricula";
            }
            if ($login) {
                $parr[':nome'] = $login;
                $parr[':matricula'] = $login;
                $sql .= "\n AND ( ";
                $sql .= "\n         pessoa.nome = :nome";
                $sql .= "\n         OR pessoa.matricula = :matricula )";
//                $parr[':login'] = $login;
//                if (is_numeric($login)){
////                    $parr[':login'] = (int)$login;
//                    $sql .= "\n AND pessoa.matricula = :login";
//                }else{
////                    $parr[':login'] = $login;
//                    $sql .= "\n AND pessoa.nome like :login";
//                }
            }
            if ($senha) {
                $parr[':senha'] = $senha;
                $sql .= "\n AND pessoa.senha = :senha";
            }
            if ($filtrar) {
                $parr[':nome'] = "%$filtrar%";
                $sql .= "\n AND pessoa.nome LIKE :nome";
            }
            if ($curso) {
                $parr[':curso'] = "%$curso%";
                $sql .= "\n AND aluno.curso LIKE :curso";
            }
            if ($formacao) {
                $parr[':formacao'] = "%$formacao%";
                $sql .= "\n AND professor.formacao LIKE :formacao";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      TRIM(pessoa.nome) ASC,";
            $sql .= "\n      TRIM(pessoa.matricula) ASC";
            if (!$contar and ($limit or $offset)) {
                $sql .= "\n LIMIT $limit OFFSET $offset";
            }
            
            $rs = $conn->prepare($sql);
            try {
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/>";
                if ($contar) {
                    return $rs->rowCount();
                }else{
                    return $rs->fetchAll(PDO::FETCH_OBJ);
                }
//                return $conn->query($sql);
            } catch (Exception $ex) {
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return FALSE;
            } catch (PDOExecption $e) {
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($e->getMessage(), "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return FALSE;
            }
        } catch (Exception $ex) {
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        } catch (PDOExecption $e) {
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($e->getMessage(), "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        }
    }
    
    function insertDisciplina($disciplinas_id = "") {
//        var_dump($disciplinas_id);
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();
            
            $parr = array(
                ':matricula' => parent::getMatricula()
            );

            $sql = "\n DELETE FROM professorministradisciplina";
            $sql .= "\n WHERE matricula = :matricula;";
            $rs = $conn->prepare($sql);
            $rs->execute($parr);
            
            if ($disciplinas_id) {
                $sql = "\n INSERT INTO professorministradisciplina (matricula, disciplina_id)";
                $sql .= "\n VALUES";
                foreach ($disciplinas_id as $key => $value) {
                    $parr[":disciplina_id$key"] = $value;
                    $sql .= "\n      (:matricula, :disciplina_id$key),";
                }
                $sql = trim($sql, ',');
            }

            $rs = $conn->prepare($sql);
            try {
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/>";
                $conn->commit();
            } catch (Exception $ex) {
                $conn->rollback();
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return FALSE;
            } catch (PDOExecption $e) {
                $conn->rollback();
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($e->getMessage(), "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
//                print "Error!: " . $e->getMessage() . "</br>";
                return FALSE;
            }
        } catch (Exception $ex) {
            $conn->rollBack();
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        } catch (PDOExecption $e) {
            $conn->rollBack();
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($e->getMessage(), "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);

//            print "Error!: " . $e->getMessage() . "</br>";
            return FALSE;
        }
        return TRUE;
    }
    
    static function selectDisciplina($param = array()) {
//        var_dump($param);
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        try {
            $conn = ClsConn::getConn();

            $sql = "\n SELECT";
            $sql .= "\n      professorministradisciplina.disciplina_id,";
            $sql .= "\n      professorministradisciplina.matricula,";
            $sql .= "\n      disciplina.nome,";
            $sql .= "\n      disciplina.cargaHoraria,";
            $sql .= "\n      disciplina.disciplina_id";
            $sql .= "\n FROM";
            $sql .= "\n      professorministradisciplina";
            $sql .= "\n INNER JOIN disciplina ON professorministradisciplina.disciplina_id = disciplina.disciplina_id";
            $sql .= "\n WHERE";
            $sql .= "\n      professorministradisciplina.matricula";
            if ($matricula) {
                $parr[':matricula'] = $matricula;
                $sql .= "\n AND professorministradisciplina.matricula = :matricula";
            }
            if ($disciplina_id) {
                $parr[':nome'] = "%$disciplina_id%";
                $sql .= "\n AND professorministradisciplina.disciplina_id = :disciplina_id";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      TRIM(disciplina.nome) ASC";
            if (!$contar and ($limit or $offset)) {
                $sql .= "\n LIMIT $limit OFFSET $offset";
            }
            
            $rs = $conn->prepare($sql);
            try {
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/>";
                if ($contar) {
                    return $rs->rowCount();
                }else{
                    return $rs->fetchAll(PDO::FETCH_OBJ);
                }
//                return $conn->query($sql);
            } catch (Exception $ex) {
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return FALSE;
            } catch (PDOExecption $e) {
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($e->getMessage(), "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return FALSE;
            }
        } catch (Exception $ex) {
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        } catch (PDOExecption $e) {
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($e->getMessage(), "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        }
    }
}
