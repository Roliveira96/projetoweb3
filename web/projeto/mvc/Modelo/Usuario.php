<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{
    const BUSCAR_TODOS = 'SELECT id, texto, usuario FROM mensagens ORDER BY id';
    const INSERIR = 'INSERT INTO usuario(nome, sobrenome, email, senha) VALUES (?, ? , ? , ?)';

    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $senha;

    public function __construct(
        $nome,
        $senha,
        $sobrenome,
        $email,
        $senha = null,
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
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->usuario, PDO::PARAM_STR);
        $comando->bindValue(2, $this->texto, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
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
}
