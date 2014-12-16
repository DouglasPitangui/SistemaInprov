<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClsAvaliacao
 *
 * @author JoãoAndré
 */
class ClsAvaliacao {

    private $avaliacao_id;
    private $matricula;
    private $disciplina_id;
    private $nome;
    private $dataInicio;
    private $dataFim;
    private $tempoMaximo;
    private $questao_id;

    function __construct($avaliacao_id, $matricula, $disciplina_id, $nome, $dataInicio, $dataFim, $tempoMaximo, $questao_id) {
        $this->avaliacao_id = $avaliacao_id;
        $this->matricula = $matricula;
        $this->disciplina_id = $disciplina_id;
        $this->nome = $nome;
//        $date = DateTime::createFromFormat('d/m/Y', $dataDeNascimento);
//        $dataDeNascimento = $date->format('Y-m-d');
        $this->dataInicio = DateTime::createFromFormat('d/m/Y', $dataInicio)->format('Y-m-d');
        $this->dataFim = DateTime::createFromFormat('d/m/Y', $dataFim)->format('Y-m-d');
        ;
        $this->tempoMaximo = $tempoMaximo;
        $this->questao_id = $questao_id;
    }

    public function __toString() {
        $v = "";
        foreach ($this as $key => $value) {
            $v .= "$key => $value,<br/>";
        }
        return $v; // = "Senha = $this->senha";
    }

    public function getAvaliacao_id() {
        return $this->avaliacao_id;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function getDisciplina_id() {
        return $this->disciplina_id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDataInicio() {
        return $this->dataInicio;
    }

    public function getDataFim() {
        return $this->dataFim;
    }

    public function getTempoMaximo() {
        return $this->tempoMaximo;
    }

    public function getQuestao_id() {
        return $this->questao_id;
    }

    public function setAvaliacao_id($avaliacao_id) {
        $this->avaliacao_id = $avaliacao_id;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setDisciplina_id($disciplina_id) {
        $this->disciplina_id = $disciplina_id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDataInicio($dataInicio) {
        $this->dataInicio = DateTime::createFromFormat('d/m/Y', $dataInicio)->format('Y-m-d');
    }

    public function setDataFim($dataFim) {
        $this->dataFim = DateTime::createFromFormat('d/m/Y', $dataFim)->format('Y-m-d');
        ;
    }

    public function setTempoMaximo($tempoMaximo) {
        $this->tempoMaximo = $tempoMaximo;
    }

    public function setQuestao_id($questao_id) {
        $this->questao_id = $questao_id;
    }

    function insertAvaliacao() {
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();

            $sql = "\n INSERT INTO avaliacao(matricula,disciplina_id,nome,dataInicio,dataFim,tempoMaximo)";
            $sql .= "\n VALUES";
            $sql .= "\n      (:matricula,:disciplina_id,:nome,:dataInicio,:dataFim,:tempoMaximo)";

            $rs = $conn->prepare($sql);
            $parr = array(
                ':matricula' => $this->matricula,
                ':disciplina_id' => $this->disciplina_id,
                ':nome' => $this->nome,
                ':dataInicio' => $this->dataInicio,
                ':dataFim' => $this->dataFim,
                ':tempoMaximo' => $this->tempoMaximo
            );

            $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/>";
            $this->avaliacao_id = $conn->lastInsertId();

            $parr = array(
                ':avaliacao_id' => $this->avaliacao_id
            );
            $sql = "\n INSERT INTO questaodaavaliacao(avaliacao_id, questao_id)";
            $sql .= "\n VALUES";
            foreach ($this->questao_id as $key => $questao) {
                $sql .= "\n      (:avaliacao_id, :questao_id$key),";
                $parr[":questao_id$key"] = $questao;
            }
            $sql = trim($sql, ',');
            $rs = $conn->prepare($sql);

            $rs->execute($parr);
            $conn->commit();
        } catch (Exception $ex) {
            $conn->rollBack();
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        } catch (PDOExecption $e) {
            $conn->rollBack();
            print "Error!: " . $e->getMessage() . "</br>";
            return null;
        }

        return $this->avaliacao_id;
    }

    function updateAvaliacao() {
//        var_dump($this);
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();

            $sql = "\n UPDATE avaliacao";
            $sql .= "\n SET matricula = :matricula,disciplina_id = :disciplina_id,nome = :nome,dataInicio = :dataInicio,dataFim = :dataFim,tempoMaximo = :tempoMaximo";
            $sql .= "\n WHERE avaliacao_id = :avaliacao_id";

            $parr = array(
                ':avaliacao_id' => $this->avaliacao_id,
                ':matricula' => $this->matricula,
                ':disciplina_id' => $this->disciplina_id,
                ':nome' => $this->nome,
                ':dataInicio' => $this->dataInicio,
                ':dataFim' => $this->dataFim,
                ':tempoMaximo' => $this->tempoMaximo
            );
            $rs = $conn->prepare($sql);
            $rs->execute($parr);
//            echo $rs->debugDumpParams()."<br/><br/>";

            $parr = array(
                ':avaliacao_id' => (int) $this->avaliacao_id
            );
            $sql = "\n DELETE FROM questaodaavaliacao";
            $sql .= "\n WHERE questaodaavaliacao.avaliacao_id = :avaliacao_id";
            $rs = $conn->prepare($sql);
            $rs->execute($parr);
//            echo $rs->debugDumpParams() . "<br/><br/>";

            $parr = array(
                ':avaliacao_id' => (int) $this->avaliacao_id
            );
            $sql = "\n INSERT INTO questaodaavaliacao(avaliacao_id, questao_id)";
            $sql .= "\n VALUES";
            foreach ($this->questao_id as $key => $questao) {
                $sql .= "\n      (:avaliacao_id, :questao_id$key),";
                $parr[":questao_id$key"] = (int) $questao;
            }
            $sql = trim($sql, ',');

            $rs = $conn->prepare($sql);
            $rs->execute($parr);

//            echo $rs->debugDumpParams() . "<br/><br/>";
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
        return TRUE;
    }

    function deleteAvaliacao() {
//        var_dump($this);
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();

            $parr = array(
                ':avaliacao_id' => $this->avaliacao_id,
            );

            $sql = "\n DELETE FROM questaodaavaliacao";
            $sql .= "\n WHERE avaliacao_id = :avaliacao_id;";

            $rs = $conn->prepare($sql);
            $rs->execute($parr);
//            var_dump($rs->rowCount());

            $sql = "\n DELETE FROM avaliacao";
            $sql .= "\n WHERE avaliacao_id = :avaliacao_id;";
            $rs = $conn->prepare($sql);
            $rs->execute($parr);
//            var_dump($rs->rowCount());
//            echo $rs->debugDumpParams() . "<br/><br/>";
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
        return TRUE;
    }

    static function selectAvaliacaoAluno($param = array()) {
//        echo "Elaboradas";
//        var_dump($param);
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        try {
            $conn = ClsConn::getConn();

            $sql .= "\n SELECT DISTINCTROW";
            $sql .= "\n      avaliacao.avaliacao_id,";
            $sql .= "\n      avaliacao.matricula,";
            $sql .= "\n      avaliacao.disciplina_id,";
            $sql .= "\n      avaliacao.nome,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataInicio,'%d/%m/%Y') as dataInicio,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataFim,'%d/%m/%Y') as dataFim,";
            $sql .= "\n      avaliacao.tempoMaximo,";
            $sql .= "\n      disciplina.nome as nomeDisciplina,";
            $sql .= "\n      disciplina.cargaHoraria,";
            $sql .= "\n      pessoa.nome AS nomePessoa,";
            $sql .= "\n      pessoa.cpf,";
            $sql .= "\n      pessoa.email,";
            $sql .= "\n      pessoa.telefone,";
            $sql .= "\n      pessoa.dataDeNascimento,";
            $sql .= "\n      pessoa.senha";
            $sql .= "\n FROM";
            $sql .= "\n      avaliacao";
            $sql .= "\n INNER JOIN disciplina ON avaliacao.disciplina_id = disciplina.disciplina_id";
            $sql .= "\n INNER JOIN pessoa ON avaliacao.matricula = pessoa.matricula";
            $sql .= "\n INNER JOIN respostaaluno ON avaliacao.avaliacao_id = respostaaluno.avaliacao_id";
            $sql .= "\n WHERE";
            $sql .= "\n      avaliacao.avaliacao_id";

            $sql = "\n SELECT";
            $sql .= "\n      avaliacao.avaliacao_id,";
            $sql .= "\n      avaliacao.matricula,";
            $sql .= "\n      avaliacao.nome,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataInicio,'%d/%m/%Y') as dataInicio,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataFim,'%d/%m/%Y') as dataFim,";
            $sql .= "\n      avaliacao.tempoMaximo,";
            $sql .= "\n      disciplina.disciplina_id,";
            $sql .= "\n      disciplina.nome as nomeDisciplina,";
            $sql .= "\n      disciplina.cargaHoraria,";
//            $sql .= "\n      pessoa.nome AS nomePessoa,";
            $sql .= "\n      (SELECT nome from pessoa WHERE pessoa.matricula = avaliacao.matricula) AS nomePessoa,";
            $sql .= "\n      pessoa.cpf,";
            $sql .= "\n      pessoa.email,";
            $sql .= "\n      pessoa.telefone,";
            $sql .= "\n      pessoa.dataDeNascimento,";
            $sql .= "\n      pessoa.senha,";
            $sql .= "\n      aluno.curso,";
            $sql .= "\n      aluno.`status`";
            $sql .= "\n FROM";
            $sql .= "\n      avaliacao";
            $sql .= "\n INNER JOIN disciplina ON avaliacao.disciplina_id = disciplina.disciplina_id";
            $sql .= "\n INNER JOIN alunocursadisciplina ON alunocursadisciplina.disciplina_id = disciplina.disciplina_id";
            $sql .= "\n INNER JOIN aluno ON alunocursadisciplina.matricula = aluno.matricula";
            $sql .= "\n INNER JOIN pessoa ON aluno.matricula = pessoa.matricula";
            $sql .= "\n WHERE";
            $sql .= "\n      avaliacao.avaliacao_id";
            $sql .= "\n AND DATE_FORMAT(now(),'%Y/%m/%d') BETWEEN dataInicio and dataFim";
            $sql .= "\n AND avaliacao.avaliacao_id NOT IN (";
            $sql .= "\n      SELECT DISTINCTROW";
            $sql .= "\n           respostaaluno.avaliacao_id";
            $sql .= "\n      FROM";
            $sql .= "\n           respostaaluno";
            $sql .= "\n      WHERE";
            $sql .= "\n            respostaaluno.matricula = pessoa.matricula";
            $sql .= "\n       AND respostaaluno.avaliacao_id = avaliacao.avaliacao_id";
            $sql .= "\n )";

            if ($avaliacao_id) {
                $parr[':avaliacao_id'] = $avaliacao_id;
                $sql .= "\n AND avaliacao.avaliacao_id = :avaliacao_id";
            }
            if ($disciplina_id) {
                $parr[':disciplina_id'] = $disciplina_id;
                $sql .= "\n AND avaliacao.disciplina_id = :disciplina_id";
            }
            if ($matricula) {
                $parr[':matricula'] = $matricula;
                $sql .= "\n AND pessoa.matricula = :matricula";
            }
            if ($filtrar) {
                $parr[':filtrar'] = "%$filtrar%";
                $sql .= "\n AND (";
                $sql .= "\n      avaliacao.nome LIKE :filtrar";
                $sql .= "\n      OR disciplina.nome LIKE :filtrar )";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      avaliacao.nome ASC,";
            $sql .= "\n      nomeDisciplina ASC,";
            $sql .= "\n      nomePessoa ASC";
            if (!$contar and ( $limit or $offset)) {
                $sql .= "\n LIMIT $limit OFFSET $offset";
            }
//            echo "$sql<br/>";
//            include_once 'ClsGravaLog.php';
//            $gravalog = new ClsGravaLog;
//            $gravalog->fazLog(__FILE__ . " Linha: " . __LINE__ . " " . __FUNCTION__ . " $sql", basename(__FILE__));

            $rs = $conn->prepare($sql);
            try {
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/>";
                if ($contar) {
                    return $rs->rowCount();
                } else {
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

    static function selectAvaliacaoAplicadaAluno($param = array()) {
//        echo "Aplicadas";
//        var_dump($param);
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        try {
            $conn = ClsConn::getConn();

            $sql = "\n SELECT";
            $sql .= "\n      avaliacao.avaliacao_id,";
            $sql .= "\n      avaliacao.matricula,";
            $sql .= "\n      avaliacao.nome,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataInicio,'%d/%m/%Y') as dataInicio,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataFim,'%d/%m/%Y') as dataFim,";
            $sql .= "\n      avaliacao.tempoMaximo,";
            $sql .= "\n      disciplina.disciplina_id,";
            $sql .= "\n      disciplina.nome as nomeDisciplina,";
            $sql .= "\n      disciplina.cargaHoraria,";
//            $sql .= "\n      pessoa.nome AS nomePessoa,";
            $sql .= "\n      (SELECT nome from pessoa WHERE pessoa.matricula = avaliacao.matricula) AS nomePessoa,";
            $sql .= "\n      pessoa.cpf,";
            $sql .= "\n      pessoa.email,";
            $sql .= "\n      pessoa.telefone,";
            $sql .= "\n      pessoa.dataDeNascimento,";
            $sql .= "\n      pessoa.senha,";
            $sql .= "\n      aluno.curso,";
            $sql .= "\n      aluno.`status`";
            $sql .= "\n FROM";
            $sql .= "\n      avaliacao";
            $sql .= "\n INNER JOIN disciplina ON avaliacao.disciplina_id = disciplina.disciplina_id";
            $sql .= "\n INNER JOIN alunocursadisciplina ON alunocursadisciplina.disciplina_id = disciplina.disciplina_id";
            $sql .= "\n INNER JOIN aluno ON alunocursadisciplina.matricula = aluno.matricula";
            $sql .= "\n INNER JOIN pessoa ON aluno.matricula = pessoa.matricula";
            $sql .= "\n WHERE";
            $sql .= "\n      avaliacao.avaliacao_id";
            $sql .= "\n AND avaliacao.avaliacao_id IN (";
            $sql .= "\n      SELECT DISTINCTROW";
            $sql .= "\n           respostaaluno.avaliacao_id";
            $sql .= "\n      FROM";
            $sql .= "\n           respostaaluno";
            $sql .= "\n      WHERE";
            $sql .= "\n            respostaaluno.matricula = pessoa.matricula";
            $sql .= "\n       AND ";
            $sql .= "\n respostaaluno.avaliacao_id = avaliacao.avaliacao_id";
            
            
            $sql .= "\n AND ISNULL(respostaAluno.respostaAlunoNota)";

            
            $sql .= "\n )";
            
            if ($avaliacao_id) {
                $parr[':avaliacao_id'] = $avaliacao_id;
                $sql .= "\n AND avaliacao.avaliacao_id = :avaliacao_id";
            }
            if ($disciplina_id) {
                $parr[':disciplina_id'] = $disciplina_id;
                $sql .= "\n AND avaliacao.disciplina_id = :disciplina_id";
            }
            if ($matricula) {
                $parr[':matricula'] = $matricula;
                $sql .= "\n AND pessoa.matricula = :matricula";
            }
            if ($filtrar) {
                $parr[':filtrar'] = "%$filtrar%";
                $sql .= "\n AND (";
                $sql .= "\n      avaliacao.nome LIKE :filtrar";
                $sql .= "\n      OR disciplina.nome LIKE :filtrar )";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      avaliacao.nome ASC";
            $sql .= "\n      ,nomeDisciplina ASC,";
            $sql .= "\n      nomePessoa ASC";
            if (!$contar and ( $limit or $offset)) {
                $sql .= "\n LIMIT $limit OFFSET $offset";
            }
//            echo "$sql<br/>";
            $rs = $conn->prepare($sql);
            try {
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/>";
                if ($contar) {
                    return $rs->rowCount();
                } else {
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

    static function selectAvaliacaoCorrigidaAluno($param = array()) {
//        echo "Corrigidas";
//        var_dump($param);
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        try {
            $conn = ClsConn::getConn();

            $sql = "\n SELECT DISTINCT";
            $sql .= "\n      avaliacao.avaliacao_id,";
            $sql .= "\n      avaliacao.matricula,";
            $sql .= "\n      avaliacao.disciplina_id,";
            $sql .= "\n      avaliacao.nome,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataInicio,'%d/%m/%Y') as dataInicio,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataFim,'%d/%m/%Y') as dataFim,";
            $sql .= "\n      avaliacao.tempoMaximo,";
            $sql .= "\n      disciplina.nome as nomeDisciplina,";
            $sql .= "\n      disciplina.cargaHoraria,";
            $sql .= "\n      pessoa.nome AS nomePessoa,";
            $sql .= "\n      pessoa.cpf,";
            $sql .= "\n      pessoa.email,";
            $sql .= "\n      pessoa.telefone,";
            $sql .= "\n      pessoa.dataDeNascimento,";
            $sql .= "\n      pessoa.senha";
            $sql .= "\n FROM";
            $sql .= "\n      avaliacao";
            $sql .= "\n INNER JOIN disciplina ON avaliacao.disciplina_id = disciplina.disciplina_id";
            $sql .= "\n INNER JOIN pessoa ON avaliacao.matricula = pessoa.matricula";
            $sql .= "\n INNER JOIN respostaaluno ON respostaaluno.avaliacao_id = avaliacao.avaliacao_id";
            $sql .= "\n WHERE";
            $sql .= "\n      avaliacao.avaliacao_id";
            $sql .= "\n AND NOT ISNULL(respostaAluno.respostaAlunoNota)";
            if ($avaliacao_id) {
                $parr[':avaliacao_id'] = $avaliacao_id;
                $sql .= "\n AND avaliacao.avaliacao_id = :avaliacao_id";
            }
            if ($disciplina_id) {
                $parr[':disciplina_id'] = $disciplina_id;
                $sql .= "\n AND avaliacao.disciplina_id = :disciplina_id";
            }
            if ($matricula) {
                $parr[':matricula'] = $matricula;
                $sql .= "\n AND respostaaluno.matricula = :matricula";
            }
            if ($filtrar) {
                $parr[':filtrar'] = "%$filtrar%";
                $sql .= "\n AND (";
                $sql .= "\n      avaliacao.nome LIKE :filtrar";
                $sql .= "\n      OR disciplina.nome LIKE :filtrar )";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      avaliacao.nome ASC";
            $sql .= "\n      ,nomeDisciplina ASC,";
            $sql .= "\n      nomePessoa ASC";
            if (!$contar and ( $limit or $offset)) {
                $sql .= "\n LIMIT $limit OFFSET $offset";
            }
//            echo "$sql<br/>";

            $rs = $conn->prepare($sql);
            try {
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/>";
                if ($contar) {
                    return $rs->rowCount();
                } else {
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

    static function selectAvaliacaoProfessor($param = array()) {
//        echo "Elaboradas";
//        var_dump($param);
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        try {
            $conn = ClsConn::getConn();

            $sql .= "\n SELECT";
            $sql .= "\n      avaliacao.avaliacao_id,";
            $sql .= "\n      avaliacao.matricula,";
            $sql .= "\n      avaliacao.disciplina_id,";
            $sql .= "\n      avaliacao.nome,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataInicio,'%d/%m/%Y') as dataInicio,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataFim,'%d/%m/%Y') as dataFim,";
            $sql .= "\n      avaliacao.tempoMaximo,";
            $sql .= "\n      disciplina.nome as nomeDisciplina,";
            $sql .= "\n      disciplina.cargaHoraria,";
            $sql .= "\n      pessoa.nome AS nomePessoa,";
            $sql .= "\n      pessoa.cpf,";
            $sql .= "\n      pessoa.email,";
            $sql .= "\n      pessoa.telefone,";
            $sql .= "\n      pessoa.dataDeNascimento,";
            $sql .= "\n      pessoa.senha";
            $sql .= "\n FROM";
            $sql .= "\n      avaliacao";
            $sql .= "\n INNER JOIN disciplina ON avaliacao.disciplina_id = disciplina.disciplina_id";
            $sql .= "\n INNER JOIN pessoa ON avaliacao.matricula = pessoa.matricula";
            $sql .= "\n WHERE";
            $sql .= "\n      avaliacao.avaliacao_id";
            if ($avaliacao_id) {
                $parr[':avaliacao_id'] = $avaliacao_id;
                $sql .= "\n AND avaliacao.avaliacao_id = :avaliacao_id";
            }
            if ($disciplina_id) {
                $parr[':disciplina_id'] = $disciplina_id;
                $sql .= "\n AND avaliacao.disciplina_id = :disciplina_id";
            }
            if ($matricula) {
                $parr[':matricula'] = $matricula;
                $sql .= "\n AND avaliacao.matricula = :matricula";
            }
            if ($filtrar) {
                $parr[':filtrar'] = "%$filtrar%";
                $sql .= "\n AND (";
                $sql .= "\n      avaliacao.nome LIKE :filtrar";
                $sql .= "\n      OR disciplina.nome LIKE :filtrar )";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      avaliacao.nome ASC,";
            $sql .= "\n      nomeDisciplina ASC,";
            $sql .= "\n      nomePessoa ASC";
            if (!$contar and ( $limit or $offset)) {
                $sql .= "\n LIMIT $limit OFFSET $offset";
            }

            $rs = $conn->prepare($sql);
            try {
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/>";
                if ($contar) {
                    return $rs->rowCount();
                } else {
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

    static function selectAvaliacaoAplicadaProfessor($param = array()) {
//        echo "Aplicadas";
//        var_dump($param);
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        try {
            $conn = ClsConn::getConn();

            $sql = "\n SELECT DISTINCT";
            $sql .= "\n      avaliacao.avaliacao_id,";
            $sql .= "\n      avaliacao.matricula AS matriculaProfessor,";
            $sql .= "\n      avaliacao.disciplina_id,";
            $sql .= "\n      avaliacao.nome,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataInicio,'%d/%m/%Y') as dataInicio,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataFim,'%d/%m/%Y') as dataFim,";
            $sql .= "\n      avaliacao.tempoMaximo,";
            $sql .= "\n      disciplina.nome as nomeDisciplina,";
            $sql .= "\n      disciplina.cargaHoraria,";
            $sql .= "\n      pessoa.matricula,";
            $sql .= "\n      pessoa.nome AS nomePessoa,";
            $sql .= "\n      pessoa.cpf,";
            $sql .= "\n      pessoa.email,";
            $sql .= "\n      pessoa.telefone,";
            $sql .= "\n      pessoa.dataDeNascimento,";
            $sql .= "\n      pessoa.senha";
            $sql .= "\n FROM";
            $sql .= "\n      avaliacao";
            $sql .= "\n INNER JOIN disciplina ON avaliacao.disciplina_id = disciplina.disciplina_id";
            $sql .= "\n INNER JOIN respostaaluno ON respostaaluno.avaliacao_id = avaliacao.avaliacao_id";
            $sql .= "\n INNER JOIN pessoa ON respostaaluno.matricula = pessoa.matricula";
            $sql .= "\n WHERE";
            $sql .= "\n      avaliacao.avaliacao_id";
            $sql .= "\n AND ISNULL(respostaAluno.respostaAlunoNota)";
            if ($avaliacao_id) {
                $parr[':avaliacao_id'] = $avaliacao_id;
                $sql .= "\n AND avaliacao.avaliacao_id = :avaliacao_id";
            }
            if ($disciplina_id) {
                $parr[':disciplina_id'] = $disciplina_id;
                $sql .= "\n AND avaliacao.disciplina_id = :disciplina_id";
            }
            if ($matricula) {
                $parr[':matricula'] = $matricula;
                $sql .= "\n AND avaliacao.matricula = :matricula";
            }
            if ($filtrar) {
                $parr[':filtrar'] = "%$filtrar%";
                $sql .= "\n AND (";
                $sql .= "\n      avaliacao.nome LIKE :filtrar";
                $sql .= "\n      OR disciplina.nome LIKE :filtrar )";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      avaliacao.nome ASC";
            $sql .= "\n      ,nomeDisciplina ASC,";
            $sql .= "\n      nomePessoa ASC";
            if (!$contar and ( $limit or $offset)) {
                $sql .= "\n LIMIT $limit OFFSET $offset";
            }
//            echo "$sql<br/>";
            $rs = $conn->prepare($sql);
            try {
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/>";
                if ($contar) {
                    return $rs->rowCount();
                } else {
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

    static function selectAvaliacaoCorrigidaProfessor($param = array()) {
//        echo "Corrigidas";
//        var_dump($param);
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        try {
            $conn = ClsConn::getConn();

            $sql = "\n SELECT DISTINCT";
            $sql .= "\n      avaliacao.avaliacao_id,";
            $sql .= "\n      avaliacao.matricula AS matriculaProfessor,";
            $sql .= "\n      avaliacao.disciplina_id,";
            $sql .= "\n      avaliacao.nome,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataInicio,'%d/%m/%Y') as dataInicio,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataFim,'%d/%m/%Y') as dataFim,";
            $sql .= "\n      avaliacao.tempoMaximo,";
            $sql .= "\n      disciplina.nome as nomeDisciplina,";
            $sql .= "\n      disciplina.cargaHoraria,";
            $sql .= "\n      pessoa.matricula,";
            $sql .= "\n      pessoa.nome AS nomePessoa,";
            $sql .= "\n      pessoa.cpf,";
            $sql .= "\n      pessoa.email,";
            $sql .= "\n      pessoa.telefone,";
            $sql .= "\n      pessoa.dataDeNascimento,";
            $sql .= "\n      pessoa.senha";
            $sql .= "\n FROM";
            $sql .= "\n      avaliacao";
            $sql .= "\n INNER JOIN disciplina ON avaliacao.disciplina_id = disciplina.disciplina_id";
            $sql .= "\n INNER JOIN respostaaluno ON respostaaluno.avaliacao_id = avaliacao.avaliacao_id";
            $sql .= "\n INNER JOIN pessoa ON respostaaluno.matricula = pessoa.matricula AND respostaaluno.matricula = pessoa.matricula";
            $sql .= "\n WHERE";
            $sql .= "\n      avaliacao.avaliacao_id";
            $sql .= "\n AND NOT ISNULL(respostaAluno.respostaAlunoNota)";
            if ($avaliacao_id) {
                $parr[':avaliacao_id'] = $avaliacao_id;
                $sql .= "\n AND avaliacao.avaliacao_id = :avaliacao_id";
            }
            if ($disciplina_id) {
                $parr[':disciplina_id'] = $disciplina_id;
                $sql .= "\n AND avaliacao.disciplina_id = :disciplina_id";
            }
            if ($matricula) {
                $parr[':matricula'] = $matricula;
                $sql .= "\n AND avaliacao.matricula = :matricula";
            }
            if ($filtrar) {
                $parr[':filtrar'] = "%$filtrar%";
                $sql .= "\n AND (";
                $sql .= "\n      avaliacao.nome LIKE :filtrar";
                $sql .= "\n      OR disciplina.nome LIKE :filtrar )";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      avaliacao.nome ASC";
            $sql .= "\n      ,nomeDisciplina ASC,";
            $sql .= "\n      nomePessoa ASC";
            if (!$contar and ( $limit or $offset)) {
                $sql .= "\n LIMIT $limit OFFSET $offset";
            }

            $rs = $conn->prepare($sql);
            try {
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/>";
                if ($contar) {
                    return $rs->rowCount();
                } else {
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

    static function selectAvaliacao($param = array()) {
//        echo "Elaboradas";
//        var_dump($param);
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        try {
            $conn = ClsConn::getConn();

            $sql .= "\n SELECT";
            $sql .= "\n      avaliacao.avaliacao_id,";
            $sql .= "\n      avaliacao.matricula,";
            $sql .= "\n      avaliacao.disciplina_id,";
            $sql .= "\n      avaliacao.nome,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataInicio,'%d/%m/%Y') as dataInicio,";
            $sql .= "\n      DATE_FORMAT(avaliacao.dataFim,'%d/%m/%Y') as dataFim,";
            $sql .= "\n      avaliacao.tempoMaximo,";
            $sql .= "\n      disciplina.nome as nomeDisciplina,";
            $sql .= "\n      disciplina.cargaHoraria,";
            $sql .= "\n      pessoa.nome AS nomePessoa,";
            $sql .= "\n      pessoa.cpf,";
            $sql .= "\n      pessoa.email,";
            $sql .= "\n      pessoa.telefone,";
            $sql .= "\n      pessoa.dataDeNascimento,";
            $sql .= "\n      pessoa.senha";
            $sql .= "\n FROM";
            $sql .= "\n      avaliacao";
            $sql .= "\n INNER JOIN disciplina ON avaliacao.disciplina_id = disciplina.disciplina_id";
            $sql .= "\n INNER JOIN pessoa ON avaliacao.matricula = pessoa.matricula";
            $sql .= "\n WHERE";
            $sql .= "\n      avaliacao.avaliacao_id";
            if ($avaliacao_id) {
                $parr[':avaliacao_id'] = $avaliacao_id;
                $sql .= "\n AND avaliacao.avaliacao_id = :avaliacao_id";
            }
            if ($disciplina_id) {
                $parr[':disciplina_id'] = $disciplina_id;
                $sql .= "\n AND avaliacao.disciplina_id = :disciplina_id";
            }
            if ($matricula) {
                $parr[':matricula'] = $matricula;
                $sql .= "\n AND avaliacao.matricula = :matricula";
            }
            if ($filtrar) {
                $parr[':filtrar'] = "%$filtrar%";
                $sql .= "\n AND (";
                $sql .= "\n      avaliacao.nome LIKE :filtrar";
                $sql .= "\n      OR disciplina.nome LIKE :filtrar )";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      avaliacao.nome ASC,";
            $sql .= "\n      nomeDisciplina ASC,";
            $sql .= "\n      nomePessoa ASC";
            if (!$contar and ( $limit or $offset)) {
                $sql .= "\n LIMIT $limit OFFSET $offset";
            }

            $rs = $conn->prepare($sql);
            try {
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/>";
                if ($contar) {
                    return $rs->rowCount();
                } else {
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

    static function selectAvaliacaoAlternativas($param = array()) {
//        var_dump($param);
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        try {
            $conn = ClsConn::getConn();

            $sql .= "\n SELECT";
            $sql .= "\n      questao.disciplina_id,";
            $sql .= "\n      questao.descricao,";
            $sql .= "\n      questao.assunto_id,";
            $sql .= "\n      assunto.assunto,";
            $sql .= "\n      avaliacao.matricula,";
            $sql .= "\n      avaliacao.disciplina_id,";
            $sql .= "\n      avaliacao.nome,";
            $sql .= "\n      avaliacao.dataInicio,";
            $sql .= "\n      avaliacao.dataFim,";
            $sql .= "\n      avaliacao.tempoMaximo,";
            $sql .= "\n      questaodaavaliacao.questao_id,";
            $sql .= "\n      questaodaavaliacao.avaliacao_id";
            $sql .= "\n      ,(SELECT questaodiscursiva.questao_id FROM questaodiscursiva";
            "";
            $sql .= "\n        WHERE questaodiscursiva.questao_id = questao.questao_id) AS questaoDiscursiva,";
            $sql .= "\n      (SELECT DISTINCT questaoobjetiva.questao_id FROM questaoobjetiva";
            $sql .= "\n       WHERE questaoobjetiva.questao_id = questao.questao_id) AS questaoObjetiva";
            $sql .= "\n FROM";
            $sql .= "\n      questaodaavaliacao";
            $sql .= "\n INNER JOIN questao ON questaodaavaliacao.questao_id = questao.questao_id";
            $sql .= "\n INNER JOIN avaliacao ON questaodaavaliacao.avaliacao_id = avaliacao.avaliacao_id";
            $sql .= "\n INNER JOIN assunto ON questao.assunto_id = assunto.assunto_id";
            $sql .= "\n WHERE";
            $sql .= "\n      questaodaavaliacao.avaliacao_id";

            if ($avaliacao_id) {
                $parr[':avaliacao_id'] = $avaliacao_id;
                $sql .= "\n AND questaodaavaliacao.avaliacao_id = :avaliacao_id";
            }
            if ($questao_id) {
                $parr[':questao_id'] = $questao_id;
                $sql .= "\n AND questaodaavaliacao.questao_id = :questao_id";
            }
            if ($filtrar) {
                $parr[':descricao'] = "%$filtrar%";
                $sql .= "\n AND (";
                $sql .= "\n      questao.descricao LIKE :descricao";
                $sql .= "\n      OR questao.assunto LIKE :descricao";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      questao.assunto_id ASC,";
            $sql .= "\n      questao.descricao ASC";
            if (!$contar and ( $limit or $offset)) {
                $sql .= "\n LIMIT $limit OFFSET $offset";
            }

            $rs = $conn->prepare($sql);
            try {
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/>";
                if ($contar) {
                    return $rs->rowCount();
                } else {
                    return $rs->fetchAll(PDO::FETCH_OBJ);
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

    static function selectAvaliacaoRespostas($param = array()) {
//        var_dump($param);
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        try {
            $conn = ClsConn::getConn();

            $sql .= "\n SELECT
                             -- respostaaluno.respostaAluno_id,
                             respostaaluno.matricula,
                             respostaaluno.avaliacao_id,
                             respostaaluno.respostaAluno,
                             respostaaluno.respostaAlunoData,
                             respostaaluno.respostaAlunoNota,
                             questao.disciplina_id,
                             questao.descricao,
                             questao.assunto_id,
                             questao.questao_id
                            ,(SELECT questaodiscursiva.questao_id FROM questaodiscursiva
                              WHERE questaodiscursiva.questao_id = questao.questao_id) AS questaoDiscursiva,
                            (SELECT DISTINCT questaoobjetiva.questao_id FROM questaoobjetiva
                             WHERE questaoobjetiva.questao_id = questao.questao_id) AS questaoObjetiva
                        FROM
                             respostaaluno
                        INNER JOIN questaodaavaliacao ON respostaaluno.questao_id = questaodaavaliacao.questao_id
                        AND respostaaluno.avaliacao_id = questaodaavaliacao.avaliacao_id
                        INNER JOIN questao ON questaodaavaliacao.questao_id = questao.questao_id
                        WHERE
                             -- respostaaluno.respostaAluno_id
                             respostaaluno.matricula";

//            $sql = " SELECT DISTINCT
//                            questao.questao_id,
//                            questao.disciplina_id,
//                            questao.descricao,
//                            questao.assunto_id
//                            ,(SELECT questaodiscursiva.questao_id FROM questaodiscursiva
//                              WHERE questaodiscursiva.questao_id = questao.questao_id) AS questaoDiscursiva,
//                            (SELECT DISTINCT questaoobjetiva.questao_id FROM questaoobjetiva
//                             WHERE questaoobjetiva.questao_id = questao.questao_id) AS questaoObjetiva
//                        FROM
//                             questao
//                        LEFT JOIN questaodaavaliacao ON questaodaavaliacao.questao_id = questao.questao_id
//                        LEFT JOIN respostaaluno ON respostaaluno.questao_id = questaodaavaliacao.questao_id AND respostaaluno.avaliacao_id = questaodaavaliacao.avaliacao_id
//                        WHERE
//                             questaodaavaliacao.avaliacao_id";
            if ($avaliacao_id) {
                $parr[':avaliacao_id'] = $avaliacao_id;
                $sql .= "\n AND respostaaluno.avaliacao_id = :avaliacao_id";
            }
            if ($matricula) {
                $parr[':matricula'] = $matricula;
                $sql .= "\n AND respostaaluno.matricula = :matricula";
            }
            if ($questao_id) {
                $parr[':questao_id'] = $questao_id;
                $sql .= "\n AND respostaAluno.questao_id = :questao_id";
            }
            if ($filtrar) {
                $parr[':descricao'] = "%$filtrar%";
                $sql .= "\n AND (";
                $sql .= "\n      questao.descricao LIKE :descricao";
                $sql .= "\n      OR questao.assunto LIKE :descricao";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      respostaaluno.avaliacao_id ASC,";
            $sql .= "\n      questao.questao_id ASC";
            if (!$contar and ( $limit or $offset)) {
                $sql .= "\n LIMIT $limit OFFSET $offset";
            }

            $rs = $conn->prepare($sql);
            try {
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/>";
                if ($contar) {
                    return $rs->rowCount();
                } else {
                    return $rs->fetchAll(PDO::FETCH_OBJ);
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

    static function realizarAvaliacao($matricula, $avaliacao_id, $respostaAluno) {
//        var_dump($matricula);
//        var_dump($avaliacao_id);
//        var_dump($respostaAluno);
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();

            $parr = array(
                ':matricula' => $matricula,
                ':avaliacao_id' => $avaliacao_id
            );
            $sql = "\n INSERT INTO respostaaluno (matricula,avaliacao_id,questao_id,respostaAluno)";
            $sql .= "\n VALUES";
            foreach ($respostaAluno as $questao => $resposta) {
                $sql .= "\n      (:matricula, :avaliacao_id, :questao_id$questao, :respostaAluno$questao),";
                $parr[":questao_id$questao"] = $questao;
                $parr[":respostaAluno$questao"] = $resposta;
            }
            $sql = trim($sql, ',');
            $sql .= "\n  ON DUPLICATE KEY UPDATE respostaAluno = VALUES(respostaAluno)";

            $rs = $conn->prepare($sql);

            $rs->execute($parr);
//            echo $rs->debugDumpParams()."<br/>";
            $conn->commit();
        } catch (Exception $ex) {
            $conn->rollBack();
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        } catch (PDOExecption $e) {
            $conn->rollBack();
            print "Error!: " . $e->getMessage() . "</br>";
            return null;
        }

        return TRUE;
    }

    static function corrigirAvaliacao($matricula, $avaliacao_id, $nota) {
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();

            $parr = array(
                ':matricula' => $matricula,
                ':avaliacao_id' => $avaliacao_id
            );
            $sql = "\n INSERT INTO respostaaluno (matricula,avaliacao_id,questao_id,respostaAlunoNota)";
            $sql .= "\n VALUES";
            foreach ($nota as $questao => $resposta) {
                $sql .= "\n      (:matricula, :avaliacao_id, :questao_id$questao, :respostaAlunoNota$questao),";
                $parr[":questao_id$questao"] = $questao;
                $parr[":respostaAlunoNota$questao"] = $resposta;
            }
            $sql = trim($sql, ',');
            $sql .= "\n  ON DUPLICATE KEY UPDATE respostaAlunoNota = VALUES(respostaAlunoNota)";

            $rs = $conn->prepare($sql);

            $rs->execute($parr);
//            echo $rs->debugDumpParams()."<br/>";
            $conn->commit();
        } catch (Exception $ex) {
            $conn->rollBack();
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        } catch (PDOExecption $e) {
            $conn->rollBack();
            print "Error!: " . $e->getMessage() . "</br>";
            return null;
        }

        return TRUE;
    }

    static function corrigirQuestao($questao, $resposta = "") {
//        var_dump($questao);
//        var_dump($resposta);
        $questao = trim($questao);
        $resposta = trim($resposta);
//        $questao = utf8_decode($questao);
//        $resposta = utf8_decode($resposta);
//        ini_set('default_charset', 'UTF-8');
        $arrDescartar = array('o', 'os', 'um', 'uns', 'a', 'as', 'uma', 'umas', 'por', 'pelo', 'pelos', 'pela', 'pelas', 'em', 'no', 'nos', 'na', 'nas', 'de', 'do', 'dos', 'da', 'das', 'em', 'para', 'per', 'com'
            , 'aquela', 'aquelas', 'aquele', 'aqueles', 'aquilo', 'e', 'ou', 'se'
        );
        $arrRemover = array('.', ',', "'", '"', '!', ':', ';');
        $resposta = str_replace($arrRemover, '', $resposta);
        $questao = str_replace($arrRemover, '', $questao);

        if (!trim($resposta)) {
            return 0;
        }
        if (strcasecmp(trim($questao), trim($resposta)) == 0) {
            return 100;
        }
        $antonimo = false;
        $qtdPalEnc = 0;
        $prob = 0;
        $anto = 0;
        $sino = 0;
        
        $arrRespostaA = preg_split("/\s+/", mb_convert_case($resposta, MB_CASE_LOWER, 'utf8'));
        $arrQuestaoA = preg_split("/\s+/", mb_convert_case($questao, MB_CASE_LOWER, 'utf8'));
        foreach ($arrRespostaA as $key => $palavra) {
            if (in_array($palavra, $arrDescartar)) {
                unset($arrRespostaA[$key]);
            } else {
                $arrResposta[] = $palavra;
            }
        }
        foreach ($arrQuestaoA as $key => $palavra) {
            if (in_array($palavra, $arrDescartar)) {
                unset($arrQuestaoA[$key]);
            } else {
                $arrQuestao[] = $palavra;
            }
        }
//        var_dump($arrQuestao);
//        var_dump($arrResposta);
        $lst = array();
        foreach ($arrResposta as $key => $palavra) {
            if (($palavra == 'não') or ($palavra == 'nao')) {
                $a = array_search($arrResposta[$key + 1], $arrQuestao);
//                echo "<br/>Palavra11: ".$arrResposta[$key + 1];
//                var_dump($a);
//                echo "<br/>Palavra22: ".$arrQuestao[$a - 1];
                $arrQuestao[$a - 1];
                if (is_numeric($a) and !(($arrQuestao[$a - 1] == 'não') or ($arrQuestao[$a - 1] == 'nao'))) {
                $lst[] = $arrResposta[$key + 1];
//                    echo "<br/>NÃO ENCONTREI O NÃO ANTES DE: ".$arrResposta[$key + 1];
                    $antonimo = true;
                    $anto++;
                } else {
//                    echo "<br/>ENCONTREI O NÃO ANTES DE: ".$arrResposta[$key + 1];
                }
            } else if (in_array($palavra, $arrQuestao) and !in_array($palavra, $lst)) {
//                echo "<br/>Encontrei Palavra: $palavra";
                $qtdPalEnc++;
            } else {
                $arrayPalavraPesquisa = self::pesquisaPalavra($palavra);

                foreach ($arrayPalavraPesquisa as $key => $palavraPesquisa) {
                    if (in_array(strtolower($palavraPesquisa->palavra), $arrQuestao)) {
                        if ($palavraPesquisa->palavraRelacaoTipoId == 1) {#Sinonimo
//                            echo "<br/>Encontrei Sinônimo: $palavra - $palavraPesquisa->palavra";
                            $sino++;
                        }
                        if ($palavraPesquisa->palavraRelacaoTipoId == 2) {#Antonimo
//                            echo "<br/>Encontrei Antônimo: $palavra - $palavraPesquisa->palavra";
                            $antonimo = true;
                            $anto++;
                        }
                        break;
                    }
                }
            }
        }

//        echo "<br/><br/>Quantidade de palavras do professor: " . count($arrQuestao);
//        echo "<br/>Quantidade de palavras iguais: " . $qtdPalEnc;
//        echo "<br/>Quantidade de palavras sinônimos: " . $sino;
//        echo "<br/>Quantidade de palavras antônimos: " . $anto;
//
////        $prob += 100 / count($arrQuestao) * $qtdPalEnc;
////        $prob += 100 / count($arrQuestao) * $sino;
////        $prob += -count($arrQuestao) * 25 / 100 * $anto;
////        $prob += 100 / count($arrQuestao) * $qtdPalEnc;
////        $prob += 100 / count($arrQuestao) * $sino;
////        $prob += 100 * $anto / -count($arrQuestao);
//
//        echo "<br/><br/>Valor quantidade palavras encontradas: " . 100 / count($arrQuestao) * $qtdPalEnc;
////        echo "<br/>qtdPalEnc: ". 100 * ($qtdPalEnc * 0.1);
//        echo "<br/>Valor quantidade sinônimos: " . 100 / count($arrQuestao) * $sino;
////        echo "<br/>Valor quantidade antônimos: " . ((25/100 * $anto)*(100 / count($arrQuestao) * $qtdPalEnc) + (100 / count($arrQuestao) * $sino));
//
////        echo "<br/><br/>adasdsads: " .
////        ((100 / count($arrQuestao) * $qtdPalEnc) + (100 / count($arrQuestao) * $sino) - (25/100 * $anto)*100);
////        ((100 / count($arrQuestao) * $qtdPalEnc) + (100 / count($arrQuestao) * $sino) - ((count($arrQuestao) * 25 / 100) * $anto));

        if ((100*$qtdPalEnc/count($arrQuestao) >= 85) and !$antonimo){
            return 100;
        }
        
        $certo = (100 / count($arrQuestao) * $qtdPalEnc) + (100 / count($arrQuestao) * $sino);
//        echo "<br/><br/>adasdsads22: " .
        $prob = ($certo - (25/100 * $anto)*$certo);
        return $prob;
    }

    static function corrigirQuestao2($questao, $resposta = "") {
        if (!trim($resposta)) {
            return 0;
        }
        if (strcasecmp(trim($questao), trim($resposta)) == 0) {
            return 100;
        }

        $pal = 0;
        $sino = 0;
        $anto = 0;
        $prob = 0;
        $probTotal = 0;
        $arrR = explode(" ", $questao);
        $arrR = preg_split("/\s+/", $resposta);
        try {
            $conn = ClsConn::getConn();

            try {
                for ($i = 0; $i < count($arrR); $i++) {
                    $p = trim($arrR[$i]);
                    $sql = "
                    SELECT
                        :p as palavraBase,
                        palavrarelacao.palavraId1, 
                        palavrarelacao.palavraRelacaoTipoId, 
                        palavrarelacaotipo.palavraRelacaoTipo, 
                        palavrarelacao.palavraId2, 
                        (SELECT palavra FROM palavra WHERE (palavraId = palavraId1 or palavraId = palavraId2) AND palavra != :p) as palavra, 
                        palavra.palavraTipoId, 
                        palavratipo.palavraTipo 
                    FROM 
                        palavrarelacao 
                    INNER JOIN palavra ON palavra.palavraId = palavrarelacao.palavraId1 
                        OR palavra.palavraId = palavrarelacao.palavraId2 
                    INNER JOIN palavrarelacaotipo ON palavrarelacaotipo.palavraRelacaoTipoId = palavrarelacao.palavraRelacaoTipoId 
                    INNER JOIN palavratipo ON palavra.palavraTipoId = palavratipo.palavraTipoId 
                    WHERE 
                        palavra.palavra = :p";

                    $rs = $conn->prepare($sql);
//                    echo $rs->debugDumpParams()."<br/>";
                    $parr = array(':p' => $p);
                    $rs->execute($parr);
                    $result = $rs->fetchAll(PDO::FETCH_OBJ);
//                    var_dump($result);
                    foreach ($result as $key => $value) {
//                        var_dump($key);
//                        var_dump($value);
//                        print_r($key);
//                        print_r($value);
//                        if (is_numeric(strripos($resposta, $p))) {
//                            echo "Encontrei Palavra: $p <br/>";
//                            $pal++;
//                            $prob+=10;
//                            break;
//                        }else{
//                            echo "NÃO Encontrei Palavra: $p <br/>";
//                        }
                        if ($value->palavraRelacaoTipoId == 1) {
//                            if (strripos($resposta, $value->palavra) >= 0) {
                            if (is_numeric(strripos($questao, $value->palavra))) {
                                echo "Encontrei Sinônimo: $p - $value->palavra <br/>";
                                $sino++;
                                $prob+=5;
//                                break;
                            }
                        }
                        if ($value->palavraRelacaoTipoId == 2) {
                            if (is_numeric(strripos($questao, $value->palavra))) {
//                            if (strtolower($respostaUser) . contains(strtolower($value->palavra))) {
                                echo "Encontrei Antônimo: $p - $value->palavra <br/>";
                                $anto++;
                                $prob-=5;
//                                break;
                            }
                        }
                    }
                    if (is_numeric(strripos($questao, $p))) {
//                    if ($respostaUser . toLowerCase() . contains($p . toLowerCase())) {
                        echo "Encontrei: $p <br/>";
                        $prob+=(float) (100 / count($arrR)) + 10;
//                        $prob+=(float) 10;
                        $probTotal = (float) 100 / count($arrR);
                        $pal++;
//                        $prob+=10;
                    } else {
                        echo "NÃO Encontrei Palavra: $p <br/>";
                    }
                }
                echo "rUser.length: " + count($arrR) . "<br/>";
                echo "100/rUser.length: " + (float) 100 / count($arrR) . "<br/>";
            } catch (Exception $ex) {
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return FALSE;
            } catch (PDOExecption $e) {
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($e->getMessage(), "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return FALSE;
            }

            $conn = null;
        } catch (IOException $ioe) {
            return $ioe->getMessage();
//            $ioe.rintStackTrace();
        } catch (Exception $ex) {
//            Logger.getLogger(JavaTestes.class.getName()).log(Level.SEVERE, null, $ex);
        }

        echo 'count($arrRC): ' . count($arrR);
        echo "<br/>";
        echo 'palavras: ' . $pal;
        echo "<br/>";
        echo "Sino: $sino";
        echo "<br/>";
        echo "Anto: $anto";
        echo "<br/>";
        echo "probabilidadeTotal: $probTotal";
        echo "<br/>";
        echo "probabilidade: $prob";
        return $prob;
    }

    static function pesquisaPalavra($palavra) {
        $conn = ClsConn::getConn();

        try {
            $sql = "
                    SELECT
                        :p as palavraBase,
                        palavrarelacao.palavraId1, 
                        palavrarelacao.palavraRelacaoTipoId, 
                        palavrarelacaotipo.palavraRelacaoTipo, 
                        palavrarelacao.palavraId2, 
                        (SELECT palavra FROM palavra WHERE (palavraId = palavraId1 or palavraId = palavraId2) AND palavra != :p) as palavra, 
                        palavra.palavraTipoId, 
                        palavratipo.palavraTipo 
                    FROM 
                        palavrarelacao 
                    INNER JOIN palavra ON palavra.palavraId = palavrarelacao.palavraId1 
                        OR palavra.palavraId = palavrarelacao.palavraId2 
                    INNER JOIN palavrarelacaotipo ON palavrarelacaotipo.palavraRelacaoTipoId = palavrarelacao.palavraRelacaoTipoId 
                    INNER JOIN palavratipo ON palavra.palavraTipoId = palavratipo.palavraTipoId 
                    WHERE 
                        palavra.palavra = :p";
//            echo str_replace(':p', "'$palavra'", $sql);
            $rs = $conn->prepare($sql);
//                echo $rs->debugDumpParams()."<br/>";
            $parr = array(':p' => $palavra);
            $rs->execute($parr);
            $result = $rs->fetchAll(PDO::FETCH_OBJ);
//                var_dump($result);
            return $result;
        } catch (Exception $ex) {
            $funcoes = new ClsFuncoes;

            $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        } catch (PDOExecption $e) {
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($e->getMessage(), "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        }

        $conn = null;
    }

}
