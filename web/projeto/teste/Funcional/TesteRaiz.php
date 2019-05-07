<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Mensagem;
use \Framework\DW3BancoDeDados;

class TesteRaiz extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificarContem($resposta, 'cod_1990');

//        $resposta = $this->get(URL_RAIZ.'login');
//        $this->verificarContem($resposta, 'home_1992');
//
//        $resposta = $this->get(URL_RAIZ.'cadastroUsuario');
//        $this->verificarContem($resposta, 'home_1991');


    }
}
