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
class ClsAluno extends ClsPessoa {

    private $curso;
    private $status;

    function __construct($matricula = "", $nome = "", $email = "", $cpf = "", $telefone = "", $dataDeNascimento = "", $senha = "", $curso = "", $status = "") {
        parent::__construct($matricula, $nome, $email, $cpf, $telefone, $dataDeNascimento, $senha);
//    function __construct($curso, $status) {
        $this->curso = $curso;
        $this->status = $status;
    }

    public function __toString() {
        $v = parent::__toString();
        foreach ($this as $key => $value) {
            $v .= "$key => $value,<br/>";
        }
        return $v;
//        return parent::__toString()."curso => $this->curso,<br/>"."status => $this->status";
    }
    
    public function getCurso() {
        return $this->curso;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setCurso($curso) {
        $this->curso = $curso;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    function insertAluno() {
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();
            $myId = parent::insertPessoa($conn);

            $sql = "\n INSERT INTO aluno(matricula,curso,status)";
            $sql .= "\n VALUES";
            $sql .= "\n      (:matricula,:curso,:status)";

            $rs = $conn->prepare($sql);
            $parr = array(
                ':matricula' => $myId,
                ':curso' => $this->curso,
                ':status' => $this->status
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

    function updateAluno() {
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();
            if (!parent::updatePessoa($conn)) return FALSE;

            $sql = "\n UPDATE aluno";
            $sql .= "\n SET curso = :curso,status = :status";
            $sql .= "\n WHERE matricula = :matricula";

            $rs = $conn->prepare($sql);
            $parr = array(
                ':matricula' => parent::getMatricula(),
                ':curso' => $this->curso,
                ':status' => $this->status
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

    static function selectAluno($param = array()) {
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
            $sql .= "\n      aluno.curso,";
            $sql .= "\n      aluno.`status`,";
            $sql .= "\n      CASE aluno.`status`";
            $sql .= "\n      WHEN 0 THEN";
            $sql .= "\n           'Trancado'";
            $sql .= "\n      WHEN 1 THEN";
            $sql .= "\n           'Cursando'";
            $sql .= "\n      WHEN 2 THEN";
            $sql .= "\n           'Concluido'";
            $sql .= "\n      END AS situacao";
            $sql .= "\n FROM";
            $sql .= "\n      pessoa";
            $sql .= "\n INNER JOIN aluno ON aluno.matricula = pessoa.matricula";
            $sql .= "\n WHERE";
            $sql .= "\n      pessoa.matricula";
            if ($matricula) {
                $parr[':matricula'] = $matricula;
                $sql .= "\n AND pessoa.matricula = :matricula";
            }
            if ($senha) {
                $parr[':senha'] = $senha;
                $sql .= "\n AND pessoa.senha = :senha";
            }
            if ($filtrar) {
                $parr[':nome'] = "%$filtrar%";
                $sql .= "\n AND pessoa.nome LIKE :nome";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      TRIM(pessoa.nome) ASC,";
            $sql .= "\n      TRIM(pessoa.matricula) ASC";
            if (!$contar and ($limit or $offset)) {
//                $parr[':limit'] = $limit;
//                $parr[':offset'] = $offset;
//                $sql .= "\n LIMIT :limit OFFSET :offset";
                $sql .= "\n LIMIT $limit OFFSET $offset";
            }
            
            $rs = $conn->prepare($sql);
//            echo $rs->debugDumpParams()."<br/>";
            try {
                $rs->execute($parr);
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

            $sql = "\n DELETE FROM alunocursadisciplina";
            $sql .= "\n WHERE matricula = :matricula;";
//SELECT
//     alunocursadisciplina.matricula
//FROM
//     alunocursadisciplina
//INNER JOIN aluno ON alunocursadisciplina.matricula = aluno.matricula
//INNER JOIN respostaaluno ON respostaaluno.matricula = aluno.matricula
//WHERE
//     aluno.matricula = 5
            $rs = $conn->prepare($sql);
            $rs->execute($parr);
            
            if ($disciplinas_id) {
                $sql = "\n INSERT IGNORE INTO alunocursadisciplina (matricula, disciplina_id)";
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
            $sql .= "\n      alunocursadisciplina.matricula,";
            $sql .= "\n      DATE_FORMAT(alunocursadisciplina.datacursada, '%d/%m/%Y') AS dataCursadaF,";
            $sql .= "\n      alunocursadisciplina.datacursada,";
            $sql .= "\n      disciplina.disciplina_id,";
            $sql .= "\n      disciplina.nome,";
            $sql .= "\n      disciplina.cargaHoraria";
            $sql .= "\n FROM";
            $sql .= "\n      alunocursadisciplina";
            $sql .= "\n INNER JOIN disciplina ON alunocursadisciplina.disciplina_id = disciplina.disciplina_id";
            $sql .= "\n WHERE";
            $sql .= "\n      alunocursadisciplina.matricula";
            if ($matricula) {
                $parr[':matricula'] = $matricula;
                $sql .= "\n AND alunocursadisciplina.matricula = :matricula";
            }
            if ($disciplina_id) {
                $parr[':nome'] = "%$disciplina_id%";
                $sql .= "\n AND alunocursadisciplina.disciplina_id = :disciplina_id";
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
