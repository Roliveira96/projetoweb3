<?php
namespace Controlador;

use \Modelo\Mensagem;

class LoginControlador extends Controlador
{
    public function loginPage()
    {
var_dump("teste");
        $this->visao('login/index.php');
        $this->redirecionar(URL_RAIZ.'login');
    }

    public function armazenar()
    {
        $mensagem = new Mensagem($_POST['usuario'], $_POST['texto']);
        $mensagem->salvar();
        $this->redirecionar(URL_RAIZ);
    }
}
