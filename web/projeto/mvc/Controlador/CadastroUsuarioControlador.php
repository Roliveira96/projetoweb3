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
        $email = $_POST['email'];

        var_dump($this->haErros);
        if ($this->haErros) {
            $this->setErros($this->errors);
            $this->Visao('cadastroUsuario/index.php',
                [
                    'nome' => $nome,
                    'sobrenome' => $sobrenome,
                    'email' => $email]

            );
        } else {
            $usuario = new Usuario($nome, $sobrenome, $email, $senha);
            if($usuario->isValido()){
                var_dump("deu certo");
            }
            else{
                var_dump("deu ruim");

            }


          //  $usuario = new Usuario($nome, $sobrenome, $email, $senha);
            $usuario->salvar();
            DW3Sessao::set('usuario' , $usuario->getId());
            $this->redirecionar('perfil');


        }


    }


}