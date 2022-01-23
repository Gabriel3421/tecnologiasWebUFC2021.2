<?php
include_once("../classes/Conexao.php");
include_once("../classes/Utilidades.php");
class Pet
{
    private $nome;
    private $dono;
    private $id;
    private $utilidades;

    public $retornoBD;
    public $conexaoBD;

    public function  __construct()
    {
        $objConexao = new Conexao();
        $this->conexaoBD = $objConexao->getConexao();
        $this->utilidades = new Utilidades();
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getDono()
    {
        return $this->dono;
    }

    public function setNome($nome)
    {
        //validacao
        return $this->nome =  mb_strtoupper($nome, 'UTF-8');
    }
    public function setDono($dono)
    {
        //validacao
        return $this->dono = $dono;
    }
    public function setId($id)
    {
        //validacao
        return $this->id = $id;
    }

    public function cadastrar()
    {
        if ($this->getDono() != null) {
            $interacaoMySql = $this->conexaoBD->prepare("INSERT INTO pet (cliente_id, nome_pet) 
            VALUES (?, ?)");
            $interacaoMySql->bind_param('is', $this->getDono(), $this->getNome());
            $retorno = $interacaoMySql->execute();

            $id = mysqli_insert_id($this->conexaoBD);

            return $this->utilidades->validaRedirecionar($retorno, $id, "admin.php?rota=visualizar_pet", "O pet foi cadastrado com sucesso!");
        } else {
            return $this->utilidades->mesagemParaUsuario("Erro, cadastro não realizado! Dono não foi infomado.");
        }
    }
    public function editar()
    {

        if ($this->getId() != null) {

            $interacaoMySql = $this->conexaoBD->prepare("UPDATE pet set  cliente_id=?, nome_pet=? where id_pet=?");
            $interacaoMySql->bind_param('isi', $this->getDono(), $this->getNome(), $this->getId());
            $retorno = $interacaoMySql->execute();
            if ($retorno === false) {
                trigger_error($this->conexaoBD->error, E_USER_ERROR);
            }
            $id = mysqli_insert_id($this->conexaoBD);

            return $this->utilidades->validaRedirecionar($retorno, $this->getId(), "admin.php?rota=visualizar_pet", "Os dados do pet foram alterados com sucesso!");
        } else {
            return $this->utilidades->mesagemParaUsuario("Erro! Id não foi infomado.");
        }
    }

    public function selecionarPorId($id)
    {
        $sql = "select * from pet where id_pet=$id";
        $this->retornoBD = $this->conexaoBD->query($sql);
    }
    public function selecionarPorDono($dono)
    {
        $sql = "select * from pet where cliente_id=$dono";
        $this->retornoBD = $this->conexaoBD->query($sql);
    }
    public function selecionarPorNome($nome)
    {
        $sql = "select * from pet where nome_pet='$nome'";
        $this->retornoBD = $this->conexaoBD->query($sql);
    }
    public function selecionarPets()
    {
        $sql = "select * from pet order by data_cadastro_pet DESC";
        $this->retornoBD = $this->conexaoBD->query($sql);
    }

    public function deletar($id)
    {
        $sql = "DELETE from pet where id_pet=$id";
        $this->retornoBD = $this->conexaoBD->query($sql);
        $this->utilidades->validaRedirecionaAcaoDeletar($this->retornoBD, 'admin.php?rota=visualizar_pet', 'O pet foi deletado com sucesso!');
    }
}
