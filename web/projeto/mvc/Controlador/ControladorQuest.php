<?php

namespace Controlador;

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


    public  function  salvarQuest(){
        var_dump($_POST['titulo']);
        var_dump($_POST['descricao']);
        var_dump($_POST['select']);
        die();
    }


}
