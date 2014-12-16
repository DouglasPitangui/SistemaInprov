<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClsDisciplina
 *
 * @author JoãoAndré
 */
class ClsQuestao {

    private $questao_id;
    private $disciplina_id;
    private $descricao;
    private $assunto;
    private $respostaDoProfessor;
    private $alternativas;
    private $alternativaCorreta;
    private $questaoObjetiva_id;

    function __construct($questao_id, $disciplina_id, $descricao, $assunto, $respostaDoProfessor, $alternativas, $alternativaCorreta, $questaoObjetiva_id) {
        $this->questao_id = $questao_id;
        $this->disciplina_id = $disciplina_id;
        $this->descricao = $descricao;
        $this->assunto = $assunto;
        $this->respostaDoProfessor = $respostaDoProfessor;
        $this->alternativas = $alternativas;
        $this->alternativaCorreta = $alternativaCorreta;
        $this->questaoObjetiva_id = $questaoObjetiva_id;
    }

    public function __toString() {
        $v = "";
        foreach ($this as $key => $value) {
            $v .= "$key => $value,<br/>";
        }
        return $v; // = "Senha = $this->senha";
    }

    public function getQuestao_id() {
        return $this->questao_id;
    }

    public function getDisciplina_id() {
        return $this->disciplina_id;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getAssunto() {
        return $this->assunto;
    }

    public function getRespostaDoProfessor() {
        return $this->respostaDoProfessor;
    }

    public function getAlternativas() {
        return $this->alternativas;
    }

    public function getAlternativaCorreta() {
        return $this->alternativaCorreta;
    }

    public function getQuestaoObjetiva_id() {
        return $this->questaoObjetiva_id;
    }

    public function setQuestao_id($questao_id) {
        $this->questao_id = $questao_id;
    }

    public function setDisciplina_id($disciplina_id) {
        $this->disciplina_id = $disciplina_id;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setAssunto($assunto) {
        $this->assunto = $assunto;
    }

    public function setRespostaDoProfessor($respostaDoProfessor) {
        $this->respostaDoProfessor = $respostaDoProfessor;
    }

    public function setAlternativas($alternativas) {
        $this->alternativas = $alternativas;
    }

    public function setAlternativaCorreta($alternativaCorreta) {
        $this->alternativaCorreta = $alternativaCorreta;
    }

    public function setQuestaoObjetiva_id($questaoObjetiva_id) {
        $this->questaoObjetiva_id = $questaoObjetiva_id;
    }

    function insertQuestao() {
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();

            $sql = "\n INSERT INTO questao(disciplina_id,descricao,assunto_id)";
            $sql .= "\n VALUES";
            $sql .= "\n      (:disciplina_id,:descricao,:assunto)";

            $rs = $conn->prepare($sql);
            $parr = array(
                ':disciplina_id' => $this->disciplina_id,
                ':descricao' => $this->descricao,
                ':assunto' => $this->assunto
            );
//            echo $rs->debugDumpParams()."<br/>";
            try {
                $rs->execute($parr);
                $this->id = $conn->lastInsertId();
                if ($this->respostaDoProfessor) {
                    $sql = "\n INSERT INTO questaoDiscursiva(respostaDoProfessor,questao_id)";
                    $sql .= "\n VALUES";
                    $sql .= "\n      (:respostaDoProfessor,:questao_id)";

                    $rs = $conn->prepare($sql);
                    $parr = array(
                        ':respostaDoProfessor' => $this->respostaDoProfessor,
                        ':questao_id' => $this->id
                    );
                } else {
                    $parr = array(
                        ':questao_id' => $this->id
                    );
                    $sql = "\n INSERT INTO questaoObjetiva(questao_id,alternativaCorreta,alternativas)";
                    $sql .= "\n VALUES";
                    foreach ($this->alternativas as $key => $alternativa) {
                        $sql .= "\n      (:questao_id,:alternativaCorreta$key,:alternativas$key),";
                        $parr[":alternativaCorreta$key"] = ($this->alternativaCorreta) == $key ? 1 : 0;
                        $parr[":alternativas$key"] = $alternativa;
                    }
                    $sql = trim($sql, ',');
                    $rs = $conn->prepare($sql);
                }

                try {
                    $rs->execute($parr);
                    $conn->commit();
                } catch (Exception $ex) {
                    $conn->rollBack();
                    $funcoes = new ClsFuncoes;
                    $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                    return FALSE;
                } catch (PDOExecption $e) {
                    $conn->rollBack();
                    $funcoes = new ClsFuncoes;
                    $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                    return null;
                }
            } catch (Exception $ex) {
                $conn->rollBack();
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return FALSE;
            } catch (PDOExecption $e) {
                $conn->rollBack();
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return null;
            }
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

        return $this->id;
    }

    function updateQuestao() {
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();

            $sql = "\n UPDATE questao";
            $sql .= "\n SET disciplina_id = :disciplina_id,descricao = :descricao,assunto_id = :assunto";
            $sql .= "\n WHERE questao_id = :questao_id";

            $rs = $conn->prepare($sql);
            $parr = array(
                ':questao_id' => $this->questao_id,
                ':disciplina_id' => $this->disciplina_id,
                ':descricao' => $this->descricao,
                ':assunto' => $this->assunto
            );
            try {
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/><br/>";
                if ($this->respostaDoProfessor) {
                    $sql = "\n UPDATE questaodiscursiva";
                    $sql .= "\n SET respostadoprofessor = :respostaDoProfessor";
                    $sql .= "\n WHERE questao_id = :questao_id";

                    $rs = $conn->prepare($sql);
                    $parr = array(
                        ':respostaDoProfessor' => $this->respostaDoProfessor,
                        ':questao_id' => $this->questao_id
                    );
                    $rs->execute($parr);
                } else {
                    $sql = "";
                    for ($key = 0; $key < count($this->alternativas); $key++) {
                        $parr = array();
                        $sql .= "\n UPDATE questaoObjetiva";
                        $sql .= "\n SET alternativaCorreta = :alternativaCorreta, alternativas = :alternativas";
                        $sql .= "\n WHERE questaoObjetiva_id = :questaoObjetiva_id;";
                        
                        $parr[":questaoObjetiva_id"] = $this->questaoObjetiva_id[$key];
                        $parr[":alternativaCorreta"] = (int)($this->alternativaCorreta) == $key ? 1 : 0;
                        $parr[":alternativas"] = $this->alternativas[$key];
                        
                        $rs = $conn->prepare($sql)->execute($parr);
//                        echo $rs->debugDumpParams()."<br/><br/>";
                    }
                }

                try {
//                    $rs->execute($parr);
//                    echo $rs->debugDumpParams()."<br/><br/>";
                    $conn->commit();
                } catch (Exception $ex) {
                    $conn->rollBack();
                    $funcoes = new ClsFuncoes;
                    $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                    return FALSE;
                } catch (PDOExecption $e) {
                    $conn->rollBack();
                    $funcoes = new ClsFuncoes;
                    $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                    return null;
                }
            } catch (Exception $ex) {
                $conn->rollBack();
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return FALSE;
            } catch (PDOExecption $e) {
                $conn->rollBack();
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return null;
            }

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

    static function selectQuestao($param = array()) {
//        var_dump($param);
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        try {
            $conn = ClsConn::getConn();

            $sql = "\n SELECT";
            $sql .= "\n      questao.questao_id,";
            $sql .= "\n      questao.disciplina_id,";
            $sql .= "\n      questao.descricao,";
            $sql .= "\n      questao.assunto_id,";
            $sql .= "\n      assunto.assunto,";
            $sql .= "\n      disciplina.nome,";
            $sql .= "\n      disciplina.cargaHoraria,";
            $sql .= "\n      CASE";
            $sql .= "\n      WHEN (";
            $sql .= "\n           SELECT";
            $sql .= "\n                questaodiscursiva.questao_id";
            $sql .= "\n           FROM";
            $sql .= "\n                questaodiscursiva";
            $sql .= "\n           WHERE";
            $sql .= "\n                questaodiscursiva.questao_id = questao.questao_id";
            $sql .= "\n      ) THEN";
            $sql .= "\n           'Discursiva'";
            $sql .= "\n      ELSE";
            $sql .= "\n           'Objetiva'";
            $sql .= "\n      END AS tipoQuestao";
            $sql .= "\n FROM";
            $sql .= "\n      `questao`";
            $sql .= "\n INNER JOIN disciplina ON questao.disciplina_id = disciplina.disciplina_id";
            $sql .= "\n INNER JOIN assunto ON assunto.assunto_id = questao.assunto_id";
            $sql .= "\n WHERE";
            $sql .= "\n      questao.questao_id";
            if ($questao_id) {
                $parr[':questao_id'] = $questao_id;
                $sql .= "\n AND questao.questao_id = :questao_id";
            }
            if ($assunto_id) {
                $parr[':assunto_id'] = $assunto_id;
                $sql .= "\n AND questao.assunto_id = :assunto_id";
            }
            if ($filtrar) {
                $parr[':descricao'] = "%$filtrar%";
                $sql .= "\n AND (";
                $sql .= "\n      questao.descricao LIKE :descricao";
                $sql .= "\n      OR assunto.assunto LIKE :descricao )";
            }
            if ($disciplina_id) {
                $parr[':disciplina_id'] = $disciplina_id;
                $sql .= "\n AND disciplina.disciplina_id = :disciplina_id";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      questao.descricao ASC,";
            $sql .= "\n      questao.disciplina_id ASC,";
            $sql .= "\n      assunto.assunto ASC,";
            $sql .= "\n      questao.questao_id ASC";
            if (!$contar and ($limit or $offset)) {
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

    static function selectQuestaoAlternativas($param = array()) {
//        var_dump($param);
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        try {
            $conn = ClsConn::getConn();

            $sql .= "\n SELECT";
            $sql .= "\n      questao.questao_id,";
            $sql .= "\n      questao.disciplina_id,";
            $sql .= "\n      questao.descricao,";
            $sql .= "\n      questao.assunto_id,";
            $sql .= "\n      assunto.assunto,";
            $sql .= "\n      questaoobjetiva.questaoObjetiva_id,";
            $sql .= "\n      questaoobjetiva.alternativaCorreta,";
            $sql .= "\n      questaoobjetiva.alternativas,";
            $sql .= "\n      questaodiscursiva.respostaDoProfessor";
            $sql .= "\n FROM";
            $sql .= "\n      questao";
            $sql .= "\n LEFT JOIN questaodiscursiva ON questaodiscursiva.questao_id = questao.questao_id";
            $sql .= "\n LEFT JOIN questaoobjetiva ON questaoobjetiva.questao_id = questao.questao_id";
            $sql .= "\n INNER JOIN disciplina ON questao.disciplina_id = disciplina.disciplina_id";
            $sql .= "\n INNER JOIN assunto ON assunto.assunto_id = questao.assunto_id";
            $sql .= "\n WHERE";
            $sql .= "\n      questao.questao_id";
            if ($questao_id) {
                $parr[':questao_id'] = $questao_id;
                $sql .= "\n AND questao.questao_id = :questao_id";
            }
            if ($filtrar) {
                $parr[':descricao'] = "%$filtrar%";
                $sql .= "\n AND (";
                $sql .= "\n      questao.descricao LIKE :descricao";
                $sql .= "\n      OR questao.assunto LIKE :descricao";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      questao.descricao ASC,";
            $sql .= "\n      questao.disciplina_id ASC,";
            $sql .= "\n      assunto.assunto ASC,";
            $sql .= "\n      questao.questao_id ASC";
            if (!$contar and ($limit or $offset)) {
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

}
