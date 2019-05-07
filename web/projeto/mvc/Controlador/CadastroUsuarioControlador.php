<?php
namespace Controlador;

use \Modelo\Usuario;

class CadastroUsuarioControlador extends Controlador
{
    public function index()
    {

    $this->visao('cadastroUsuario/index.php');

    }

    public function armazenar()
    {

//        var_dump("Nome: " . $_POST['nome']);
//        var_dump("Sobrenome: " . $_POST['sobrenome']);
//        var_dump("Senha: " . $_POST['senha']);
//        var_dump("Senhare: " . $_POST['senhare']);
//        var_dump("Email: " . $_POST['email']);



        $usuario = new Usuario($_POST['nome'],$_POST['sobrenome'],$_POST['email'],$_POST['senha']);
        $usuario->salvar();


        $this->redirecionar(URL_RAIZ.'login');


    }

}
