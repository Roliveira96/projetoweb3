<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Pedido extends Modelo
{
    const BUSCAR_TODOS = 'SELECT * FROM pedidos ORDER BY id DESC';
    const INSERIR = 'INSERT INTO pedidos(mesa,quantidade) VALUES (?, ?)';
    private $id;
    private $mesa;
    private $quantidade;

    public function __construct(
        $mesa,
        $quantidade,
        $id = null
    ) {
        $this->mesa = $mesa;
        $this->quantidade = $quantidade;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMesa()
    {
        return $this->mesa;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function salvar()
    {
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->mesa);
        $comando->bindValue(2, $this->quantidade);
        $comando->execute();
    }

    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Pedido(
                $registro['mesa'],
                $registro['quantidade'],
                $registro['id']
            );
        }
        return $objetos;
    }
}
