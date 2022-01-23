<?php

class Utilidades{

    public function __construct()    {
    }

    public function redireciona($link) {

        if ($link == -1) {
            echo" <script>history.go(-1);</script>";
        } else {
            echo" <script>document.location.href='$link'</script>";
        }
    }
    public function alerta($sucesso) {
        if ($sucesso) {
            echo "<script>alert('Operacao executada com sucesso!')</script>";
        } else {
            echo "<script>alert('Operacao nao foi executada!')</script>";
        }
    }
    
    public function mesagemParaUsuario($msg) {
        echo "<script>alert('$msg')</script>";
    }

    public function validaRedirecionar($retornoBanco, $id, $pag, $msg)  {
        if ($retornoBanco != 0) {
            $link = $pag . "&id=" . $id . '&msg=' . $msg;
            $this->redireciona($link);
            return true;
        } else {
            $this->alerta(false);
            return false;
        }
    }
    public function validaRedirecionaAcaoDeletar($retornoBanco, $pag, $msg) {
        if ($retornoBanco == 0) {
            $this->mesagemParaUsuario("O elemento não pode ser deletado!");
         } else {
            $url = $pag . '&msg=' . $msg;
            $this->redireciona($url);
        } 
      }

}
