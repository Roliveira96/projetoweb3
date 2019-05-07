<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Mensagem;
use \Framework\DW3BancoDeDados;

class TesteLogin extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'cod_1992');


    }
}
