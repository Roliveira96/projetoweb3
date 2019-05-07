<?php
namespace Controlador;

use \Modelo\Mensagem;

class CadastroUsuarioControlador extends Controlador
{
    public function index()
    {

    $this->visao('cadastroUsuario/index.php');

    }

    public function armazenar()
    {

        var_dump("teste");
        $mensagem = new Mensagem($_POST['usuario'], $_POST['texto']);
        $mensagem->salvar();
        $this->redirecionar(URL_RAIZ);
    }
}
