<?php

namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Sessao;


class LoginControlador extends Controlador
{
    public function loginPage()
    {

        $usuarioID = DW3Sessao::get('usuario');

        if (!$usuarioID) {
            $this->visao('login/index.php');

        } else {
            $this->redirecionar(URL_RAIZ . 'quest');

        }

    }


    public function loginPageAPI()
    {
        header('Content-Type: application/json');
        $usuarios = Usuario::buscarTodos();

        echo json_encode($usuarios);

    }


    public function destruirLogin()
    {
        DW3Sessao::deletar('usuario');

        $this->visao('login/index.php');

    }

    public function login()
    {
        setcookie('emailLogin', $_POST['usuario'], time() + 600);

        $usuario = Usuario::buscarEmail($_POST['usuario']);


        if ($usuario && $usuario->verificarSenha($_POST['senha'])) {
            DW3Sessao::set('usuario', $usuario);

           $this->redirecionar(URL_RAIZ . 'quest');


        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('login/index.php');

        }


    }

}
