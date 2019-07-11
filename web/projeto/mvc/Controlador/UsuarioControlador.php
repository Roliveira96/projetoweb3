<?php

namespace Controlador;

use Framework\DW3Sessao;
use \Modelo\Usuario;

class UsuarioControlador extends Controlador
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
        $senha = htmlentities($_POST['senha']);
        $senha1 = htmlentities($_POST['senha1']);
        $email = htmlentities($_POST['email']);


        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;

        $usuario = new Usuario($nome, $sobrenome, $email, $senha, $senha1, null, $foto);

        if ($usuario->isValido()) {
            $usuario->salvar();
            DW3Sessao::set('usuario', $usuario);
            $this->redirecionar('questao');

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
