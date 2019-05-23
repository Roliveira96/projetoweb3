<?php
namespace Controlador;

use \Modelo\Pedido;

class PedidoControlador extends Controlador
{
    public function index()
    {
        $pedidos = Pedido::buscarTodos();
        $this->visao('pedidos/index.php', [
            'pedidos' => $pedidos
        ]);
    }

    public function criar()
    {
        $this->visao('pedidos/criar.php');
    }

    public function armazenar()
    {
        $mensagem = new Pedido($_POST['mesa'], $_POST['quantidade']);
        $mensagem->salvar();
        $this->redirecionar(URL_RAIZ);
    }
}
