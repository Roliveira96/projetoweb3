<?php

namespace Controlador;

use Framework\DW3Sessao;
use Modelo\Quest;

class ControladorQuest extends Controlador
{
    public function index()
    {

        $usuario = DW3Sessao::get('usuario');

        if ($usuario) {

            $paginacao = $this->calcularPaginacao(null);


            $this->visao('quest/index.php', [
                'questoes' =>  $paginacao['questoes'],
                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
            ], 'logado.php');
        } else {
            $this->redirecionar(URL_RAIZ . 'login');

        }



    }

    private function calcularPaginacao($id)
    {
        if($id){
            $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
            $limit = 4;
            $offset = ($pagina - 1) * $limit;
            $questoes = Quest::buscarPorId($limit, $offset , $id);
            $ultimaPagina = ceil(Quest::contarTodosId($id) / $limit);
            return compact('pagina', 'questoes', 'ultimaPagina');

        }else{

            $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
            $limit = 4;
            $offset = ($pagina - 1) * $limit;
            $questoes = Quest::buscarTodos($limit, $offset);
            $ultimaPagina = ceil(Quest::contarTodos() / $limit);
            return compact('pagina', 'questoes', 'ultimaPagina');
        }

    }

    public function noLogado()
    {
        $this->visao('quest/noLogado.php');
    }

    public function criarPageQuest()
    {
        $usuario = DW3Sessao::get('usuario');

        if ($usuario) {
            $this->visao('quest/criar.php', ['sucesso' => DW3Sessao::getFlash('sucesso')], 'logado.php');
        } else {
            $this->redirecionar(URL_RAIZ . 'login');

        }

    }

    public function responderPageQuest()
    {

        $usuario = DW3Sessao::get('usuario');
        if ($usuario) {

            $paginacao = $this->calcularPaginacao($usuario->getId());


            $flash = DW3Sessao::getFlash('flash');
            $valores = DW3Sessao::get('acertou');


            $this->visao('quest/responder.php', [
                'questoes' =>  $paginacao['questoes'],
                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
                'flash' => $flash,
                'valores' => $valores
            ], 'logado.php');




          //  $questoes = Quest::buscarPorId($usuario->getId());


//
//            $this->visao('quest/responder.php',
//                [
//
//                    'questoes' =>  $paginacao['questoes'],
//                    'pagina' => $paginacao['pagina'],
//                    'ultimaPagina' => $paginacao['ultimaPagina'],
////                    'questoes' => $questoes,
//
//                ],
//                'logado.php');

        } else {
            $this->redirecionar(URL_RAIZ . 'login');
        }


    }

    public function relatorioPageQuest()
    {

        $usuario = DW3Sessao::get('usuario');

        if ($usuario) {

            //$questoes = Quest::buscarTodos($limit, $offset);

//$facil =  Quest::categoriaFacil()

            $this->visao('quest/relatorio.php', [

            ], 'logado.php');
        } else {
            $this->redirecionar(URL_RAIZ . 'login');

        }
    }

    public function respostaQuest()
    {

        $usuario = DW3Sessao::get('usuario');
        if ($usuario) {


            $alternativaCorreta = $_POST['alternativaCorreta'];
            $id_quest = $_POST['id_quest'];
            $id_user = $usuario->getId();

            $verdadeiroOuFalso = Quest::validacaoQuest($id_quest, $alternativaCorreta, $id_user);

            if ($verdadeiroOuFalso) {
                DW3Sessao::setFlash('flash', 'Que maravilha você acertou! 😉');
                DW3Sessao::set('acertou',
                    [
                        'alternativa' => $alternativaCorreta ,
                        'resultado' => $verdadeiroOuFalso ,
                        'id_quest' => $id_quest
                    ]);

                $this->redirecionar(URL_RAIZ . 'quest/responderPage');

            } else {

                DW3Sessao::setFlash('flash', 'Ops, eita, melhor dedicar mais na próxima! 😭');
                DW3Sessao::set('acertou',
                    [
                        'alternativa' => $alternativaCorreta ,
                        'resultado' => $verdadeiroOuFalso ,
                        'id_quest' => $id_quest
                    ]);
                $this->redirecionar(URL_RAIZ . 'quest/responderPage');
            }

        } else {
            $this->redirecionar(URL_RAIZ . 'login');
        }
    }

    public function salvarQuest()
    {

        $usuario = DW3Sessao::get('usuario');

        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;

        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $dificuldade = $_POST['select'];
        $a = $_POST['a'];
        $b = $_POST['b'];
        $c = $_POST['c'];
        $d = $_POST['d'];
        $e = $_POST['e'];

        $foto = array_key_exists('img', $_FILES) ? $_FILES['img'] : null;

        if ($usuario) {

            if (isset($_POST['alternativaCorreta'])) {
                $alternativaCorreta = $_POST['alternativaCorreta'];

                $questao = new Quest(
                    $usuario,
                    $usuario->getId(),
                    $titulo,
                    $descricao,
                    $dificuldade,
                    $alternativaCorreta,
                    ["a" => $a, "b" => $b, "c" => $c, "d" => $d, "e" => $e],
                    $foto,
                    null
                );

                if ($questao->isValido()) {
                    $questao->salvar();
                    DW3Sessao::setFlash('sucesso', 'Quest salva com sucesso! 😉');
                    $this->redirecionar(URL_RAIZ . 'quest/criarPage');

                } else {
                    $this->setErros($questao->getValidacaoErros());
                    $this->visao('quest/criar.php',

                        [
                            'titulo' => $titulo,
                            'descricao' => $descricao,
                            'dificuldade' => $dificuldade,
                            'a' => $a,
                            'b' => $b,
                            'c' => $c,
                            'd' => $d,
                            'e' => $e,
                            'alternativaCorreta' => $alternativaCorreta,
                            'sucesso' => null

                        ]
                    );
                }

            } else {
                $this->setErros(['alternativa' => 'Tem que selecionar uma alternativa correta para proceguir 😶']);

                $this->visao('quest/criar.php',

                    [
                        'titulo' => $titulo,
                        'descricao' => $descricao,
                        'dificuldade' => $dificuldade,
                        'a' => $a,
                        'b' => $b,
                        'c' => $c,
                        'd' => $d,
                        'e' => $e,
                        'alternativaCorreta' => null,
                        'sucesso' => null

                    ]
                );
            }

        } else {
            $this->redirecionar(URL_RAIZ . 'login');
        }

    }


}
