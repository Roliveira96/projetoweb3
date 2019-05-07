<?php
namespace Controlador;

use \Modelo\Mensagem;

class LoginControlador extends Controlador
{
    public function loginPage()
    {

    $this->visao('login/index.php');
    
    }

    public function armazenar()
    {

        var_dump("teste");
        $mensagem = new Mensagem($_POST['usuario'], $_POST['texto']);
        $mensagem->salvar();
        $this->redirecionar(URL_RAIZ);
    }
}
