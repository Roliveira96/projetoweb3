<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{
    const BUSCAR_TODOS = 'SELECT id, texto, usuarios FROM mensagens ORDER BY id';
    const INSERIR = 'INSERT INTO usuarios(nome, sobrenome, email, senha) VALUES (?, ? , ? , ?)';
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';

    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $senha;

    public function __construct(
        $nome,
        $sobrenome,
        $email,
        $senha ,
        $id = null
    ) {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->senha = $senha;
        $this->id = $id;
    }


    public function salvar()
    {
        var_dump("entrou");
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


    public static function login($email,$senha){

        /// Fazer depois...



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
        var_dump("senha Plana --> " .$this->senha);
        var_dump("senha  --> " .$senhaPlana);

        if($this->senha == $senhaPlana)
        return true;
        else
            false;
    }

    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Mensagem(
                $registro['usuario'],
                $registro['texto'],
                $registro['id']
            );
        }
        return $objetos;
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
