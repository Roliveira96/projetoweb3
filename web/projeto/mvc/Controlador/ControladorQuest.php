<?php

namespace Controlador;

use Framework\DW3Sessao;
use \Modelo\Mensagem;
use Modelo\Quest;

class ControladorQuest extends Controlador
{
    public function index()
    {
        $this->visao('quest/index.php', [], 'logado.php');
    }

    public function noLogado()
    {
        $this->visao('quest/noLogado.php');
    }

    public function criarPageQuest()
    {
        $usuario = DW3Sessao::get('usuario');

        if ($usuario) {
            $this->visao('quest/criar.php', [], 'logado.php');
        } else {
            $this->redirecionar(URL_RAIZ . 'login');

        }

    }

    public function responderPageQuest()
    {
        $this->visao('quest/responder.php', [], 'logado.php');

    }

    public function relatorioPageQuest()
    {
        $this->visao('quest/relatorio.php', [], 'logado.php');

    }


    public function salvarQuest()
    {

        $usuario = DW3Sessao::get('usuario');

        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $dificuldade = $_POST['select'];
        $a = $_POST['a'];
        $b = $_POST['b'];
        $c = $_POST['c'];
        $d = $_POST['d'];
        $e = $_POST['e'];


        if ($usuario) {

            if (isset($_POST['alternativaCorreta'])) {
                //var_dump("Deu boa existe");
                $alternativaCorreta = $_POST['alternativaCorreta'];
                // echo "Titulo: " . $titulo . " Descrição: " . $descricao . " Dificuldade: " . $dificuldade . " a: " . $a . " b: " . $b . " c: " . $c . " d: " . $d . " e: " . $e . " Alternativa selecionada para ser a correta: " . $alternativaCorreta;
                $questao = new Quest(
                    $usuario->getId(),
                    $titulo,
                    $descricao,
                    $dificuldade,
                    $alternativaCorreta,
                    ["a" => $a, "b" => $b, "c" => $c, "d" => $d, "e" => $e],
                    null
                );

                if ($questao->isValido()) {
                    echo "è valido";
                } else {
                    echo "não é valido";

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
                            'alternativaCorreta' => $alternativaCorreta

                        ]
                    );
                }
                echo "fim de teste";
//                $questao->vereficaValorVetorTeste();
//
//                $arrayAlternativas = $questao->getAlternativas();
//
//                foreach ($arrayAlternativas as $alternativa) {
//                    echo "<br>" . $alternativa;
//                }


            } else {
                var_dump("Deu ruim não existe");
            }

        }

        $foto = array_key_exists('img', $_FILES) ? $_FILES['img'] : null;

        // var_dump($foto);
        die();
    }


}
