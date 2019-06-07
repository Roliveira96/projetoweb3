<?php

namespace Modelo;

use Framework\DW3ImagemUpload;
use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{
    const BUSCAR_TODOS = 'SELECT * FROM usuarios ';
    const INSERIR = 'INSERT INTO usuarios(nome, sobrenome, email, senha) VALUES (?, ? , ? , ?)';
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';

    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $senha;
    private $senhaCripto;

    public function __construct(
        $nome,
        $sobrenome,
        $email,
        $senha,
        $senha1,
        $id = null
    )
    {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->senha = $senha;
        $this->senha1 = $senha1;
        $this->id = $id;
        $this->senhaCripto = password_hash($senha, PASSWORD_BCRYPT);
    }


    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->sobrenome, PDO::PARAM_STR);
        $comando->bindValue(3, $this->email, PDO::PARAM_STR);
        $comando->bindValue(4, $this->senha, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }


    public static function buscarEmail($email)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_EMAIL);
        $comando->bindValue(1, $email, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                '',
                '',
                $registro['email'],
                null,
                $registro['id_usuario']
            );
            $objeto->senha = $registro['senha'];
        }

        return $objeto;
    }

    public function verificarSenha($senhaPlana)
    {

        //  return password_verify($senhaPlana, $this->senha);
        //  var_dump("senha Plana --> " .$this->senha);
        // var_dump("senha  --> " .$senhaPlana);

        if ($this->senha == $senhaPlana)
            return true;
        else
            false;
    }

    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Usuario(
                $registro['nome'],
                $registro['sobrenome'],
                null,
                null
            );
        }

        //  var_dump($objetos);
        return $objetos;
    }



    public function salvar()
    {
        $this->inserir();
        $this->salvarImagem();
    }


    public function getImagem()
    {
        $imagemNome = "{$this->id}.png";
        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = 'padrao.png';
        }
        return $imagemNome;
    }


    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/{$this->id}.png";
            DW3ImagemUpload::salvar($this->foto, $nomeCompleto);
        }
    }

    protected function verificarErros()
    {

        //Verifica o tamanho do nome
        if ($this->vereficaTamanhoString($this->nome, 2)) {
            var_dump("NOME maior ou igual");
        } else {
            var_dump("Nome menor");
            $this->insereError('nome');
        }

        //Verifica o tamanho do sobrenome
        if ($this->vereficaTamanhoString($this->sobrenome, 4)) {
            var_dump("SOBRENOME maior ou igual");
        } else {
            var_dump("Sobrenome menor");
            $this->insereError('sobrenome');


        }

        //Verifica o tamanho da senha
        if ($this->vereficaTamanhoString($this->senha, 8)) {
            var_dump("Senha maior ou igual");

            //Verificando se as senhas confere uma com a outra
            if ($this->senha == $this->senha1) {
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
        if ($this->vereficaTamcanhoString($this->email, 8)) {
            var_dump("EMAIL maior ou igual");


        } else {
            var_dump("Email menor");
            $this->insereError('email');


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


    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }


}
