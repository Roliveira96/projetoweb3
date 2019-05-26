<?php

namespace Controlador;

use \Modelo\Usuario;

class CadastroUsuarioControlador extends Controlador
{

    private $error =['erros' => 'Foram encontrado alguns erros'];

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
//        var_dump("Email: " . );

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


        //$usuario = new Usuario("ricardo", $_POST['sobrenome'], $_POST['email'], $_POST['senha']);
        //  $usuario->salvar();
        // setcookie('emailLogin', $_POST['email'], time() +100);

        $this->setErros($this->error);

        $this->visao('cadastroUsuario/index.php');


    }


    private function vereficaTamanhoString($palavra, $tamanho)
    {
        return strlen($palavra) >= $tamanho;


    }

    private function insereError($campo)
    {


        switch ($campo) {
            case "nome" :
                $this->error += ['nome' => 'O nome deve conter mais que 2 letras!'];
                break;
            case  "sobrenome":
                $this->error += ['sobrenome' => 'O sobrenome deve conter mais que 5 letras!'];
                break;
            case  "senha":
                $this->error += ['senha' => 'A senha deve conter no minimo 8 caracteres!'];
                break;
            case  "senha1":
                $this->error += ['senha1' => 'A senha deve conter no minimo 8 caracteres!'];
                break;
            case  "email":
                $this->error += ['email' => 'O email deve conter mais caracteres!'];
                break;
                case  "senhaDif":
                $this->error += ['conf' => 'As senhas estão diferente!'];
                break;
        }

        var_dump($this->error);

    }
}