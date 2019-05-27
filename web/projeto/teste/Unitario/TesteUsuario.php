<?php

namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;


class TesteUsuario extends Teste
{

    public function testeInserir()
    {
        $usuario = new Usuario('Bruna', 'Schwab', 'bruna@bruna.com', '12345');
        $usuario->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios');
        $baseUsuario = $query->fetch();
        var_dump("Quantidade de registros: " . $query->rowCount());
        var_dump("Email do usuario vindo do banco: ".$baseUsuario['email']);
        var_dump("Email do usuario vindo da aplicação: " . $usuario->getEmail());

        $this->verificar($baseUsuario['email'] === $usuario->getEmail());
        $this->verificar($query->rowCount() == 1);
    }

//    public function testeBuscarTodos()
//    {
//        (new Pedido('1', '1'))->salvar();
//        (new Pedido('2', '2'))->salvar();
//        $pedidos = Pedido::buscarTodos();
//        $this->verificar(count($pedidos) == 2);
//    }

}
