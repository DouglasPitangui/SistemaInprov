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
class ClsDisciplina {

    private $disciplina_id;
    private $nome;
    private $cargaHoraria;

    function __construct($disciplina_id, $nome, $cargaHoraria) {
        $this->disciplina_id = $disciplina_id;
        $this->nome = $nome;
        $this->cargaHoraria = $cargaHoraria;
    }

    public function __toString() {
        $v = "";
        foreach ($this as $key => $value) {
            $v .= "$key => $value,<br/>";
        }
        return $v; // = "Senha = $this->senha";
    }

    public function getId() {
        return $this->disciplina_id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCargaHoraria() {
        return $this->cargaHoraria;
    }

    public function setId($disciplina_id) {
        $this->disciplina_id = $disciplina_id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCargaHoraria($cargaHoraria) {
        $this->cargaHoraria = $cargaHoraria;
    }

    function insertDisciplina() {
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();

            $sql = "\n INSERT INTO disciplina(nome,cargaHoraria)";
            $sql .= "\n VALUES";
            $sql .= "\n      (:nome,:cargaHoraria)";

            $rs = $conn->prepare($sql);
            $parr = array(
                ':nome' => $this->nome,
                ':cargaHoraria' => $this->cargaHoraria
            );
//            echo $rs->debugDumpParams()."<br/>";
            try {
                $rs->execute($parr);
                $this->disciplina_id = $conn->lastInsertId();
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
            print "Error!: " . $e->getMessage() . "</br>";
            return null;
        }
        return $this->disciplina_id;
    }

    function updateDisciplina() {
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();

            $sql = "\n UPDATE disciplina";
            $sql .= "\n SET nome = :nome, cargaHoraria = :cargaHoraria";
            $sql .= "\n WHERE disciplina_id = :disciplina_id";
            
            $rs = $conn->prepare($sql);
            $parr = array(
                ':nome' => $this->nome,
                ':cargaHoraria' => $this->cargaHoraria,
                ':disciplina_id' => $this->disciplina_id
            );
            try {
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/>";
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
            print "Error!: " . $e->getMessage() . "</br>";
            return null;
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
            $sql .= "\n      disciplina.disciplina_id,";
            $sql .= "\n      disciplina.nome,";
            $sql .= "\n      disciplina.cargaHoraria";
            $sql .= "\n FROM";
            $sql .= "\n      `disciplina`";
            $sql .= "\n WHERE";
            $sql .= "\n      disciplina.disciplina_id";
            if ($disciplina_id) {
                $parr[':disciplina_id'] = $disciplina_id;
                $sql .= "\n AND disciplina_id = :disciplina_id";
            }
            if ($nome) {
                $parr[':nome'] = "%$nome%";
                $sql .= "\n AND nome like :nome";
            }
            if ($cargaHoraria) {
                $parr[':cargaHoraria'] = $nome;
                $sql .= "\n AND cargaHoraria = :cargaHoraria";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      disciplina.nome ASC,";
            $sql .= "\n      disciplina.cargaHoraria ASC,";
            $sql .= "\n      disciplina.disciplina_id ASC";
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

}
