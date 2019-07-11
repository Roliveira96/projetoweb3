<?php

namespace Teste\Funcional;

use Framework\DW3Sessao;
use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteResponder extends Teste
{


    public function testeLogin()
    {


        $login =TesteResponder::salvarUsuario();

        $this->verificar(DW3Sessao::get('usuario') != null);

        $this->verificarRedirecionar($login, URL_RAIZ . 'questao');


    }

    public function testeMinhasQuestoesPagina()
    {

        $login =TesteResponder::salvarUsuario();


        $resposta = $this->get(URL_RAIZ . 'questao/responderPagina');

        $this->verificarContem($resposta, 'responder');
        $this->verificar(DW3Sessao::get('usuario') != null);

    }






    private function salvarUsuario()
    {

        (new Usuario('Ricardo', 'de Oliveira', 'ricardo.de.oliveira@ricardo.com', '123456789', '123456789', null, null))->salvar();

        $login = $this->post(URL_RAIZ . 'login', [
            'usuario' => 'ricardo.de.oliveira@ricardo.com',
            'senha' => '123456789'
        ]);
        return $login;

    }
}
