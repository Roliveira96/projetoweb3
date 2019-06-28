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
        $senha = $_POST['senha'];
        $senha1 = $_POST['senha1'];
        $email = $_POST['email'];
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;

        $usuario = new Usuario($nome, $sobrenome, $email, $senha, $senha1,null, $foto);

        if ($usuario->isValido()) {
          //  var_dump("deu certo");
            $usuario->salvar();
            DW3Sessao::set('usuario', $usuario);
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
