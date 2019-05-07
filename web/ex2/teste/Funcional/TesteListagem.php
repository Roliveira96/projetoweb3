<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Pedido;
use \Framework\DW3BancoDeDados;

class TesteListagem extends Teste
{
    public function testeListagemVazia()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificarContem($resposta, 'Nenhum pedido encontrado');
    }

    public function testeListagemComPedido()
    {
        (new Pedido('123', '456'))->salvar();
        $resposta = $this->get(URL_RAIZ);
        $this->verificarContem($resposta, '123');
        $this->verificarContem($resposta, '456');
    }
}
