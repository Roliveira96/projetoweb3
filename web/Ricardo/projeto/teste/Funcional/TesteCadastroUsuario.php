<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Mensagem;
use \Framework\DW3BancoDeDados;

class TesteCadastroUsuario extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'cadastroUsuario');
        $this->verificarContem($resposta, 'cod_1991');


    }

    public function testeAcessar1()
    {
        $resposta = $this->get(URL_RAIZ . 'cadastroUsuario');
        $this->verificarNaoContem($resposta, 'cod_1992');


    }
}
