<?php

namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Sessao;


class LoginControlador extends Controlador
{
    public function loginPage()
    {
        $usuarioID = DW3Sessao::get('usuario');

//        var_dump("Teste: --> " . $usuarioid);
//        var_dump("Teste: --> " . $usuarioid);
//        die();

        $this->visao('login/index.php');

    }


    public function login()
    {


// Criando Cookies
        $nome = "masterdaweb";
        $valor = "Cookie Criado com Sucesso";
        $expira = time() + 3600;

        setcookie('emailLogin', $_POST['usuario'], time() + 600);

        $usuario = Usuario::buscarEmail($_POST['usuario']);


        if ($usuario && $usuario->verificarSenha($_POST['senha'])) {
            DW3Sessao::set('usuario', $usuario->getId());
            $this->visao('perfil/index.php', [], 'logado.php');

        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('login/index.php');

        }

    }
}
