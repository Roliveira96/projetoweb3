<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Pedido;
use \Framework\DW3BancoDeDados;

class TesteLancarPedido extends Teste
{
    public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'lancar_pedido');
        $this->verificarContem($resposta, 'input name="mesa"');
        $this->verificarContem($resposta, 'input name="quantidade"');
    }

    public function testeArmazenar()
    {
        $resposta = $this->post(URL_RAIZ . 'lancar_pedido', [
        	'mesa' => '321',
        	'quantidade' => '432'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ);
        $query = DW3BancoDeDados::query('SELECT * FROM pedidos');
        $registro = $query->fetch();
        $this->verificar($registro['mesa'] == '321');
        $this->verificar($registro['quantidade'] == '432');
    }
}
