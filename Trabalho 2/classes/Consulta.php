<?php
include_once("../classes/Conexao.php");
include_once("../classes/Utilidades.php");
class Consulta
{
    private $observacoes;
    private $cliente_id;
    private $pet_id;
    private $data;
    private $hora;
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
    public function getCliente_id()
    {
        return $this->cliente_id;
    }
    public function getPet_id()
    {
        return $this->pet_id;
    }
    public function getObservacoes()
    {
        return $this->observacoes;
    }
    public function getData()
    {
        return $this->data;
    }
    public function getHora()
    {
        return $this->hora;
    }
    public function setId($var)
    {
        return $this->id = $var;
    }
    public function setCliente_id($var)
    {
        return $this->cliente_id = $var;
    }
    public function setPet_id($var)
    {
        return $this->pet_id = $var;
    }
    public function setObservacoes($var)
    {
        return $this->observacoes = $var;
    }
    public function setData($var)
    {
        return $this->data = $var;
    }
    public function setHora($var)
    {
        return $this->hora = $var;
    }

    public function cadastrar()
    {
        if ($this->getCliente_id() != null && $this->getPet_id() != null) {
            $interacaoMySql = $this->conexaoBD->prepare("INSERT INTO consultas (cliente_id, pet_id, data, hora, observacoes) 
            VALUES (?, ?, ?, ?, ?)");
            $interacaoMySql->bind_param('iisss', $this->getCliente_id(), $this->getPet_id(), $this->getData(), $this->getHora(), $this->getObservacoes());
            $retorno = $interacaoMySql->execute();

            $id = mysqli_insert_id($this->conexaoBD);

            return $this->utilidades->validaRedirecionar($retorno, $id, "admin.php?rota=visualizar_consulta", "O consulta foi cadastrado com sucesso!");
        } else {
            return $this->utilidades->mesagemParaUsuario("Erro, cadastro não realizado! Cliente e/ou pet não foi infomado.");
        }
    }
    public function editar()
    {

        if ($this->getId() != null) {

            $interacaoMySql = $this->conexaoBD->prepare("UPDATE consultas set  cliente_id=?, pet_id=?, data=?, hora=?, observacoes=? where id_consulta=?");
            $interacaoMySql->bind_param('iisssi', $this->getCliente_id(), $this->getPet_id(), $this->getData(), $this->getHora(), $this->getObservacoes(), $this->getId());
            $retorno = $interacaoMySql->execute();
            if ($retorno === false) {
                trigger_error($this->conexaoBD->error, E_USER_ERROR);
            }
            $id = mysqli_insert_id($this->conexaoBD);

            return $this->utilidades->validaRedirecionar($retorno, $this->getId(), "admin.php?rota=visualizar_consulta", "Os dados da consulta foram alterados com sucesso!");
        } else {
            return $this->utilidades->mesagemParaUsuario("Erro! Id não foi infomado.");
        }
    }

    public function selecionarPorId($id)
    {
        $sql = "select * from consultas where id_consulta=$id";
        $this->retornoBD = $this->conexaoBD->query($sql);
    }
    public function selecionarPorData($data)
    {
        $sql = "select * from consultas where data='$data'";
        $this->retornoBD = $this->conexaoBD->query($sql);
    }
    public function selecionarConsultas()
    {
        $sql = "select * from consultas order by data_cadastro_consulta DESC";
        $this->retornoBD = $this->conexaoBD->query($sql);
    }

    public function deletar($id)
    {
        $sql = "DELETE from consultas where id_consulta=$id";
        $this->retornoBD = $this->conexaoBD->query($sql);
        $this->utilidades->validaRedirecionaAcaoDeletar($this->retornoBD, 'admin.php?rota=visualizar_consulta', 'A consulta foi deletado com sucesso!');
    }
}
