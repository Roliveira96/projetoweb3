<?php

namespace Controlador;

use Framework\DW3Sessao;
use \Modelo\Usuario;

class CadastroUsuarioControlador extends Controlador
{

    private $errors = ['erros' => 'Foram encontrado alguns erros'];
    private $haErros = false;

    public function index()
    {

        $this->visao('cadastroUsuario/index.php');

    }

    public function armazenar()
    {


        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $senha = $_POST['senha'];
        $senha1 = $_POST['senha1'];
        $email = $_POST['email'];
        $usuario = new Usuario($nome, $sobrenome, $email, $senha, $senha1);

        if ($usuario->isValido()) {
          //  var_dump("deu certo");
            $usuario->salvar();
            DW3Sessao::set('usuario', $usuario->getId());
            $this->redirecionar('quest/relatorioPage');

        } else {

            $this->setErros($usuario->getValidacaoErros());
            $this->visao('cadastroUsuario/index.php', [
                'nome' => $nome,
                'sobrenome' => $sobrenome,
                'email' => $email
            ]);

        }


    }


}
