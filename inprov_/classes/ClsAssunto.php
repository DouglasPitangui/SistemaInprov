<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClsAssunto
 *
 * @author JoãoAndré
 */
class ClsAssunto {

    private $assunto_id;
    private $assunto;

    function __construct($assunto_id, $assunto) {
        $this->assunto_id = $assunto_id;
        $this->assunto = $assunto;
    }

    public function __toString() {
        $v = "";
        foreach ($this as $key => $value) {
            $v .= "$key => $value,<br/>";
        }
        return $v; // = "Senha = $this->senha";
    }

    function getAssunto_id() {
        return $this->assunto_id;
    }

    function getAssunto() {
        return $this->assunto;
    }

    function setAssunto_id($assunto_id) {
        $this->assunto_id = $assunto_id;
    }

    function setAssunto($assunto) {
        $this->assunto = $assunto;
    }

    function insertAssunto() {
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();

            $sql = "\n INSERT INTO assunto(assunto)";
            $sql .= "\n VALUES";
            $sql .= "\n      (:assunto)";

            $parr = array(
                ':assunto' => $this->assunto
            );
            try {
                $rs = $conn->prepare($sql);
                $rs->execute($parr);
                $this->assunto_id = $conn->lastInsertId();
//                echo $rs->debugDumpParams()."<br/><br/>";
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

        return $this->assunto_id;
    }

    function updateAssunto() {
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();

            $sql = "\n UPDATE assunto";
            $sql .= "\n SET assunto = :assunto";
            $sql .= "\n WHERE assunto_id = :assunto_id";

            $parr = array(
                ':assunto_id' => $this->assunto_id,
                ':assunto' => $this->assunto
            );
            try {
                $rs = $conn->prepare($sql);
                $rs->execute($parr);
//                echo $rs->debugDumpParams()."<br/><br/>";
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

    static function selectAssunto($param = array()) {
//        var_dump($param);
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        try {
            $conn = ClsConn::getConn();

            $sql = "\n SELECT";
            $sql .= "\n      assunto.assunto_id,";
            $sql .= "\n      assunto.assunto";
            $sql .= "\n FROM";
            $sql .= "\n      `assunto`";
            $sql .= "\n WHERE";
            $sql .= "\n      assunto.assunto_id";
            if ($assunto_id) {
                $parr[':assunto_id'] = $assunto_id;
                $sql .= "\n AND assunto.assunto_id = :assunto_id";
            }
            if ($assunto) {
                $parr[':assunto'] = $assunto;
                $sql .= "\n AND assunto.assunto = :assunto";
            }
            if ($filtrar) {
                $parr[':filtrar'] = "%$filtrar%";
                $sql .= "\n AND assunto.assunto LIKE :filtrar";
            }
            $sql .= "\n ORDER BY";
            $sql .= "\n      assunto.assunto ASC,";
            $sql .= "\n      assunto.assunto_id ASC";
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
