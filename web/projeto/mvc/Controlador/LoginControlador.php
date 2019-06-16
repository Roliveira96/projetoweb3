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
            $this->visao('quest/index.php', [], 'logado.php');
        }


    }


    public function loginPageAPI()
    {
        //Mudar o header quando for redirecionar para html
        header('Content-Type: application/json');

        $usuarios = Usuario::buscarTodos();

        // $this->visao('login/index.php');

        //Mudar para o metodo da api
        echo json_encode($usuarios);

    }


    public function destruirLogin()
    {
        DW3Sessao::deletar('usuario');

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
            DW3Sessao::set('usuario', $usuario);
            $this->visao('quest/index.php', [], 'logado.php');

        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('login/index.php');

        }


    }

}
