<?php

namespace Controlador;

use Framework\DW3Sessao;
use \Modelo\Mensagem;

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
        $this->visao('quest/criar.php', [], 'logado.php');

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

        $usuarioID = DW3Sessao::get('usuario');

        var_dump($usuarioID);
        var_dump($_POST['titulo']);
        var_dump($_POST['descricao']);
        var_dump($_POST['select']);

        $foto = array_key_exists('img', $_FILES) ? $_FILES['img'] : null;

        var_dump($foto);
        die();
    }


}
