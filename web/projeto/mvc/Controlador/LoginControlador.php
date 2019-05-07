<?php
namespace Controlador;

use \Modelo\Usuario;

class LoginControlador extends Controlador
{
    public function loginPage()
    {

    $this->visao('login/index.php');

    }


    public function login()
    {

        var_dump("Email: " . $_POST['usuario']);
        var_dump("Senha: " . $_POST['senha']);

        $usuario = new Usuario();

        $usuario->login($_POST['usuario'] , $_POST['senha'] );


    }
}
