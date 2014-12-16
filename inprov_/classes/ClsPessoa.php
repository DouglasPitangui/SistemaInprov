<?php

//ini_set('default_charset', 'UTF-8');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClsPessoa
 *
 * @author JoãoAndré
 */
class ClsPessoa {
    private $nome;
    private $matricula;
    private $email;
    private $cpf;
    private $telefone;
    private $dataDeNascimento;
    private $senha;

    function __construct($matricula = "", $nome = "", $email = "", $cpf = "", $telefone = "", $dataDeNascimento = "", $senha = "") {
        $this->nome = $nome;
        $this->matricula = $matricula;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
        if (!$dataDeNascimento) {
            $dataDeNascimento = date('d/m/Y');
        }
        $date = DateTime::createFromFormat('d/m/Y', $dataDeNascimento);
        $dataDeNascimento = $date->format('Y-m-d');
        $this->dataDeNascimento = $dataDeNascimento;
        $this->senha = $senha;
    }

    public function __toString() {
        $v = "";
        foreach ($this as $key => $value) {
            $v .= "$key => $value,<br/>";
        }
        return $v; // = "Senha = $this->senha";
    }

    public function getNome() {
        return $this->nome;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getDataDeNascimento() {
        return Date('d/m/Y', $this->dataDeNascimento);
//        return $this->dataDeNascimento;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setDataDeNascimento($dataDeNascimento) {
        $date = DateTime::createFromFormat('d/m/Y', $dataDeNascimento);
        $dataDeNascimento = $date->format('Y-m-d');
        $this->dataDeNascimento = $dataDeNascimento;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    function insertPessoa($conn) {
        try {
//            $conn = ClsConn::getConn();

            $sql = "\n INSERT INTO pessoa(nome,cpf,email,telefone,dataDeNascimento,senha)";
            $sql .= "\n VALUES";
            $sql .= "\n      (:nome,:cpf,:email,:telefone,:dataDeNascimento,:senha)";

            $rs = $conn->prepare($sql);
            $parr = array(
                ':nome' => $this->nome,
                ':cpf' => $this->cpf,
                ':email' => $this->email,
                ':telefone' => $this->telefone,
//                ':matricula' => $this->matricula,
                ':dataDeNascimento' => $this->dataDeNascimento,
                ':senha' => $this->senha
            );
//            echo $rs->debugDumpParams()."<br/>";
            try {
                $rs->execute($parr);
                $this->matricula = $conn->lastInsertId();
            } catch (Exception $ex) {
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return FALSE;
            } catch (PDOExecption $e) {
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return null;
            }
        } catch (Exception $ex) {
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        } catch (PDOExecption $e) {
            print "Error!: " . $e->getMessage() . "</br>";
            return null;
        }
        return $this->matricula;
    }

    function updatePessoa($conn) {
        try {
//            $conn = ClsConn::getConn();

            $sql = "\n UPDATE pessoa";
            $sql .= "\n SET nome = :nome,cpf = :cpf,email = :email,telefone = :telefone,dataDeNascimento = :dataDeNascimento";
            $sql .= "\n WHERE matricula = :matricula";
            
            $rs = $conn->prepare($sql);
            $parr = array(
                ':nome' => $this->nome,
                ':cpf' => $this->cpf,
                ':email' => $this->email,
                ':telefone' => $this->telefone,
                ':matricula' => $this->matricula,
//                ':senha' => $this->senha,
                ':dataDeNascimento' => $this->dataDeNascimento
            );
//            echo $rs->debugDumpParams()."<br/>";
            try {
                $rs->execute($parr);
            } catch (Exception $ex) {
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return FALSE;
            } catch (PDOExecption $e) {
                $funcoes = new ClsFuncoes;
                $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
                return null;
            }
        } catch (Exception $ex) {
            $funcoes = new ClsFuncoes;
            $funcoes->fezErrado($ex, "Mensagem: Arquivo: " . __FILE__ . " Linha " . __LINE__ . " " . mysql_error() . " SQL = " . $sql);
            return FALSE;
        } catch (PDOExecption $e) {
            print "Error!: " . $e->getMessage() . "</br>";
            return null;
        }
        return TRUE;
    }

    function updateSenha($senha = "") {
        if ($senha == "") {
            $senha = $this->senha;
        }
        try {
            $conn = ClsConn::getConn();
            $conn->beginTransaction();

            $sql = "\n UPDATE pessoa";
            $sql .= "\n SET senha = :senha";
            $sql .= "\n WHERE matricula = :matricula";
            
            $rs = $conn->prepare($sql);
            $parr = array(
                ':senha' => $senha,
                ':matricula' => $this->matricula
            );
//            echo $rs->debugDumpParams()."<br/>";
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
            print "Error!: " . $e->getMessage() . "</br>";
            return null;
        }
        return TRUE;
    }
    
    static function selectPessoa($param = array()) {
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
            $sql .= "\n      pessoa.senha";
            $sql .= "\n FROM";
            $sql .= "\n      pessoa";
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

}
