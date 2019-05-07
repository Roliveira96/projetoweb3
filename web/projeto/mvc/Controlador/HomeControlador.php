<?php
namespace Controlador;

use \Modelo\Mensagem;

class HomeControlador extends Controlador
{
    public function index()
    {
        $this->visao('home/index.php');
    }

    public function armazenar()
    {
        $mensagem = new Mensagem($_POST['usuario'], $_POST['texto']);
        $mensagem->salvar();
        $this->redirecionar(URL_RAIZ);
    }
}
