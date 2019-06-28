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
    private $img;

    public function __construct(
        $nome,
        $sobrenome,
        $email,
        $senha,
        $senha1,
        $id = null,
        $img

    )
    {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->senha = $senha;
        $this->senha1 = $senha1;
        $this->id = $id;
        $this->senhaCripto = password_hash($senha, PASSWORD_BCRYPT);
        $this->img = $img;
    }


    public function inserir()
    {


        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->sobrenome, PDO::PARAM_STR);
        $comando->bindValue(3, $this->email, PDO::PARAM_STR);
        $comando->bindValue(4, $this->senhaCripto, PDO::PARAM_STR);
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
                $registro['nome'],
                $registro['sobrenome'],
                $registro['email'],
                null,
                null,
                $registro['id_usuario'],
                null
            );
            $objeto->senha = $registro['senha'];
            $objeto->id = $registro['id_usuario'];
        }

        return $objeto;
    }

    public function verificarSenha($senhaPlana)
    {

        return password_verify($senhaPlana, $this->senha);

    }

    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            array_push($objetos, array(
                'nome' => $registro['nome'],
                'sobrenome' => $registro['sobrenome'],
                'email' => $registro['email']
            ));

        }


        return $objetos;
    }


    public function salvar()
    {
        $this->inserir();
        $this->salvarImagem();
    }


    public function getImagem()
    {
        $img = "$this->id .png";
        if (!DW3ImagemUpload::existe($img)) {
            $img = 'padrao.png';
        }
        return $img;
    }


    private function salvarImagem()
    {

        if (DW3ImagemUpload::isValida($this->img)) {
            $nomeCompleto = PASTA_PUBLICO . "img/$this->id .png";
            DW3ImagemUpload::salvar($this->img, $nomeCompleto);
        }
    }

    protected function verificarErros()
    {

        //Verifica o tamanho do nome
        if ($this->vereficaTamanhoString($this->nome, 2)) {
        } else {
            $this->insereError('nome');
        }

        //Verifica o tamanho do sobrenome
        if ($this->vereficaTamanhoString($this->sobrenome, 4)) {
        } else {
            $this->insereError('sobrenome');


        }

        //Verifica o tamanho da senha
        if ($this->vereficaTamanhoString($this->senha, 8)) {


            //Verificando se as senhas confere uma com a outra
            if ($this->senha == $this->senha1) {
            } else {
                $this->insereError('senhaDif');

            }

        } else {
            $this->insereError('senha');
            $this->insereError('senha1');

        }


        if ($this->vereficaTamanhoString($this->email, 8)) {


        } else {
            $this->insereError('email');


        }

        $array = self::buscarEmail($this->email);
        if (!$array) {
        } else {
            $this->insereError('emailexistente');
        }


    }


    private function vereficaTamanhoString($palavra, $tamanho)
    {
        return strlen($palavra) >= $tamanho;

    }


    private function insereError($campo)
    {
        switch ($campo) {
            case "nome" :
                $this->setErroMensagem('nome', 'O nome deve conter mais que 2 letras!');
                break;
            case  "sobrenome":
                $this->setErroMensagem('sobrenome', 'O sobrenome deve conter mais que 5 letras!');
                break;
            case  "senha":
                $this->setErroMensagem('senha', 'A senha deve conter no minimo 8 caracteres!');
                break;
            case  "senha1":
                $this->setErroMensagem('senha1', 'A senha deve conter no minimo 8 caracteres!');
                break;
            case  "email":
                $this->setErroMensagem('email', 'O email deve conter mais caracteres!');
                break;
            case  "senhaDif":
                $this->setErroMensagem('conf', 'As senhas estão diferente!');
                break;
            case  "emailexistente":
                $this->setErroMensagem('email', 'Ops, acho que você já é cadastrado em nosso sistema!');
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

    public function getNome()
    {
        return $this->nome;
    }


}
