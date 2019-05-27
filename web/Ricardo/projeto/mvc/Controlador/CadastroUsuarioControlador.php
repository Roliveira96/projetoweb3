<?php

namespace Controlador;

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


        //Verifica o tamanho do nome
        if ($this->vereficaTamanhoString($nome, 2)) {
            var_dump("NOME maior ou igual");
        } else {
            var_dump("Nome menor");
            $this->insereError('nome');
        }

        //Verifica o tamanho do sobrenome
        if ($this->vereficaTamanhoString($sobrenome, 4)) {
            var_dump("SOBRENOME maior ou igual");
        } else {
            var_dump("Sobrenome menor");
            $this->insereError('sobrenome');


        }

        //Verifica o tamanho da senha
        if ($this->vereficaTamanhoString($senha, 8)) {
            var_dump("Senha maior ou igual");

            //Verificando se as senhas confere uma com a outra
            if ($senha == $_POST['senhare']) {
                var_dump("As senhas confere");
            } else {
                var_dump("As senhas não confere");
                $this->insereError('senhaDif');

            }

        } else {
            var_dump("Senha menor");
            $this->insereError('senha');
            $this->insereError('senha1');

        }


        //Verifica o tamanho do email
        if ($this->vereficaTamanhoString($email, 8)) {
            var_dump("EMAIL maior ou igual");



        } else {
            var_dump("Email menor");
            $this->insereError('email');


        }


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

            $this->redirecionar('perfil');


        }


    }


    private function vereficaTamanhoString($palavra, $tamanho)
    {
        return strlen($palavra) >= $tamanho;


    }

    private function insereError($campo)
    {
        $this->haErros = true;
        switch ($campo) {
            case "nome" :
                $this->errors += ['nome' => 'O nome deve conter mais que 2 letras!'];
                break;
            case  "sobrenome":
                $this->errors += ['sobrenome' => 'O sobrenome deve conter mais que 5 letras!'];
                break;
            case  "senha":
                $this->errors += ['senha' => 'A senha deve conter no minimo 8 caracteres!'];
                break;
            case  "senha1":
                $this->errors += ['senha1' => 'A senha deve conter no minimo 8 caracteres!'];
                break;
            case  "email":
                $this->errors += ['email' => 'O email deve conter mais caracteres!'];
                break;
            case  "senhaDif":
                $this->errors += ['conf' => 'As senhas estão diferente!'];
                break;
        }


    }
}