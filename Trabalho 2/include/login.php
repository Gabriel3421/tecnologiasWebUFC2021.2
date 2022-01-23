<?php
session_start();
include("../classes/Conexao.php");
include("../classes/Utilidades.php");
if (isset($_POST['login'])) {
  $objConexao = new Conexao();
  $conexaoBD = $objConexao->getConexao();
  $utilidades = new Utilidades();
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "select * from admins where email_admin='$email' and senha_admin='$password'";
  $retornoBD = $conexaoBD->query($sql);
  if (!$retornoBD) {
    $utilidades->alerta(false);
  } else {
    $_SESSION["administrador"] = 'true';

    $utilidades->redireciona("/trabalho/produto/admin.php");
    // echo $retornoBD->fetch_object()->id_admin;
  }
}
