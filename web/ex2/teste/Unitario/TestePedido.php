<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Pedido;
use \Framework\DW3BancoDeDados;

class TestePedido extends Teste
{
    public function testeInserir()
    {
        $pedido = new Pedido('1', '2');
        $pedido->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM pedidos');
        $bdPedido = $query->fetch();
        $this->verificar($bdPedido['mesa'] === $pedido->getMesa());
        $this->verificar($query->rowCount() == 1);
    }

    public function testeBuscarTodos()
    {
        (new Pedido('1', '1'))->salvar();
        (new Pedido('2', '2'))->salvar();
        $pedidos = Pedido::buscarTodos();
        $this->verificar(count($pedidos) == 2);
    }
}
