<?php
namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Sessao;

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



        $usuario = Usuario::buscarEmail($_POST['usuario']);
        if ($usuario && $usuario->verificarSenha($_POST['senha'])) {
           DW3Sessao::set('usuario', $usuario->getId());
            $this->redirecionar(URL_RAIZ );
            var_dump("deu certo");
        } else {
           $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('login/index.php');
            var_dump("deu ruim");
        }

    }
}
