<?php

namespace Teste\Funcional;

use Framework\DW3Sessao;
use Modelo\Questao;
use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteRelatorio extends Teste
{


    public function testeLogin()
    {


        $login = TesteRelatorio::salvarUsuario();

        $this->verificar(DW3Sessao::get('usuario') != null);

        $this->verificarRedirecionar($login, URL_RAIZ . 'questao');


    }

    public function testeMinhasQuestoesPagina()
    {

        $login = TesteRelatorio::salvarUsuario();


        $resposta = $this->get(URL_RAIZ . 'questao/relatorioPagina');

        $this->verificarContem($resposta, 'relatorio');
        $this->verificar(DW3Sessao::get('usuario') != null);

    }


    public function testeResponderCerto()
    {

        TesteRelatorio::salvarOutroUsuario();
        $login = TesteRelatorio::salvarUsuario();

        $usuario = DW3Sessao::get('usuario');


        $resposta = $this->get(URL_RAIZ . 'questao/responderPagina');
        $todasQuestoes = Questao::buscarPorId(4, 0, $usuario->getId(), 'facil');
        foreach ($todasQuestoes as $questao) {
            $resposta = $this->post(URL_RAIZ . 'questao/responderPagina', [
                'id_quest' => $questao->getId(),
                'pagina' => 1,
                'alternativaCorreta' => 'rua'

            ]);
            $resposta = $this->get(URL_RAIZ . 'questao/responderPagina');
            $this->verificarContem($resposta, 'Que maravilha você acertou');

        }

    }

    public function testeRelatorio()
    {


        $login = TesteRelatorio::salvarUsuario();

        $usuario = DW3Sessao::get('usuario');


        $resposta = $this->get(URL_RAIZ . 'questao/relatorioPagina' .'facil');

        $resposta = $this->get(URL_RAIZ . 'questao/relatorioPagina');
        $this->verificarContem($resposta, 'facil');

    }
    public function testeRelatorio1()
    {


        $login = TesteRelatorio::salvarUsuario();

        $usuario = DW3Sessao::get('usuario');


        $resposta = $this->get(URL_RAIZ . 'questao/relatorioPagina' .'media');

        $resposta = $this->get(URL_RAIZ . 'questao/relatorioPagina');
        $this->verificarContem($resposta, 'media');

    }
    public function testeRelatorio2()
    {


        $login = TesteRelatorio::salvarUsuario();

        $usuario = DW3Sessao::get('usuario');


        $resposta = $this->get(URL_RAIZ . 'questao/relatorioPagina' .'dificil');

        $resposta = $this->get(URL_RAIZ . 'questao/relatorioPagina');
        $this->verificarContem($resposta, 'dificil');

    }


    private function salvarOutroUsuario()
    {

        (new Usuario('Bruna', 'Camomila', 'bruna.camomila@gmail.com', '123456789', '123456789', null, null))->salvar();

        $login = $this->post(URL_RAIZ . 'login', [
            'usuario' => 'bruna.camomila@gmail.com',
            'senha' => '123456789'
        ]);

        $resposta = $this->post(URL_RAIZ . 'questao/criarPagina', [
            'titulo' => 'O que é, o que é?',
            'descricao' => 'O que é, o que é? Feito para andar e não anda facil.',
            'select' => 'facil',
            'a' => 'Carro',
            'b' => 'Sapato',
            'c' => 'Violão',
            'd' => 'rua',
            'e' => 'Spacionave',
            'alternativaCorreta' => 'd'

        ]);
        $resposta = $this->get(URL_RAIZ . 'questao/minhasQuestoesPagina');
        $this->verificarContem($resposta, ' O que &eacute;, o que &eacute;? Feito para andar e n&atilde;o anda facil');


        $resposta = $this->post(URL_RAIZ . 'questao/criarPagina', [
            'titulo' => 'O que é, o que é?',
            'descricao' => 'O que é, o que é? Feito para andar e não anda media.',
            'select' => 'media',
            'a' => 'Carro',
            'b' => 'Sapato',
            'c' => 'Violão',
            'd' => 'rua',
            'e' => 'Spacionave',
            'alternativaCorreta' => 'd'

        ]);
        $resposta = $this->get(URL_RAIZ . 'questao/minhasQuestoesPagina');
        $this->verificarContem($resposta, ' O que &eacute;, o que &eacute;? Feito para andar e n&atilde;o anda media');


        $resposta = $this->post(URL_RAIZ . 'questao/criarPagina', [
            'titulo' => 'O que é, o que é?',
            'descricao' => 'O que é, o que é? Feito para andar e não anda dificil.',
            'select' => 'dificil',
            'a' => 'Carro',
            'b' => 'Sapato',
            'c' => 'Violão',
            'd' => 'rua',
            'e' => 'Spacionave',
            'alternativaCorreta' => 'd'

        ]);


        $resposta = $this->get(URL_RAIZ . 'questao/minhasQuestoesPagina');
        $this->verificarContem($resposta, ' O que &eacute;, o que &eacute;? Feito para andar e n&atilde;o anda dificil');

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
