<?php

namespace Modelo;

use Framework\DW3ImagemUpload;
use \PDO;
use \Framework\DW3BancoDeDados;

class Quest extends Modelo
{
    const BUSCAR_TODOS = 'SELECT * FROM usuarios ';
    const INSERIR = 'INSERT INTO quest(titulo, descricao, dificuldade) VALUES (?, ? , ? )';
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';

    private $id;
    private $titulo;
    private $descricao;
    private $dificuldade;
    private $img;


    public function __construct(
        $titulo,
        $descricao,
        $dificuldade,
        $id = null
    )
    {
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->dificuldade = $dificuldade;
        $this->id = $id;

    }


    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->titulo, PDO::PARAM_STR);
        $comando->bindValue(2, $this->descricao, PDO::PARAM_STR);
        $comando->bindValue(3, $this->dificuldade, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }


    public static function buscarPorId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_EMAIL);
        $comando->bindValue(1, $id, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Quest(
                $registro['titulo'],
                $registro['descricao'],
                $registro['dificuldade'],
                null
            );
            $objeto->id = $registro['id'];
        }


        return $objeto;
    }


    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Quest(
                $registro['titulo'],
                $registro['descricao'],
                $registro['dificuldade'],
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
            // var_dump("NOME maior ou igual");
        } else {
            //var_dump("Nome menor");
            $this->insereError('nome');
        }

        //Verifica o tamanho do sobrenome
        if ($this->vereficaTamanhoString($this->sobrenome, 4)) {
            // var_dump("SOBRENOME maior ou igual");
        } else {
            // var_dump("Sobrenome menor");
            $this->insereError('sobrenome');


        }

        //Verifica o tamanho da senha
        if ($this->vereficaTamanhoString($this->senha, 8)) {
            // var_dump("Senha maior ou igual");

            //Verificando se as senhas confere uma com a outra
            if ($this->senha == $this->senha1) {
                //var_dump("As senhas confere");
            } else {
                //  var_dump("As senhas não confere");
                $this->insereError('senhaDif');

            }

        } else {
            $this->insereError('senha');
            $this->insereError('senha1');

        }


        if ($this->vereficaTamanhoString($this->email, 8)) {
            //  var_dump("EMAIL maior ou igual");


        } else {
            //  var_dump("Email menor");
            $this->insereError('email');


        }

        $array = self::buscarEmail($this->email);
        var_dump($this->email);
        if (!$array) {
            var_dump("Não exite o email ");
        } else {
            var_dump("O email já existe em nossa base ");
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


}
